<?php
add_action('after_setup_theme', 'kopa_front_after_setup_theme');

function kopa_front_after_setup_theme() {
    add_theme_support('post-formats', array('gallery', 'audio', 'video'));
    add_theme_support('post-thumbnails');
    add_theme_support('loop-pagination');
    add_theme_support('automatic-feed-links');

    global $content_width;
    if ( ! isset( $content_width ) ) {
        $content_width = 911;
    }

    register_nav_menus(array(
        'top-nav'      => __( 'Top Menu (All Items Flat)', 'newsmaxx' ),
        'main-nav'     => __( 'Main Menu', 'newsmaxx' ),
        'second-nav'     => __( 'Second Menu', 'newsmaxx' ),
        'bottom-nav'   => __( 'Bottom Menu (All Items Flat)', 'newsmaxx' ),
    ));

    if (!is_admin()) {
        add_filter('wp_title', 'kopa_wp_title', 10, 2);
        add_action('wp_enqueue_scripts', 'kopa_front_enqueue_scripts');
        add_action('wp_head', 'kopa_head');
        add_filter('widget_text', 'do_shortcode');
        add_filter('excerpt_length', 'kopa_custom_excerpt_length', 55);
        add_filter('excerpt_more', 'kopa_custom_excerpt_more');
        add_filter('the_category', 'kopa_the_category');
        add_filter('post_class', 'kopa_post_class');
        add_filter('body_class', 'kopa_body_class');
        add_filter('comment_reply_link', 'kopa_comment_reply_link');
        add_filter('edit_comment_link', 'kopa_edit_comment_link');
    } else {
        add_filter('image_size_names_choose', 'kopa_image_size_names_choose');
    }
    kopa_add_image_sizes();
}


function kopa_comment_reply_link($link) {
    return str_replace('comment-reply-link', 'comment-reply-link reply-link', $link);
}

function kopa_edit_comment_link($link) {
    return str_replace('comment-edit-link', 'comment-edit-link edit-link', $link);
}

function kopa_post_class($classes) {
    return $classes;
}

function kopa_body_class($classes) {
    $template_setting = kopa_get_template_setting();
    switch ( $template_setting['layout_id'] ){
        case 'blog-2':
            $classes[] = 'kopa-subpage kopa-categories-2';
            break;
        case 'page-full-width':
            $classes[] = 'kopa-subpage kopa-fullwidth';
            break;
        default:
            $classes[] = 'kopa-subpage';
            break;
    }

    //add fullwidth
    if (isset($template_setting['sidebars'][$template_setting['layout_id']])){
        $sidebars = $template_setting['sidebars'][$template_setting['layout_id']];
    }

    $kopa_fullwidth = true;
    if(isset($sidebars)){
        foreach($sidebars as $k => $v){
            if ( is_active_sidebar( $v ) ) {
                $kopa_fullwidth = false;
            }
        }
        if($kopa_fullwidth){
            $classes[] = 'kopa-fullwidth';
        }
    }

    $format = get_post_format();
    switch ($format){
        case 'audio':
            $classes[] = 'kopa-subpage kopa-single-audio';
            break;
        default:
            break;
    }

    return $classes;
}

function kopa_front_enqueue_scripts() {
    if (!is_admin()) {
        global $wp_styles, $is_IE;

        $dir = get_template_directory_uri();

        /* STYLESHEETs */
        wp_enqueue_style('kopa-oswald', '//fonts.googleapis.com/css?family=Oswald:400,300,700');
        wp_enqueue_style('kopa-bootstrap', $dir . '/css/bootstrap.css');
        wp_enqueue_style('kopa-font-awesome', $dir . '/css/font-awesome.css');
        wp_enqueue_style('kopa-superfish', $dir . '/css/superfish.css');
        wp_enqueue_style('kopa-owl.carousel', $dir . '/css/owl.carousel.css');
        wp_enqueue_style('kopa-owl.theme', $dir . '/css/owl.theme.css');
        wp_enqueue_style('kopa-navgoco', $dir . '/css/jquery.navgoco.css');
        wp_enqueue_style('kopa-extra', $dir . '/css/extra.css');
        wp_enqueue_style('kopa-style', get_stylesheet_uri());
        wp_enqueue_style('kopa-responsive', $dir . '/css/responsive.css');

        if ( $is_IE ) {
            wp_register_style('kopa-ie', $dir . '/css/ie.css');
            $wp_styles->add_data('kopa-ie', 'conditional', 'lt IE 9');
            wp_register_style('kopa-ie9', $dir . '/css/ie9.css');
            wp_enqueue_style('kopa-ie');
            wp_enqueue_style('kopa-ie9');
        }

        /* JAVASCRIPTs */
        wp_enqueue_script('jquery');
        wp_localize_script('jquery', 'kopa_front_variable', kopa_front_localize_script());
        wp_enqueue_script('modernizr.custom', $dir . '/js/modernizr.custom.min.js', array(), null);
        wp_enqueue_script('kopa-bootstrap', $dir . '/js/bootstrap.min.js', array(), null);
        wp_enqueue_script('kopa-custom-js', $dir . '/js/custom.js', array(), null, true);
        wp_enqueue_script('kopa-match-height', $dir . '/js/jquery.matchHeight-min.js', array(), null, true);

        // send localization to frontend
        wp_localize_script('kopa-custom-js', 'kopa_custom_front_localization', kopa_custom_front_localization());

        if (is_single() || is_page()) {
            wp_enqueue_script('comment-reply');
        }
    }
}

