<?php
/**
 * Template Name: WGOS Video Fullscreen
 * Description: Zeigt das WGOS Explainer Video ohne Header/Footer
 */

// Kein wp_head/wp_footer — komplett saubere Seite
?><!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1920">
    <title>WGOS Explainer | Haşim Üner</title>
    <meta name="robots" content="noindex, nofollow">
    <style>
        * { margin: 0; padding: 0; }
        body { background: #0a0a0a; overflow: hidden; }
        iframe {
            width: 100vw;
            height: 56.25vw; /* 16:9 */
            max-height: 100vh;
            max-width: 177.78vh; /* 16:9 */
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border: none;
        }
        .back-link {
            position: fixed;
            top: 16px;
            left: 16px;
            z-index: 100;
            color: rgba(255,255,255,0.3);
            font-family: system-ui, sans-serif;
            font-size: 13px;
            text-decoration: none;
            transition: color 0.2s;
        }
        .back-link:hover { color: hsl(22, 70%, 48%); }
    </style>
</head>
<body>
    <a href="<?php echo esc_url( home_url() ); ?>" class="back-link">&larr; zurück</a>
    <iframe src="<?php echo esc_url( home_url( '/wgos-video/' ) ); ?>" allowfullscreen></iframe>
</body>
</html>
