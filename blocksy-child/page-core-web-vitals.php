<?php
/**
 * Plugin Name: WP Growth Connector
 * Description: REST-API für Audits & Auto-Fixes (Yoast/RankMath kompatibel) + Debug.
 * Version: 1.3.0
 * Author: Hasim
 */

if (!defined('ABSPATH')) exit;

/**
 * 0) ENV & CONFIG
 * - API-Key kommt aus wp-config.php: define('GROWTH_API_KEY','...'); (empfohlen)
 * - Fallback: optionaler Filter growth/api_key, falls du Key zur Laufzeit setzen willst.
 */
function growth_get_api_key(): string {
    if (defined('GROWTH_API_KEY') && GROWTH_API_KEY !== '') return (string) GROWTH_API_KEY;
    $k = apply_filters('growth/api_key', '');
    return is_string($k) ? $k : '';
}

/**
 * 1) SEO-Umgebung erkennen
 */
function growth_seo_env(): array {
    $yoast    = defined('WPSEO_VERSION') || class_exists('WPSEO_Frontend');
    $rankmath = defined('RANK_MATH_VERSION') || class_exists('RankMath');
    return ['yoast'=>$yoast, 'rankmath'=>$rankmath];
}

/**
 * 2) Auth-Helpers – akzeptiert:
 *    - X-Growth-Key: <key>
 *    - Authorization: Bearer <key>
 *    - ?growth_key=<key>
 */
function growth_get_provided_key( WP_REST_Request $req ): string {
    $k = (string) $req->get_header('x-growth-key');
    if ($k === '') {
        $auth = (string) $req->get_header('authorization');
        if ($auth && preg_match('/Bearer\s+(.+)/i', $auth, $m)) $k = $m[1];
    }
    if ($k === '') {
        $q = (string) $req->get_param('growth_key');
        if ($q !== '') $k = $q;
    }
    // Whitespaces killen (Copy/Paste-Schutz)
    return preg_replace('/\s+/', '', trim($k));
}

function growth_require_key_or_cap( WP_REST_Request $req ) {
    if ( current_user_can('edit_posts') ) return true;
    $const = preg_replace('/\s+/', '', growth_get_api_key());
    $prov  = growth_get_provided_key($req);
    if ($const !== '' && $prov !== '' && hash_equals($const, $prov)) return true;
    return new WP_Error('growth_forbidden', 'Unauthorized', ['status'=>401]);
}

/**
 * 3) Routen
 */