function kopa_front_localize_script() {
    $kopa_variable = array(
        'ajax' => array(
            'url' => admin_url('admin-ajax.php')
        ),
        'template' => array(
            'post_id' => (is_singular()) ? get_queried_object_id() : 0
        )
    );
    return $kopa_variable;
}

/**
 * Send the translated texts to frontend
 * @package Circle
 * @since Circle 1.12
 */
function kopa_custom_front_localization() {
    $front_localization = array(
        'url' => array(
            'template_directory_uri' => get_template_directory_uri(),
        ),
        'validate' => array(
            'form' => array(
                'submit'  => __('SEND', 'newsmaxx'),
                'sending' => __('SENDING...', 'newsmaxx')
            ),
            'name' => array(
                'required'  => __('Please enter your name.', 'newsmaxx')
            ),
            'email' => array(
                'required' => __('Please enter your email.', 'newsmaxx'),
                'email'    => __('Please enter a valid email.', 'newsmaxx')
            ),
            'comment' => array(
                'required'  => __('Please enter your comment.', 'newsmaxx')
            )
        )
    );

    return $front_localization;
}

function kopa_the_category($thelist) {
    return $thelist;
}

/* FUNCTION */

/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @package Nictitate
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function kopa_wp_title( $title, $sep ) {
    global $paged, $page;

    if ( is_feed() ) {
        return $title;
    }

    // Add the site name.
    $title .= get_bloginfo( 'name' );

    // Add the site description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) ) {
        $title = "$title $sep $site_description";
    }

    // Add a page number if necessary.
    if ( $paged >= 2 || $page >= 2 ) {
        $title = "$title $sep " . sprintf( __( 'Page %s', 'newsmaxx' ), max( $paged, $page ) );
    }

    return $title;
}


function kopa_get_image_sizes() {
    $sizes = array(
        'kopa-size-1'    => array(882, 436, true, __('kopa size 882 x 436 (Kopatheme)', 'newsmaxx')),
        'kopa-size-2'    => array(131, 97, true, __('kopa size 131 x 97 (Kopatheme)', 'newsmaxx')),
        'kopa-size-3'    => array(866, 428, true, __('kopa size 866 x 428 (Kopatheme)', 'newsmaxx')),

    );

    return apply_filters('kopa_get_image_sizes', $sizes);
}

function kopa_add_image_sizes() {
    $sizes = kopa_get_image_sizes();
    foreach ($sizes as $slug => $details) {
        add_image_size($slug, $details[0], $details[1], $details[2]);
    }
}

function kopa_image_size_names_choose($sizes) {
    $kopa_sizes = kopa_get_image_sizes();
    foreach ($kopa_sizes as $size => $image) {
        $width = ($image[0]) ? $image[0] : __('auto', 'newsmaxx');
        $height = ($image[1]) ? $image[1] : __('auto', 'newsmaxx');
        $sizes[$size] = $image[3] . " ({$width} x {$height})";
    }
    return $sizes;
}

function kopa_set_view_count($post_id) {
    $new_view_count = 0;
    $meta_key = 'kopa_' . 'newsmaxx' . '_total_view';

    $current_views = (int) get_post_meta($post_id, $meta_key, true);

    if ($current_views) {
        $new_view_count = $current_views + 1;
        update_post_meta($post_id, $meta_key, $new_view_count);
    } else {
        $new_view_count = 1;
        add_post_meta($post_id, $meta_key, $new_view_count);
    }
    return $new_view_count;
}

function kopa_get_view_count($post_id) {
    $key = 'kopa_' . 'newsmaxx' . '_total_view';
    return kopa_get_post_meta($post_id, $key, true, 'Int');
}

/**
 * Template tag: print breadcrumb
 */
