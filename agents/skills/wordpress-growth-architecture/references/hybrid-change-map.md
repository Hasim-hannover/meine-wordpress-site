# Hybrid Change Map

Use this quick map before editing.

## Usually Repo-Owned

- Template hierarchy and wrappers in `blocksy-child/*.php`
- Shared partials in `blocksy-child/template-parts/`
- Menu generation logic in `blocksy-child/inc/menu-setup.php`
- Shared homepage blocks and shortcodes in `blocksy-child/inc/shortcodes.php`
- Helper URLs, schema, and technical page logic in `blocksy-child/inc/`
- Visual system, page CSS, and interaction JS in `blocksy-child/assets/`

## Usually Editor-Owned

- Homepage block content when the page uses Gutenberg blocks or stored shortcode placement
- Service-page copy for wrapper templates that mainly call `the_content()`
- FAQ blocks, proof blocks, or case-study excerpts inserted directly in the editor

## Usually Manual WordPress Admin Work

- Rebuilding or assigning menus after menu generation logic changes
- Replacing homepage or service-page block content with the new copy
- Verifying that the correct page template is assigned
- Checking that the homepage actually uses the expected shortcodes
- Reviewing permalinks when slug or routing assumptions changed

## Decision Rule

If the repo only changes shared structure but the live narrative still lives in the editor, say so explicitly in the final answer and list the exact manual follow-up.