add_action('rest_api_init', function () {
    $ns = 'growth/v1';

    // GET /sitemap/urls
    register_rest_route($ns, '/sitemap/urls', [
        'methods'  => 'GET',
        'permission_callback' => '__return_true',
        'args' => [
            'limit' => ['type'=>'integer','default'=>50,'minimum'=>1,'maximum'=>500],
            'types' => ['type'=>'array','items'=>['type'=>'string'],'required'=>false], // optional: ["post","page","product"]
        ],
        'callback' => function (WP_REST_Request $req) {
            $limit = (int)$req->get_param('limit');
            $types = $req->get_param('types');
            if (!is_array($types) || empty($types)) $types = ['post','page','product'];

            $q = new WP_Query([
                'posts_per_page'=>$limit,
                'post_type'=>$types,
                'post_status'=>'publish',
                'orderby'=>'date',
                'order'=>'DESC',
                'no_found_rows'=>true,
                'fields'=>'ids',
            ]);

            $items = array_map(function($id){
                return [
                    'id'=>$id,
                    'url'=>get_permalink($id),
                    'type'=>get_post_type($id),
                    'title'=>get_the_title($id),
                    'date'=>get_post_field('post_date', $id),
                ];
            }, $q->posts);

            return rest_ensure_response(['count'=>count($items),'items'=>$items]);
        },
    ]);

    // POST /post/{id}/audit
    register_rest_route($ns, '/post/(?P<id>\d+)/audit', [
        'methods'  => 'POST',
        'permission_callback' => 'growth_require_key_or_cap',
        'args' => [
            'id' => ['type'=>'integer','required'=>true],
        ],
        'callback' => function (WP_REST_Request $req) {
            $id = (int)$req['id'];
            $p = get_post($id);
            if (!$p) return new WP_Error('growth_not_found','Post not found',['status'=>404]);

            $env = growth_seo_env();
            $title = trim(get_the_title($id) ?? '');
            $title_len = mb_strlen($title);
            $content = get_post_field('post_content', $id) ?: '';
            $h1_count = preg_match_all('/<h1\b[^>]*>(.*?)<\/h1>/is', $content, $m);

            // Read meta depending on SEO plugin
            $yoast_desc = get_post_meta($id, '_yoast_wpseo_metadesc', true);
            $yoast_cano = get_post_meta($id, '_yoast_wpseo_canonical', true);
            $rm_desc    = get_post_meta($id, 'rank_math_description', true);
            $rm_cano    = get_post_meta($id, 'rank_math_canonical', true);
            $fallback_desc = get_post_meta($id, 'growth_meta_desc', true);
            $fallback_cano = get_post_meta($id, 'growth_canonical', true);

            $meta_desc = $env['yoast'] ? $yoast_desc : ($env['rankmath'] ? $rm_desc : $fallback_desc);
            $canonical = $env['yoast'] ? $yoast_cano : ($env['rankmath'] ? $rm_cano : $fallback_cano);

            $issues = [];
            if ($title_len < 35 || $title_len > 60) $issues[] = "Title-Länge suboptimal ($title_len, Ziel: 35–60).";
            if ($h1_count !== 1) $issues[] = "H1-Überschriften: $h1_count gefunden (Ziel: genau 1).";

            $md_len = is_string($meta_desc) ? mb_strlen($meta_desc) : 0;
            if (!$meta_desc || $md_len < 80 || $md_len > 160) $issues[] = "Meta Description fehlt/ungünstig (Ziel: 120–155).";
            if (!$canonical || !filter_var($canonical, FILTER_VALIDATE_URL)) $issues[] = "Canonical fehlt/ungültig.";

            return rest_ensure_response([
                'id'     => $id,
                'plugin_env' => $env,
                'title'  => $title,
                'checks' => [
                    'title_len' => $title_len,
                    'h1_count'  => $h1_count,
                    'meta_desc_len' => $md_len,
                    'has_canonical' => (bool)$canonical,
                ],
                'issues' => $issues,
                'ok'     => empty($issues),
            ]);
        },
    ]);

    // POST /post/{id}/apply-fixes
    register_rest_route($ns, '/post/(?P<id>\d+)/apply-fixes', [
        'methods'  => 'POST',
        'permission_callback' => 'growth_require_key_or_cap',
        'args' => [
            'id'        => ['type'=>'integer','required'=>true],
            'meta_desc' => ['type'=>'string','required'=>false],
            'canonical' => ['type'=>'string','required'=>false],
            'status'    => ['type'=>'string','required'=>false,'enum'=>['draft','publish','pending']],
        ],
        'callback' => function (WP_REST_Request $req) {
            $id = (int)$req['id'];
            $p  = get_post($id);
            if (!$p) return new WP_Error('growth_not_found','Post not found',['status'=>404]);

            $env = growth_seo_env(); $changed = [];

            // Meta Description
            $meta_desc = $req->get_param('meta_desc');
            if (is_string($meta_desc) && $meta_desc !== '') {
                $val = wp_strip_all_tags($meta_desc);
                if ($env['yoast'])      update_post_meta($id, '_yoast_wpseo_metadesc', $val);
                elseif ($env['rankmath']) update_post_meta($id, 'rank_math_description', $val);
                else                     update_post_meta($id, 'growth_meta_desc', $val);
                $changed['meta_desc'] = true;
            }

            // Canonical
            $canonical = $req->get_param('canonical');
            if (is_string($canonical) && filter_var($canonical, FILTER_VALIDATE_URL)) {
                $val = esc_url_raw($canonical);
                if ($env['yoast'])      update_post_meta($id, '_yoast_wpseo_canonical', $val);
                elseif ($env['rankmath']) update_post_meta($id, 'rank_math_canonical', $val);
                else                     update_post_meta($id, 'growth_canonical', $val);
                $changed['canonical'] = true;
            }

            // Status
            $status = $req->get_param('status');
            if (in_array($status, ['draft','publish','pending'], true)) {
                wp_update_post(['ID'=>$id,'post_status'=>$status]);
                $changed['status'] = $status;
            }

            return rest_ensure_response(['id'=>$id,'changed'=>$changed,'plugin_env'=>$env]);
        },
    ]);

    // GET /debug  (TEMP – nach dem Test entfernen)
    register_rest_route($ns, '/debug', [
        'methods'  => 'GET',
        'permission_callback' => '__return_true',
        'callback' => function ( WP_REST_Request $req ) {
            $const = growth_get_api_key();
            $prov  = growth_get_provided_key($req);
            return [
                'defined_CONST' => $const !== '',
                'const_len'     => strlen($const),
                'recv_prefix'   => $prov ? substr($prov, 0, 6) : '(leer)',
                'match'         => ($const !== '' && $prov !== '') ? hash_equals($const, $prov) : null,
                'plugin_env'    => growth_seo_env(),
            ];
        },
    ]);
});

/**
 * 4) Frontend-Ausgabe (nur wenn KEIN SEO-Plugin aktiv ist)
 */
add_action('wp_head', function () {
    $env = growth_seo_env();
    if ($env['yoast'] || $env['rankmath']) return;
    if (!is_singular()) return;
    $id = get_queried_object_id(); if (!$id) return;

    $md  = get_post_meta($id, 'growth_meta_desc', true);
    $can = get_post_meta($id, 'growth_canonical', true);

    if ($md)  echo '<meta name="description" content="'.esc_attr($md).'">' . PHP_EOL;
    if ($can) echo '<link rel="canonical" href="'.esc_url($can).'">' . PHP_EOL;
}, 1);

/**
 * 5) RankMath Canonical-Override absichern
 */
add_filter('rank_math/frontend/canonical', function ($canonical) {
    if (is_singular()) {
        $id = get_queried_object_id();
        $rm = get_post_meta($id, 'rank_math_canonical', true);
        if ($rm && filter_var($rm, FILTER_VALIDATE_URL)) return $rm;
    }
    return $canonical;
});