function kopa_breadcrumb() {
    // get show/hide option
    $kopa_breadcrumb_status = get_option('kopa_theme_options_breadcrumb_status', 'show');

    if ( $kopa_breadcrumb_status != 'show' ) {
        return;
    }

    if (is_main_query()) {
        global $post, $wp_query;

        $prefix = '&nbsp;/&nbsp;';
        $current_class = 'current-page';
        $description = '';
        $breadcrumb_before = '<div class="breadcrumb clearfix">';
        $breadcrumb_after = '</div>';
        $breadcrumb_home = '<span>'.__('You are here: ', 'newsmaxx') .'</span> <span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="' . home_url() . '"><span itemprop="title">' . __('Home', 'newsmaxx') . '</span></a></span>';
        $breadcrumb = '';
        ?>

        <?php
        if (is_home()) {
            $breadcrumb.= $breadcrumb_home;
            if ( get_option( 'page_for_posts' ) ) {
                $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb" class="%1$s">%2$s</span>', $current_class, get_the_title(get_option('page_for_posts')));
            } else {
                $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, __('Blog', 'newsmaxx'));
            }
        } else if (is_post_type_archive('product') && get_option('woocommerce_shop_page_id')) {
            $breadcrumb.= $breadcrumb_home;
            $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb" class="%1$s">%2$s</span>', $current_class, get_the_title(get_option('woocommerce_shop_page_id')));
        } else if (is_tag()) {
            $breadcrumb.= $breadcrumb_home;

            $term = get_term(get_queried_object_id(), 'post_tag');
            $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, $term->name);
        } else if (is_category()) {
            $breadcrumb.= $breadcrumb_home;

            $category_id = get_queried_object_id();
            $terms_link = explode(',', substr(get_category_parents(get_queried_object_id(), TRUE, ','), 0, (strlen(',') * -1)));
            $n = count($terms_link);
            if ($n > 1) {
                for ($i = 0; $i < ($n - 1); $i++) {
                    $breadcrumb.= $prefix . $terms_link[$i];
                }
            }
            $breadcrumb.= $prefix . sprintf('<span class="%1$s" itemprop="title">%2$s</span>', $current_class, get_the_category_by_ID(get_queried_object_id()));

        } else if ( is_tax('product_cat') ) {
            $breadcrumb.= $breadcrumb_home;
            $breadcrumb.= $prefix . '<a href="'.get_page_link( get_option('woocommerce_shop_page_id') ).'">'.get_the_title( get_option('woocommerce_shop_page_id') ).'</a>';
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

            $parents = array();
            $parent = $term->parent;
            while ($parent):
                $parents[] = $parent;
                $new_parent = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ));
                $parent = $new_parent->parent;
            endwhile;
            if( ! empty( $parents ) ):
                $parents = array_reverse($parents);
                foreach ($parents as $parent):
                    $item = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ));
                    $breadcrumb .= $prefix . '<a href="' . get_term_link( $item->slug, 'product_cat' ) . '">' . $item->name . '</a>';
                endforeach;
            endif;

            $queried_object = get_queried_object();
            $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, $queried_object->name);
        } else if ( is_tax( 'product_tag' ) ) {
            $breadcrumb.= $breadcrumb_home;
            $breadcrumb.= $prefix . '<a href="'.get_page_link( get_option('woocommerce_shop_page_id') ).'">'.get_the_title( get_option('woocommerce_shop_page_id') ).'</a>';
            $queried_object = get_queried_object();
            $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, $queried_object->name);
        } else if (is_single()) {
            $breadcrumb.= $breadcrumb_home;

            if ( get_post_type() === 'product' ) :

                $breadcrumb .= $prefix . '<a href="'.get_page_link( get_option('woocommerce_shop_page_id') ).'">'.get_the_title( get_option('woocommerce_shop_page_id') ).'</a>';

                if ($terms = get_the_terms( $post->ID, 'product_cat' )) :
                    $term = apply_filters( 'jigoshop_product_cat_breadcrumb_terms', current($terms), $terms);
                    $parents = array();
                    $parent = $term->parent;
                    while ($parent):
                        $parents[] = $parent;
                        $new_parent = get_term_by( 'id', $parent, 'product_cat');
                        $parent = $new_parent->parent;
                    endwhile;
                    if(!empty($parents)):
                        $parents = array_reverse($parents);
                        foreach ($parents as $parent):
                            $item = get_term_by( 'id', $parent, 'product_cat');
                            $breadcrumb .= $prefix . '<a href="' . get_term_link( $item->slug, 'product_cat' ) . '">' . $item->name . '</a>';
                        endforeach;
                    endif;
                    $breadcrumb .= $prefix . '<a href="' . get_term_link( $term->slug, 'product_cat' ) . '">' . $term->name . '</a>';
                endif;

                $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, get_the_title());

            else :

                $categories = get_the_category(get_queried_object_id());
                if ($categories) {
                    foreach ($categories as $category) {
                        $breadcrumb.= $prefix . sprintf('<a href="%1$s">%2$s</a>', get_category_link($category->term_id), $category->name);
                    }
                }

                $post_id = get_queried_object_id();
                $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, get_the_title($post_id));

            endif;

        } else if (is_page()) {
            if (!is_front_page()) {
                $post_id = get_queried_object_id();
                $breadcrumb.= $breadcrumb_home;
                $post_ancestors = get_post_ancestors($post);
                if ($post_ancestors) {
                    $post_ancestors = array_reverse($post_ancestors);
                    foreach ($post_ancestors as $crumb)
                        $breadcrumb.= $prefix . sprintf('<a href="%1$s">%2$s</a>', get_permalink($crumb), get_the_title($crumb));
                }
                $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, get_the_title(get_queried_object_id()));
            }
        } else if (is_year() || is_month() || is_day()) {
            $breadcrumb.= $breadcrumb_home;

            $date = array('y' => NULL, 'm' => NULL, 'd' => NULL);

            $date['y'] = get_the_time('Y');
            $date['m'] = get_the_time('m');
            $date['d'] = get_the_time('j');

            if (is_year()) {
                $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, $date['y']);
            }

            if (is_month()) {
                $breadcrumb.= $prefix . sprintf('<a href="%1$s">%2$s</a>', get_year_link($date['y']), $date['y']);
                $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, date_i18n('F', $date['m']));
            }

            if (is_day()) {
                $breadcrumb.= $prefix . sprintf('<a href="%1$s">%2$s</a>', get_year_link($date['y']), $date['y']);
                $breadcrumb.= $prefix . sprintf('<a href="%1$s">%2$s</a>', get_month_link($date['y'], $date['m']), date_i18n('F', $date['m']));
                $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, $date['d']);
            }

        } else if (is_search()) {
            $breadcrumb.= $breadcrumb_home;

            $s = get_search_query();
            $c = $wp_query->found_posts;
            $count = $wp_query->post_count.'';

            $description = sprintf(__('<span class="%1$s">Your search for "%2$s" return %3$s results', 'newsmaxx'), $current_class, $s, $count);
            $breadcrumb .= $prefix . $description;
        } else if (is_author()) {
            $breadcrumb.= $breadcrumb_home;
            $author_id = get_queried_object_id();
            $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</a>', $current_class, sprintf(__('Posts created by %1$s', 'newsmaxx'), get_the_author_meta('display_name', $author_id)));
        } else if (is_404()) {
            $breadcrumb.= $breadcrumb_home;
            $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, __('Error 404', 'newsmaxx'));
        }

        if ($breadcrumb)
            echo apply_filters('kopa_breadcrumb', $breadcrumb_before . $breadcrumb . $breadcrumb_after);
    }
}

