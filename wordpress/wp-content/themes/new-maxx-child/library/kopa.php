<?php

add_action('after_setup_theme', 'kopa_after_setup_theme');

function kopa_after_setup_theme() {
    kopa_i18n();

    add_action('admin_menu', 'kopa_admin_menu');
    add_action('init', 'kopa_initial_database');
    add_action('init', 'kopa_add_exceprt_page');
    require trailingslashit(get_template_directory()) . '/library/includes/widgets.php';
}
function kopa_add_exceprt_page() {
	add_post_type_support( 'page', 'excerpt' );
}
function kopa_admin_menu() {

    //General Setting Page
    $page_kopa_cpanel_theme_options = add_theme_page(
        __('Theme Options', 'newsmaxx'), __('Theme Options', 'newsmaxx'), 'edit_theme_options', 'kopa_cpanel_theme_options', 'kopa_cpanel_theme_options'
    );

    //call register settings function
    add_action( 'admin_init', 'kopa_register_settings' );

    add_action('admin_print_scripts-' . $page_kopa_cpanel_theme_options, 'kopa_admin_enqueue_scripts');
    add_action('admin_print_styles-' . $page_kopa_cpanel_theme_options, 'kopa_admin_enqueue_styles');
}

/**
 * Register settings
 */
function kopa_register_settings() {
    //register our settings
    register_setting( 'kopa_theme_options_group', KOPA_THEME_OPTIONS, 'kopa_validate_options' );
}

/**
 * Validate/Sanitize options
 */
function kopa_validate_options( $input ) {
    $args = kopa_get_options_args();

    foreach ( $args as $index => $option ) {
        $id = $option['id'];

        if ( isset( $input[ $id ] ) ) {
            switch ( $option['type'] ) {
                case 'text':
                    $input[ $id ] = sanitize_text_field( $input[ $id ] );
                    break;
                case 'url':
                    $input[ $id ] = esc_url( $input[ $id ] );
                    break;
                case 'email':
                    $input[ $id ] = sanitize_email( $input[ $id ] );
                    break;
                case 'number':
                    $input[ $id ] = kopa_sanitize_number( $input[ $id ] );
                    break;
                case 'abs_number':
                    $input[ $id ] = absint( $input[ $id ] );
                    break;
                case 'textarea':
                    $input[ $id ] = kopa_sanitize_textarea( $input[ $id ] );
                    break;
                case 'upload':
                    $input[ $id ] = kopa_sanitize_upload( $input[ $id ] );
                default:
                    break;
            }
        }
    }

    return $input;
}

function kopa_cpanel_theme_options() {
    include trailingslashit(get_template_directory()) . '/library/includes/cpanel/theme-options.php';
}

function kopa_cpanel_sidebar_management() {
    include trailingslashit(get_template_directory()) . '/library/includes/cpanel/sidebar-manager.php';
}

function kopa_cpanel_layout_management() {
    include trailingslashit(get_template_directory()) . '/library/includes/cpanel/layout-manager.php';
}

function kopa_admin_enqueue_scripts() {
    if ( isset( $_GET['page'] ) && ( 'kopa_cpanel_theme_options' == $_GET['page'] || 'kopa_cpanel_sidebar_management' == $_GET['page'] || 'kopa_cpanel_layout_management' == $_GET['page'] ) || isset( $_GET['post'] ) ) {
        
        $dir = get_template_directory_uri() . '/library/js';

        if (!wp_script_is('jquery'))
            wp_enqueue_script('jquery');

        wp_localize_script('jquery', 'kopa_variable', kopa_localize_script());

        if (!wp_script_is('wp-color-picker'))
            wp_enqueue_script('wp-color-picker');
        if (!wp_script_is('kopa-colorpicker'))
            wp_enqueue_script('kopa-colorpicker', "{$dir}/colorpicker.js", array('jquery'), NULL, TRUE);

        if (!wp_script_is('kopa-admin-utils'))
            wp_enqueue_script('kopa-admin-utils', "{$dir}/utils.js", array('jquery'), NULL, TRUE);

        if (!wp_script_is('kopa-admin-jquery-form'))
            wp_enqueue_script('kopa-admin-jquery-form', "{$dir}/jquery.form.js", array('jquery'), NULL, TRUE);

        if (!wp_script_is('kopa-admin-script'))
            wp_enqueue_script('kopa-admin-script', "{$dir}/script.js", array('jquery'), NULL, TRUE);

        if (!wp_script_is('kopa-admin-bootstrap'))
            wp_enqueue_script('kopa-admin-bootstrap', "{$dir}/bootstrap.min.js", array('jquery'), NULL, TRUE);

        if (!wp_script_is('thickbox'))
            wp_enqueue_script('thickbox', null, array('jquery'), NULL, TRUE);

        if (!wp_script_is('kopa-uploader'))
            wp_enqueue_script('kopa-uploader', "{$dir}/uploader.js", array('jquery'), NULL, TRUE);
    }
}

