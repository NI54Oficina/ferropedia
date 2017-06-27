<?php
define('KOPA_THEME_NAME', 'Newsmaxx');
define('KOPA_CPANEL_IMAGE_DIR', get_template_directory_uri() . '/library/images/layout/');
define('KOPA_THEME_OPTIONS', 'kopa_theme_options_newsmaxxlight');

require trailingslashit(get_template_directory()) . '/library/kopa.php';
require trailingslashit(get_template_directory()) . '/library/ini.php';
require trailingslashit(get_template_directory()) . '/library/includes/google-fonts.php';
require trailingslashit(get_template_directory()) . '/library/includes/ajax.php';
require trailingslashit(get_template_directory()) . '/library/includes/bfithumb.php';
require trailingslashit(get_template_directory()) . '/library/includes/metabox/post.php';
require trailingslashit(get_template_directory()) . '/library/includes/metabox/category.php';
require trailingslashit(get_template_directory()) . '/library/includes/metabox/page.php';
require trailingslashit(get_template_directory()) . '/library/front.php';

function theme_add_query() {
wp_enqueue_script( 'jquery-min-js', site_url() . '/jquery.min.js');
wp_enqueue_script( 'script-js', site_url() . '/script.js');

}

add_action( 'wp_enqueue_scripts', 'theme_add_query' );