function kopa_related_articles() {
    if (is_single()) {
        $get_by = get_option('kopa_theme_options_post_related_get_by', 'category');
        if ('hide' != $get_by) {
            $limit = (int) get_option('kopa_theme_options_post_related_limit', 4);
            if ($limit > 0) {
                global $post;
                $taxs = array();
                if ('category' == $get_by) {
                    $cats = get_the_category(($post->ID));
                    if ($cats) {
                        $ids = array();
                        foreach ($cats as $cat) {
                            $ids[] = $cat->term_id;
                        }
                        $taxs [] = array(
                            'taxonomy' => 'category',
                            'field' => 'id',
                            'terms' => $ids
                        );
                    }
                } else {
                    $tags = get_the_tags($post->ID);
                    if ($tags) {
                        $ids = array();
                        foreach ($tags as $tag) {
                            $ids[] = $tag->term_id;
                        }
                        $taxs [] = array(
                            'taxonomy' => 'post_tag',
                            'field' => 'id',
                            'terms' => $ids
                        );
                    }
                }

                if ($taxs) {
                    $related_args = array(
                        'tax_query' => $taxs,
                        'post__not_in' => array($post->ID),
                        'posts_per_page' => $limit
                    );
                    $related_posts = new WP_Query( $related_args );
                    if ( $related_posts->have_posts() ) { ?>

                        <div class="related-post">
                            <h3><span><?php _e('Post by related', 'newsmaxx'); ?></span><?php _e('Related post', 'newsmaxx'); ?></h3>
                        </div>
                        <div class="owl-carousel kopa-related-post-carousel">
                            <?php $i = 0; ?>
                            <?php while ( $related_posts->have_posts() ) : $related_posts->the_post();
                                if ($i % 2 == 0){
                                    echo '<div class="item"><ul>';
                                }?>

                                <li>
                                    <article class="entry-item clearfix">
                                        <?php if ( has_post_thumbnail() && get_option('kopa_theme_options_featured_image_status', 'show') == 'show') : ?>
                                            <div class="entry-thumb">
                                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                                    <?php kopa_the_image(get_the_ID(), get_the_title(), 60, 60); ?>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                        <div class="entry-content">
                                            <?php if ( 'show' === get_option('kopa_theme_options_view_date_status', 'show') && 'post' === get_post_type() ) :?>
                                                <?php
                                                if ( kopa_check_title_null(get_the_ID())){?>
                                                        <span class="entry-date"><i class="fa <?php echo kopa_get_post_format_icon(get_the_ID());?>"></i><?php the_time(get_option('date_format')); ?></span>
                                                    <?php }else{ ?>
                                                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><span class="entry-date"><i class="fa <?php echo kopa_get_post_format_icon(get_the_ID());?>"></i><?php the_time(get_option('date_format')); ?></span></a>
                                                    <?php }
                                                ?>


                                            <?php endif; ?>
                                            <h6 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title();?>"><?php the_title(); ?></a></h6>
                                        </div>
                                    </article>
                                </li>

                                <?php if ($i % 2 == 1){
                                    echo '</ul></div>';
                                }
                                $i++;
                            ?>
                            <?php endwhile; ?>
                            <?php
                            //Check in case don't have multiple of 3 items
                                if ($i % 2 != 0){
                                    echo '</ul></div>';
                                }
                            ?>
                        </div>
                        <?php
                    } // endif
                    wp_reset_postdata();
                }
            }
        }
    }
}


function kopa_about_author() {
    if ('show' != get_option('kopa_theme_options_post_about_author', 'show')) {
        return;
    }
    ?>
    <section class="about-author">
        <div class="about-author-inner clearfix">
            <div class="author-avatar">
                <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'ID' ), 60 ); ?></a>
            </div>
            <div class="author-content">
                <h5><?php _e('About', 'newsmaxx');?> <?php the_author_posts_link(); ?></h5>
                <p><?php the_author_meta( 'description' ); ?></p>
            </div>
        </div>
        <!-- about-author-inner -->
    </section>
<?php
}

function kopa_get_the_excerpt_for_widget($excerpt, $content, $length = 0) {
    if ( $length ){
        $kopa_length = $length;
    }elseif(is_category() || is_tag()) {
        $kopa_length = (int) get_option('kopa_theme_options_blog_excerpt_length', 55);
    }else{
        $kopa_length = (int) get_option('kopa_theme_options_frontpage_excerpt_length', 55);
    }
    $temp_excerp = $excerpt;
    if ( empty($temp_excerp) ) {
        $temp_excerp =  strip_tags($content);
        $temp_excerp =  strip_shortcodes($temp_excerp);
    }


    $kopa_excerpt = wp_trim_words($temp_excerp, $kopa_length, $more = null);
    return $kopa_excerpt;
}

