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

function pw_show_gallery_image_urls( $content ) {

 global $post;

 // Only do this on singular items
 if( ! is_singular() )
   return $content;

 // Make sure the post has a gallery in it
 if( ! has_shortcode( $post->post_content, 'gallery' ) )
   return $content;

 // Retrieve the first gallery in the post
 $gallery = get_post_gallery_images( $post );

 $image_list = '<ul>';

 // Loop through each image in each gallery
 foreach( $gallery as $image_url ) {

   $image_list .= '<li>' . '<img src="' . $image_url . '">' . '</li>';

 }

 $image_list .= '</ul>';

 // Append our image list to the content of our post
 $content .= $image_list;

 return $content;

}
add_filter( 'the_content', 'pw_show_gallery_image_urls' );
