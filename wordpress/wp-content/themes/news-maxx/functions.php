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

wp_enqueue_style ('photoswipe-style', get_template_directory_uri().'/photoswipe/photoswipe.css');
wp_enqueue_style ('default-skin-style', get_template_directory_uri().'/photoswipe/default-skin/default-skin.css');


function theme_add_query() {
  wp_enqueue_script( 'jquery-min-js', site_url() . '/jquery.min.js');

  wp_enqueue_script( 'swipe-js', site_url() . '/photoswipe/photoswipe.min.js');
  wp_enqueue_script( 'swipe-ui-js', site_url() . '/photoswipe/photoswipe-ui-default.min.js');
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


add_action( 'init', 'wpse34528_add_page_cats' );
function wpse34528_add_page_cats()
{
    register_taxonomy_for_object_type( 'category', 'page' );
}

add_action( 'init', 'create_post_type' );
function create_post_type() {
  $labels = array(
        'name' => _x( 'Jugador', 'post type general name' ),
        'singular_name' => _x( 'Libro', 'post type singular name' ),
        'add_new' => _x( 'Añadir nuevo', 'book' ),
        'add_new_item' => __( 'Añadir nuevo Libro' ),
        'edit_item' => __( 'Editar Libro' ),
        'new_item' => __( 'Nuevo Libro' ),
        'view_item' => __( 'Ver Libro' ),
        'search_items' => __( 'Buscar Libros' ),
        'not_found' =>  __( 'No se han encontrado Libros' ),
        'not_found_in_trash' => __( 'No se han encontrado Libros en la papelera' ),
        'parent_item_colon' => ''
    );
 
    // Creamos un array para $args
    $args = array( 'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => false,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => null,
		"show_in_nav_menus"=>false,
		"show_in_menu"=>false,
		"show_in_admin_bar"=>false,
		
        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
    );
 
    register_post_type( 'jugador', $args );
}

add_action( 'admin_init', 'wpse_55202_do_terms_exclusion' );

function wpse_55202_do_terms_exclusion() { if( current_user_can('administrator') ) add_filter( 'list_terms_exclusions', 'wpse_55202_list_terms_exclusions', 10, 2 ); }

function wpse_55202_list_terms_exclusions($exclusions,$args) { return $exclusions . " AND ( t.term_id <> 69 ) AND ( t.term_id <> 70 )"; }

//contador views
function wpb_set_post_views($postID) {
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

function wpb_track_post_views ($post_id) {
    if ( !is_single() ) return;

    if ( empty ( $post_id) ) {

        global $post;

        $post_id = $post->ID;   

    }

    wpb_set_post_views($post_id);

}
add_action( 'wp_head', 'wpb_track_post_views');
