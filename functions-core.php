<?php
/*
 * Author:      Frity Lo
 * Email:       to.fritylo@gmail.com
 * Date:        Mon Nov 21 2022 10:07:25 PM
 * Order site:  https://frity.org
 * Repo:        https://github.com/fritylo
 */


function relocate() {
    $predefined_names = [
        '404', 'archive', 'attachment', 'author', 'category', 'date', 'embed', 'frontpage', 
        'home', 'index', 'page', 'paged', 'privacypolicy', 'search', 'single', 'singular', 
        'tag', 'taxonomy', 
    ];

    foreach ($predefined_names as $type) {
        add_filter("{$type}_template_hierarchy", function ($templates) {
            return array_map(function ($template) {
                return NEW_THEME_LOCATION . '/' . $template;
            }, $templates);
        });
    }
}

// Used in relocate() function
// WP will look for all default files in get_template_directory() . NEW_THEME_LOCATION
define( 'NEW_THEME_LOCATION', './dist' );
relocate();


define( 'URL_ROOT', get_template_directory_uri() . '/' . NEW_THEME_LOCATION);
$URL_ROOT = URL_ROOT;

$PAGE_INSERTIONS_HEAD = [];
$PAGE_INSERTIONS_BODY = [];

function insert_to_page($locations, $hash) {
    global $PAGE_INSERTIONS_HEAD, $PAGE_INSERTIONS_BODY;

    $head_insertions = isset($locations['head']) ? $locations['head'] : [];
    $body_insertions = isset($locations['body']) ? $locations['body'] : [];

    $head_styles_insertions = isset($head_insertions['styles']) ? $head_insertions['styles'] : [];
    $head_scripts_insertions = isset($head_insertions['scripts']) ? $head_insertions['scripts'] : [];
    $body_styles_insertions = isset($body_insertions['styles']) ? $body_insertions['styles'] : [];
    $body_scripts_insertions = isset($body_insertions['scripts']) ? $body_insertions['scripts'] : [];

    foreach ($head_styles_insertions as $path) {
        array_push($PAGE_INSERTIONS_HEAD, '<link rel="stylesheet" href="' . URL_ROOT . $path . '?ver=' . $hash . '">');
    }
    foreach ($body_styles_insertions as $path) {
        array_push($PAGE_INSERTIONS_BODY, '<link rel="stylesheet" href="' . URL_ROOT . $path . '?ver=' . $hash . '">');
    }
    foreach ($head_scripts_insertions as $path) {
        array_push($PAGE_INSERTIONS_HEAD, '<script src="' . URL_ROOT . $path . '?ver=' . $hash . '"></script>');
    }
    foreach ($body_scripts_insertions as $path) {
        array_push($PAGE_INSERTIONS_BODY, '<script src="' . URL_ROOT . $path . '?ver=' . $hash . '"></script>');
    }
}


function use_header($name = null, $args = []) {
	do_action( 'get_header', $name, $args );
    $template = $name ? "header-$name.php" : 'header.php';
    require __DIR__ . '/' . NEW_THEME_LOCATION . '/' . $template;
}

function use_footer($name = null, $args = []) {
	do_action( 'get_footer', $name, $args );
    $template = $name ? "footer-$name.php" : 'footer.php';
    require __DIR__ . '/' . NEW_THEME_LOCATION . '/' . $template;
}


function header_enqueue_styles_and_scripts() {
    global $PAGE_INSERTIONS_HEAD;
    echo implode("\n", $PAGE_INSERTIONS_HEAD);
}

function footer_enqueue_styles_and_scripts() {
    global $PAGE_INSERTIONS_BODY;
    echo implode("\n", $PAGE_INSERTIONS_BODY);
}

// TODO: add precommit prettify and tsc
// TODO: add commitlint with conventional commits
// TODO: add tool to change version of project when commit
// TODO: add plop generator
// TODO: add stylelint
// FIXME: need to use submodule for husky ???