function kopa_localize_script() {
    return array(
        'AjaxUrl' => admin_url('admin-ajax.php'),
        'google_fonts' => kopa_get_google_font_array()
    );
}

function kopa_admin_enqueue_styles() {
    if ( isset( $_GET['page'] ) && ( 'kopa_cpanel_theme_options' == $_GET['page'] || 'kopa_cpanel_sidebar_management' == $_GET['page'] || 'kopa_cpanel_layout_management' == $_GET['page'] ) ) {

        $dir = get_template_directory_uri() . '/library/css';
        wp_enqueue_style('kopa-admin-style', "{$dir}/style.css", array(), NULL);
        wp_enqueue_style('thickbox.css', '/' . WPINC . '/js/thickbox/thickbox.css', array(), NULL);
        wp_enqueue_style('open-sans-font', 'http://fonts.googleapis.com/css?family=Open+Sans:400,700,600', array(), NULL);
        if (!wp_style_is('wp-color-picker'))
            wp_enqueue_style('wp-color-picker');


        $google_fonts = kopa_get_google_font_array();
        $current_heading_font = get_option('kopa_theme_options_heading_font_family', array(), NULL);
        $current_content_font = get_option('kopa_theme_options_content_font_family');
        $current_main_nav_font = get_option('kopa_theme_options_main_nav_font_family');
        $current_wdg_sidebar_font = get_option('kopa_theme_options_wdg_sidebar_font_family');
        
        $load_font_array = array();
        if ($current_heading_font) {
            array_push($load_font_array, $current_heading_font);
        }
        if ($current_content_font && !in_array($current_content_font, $load_font_array)) {
            array_push($load_font_array, $current_content_font);
        }
        if ($current_main_nav_font && !in_array($current_main_nav_font, $load_font_array)) {
            array_push($load_font_array, $current_main_nav_font);
        }
        if ($current_wdg_sidebar_font && !in_array($current_wdg_sidebar_font, $load_font_array)) {
            array_push($load_font_array, $current_wdg_sidebar_font);
        }

        foreach ($load_font_array as $current_font) {

            if ($current_font != '') {
                $google_font_family = $google_fonts[$current_font]['family'];
                $temp_font_name = str_replace(' ', '+', $google_font_family);
                $font_url = 'http://fonts.googleapis.com/css?family=' . $temp_font_name . ':300,300italic,400,400italic,700,700italic&subset=latin';
                wp_enqueue_style('Google-Font-' . $temp_font_name, $font_url, array(), NULL);
            }
        }
    }
}

function kopa_i18n() {
    load_theme_textdomain('newsmaxx', get_template_directory() . '/languages');
}

/* =====================================================================================
 * Add Style and script for categories and post edit page
  ==================================================================================== */
add_action('admin_enqueue_scripts', 'kopa_category_scripts', 10, 1);

function kopa_category_scripts($hook) {
    if ($hook == 'edit-tags.php' or $hook == 'post-new.php' or $hook == 'post.php' or $hook == 'widgets.php') {
        wp_enqueue_script('jquery');
        wp_localize_script('jquery', 'kopa_variable', kopa_localize_script());
        wp_enqueue_script('kopa-admin-script', get_template_directory_uri() . '/library/js/script.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('kopa-admin-bootstrap', get_template_directory_uri() . '/library/js/bootstrap.min.js', array('jquery'), NULL, TRUE);
        wp_enqueue_style('kopa-admin-style', get_template_directory_uri() . '/library/css/style.css', array(), NULL);
    }

    // for generate automatically rating fields
    if ( 'post-new.php' == $hook || 'post.php' == $hook ) {
        wp_enqueue_script('kopa-post-rating-script', get_template_directory_uri() . '/library/js/post-rating.js', array('jquery'), NULL, TRUE);
    }
}

/* =====================================================================================
 * Add Style and script for Widget page
  ==================================================================================== */
add_action('admin_enqueue_scripts', 'kopa_widget_page_scripts', 10, 1);

function kopa_widget_page_scripts($hook) {
    if ($hook == 'widgets.php') {
        wp_enqueue_script('jquery');
        if (!wp_script_is('thickbox'))
            wp_enqueue_script('thickbox', null, array('jquery'), NULL, TRUE);

        if (!wp_script_is('kopa-uploader'))
            wp_enqueue_script('kopa-uploader', get_template_directory_uri() ."/library/js/uploader.js", array('jquery'), NULL, TRUE);
        wp_enqueue_style('thickbox.css', '/' . WPINC . '/js/thickbox/thickbox.css', array(), NULL);
        wp_enqueue_style('kopa-admin-style', get_template_directory_uri() . '/library/css/widget.css', array(), NULL);
    }
}

function kopa_log($message) {
    if (WP_DEBUG === true) {
        if (is_array($message) || is_object($message)) {
            error_log(print_r($message, true));
        } else {
            error_log($message);
        }
    }
}