function kopa_get_template_setting() {
    $kopa_setting = get_option('kopa_setting');
    $setting = array();
    if (is_home()) {
        $setting = $kopa_setting['home'];
    } else if (is_post_type_archive('product')) {
        $setting = $kopa_setting['shop'];
    } else if (is_archive()) {
        if (is_category() || is_tag()) {
            $setting = get_option("kopa_category_setting_" . get_queried_object_id(), $kopa_setting['taxonomy']);
        } else if (is_tax('product_cat') || is_tax('product_tag')) {
            $setting = $kopa_setting['shop'];
        } else {
            $setting = get_option("kopa_category_setting_" . get_queried_object_id(), $kopa_setting['archive']);
        }
    } else if (is_singular()) {
        if (is_singular('post')) {
            $setting = get_option("kopa_post_setting_" . get_queried_object_id(), $kopa_setting['post']);
        } else if (is_singular('product')) {
            $setting = $kopa_setting['single-product'];
        } else if (is_page()) {
            $setting = get_option("kopa_page_setting_" . get_queried_object_id());
            if (!$setting) {
                $setting = $kopa_setting['page'];
            }
        } else {
            $setting = $kopa_setting['post'];
        }
    } else if (is_404()) {
        $setting = $kopa_setting['_404'];
    } else if (is_search()) {
        $setting = $kopa_setting['search'];
    }
    return $setting;
}

function kopa_content_get_gallery($content, $enable_multi = false) {
    return kopa_content_get_media($content, $enable_multi, array('gallery'));
}

function kopa_content_get_video($content, $enable_multi = false) {
    return kopa_content_get_media($content, $enable_multi, array('vimeo', 'youtube', 'video'));
}

function kopa_content_get_audio($content, $enable_multi = false) {
    return kopa_content_get_media($content, $enable_multi, array('audio', 'soundcloud'));
}

function kopa_content_get_media($content, $enable_multi = false, $media_types = array()) {
    $media = array();
    $regex_matches = '';
    $regex_pattern = get_shortcode_regex();
    preg_match_all('/' . $regex_pattern . '/s', $content, $regex_matches);
    foreach ($regex_matches[0] as $shortcode) {
        $regex_matches_new = '';
        preg_match('/' . $regex_pattern . '/s', $shortcode, $regex_matches_new);

        if (in_array($regex_matches_new[2], $media_types)) :
            $media[] = array(
                'shortcode' => $regex_matches_new[0],
                'type' => $regex_matches_new[2],
                'url' => $regex_matches_new[5]
            );
            if (false == $enable_multi) {
                break;
            }
        endif;
    }    return $media;
}

function kopa_get_client_IP() {
    $IP = NULL;

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        //check if IP is from shared Internet
        $IP = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        //check if IP is passed from proxy
        $ip_array = explode(",", $_SERVER['HTTP_X_FORWARDED_FOR']);
        $IP = trim($ip_array[count($ip_array) - 1]);
    } elseif (!empty($_SERVER['REMOTE_ADDR'])) {
        //standard IP check
        $IP = $_SERVER['REMOTE_ADDR'];
    }
    return $IP;
}

function kopa_get_post_meta($pid, $key = '', $single = false, $type = 'String', $default = '') {
    $data = get_post_meta($pid, $key, $single);
    switch ($type) {
        case 'Int':
            $data = (int) $data;
            return ($data >= 0) ? $data : $default;
            break;
        default:
            return ($data) ? $data : $default;
            break;
    }
}

function kopa_head() {
     // contains all theme options custom styles
    $custom_styles = '';
    //logo 1
    $logo_margin_top = get_option('kopa_theme_options_logo_margin_top');
    $logo_margin_left = get_option('kopa_theme_options_logo_margin_left');
    $logo_margin_right = get_option('kopa_theme_options_logo_margin_right');
    $logo_margin_bottom = get_option('kopa_theme_options_logo_margin_bottom');
    //logo 2
    $logo_margin_top_2 = get_option('kopa_theme_options_logo_margin_top_2');
    $logo_margin_left_2 = get_option('kopa_theme_options_logo_margin_left_2');
    $logo_margin_right_2 = get_option('kopa_theme_options_logo_margin_right_2');
    $logo_margin_bottom_2 = get_option('kopa_theme_options_logo_margin_bottom_2');


    $logo_margin = '';
    if ( $logo_margin_top ) {
        $logo_margin .= "margin-top:{$logo_margin_top}px !important;";
    }
    if ( $logo_margin_left ) {
        $logo_margin .= "margin-left:{$logo_margin_left}px !important;";
    }
    if ( $logo_margin_right ) {
        $logo_margin .= "margin-right:{$logo_margin_right}px;";
    }
    if ( $logo_margin_bottom ) {
        $logo_margin .= "margin-bottom:{$logo_margin_bottom}px;";
    }
    if ( $logo_margin ) {
        $custom_styles .= "#logo-image { $logo_margin }";
    }

    $logo_margin_2 = '';
    if ( $logo_margin_top_2 ) {
        $logo_margin_2 .= "margin-top:{$logo_margin_top_2}px !important;";
    }
    if ( $logo_margin_left_2 ) {
        $logo_margin_2 .= "margin-left:{$logo_margin_left_2}px !important;";
    }
    if ( $logo_margin_right_2 ) {
        $logo_margin_2 .= "margin-right:{$logo_margin_right_2}px;";
    }
    if ( $logo_margin_bottom_2 ) {
        $logo_margin_2 .= "margin-bottom:{$logo_margin_bottom_2}px;";
    }
    if ( $logo_margin_2 ) {
        $custom_styles .= "#logo-image2 { $logo_margin_2 }";
    }

    echo '<style id="kopa-theme-options-custom-styles">'.$custom_styles.'</style>';

    /* ==================================================================================================
     * Custom CSS
     * ================================================================================================= */
    $kopa_theme_options_custom_css = htmlspecialchars_decode(stripslashes(get_option('kopa_theme_options_custom_css')));
    if ($kopa_theme_options_custom_css)
        echo "<style id='kopa-user-custom-css' type='text/css'>{$kopa_theme_options_custom_css}</style>";
}

/* ==============================================================================
 * Mobile Menu Walker Class
  ============================================================================= */

class kopa_mobile_menu extends Walker_Nav_Menu {

    function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat("\t", $depth) : '';

        $class_names = $value = '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));

        if ($depth == 0)
            $class_names = $class_names ? ' class="' . esc_attr($class_names) . ' clearfix"' : 'class="clearfix"';
        else
            $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : 'class=""';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names . '>';

        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .=!empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .=!empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .=!empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        if ($depth == 0) {
            $item_output = $args->before;
            $item_output .= '<h3><a' . $attributes . '>';
            $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
            $item_output .= '</a></h3>';
            $item_output .= $args->after;
        } else {
            $item_output = $args->before;
            $item_output .= '<a' . $attributes . '>';
            $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;
        }
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    function start_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        if ($depth == 0) {
            $output .= "\n$indent<span>+</span><div class='clearfix'></div><div class='menu-panel clearfix'><ul>";
        } else {
            $output .= '<ul>'; // indent for level 2, 3 ...
        }
    }

    function end_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        if ($depth == 0) {
            $output .= "$indent</ul></div>\n";
        } else {
            $output .= '</ul>';
        }
    }

}

/**
 * Get gallery string ids after getting matched gallery array
 * @return array of attachment ids in gallery
 * @return empty if no gallery were found
 */
function kopa_content_get_gallery_attachment_ids( $content ) {
    $gallery = kopa_content_get_gallery( $content );

    if (isset( $gallery[0] )) {
        $gallery = $gallery[0];
    } else {
        return '';
    }

    if ( isset($gallery['shortcode']) ) {
        $shortcode = $gallery['shortcode'];
    } else {
        return '';
    }

    // get gallery string ids
    preg_match_all('/ids=\"(?:\d+,*)+\"/', $shortcode, $gallery_string_ids);
    if ( isset( $gallery_string_ids[0][0] ) ) {
        $gallery_string_ids = $gallery_string_ids[0][0];
    } else {
        return '';
    }

    // get array of image id
    preg_match_all('/\d+/', $gallery_string_ids, $gallery_ids);
    if ( isset( $gallery_ids[0] ) ) {
        $gallery_ids = $gallery_ids[0];
    } else {
        return '';
    }

    return $gallery_ids;
}

/**
 * Template tag: print socials link
 * @since Newsmaxx 1.0
 */
function kopa_social_links() {
    $social_links = array(
        'facebook'  => array(
            'url'     => '',
            'icon'    => 'icon-facebook',
            'display' => false,
        ),
        'twitter'   => array(
            'url'    => '',
            'icon'   => 'icon-twitter',
            'display' => false,
        ),
        'gplus'     => array(
            'url'    => '',
            'icon'   => 'icon-google-plus2',
            'display' => false,
        ),
        'dribbble'  => array(
            'url'     => '',
            'icon'    => 'icon-dribbble',
            'display' => false,
        ),
        'linkedin'     => array(
            'url'    => '',
            'icon'   => 'icon-linkedin',
            'display' => false,
        ),
        'rss'  => array(
            'url'    => '',
            'icon'   => 'icon-feed',
            'display' => false,
        ),
    );

    foreach( $social_links as $social_name => $social_atts ) {
        $option_name = 'kopa_theme_options_social_links_' . $social_name . '_url';
        $social_atts['url'] = get_option( $option_name, '' );

        if ( 'rss' == $social_name ) {
            if ( empty( $social_atts['url'] ) ) {
                $social_atts['url'] = get_bloginfo('rss2_url');
                $social_atts['display'] = true;
            } elseif ( $social_atts['url'] != 'HIDE' ) {
                $social_atts['url'] = esc_url( $social_atts['url'] );
                $social_atts['display'] = true;
            }
        } else {
            $social_atts['url'] = esc_url( $social_atts['url'] );
            if ( !empty( $social_atts['url'] ) ) { $social_atts['display'] = true; }
        }

        $social_links[ $social_name ] = $social_atts;
    }

    $social_link_target = get_option( 'kopa_theme_options_social_link_target', '_self' );
    ?>

    <?php foreach ( $social_links as $social_name => $social_atts) { ?>
        <?php if ( $social_atts['display'] ) { ?>
        <li><a href="<?php echo $social_atts['url']; ?>" class="<?php echo $social_atts['icon']; ?>" target="<?php echo $social_link_target; ?>"></a></li>
        <?php } // endif ?>
    <?php } // endforeach ?>

    <?php
}

/*
 * header headline
 */
function kopa_the_headline()
{
    $limit = (int) get_option('kopa_theme_options_headline_limit', 5);
    $speed = (float)get_option('kopa_theme_options_headline_duration',700);
    $speed = $speed/10000;
    if ($limit) {
        $prefix = get_option('kopa_theme_options_headline_prefix', 'DESTACADO');
        $cats = (array)get_option('kopa_theme_options_headline_cats');
        $cats = implode(',', $cats);

        if( !empty($cats) ){
            $posts = new WP_Query('cat='.$cats.'&posts_per_page='.$limit);
        }else{
            $posts = new WP_Query( 'posts_per_page='.$limit);
        }
        ?>
            <div class="kp-headline-wrapper clearfix">
                <span class="kp-headline-title"><?php echo $prefix; ?></span>
                <div class="kp-headline clearfix" style="margin-left:175px;">
                        <?php
                        if ($posts->have_posts()) { ?>
                                <dl class="ticker-1 clearfix" data-speed="<?php echo $speed;?>">
                                    <dt style="display: none;">ticket title</dt>
                                    <?php
                                    while ($posts->have_posts()) {
                                        $posts->the_post();
                                        $post_url = get_permalink();
                                        $post_title = get_the_title();
                                        ?>
                                        <dd><a href="<?php echo $post_url; ?>" title="<?php echo get_the_title(); ?>"><?php echo $post_title; ?></a></dd>
                                        <?php
                                    }
                                    wp_reset_query();
                                    ?>
                                </dl>
                            <?php
                        }
                        ?>
                </div>
            </div>
        <?php
    }
}


/*
* top new
*/
function kopa_the_topnew()
{
    $limit = (int) get_option('kopa_theme_options_topnew_limit', 5);
    if ($limit) {
        $title = get_option('kopa_theme_options_topnew_title', __('Últimas actualizaciones', 'newsmaxx'));
        $cats = (array)get_option('kopa_theme_options_topnew_cats');
        $cats = implode(',', $cats);
        $args = array(
            'posts_per_page'      => $limit,
            'ignore_sticky_posts' => true
        );
        $tax_query = array();
        if ( $cats ) {
            $tax_query[] = array(
                'taxonomy' => 'category',
                'field'    => 'id',
                'terms'    => $cats
            );
        }
        if ( $tax_query ) {
            $args['tax_query'] = $tax_query;
        }
        $posts = new WP_Query( $args );
        $index = 1;
        ?>

    <div class="widget kopa-nothumb-carousel-widget loading">
        <h4 class="widget-title"><?php echo $title; ?></h4>
        <div class="owl-carousel kopa-nothumb-carousel loading">
            <?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
                <div class="item">
                    <article class="entry-item clearfix">
                        <div class="entry-number">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">

                              <img src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/<?php
                              $post_categories = wp_get_post_categories( get_the_ID() );

                              // echo var_dump($post_categories);
                              $c =$post_categories[0];

                              //foreach($post_categories as $c){

                              $cat = get_category( $c );

                              switch($cat->slug){
                               case "museo":
                                echo 'icono-museo-verde.svg';
                                break;

                               case "cuna-cajon":
                                echo "icono-dechiquitomiviejo-verde.svg";
                                break;

                              case "rincon-mudo":
                                echo "icono-rinconmudo-verde.svg";
                                break;

                              }


                              //}
                              ?>" alt="">


                              <?php // kopa_the_image(get_the_ID(), get_the_title(), 60, 60, true, true); ?>
                            </a>
                        </div>
                        <div class="entry-content">
                            <header>
                                <span class="entry-date pull-left">
                                  <!-- <i class="fa fa-pencil-square-o"></i> -->
                                  <?php the_time(get_option('date_format')); ?></span>
                            </header>
                            <h6 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title();?>"><?php the_title(); ?></a></h6>
                        </div>
                        <!-- entry-content -->
                    </article>
                    <!-- entry-item -->
                </div>
                <!-- item -->
                <?php $index++; ?>
            <?php endwhile; ?>
        </div>

        <div class="weather-widget-wrapper">
                        <span class="triangle-1st"></span>
                        <span class="triangle-2nd"></span>
                        <div class="widget widget_awesomeweatherwidget masonry-brick">

                          <h1>Próximo Rival (L)</h1>
                          <p>Juventud Unida <br>
                            Gualeguaychu <br>
                          <span>Domingo 23</span></p>
                            <!-- <div class="awesome-weather-wrap awecf custom awe_with_stats awe_wide" id="awesome-weather-vietnam"> -->

                                <!-- <div class="awesome-weather-header">VietNam</div> -->

                                <!-- <div class="awesome-weather-current-temp">
                                    +24<sup>C</sup>
                                </div>  -->
                                <!-- /.awesome-weather-current-temp -->
<!--
                    s            <div class="awesome-weather-todays-stats">
                                    <div class="awe_desc">moderate rain</div>
                                    <div class="awe_humidty">humidity: 100% </div>
                                    <div class="awe_wind">wind: 2km/h NNW</div>
                                    <div class="awe_highlow"> H 24 • L 24 </div>
                                </div>  -->
                                <!-- /.awesome-weather-todays-stats -->
                                <!-- <div class="awesome-weather-forecast awe_days_1 awecf">
                                    <div class="awesome-weather-forecast-day">
                                        <div class="awesome-weather-forecast-day-temp">24<sup>C</sup></div>
                                        <div class="awesome-weather-forecast-day-abbr">Wed</div>
                                    </div>
                                 </div>  -->
                                 <!-- /.awesome-weather-forecast --></div> <!-- /.awesome-weather-wrap -->
                            </div>
        </div>
        <!-- kopa-nothumb-carousel -->
    </div>
    <!-- widget -->
    <?php
    }
}

/**
 * Get The Excerpt ( the_excerpt ) With Lenght In Theme Option Via Hook the_excerpt
 */
function kopa_custom_excerpt_length( $length ) {
    if ( is_home() || is_archive() || is_search() || is_category() ) {
        $length = (int) get_option('kopa_theme_options_blog_excerpt_length', $length );
    }
    return $length;
}


function kopa_custom_excerpt_more( $more ) {
    return '';
}

/*
 * Remove dimension of post thumbnail
 */
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10, 3 );
function remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

/*
 * Kopa check post title is null
 */
function kopa_check_title_null($id){
    $title = get_the_title($id);
    if ( empty($title) )
        return false;

    return true;
}

/*
 * Kopa get post format icon
 */
function kopa_get_post_format_icon ($post_id) {
    $post_format = get_post_format();
    if ( false === $post_format ) {
        $post_format = 'standard';
    }
    switch($post_format){
        case 'standard':
            $fa_icon = 'fa-pencil-square-o';
            break;
        case 'video':
            $fa_icon = 'fa-picture-o';
            break;
        case 'audio':
            $fa_icon = 'fa-file-audio-o';
            break;
        default:
            $fa_icon = 'fa-pencil-square-o';
            break;
    }
    return $fa_icon;
}

/*
 * Kopa get time ago
 */
function kopa_print_timeago($field_id, $field_name, $selected_timeago, $is_admin = false){
    $timeago = array(
        'label' => __('Timestamp (ago)', 'newsmaxx'),
        'options' => array(
            '' => __('-- Select --', 'newsmaxx'),
            '-1 week' => __('1 week', 'newsmaxx'),
            '-2 week' => __('2 weeks', 'newsmaxx'),
            '-3 week' => __('3 weeks', 'newsmaxx'),
            '-1 month' => __('1 months', 'newsmaxx'),
            '-2 month' => __('2 months', 'newsmaxx'),
            '-3 month' => __('3 months', 'newsmaxx'),
            '-4 month' => __('4 months', 'newsmaxx'),
            '-5 month' => __('5 months', 'newsmaxx'),
            '-6 month' => __('6 months', 'newsmaxx'),
            '-7 month' => __('7 months', 'newsmaxx'),
            '-8 month' => __('8 months', 'newsmaxx'),
            '-9 month' => __('9 months', 'newsmaxx'),
            '-10 month' => __('10 months', 'newsmaxx'),
            '-11 month' => __('11 months', 'newsmaxx'),
            '-1 year' => __('1 year', 'newsmaxx'),
            '-2 year' => __('2 years', 'newsmaxx'),
            '-3 year' => __('3 years', 'newsmaxx'),
            '-4 year' => __('4 years', 'newsmaxx'),
            '-5 year' => __('5 years', 'newsmaxx'),
            '-6 year' => __('6 years', 'newsmaxx'),
            '-7 year' => __('7 years', 'newsmaxx'),
            '-8 year' => __('8 years', 'newsmaxx'),
            '-9 year' => __('9 years', 'newsmaxx'),
            '-10 year' => __('10 years', 'newsmaxx'),
        )
    );
    if ($is_admin) {
        $str_ret = '';
        $str_ret .= '<span class="kopa-component-title">'. $timeago['label'] . '</span>';
        $str_ret .= '<select class="widefat" name="' . $field_name . '" id="' . $field_id . '" class="kopa-ui-taxonomy kopa-ui-select form-control">';
        foreach ($timeago['options'] as $k => $v){
            if ($selected_timeago === $k){
                $str_ret .= '<option value="' . $k . '" selected>' . $v . '</option>';
            } else {
                $str_ret .= '<option value="' . $k . '">' . $v . '</option>';
            }

        }
        $str_ret .= '</select>';
    } else {
        $str_ret = '<p>';
        $str_ret .= '<label for="'.$field_id.'">'. $timeago['label'] . '</label>';
        $str_ret .= '<select class="widefat" name="' . $field_name . '" id="' . $field_id . '">';
        foreach ($timeago['options'] as $k => $v){
            if ($selected_timeago === $k){
                $str_ret .= '<option value="' . $k . '" selected>' . $v . '</option>';
            } else {
                $str_ret .= '<option value="' . $k . '">' . $v . '</option>';
            }

        }
        $str_ret .= '</select>';
        $str_ret .= '</p>';
    }

    echo $str_ret;
}

/*
 * Kopa get image source
 */
function kopa_get_image_src($post_id = 0, $size = 'full', $use_sample_thumbnail) {
    $thumb = get_the_post_thumbnail($post_id, $size);
    if (!empty($thumb)) {
        $_thumb = array();
        $regex = '#<\s*img [^\>]*src\s*=\s*(["\'])(.*?)\1#im';
        preg_match($regex, $thumb, $_thumb);
        $thumb = $_thumb[2];
    } elseif($use_sample_thumbnail) {
            $thumb = get_template_directory_uri() . "/images/sample/index1-nothumb.jpg";
    }
    return $thumb;
}

/*
 * Kopa print image use bfithumb
 */
function kopa_the_image($post_id = 0, $alt = '', $width = 0, $height = 0, $crop = true, $use_sample_thumbnail = false){
    $key_name = 'thumbnail_'.$width.'x'.$height;
    $custom_thumbnail = get_post_meta( $post_id, $key_name, true );

    $img_src = kopa_get_image_src($post_id, 'full', $use_sample_thumbnail);
    if(!empty($custom_thumbnail)){
        echo '<img src="' . $custom_thumbnail . '" alt="' . $alt . '" />';
    }else{
        $params = array( 'width' => $width, 'height' => $height, 'crop' => $crop );
        echo '<img src="' . bfi_thumb($img_src, $params) . '" alt="' . $alt . '" />';
    }
}

/*
 * kopa get current time
 */
function kopa_the_current_time(){
   $retdate = '';
   $gmt = (int) get_option('gmt_offset');
   $retdate .= date( 'l, j/n/Y \| g:i T', current_time( 'timestamp', 1 ));//get_the_time('l, j/n/Y \| g:i T');
   $retdate .= $gmt >= 0 ? '+'.$gmt : $gmt;
    echo '<span class="kopa-current-time pull-left">' . $retdate . '</span>';
}
