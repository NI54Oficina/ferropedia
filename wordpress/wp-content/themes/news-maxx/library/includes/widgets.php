<?php
/**
 * Widget Registration
 * @package Newsmaxx
 */
add_action('widgets_init', 'kopa_widgets_init');

function kopa_widgets_init() {
    register_widget('Kopa_Widget_Text');
    register_widget('Kopa_Widget_Articles_List');
    register_widget('Kopa_Widget_Video');
    register_widget('Kopa_Widget_List_Gallery'); // dùng ở sidebar
    register_widget('Kopa_Widget_Combo');
    register_widget('Kopa_Widget_Contact_Info');
}

add_action('admin_enqueue_scripts', 'kopa_widget_admin_enqueue_scripts');

function kopa_widget_admin_enqueue_scripts($hook) {
    if ('widgets.php' === $hook) {
        $dir = get_template_directory_uri() . '/library';
        wp_enqueue_style('kopa_widget_admin', "{$dir}/css/widget.css");
        wp_enqueue_script('kopa_widget_admin', "{$dir}/js/widget.js", array('jquery'));
    }
}

function kopa_widget_article_build_query($query_args = array()) {
    $args = array(
        'post_type' => array('post'),
        'posts_per_page' => $query_args['number_of_article']
    );

    $tax_query = array();

    if ($query_args['categories']) {
        $tax_query[] = array(
            'taxonomy' => 'category',
            'field' => 'id',
            'terms' => $query_args['categories']
        );
    }
    if ($query_args['tags']) {
        $tax_query[] = array(
            'taxonomy' => 'post_tag',
            'field' => 'id',
            'terms' => $query_args['tags']
        );
    }
    if ($query_args['relation'] && count($tax_query) == 2) {
        $tax_query['relation'] = $query_args['relation'];
    }

    if ($tax_query) {
        $args['tax_query'] = $tax_query;
    }

    switch ($query_args['orderby']) {
        case 'popular':
            $args['meta_key'] = 'kopa_' . 'newsmaxx' . '_total_view';
            $args['orderby'] = 'meta_value_num';
            break;
        case 'most_comment':
            $args['orderby'] = 'comment_count';
            break;
        case 'random':
            $args['orderby'] = 'rand';
            break;
        default:
            $args['orderby'] = 'date';
            break;
    }
    if (isset($query_args['post__not_in']) && $query_args['post__not_in']) {
        $args['post__not_in'] = $query_args['post__not_in'];
    }
    return new WP_Query($args);
}

function kopa_widget_posttype_build_query( $query_args = array() ) {
    $default_query_args = array(
        'post_type'      => 'post',
        'posts_per_page' => -1,
        'post__not_in'   => array(),
        'ignore_sticky_posts' => 1,
        'categories'     => array(),
        'tags'           => array(),
        'relation'       => 'OR',
        'post_format' => '',
        'orderby'        => 'latest',
        'cat_name'       => 'category',
        'tag_name'       => 'post_tag'
    );

    $query_args = wp_parse_args( $query_args, $default_query_args );

    $args = array(
        'post_type'           => $query_args['post_type'],
        'posts_per_page'      => $query_args['posts_per_page'],
        'post_format' => $query_args['post_format'],
        'post__not_in'        => $query_args['post__not_in'],
        'ignore_sticky_posts' => $query_args['ignore_sticky_posts']
    );

    $tax_query = array();

    if ( $query_args['categories'] ) {
        $tax_query[] = array(
            'taxonomy' => $query_args['cat_name'],
            'field'    => 'id',
            'terms'    => $query_args['categories']
        );
    }
    if ( $query_args['tags'] ) {
        $tax_query[] = array(
            'taxonomy' => $query_args['tag_name'],
            'field'    => 'id',
            'terms'    => $query_args['tags']
        );
    }
    if ( $query_args['relation'] && count( $tax_query ) == 2 ) {
        $tax_query['relation'] = $query_args['relation'];
    }
    if ( $query_args['post_format'] ) {
        $tax_query[] = array(
            'taxonomy' => 'post_format',
            'field' => 'slug',
            'terms' => array( $query_args['post_format'] )
        );
    }

    if ( isset($query_args['date_query']) && $query_args['date_query'] ){
        global $wp_version;
        $timestamp =  $query_args['date_query'];
        if (version_compare($wp_version, '3.7.0', '>=')) {
            if (isset($timestamp) && !empty($timestamp)) {
                $y = date('Y', strtotime($timestamp));
                $m = date('m', strtotime($timestamp));
                $d = date('d', strtotime($timestamp));
                $args['date_query'] = array(
                    array(
                        'after' => array(
                            'year' => (int) $y,
                            'month' => (int) $m,
                            'day' => (int) $d
                        )
                    )
                );
            }
        }
    }


    if ( $tax_query ) {
        $args['tax_query'] = $tax_query;
    }

    switch ( $query_args['orderby'] ) {
        case 'popular':
            $args['meta_key'] = 'kopa_' . 'newsmaxx' . '_total_view';
            $args['orderby'] = 'meta_value_num';
            break;
        case 'most_comment':
            $args['orderby'] = 'comment_count';
            break;
        case 'random':
            $args['orderby'] = 'rand';
            break;
        default:
            $args['orderby'] = 'date';
            break;
    }

    return new WP_Query( $args );
}

class Kopa_Widget_Text extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'widget_text', 'description' => __('Arbitrary text, HTML or shortcodes', 'newsmaxx'));
        $control_ops = array('width' => 600, 'height' => 400);
        parent::__construct('kopa_widget_text', __('Kopa Text', 'newsmaxx'), $widget_ops, $control_ops);
    }

    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        $text = apply_filters('widget_text', empty($instance['text']) ? '' : $instance['text'], $instance);

        echo $before_widget;
        ?>

    <h4 class="widget-title">
        <?php if (!empty($title)) : ?>
            <?php echo $title;?>
        <?php endif; ?>
    </h4>
    <!-- widget-title -->
    <?php echo !empty($instance['filter']) ? wpautop($text) : $text; ?>

    <?php
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['title-icon'] = $new_instance['title-icon'];
        if (current_user_can('unfiltered_html')) {
            $instance['text'] = $new_instance['text'];
        } else {
            $instance['text'] = stripslashes(wp_filter_post_kses(addslashes($new_instance['text'])));
        }
        $instance['filter'] = isset($new_instance['filter']);

        return $instance;
    }

    function form($instance) {
        $instance = wp_parse_args((array) $instance, array(
            'title'      => '',
            'text'       => ''));
        $title = strip_tags($instance['title']);
        $text = esc_textarea($instance['text']);
        ?>
    <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'newsmaxx'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
    </p>
    <ul class="kopa_shortcode_icons">
        <?php
        $shortcodes = array(
            'one_half'           => __( 'One Half Column', 'newsmaxx' ),
            'one_third'          => __( 'One Thirtd Column', 'newsmaxx' ),
            'two_third'          => __( 'Two Third Column', 'newsmaxx' ),
            'one_fourth'         => __( 'One Fourth Column', 'newsmaxx' ),
            'three_fourth'       => __( 'Three Fourth Column', 'newsmaxx' ),
            'dropcaps'           => __( 'Add Dropcaps Text', 'newsmaxx' ),
            'button'             => __( 'Add A Button', 'newsmaxx' ),
            'alert'              => __( 'Add A Alert Box', 'newsmaxx' ),
            'tabs'               => __( 'Add A Tabs Content', 'newsmaxx' ),
            'accordions'         => __( 'Add A Accordions Content', 'newsmaxx' ),
            'toggle'             => __( 'Add A Toggle Content', 'newsmaxx' ),
            'contact_form'       => __( 'Add A Contact Form', 'newsmaxx' ),
            // 'posts_lastest'      => __( 'Add A List Latest Post', 'newsmaxx' ),
            // 'posts_popular'      => __( 'Add A List Popular Post', 'newsmaxx' ),
            // 'posts_most_comment' => __( 'Add A List Most Comment Post', 'newsmaxx' ),
            // 'posts_random'       => __( 'Add A List Random Post', 'newsmaxx' ),
            'youtube'            => __( 'Add A Yoube Video Box', 'newsmaxx' ),
            'vimeo'              => __( 'Add A Vimeo Video Box', 'newsmaxx' ),
        );
        foreach ($shortcodes as $rel => $title):
            ?>
            <li>
                <a onclick="return kopa_shortcode_icon_click('<?php echo $rel; ?>', jQuery('#<?php echo $this->get_field_id('text'); ?>'));" href="#" class="<?php echo "kopa-icon-{$rel}"; ?>" rel="<?php echo $rel; ?>" title="<?php echo $title; ?>"></a>
            </li>
            <?php endforeach; ?>
    </ul>
    <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
    <p>
        <input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('filter'); ?>"><?php _e('Automatically add paragraphs', 'newsmaxx'); ?></label>
    </p>
    <?php
    }

}


/**
 * Widget article list
 */
class Kopa_Widget_Articles_List extends WP_Widget {
    function __construct() {
        $widget_ops = array('classname' => 'kp-article-list-widget', 'description' => __('Article list widget', 'newsmaxx'));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('kopa_widget_article_list', __('Kopa Widget Article List', 'newsmaxx'), $widget_ops, $control_ops);
    }

    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? __('List Articles', 'newsmaxx') : $instance['title'], $instance, $this->id_base);

        $query_args['categories'] = $instance['categories'];
        $query_args['relation'] = esc_attr($instance['relation']);
        $query_args['tags'] = $instance['tags'];
        $query_args['posts_per_page'] = (int) $instance['posts_per_page'];
        if (isset($instance['kopa_timestamp'])){
            $query_args['date_query'] = $instance['kopa_timestamp'];
        }
        $query_args['orderby'] = $instance['orderby'];
        $limit = $instance['limit'];

        $posts = kopa_widget_posttype_build_query($query_args);
        ?>

        <div class="widget kopa-article-list-1-widget clearfix">
            <h4 class="widget-title"><?php echo $title; ?></h4>
            <?php
                if ( $posts->have_posts() ){
                    $index = 0;
                    while ( $posts->have_posts() ){
                        $posts->the_post();
                       $index++;

                        $li_common = '<li>';
                        $li_common .= '<article class="entry-item clearfix">';
                        $li_common .= '<div class="entry-content">';
                        $li_common .= '<header>';
                        if ( kopa_check_title_null(get_the_ID())){
                           $li_common .= '<span class="entry-date"><i class="fa '. kopa_get_post_format_icon(get_the_ID()) . '"></i>' . get_the_time(get_option('date_format')) . '</span>';
                        }else{
                           $li_common .= '<span class="entry-date"><i class="fa '. kopa_get_post_format_icon(get_the_ID()) . '"></i><a href="' . get_permalink() . '" title="' . get_the_title() . '">' . get_the_time(get_option('date_format')) . '</a></span>';
                        }
                        $li_common .= '<span class="entry-meta">&nbsp;/&nbsp;</span>';
                        $li_common .= '<span class="entry-author">' .  __("By ", 'newsmaxx') . '<a href="' . get_author_posts_url(get_the_author_meta('ID')) . '">' . get_the_author_meta('display_name') . '</a></span>';
                        $li_common .= '</header>';
                        $li_common .= '<h6 class="entry-title"><a href="' . get_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a></h6>';
                        $li_common .= '</div>';
                        $li_common .= '</article>';
                        $li_common .= '</li>';


                       if ( 1 === $index ){?>
                           <article class="last-item clearfix">
                               <?php if ( has_post_thumbnail() ) :?>
                                   <div class="entry-thumb">
                                       <a href="<?php the_permalink(); ?>" title="<?php the_title();?>">
                                           <?php kopa_the_image(get_the_ID(), get_the_title(), 267, 256); ?>
                                       </a>
                                   </div>
                               <?php endif; ?><!-- entry-thumb -->
                               <div class="entry-content">
                                   <header>
                                       <span class="entry-date pull-left"><i class="fa <?php echo kopa_get_post_format_icon(get_the_ID()); ?>"></i><?php the_time(get_option('date_format')); ?></span>
                                   </header>
                                   <h6 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title();?>"><?php the_title(); ?></a></h6>
                                   <?php global $post; ?>
                                   <p><?php echo kopa_get_the_excerpt_for_widget($post->post_excerpt, $post->post_content, $limit); ?></p>
                                   <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="more-link"><span><?php _e('Read more', 'newsmaxx'); ?></span></a>
                               </div>
                               <!-- entry-content -->
                           </article>
                           <!-- last-item -->
                       <?php } elseif ( 2 === $index ){?>
                           <ul class="older-post clearfix">
                               <?php echo $li_common; ?>
                       <?php } elseif ( $index === $posts->post_count ){?>
                                <?php echo $li_common; ?>
                           </ul>
                       <?php } else {?>
                        <?php echo $li_common; ?>
                       <?php }
                    }
                }
            ?>
        </div>



    <?php
        wp_reset_postdata();
    }

    function form($instance) {
        $default = array(
            'title' => '',
            'categories' => array(),
            'relation' => 'OR',
            'tags' => array(),
            'posts_per_page' => 6,
            'kopa_timestamp' => '',
            'limit' => 55,
            'orderby' => 'latest',
            'display_type' => 'medium'
        );
        $instance = wp_parse_args((array) $instance, $default);
        $title = strip_tags($instance['title']);
        $limit = (int)$instance['limit'];

        $form['categories'] = $instance['categories'];
        $form['relation'] = esc_attr($instance['relation']);
        $form['tags'] = $instance['tags'];
        $form['posts_per_page'] = (int) $instance['posts_per_page'];
        $form['kopa_timestamp'] = (int) $instance['kopa_timestamp'];
        $form['orderby'] = $instance['orderby'];
        $form['display_type'] = $instance['display_type'];
        ?>

    <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'newsmaxx'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'categories' ); ?>"><?php _e( 'Categories', 'newsmaxx' ); ?></label>
        <select class="widefat" id="<?php echo $this->get_field_id( 'categories' ); ?>" name="<?php echo $this->get_field_name( 'categories' ) ?>[]" multiple="multiple" size="5">
            <option value=""><?php _e('--Select--', 'newsmaxx'); ?></option>
            <?php
            $categories = get_categories();
            foreach ($categories as $category) :
                ?>
                <option value="<?php echo $category->term_id; ?>" <?php echo in_array($category->term_id, $form['categories']) ? 'selected="selected"' : ''; ?>>
                    <?php echo $category->name.' ('.$category->count.')'; ?></option>
                <?php
            endforeach;
            ?>
        </select>
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('relation'); ?>"><?php _e('Relation', 'newsmaxx'); ?>:</label>
        <select class="widefat" name="<?php echo $this->get_field_name('relation'); ?>" id="<?php echo $this->get_field_id('relation'); ?>">
            <option value="OR" <?php selected('OR', $form['relation']); ?>><?php _e('OR', 'newsmaxx'); ?></option>
            <option value="AND" <?php selected('AND', $form['relation']); ?>><?php _e('AND', 'newsmaxx'); ?></option>
        </select>
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'tags' ); ?>"><?php _e( 'Tags', 'newsmaxx' ); ?></label>
        <select class="widefat" id="<?php echo $this->get_field_id( 'tags' ); ?>" name="<?php echo $this->get_field_name( 'tags' ) ?>[]" multiple="multiple" size="5">
            <option value=""><?php _e('--Select--', 'newsmaxx'); ?></option>
            <?php
            $tags = get_tags();
            foreach ($tags as $category) :
                ?>
                <option value="<?php echo $category->term_id; ?>" <?php echo in_array($category->term_id, $form['tags']) ? 'selected="selected"' : ''; ?>>
                    <?php echo $category->name.' ('.$category->count.')'; ?></option>
                <?php
            endforeach;
            ?>
        </select>
    </p>
    <?php kopa_print_timeago($this->get_field_id('kopa_timestamp'), $this->get_field_name('kopa_timestamp'), $form['kopa_timestamp']); ?>
    <p>
        <label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e( 'Orderby', 'newsmaxx' ); ?></label>
        <select class="widefat" name="<?php echo $this->get_field_name( 'orderby' ); ?>" id="<?php echo $this->get_field_id('orderby' ); ?>">
            <?php $orderby = array(
            'latest'      => __('Latest', 'newsmaxx'),
            'popular'      => __('Popular by view count', 'newsmaxx'),
            'most_comment' => __('Popular by comment count', 'newsmaxx'),
            'random'       => __('Random', 'newsmaxx')
        );

            foreach ($orderby as $value => $label) :
                ?>
                <option value="<?php echo $value; ?>" <?php selected($value, $form['orderby']); ?>><?php echo $label; ?></option>
                <?php
            endforeach;
            ?>
        </select>
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('posts_per_page'); ?>"><?php _e('Number of items:', 'newsmaxx'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('posts_per_page'); ?>" name="<?php echo $this->get_field_name('posts_per_page'); ?>" value="<?php echo $form['posts_per_page']; ?>" type="number" min="1">
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Custom post excerpt length:', 'newsmaxx'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" />
    </p>


    <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['categories'] = (empty($new_instance['categories'])) ? array() : array_filter($new_instance['categories']);
        $instance['relation'] = $new_instance['relation'];
        $instance['tags'] = (empty($new_instance['tags'])) ? array() : array_filter($new_instance['tags']);
        $instance['posts_per_page'] = (int) $new_instance['posts_per_page'];
        $instance['orderby'] = $new_instance['orderby'];
        $instance['kopa_timestamp'] = $new_instance['kopa_timestamp'];
        $instance['limit'] = $new_instance['limit'];
        return $instance;
    }
}

/*
 * Widget Article List Carousel
 */

class Kopa_Widget_Article_List_Carousel extends WP_Widget {
    function __construct() {
        $widget_ops = array('classname' => 'kopa-full-width-carousel-widget', 'description' => __('Article list carousel', 'newsmaxx'));
        $control_ops = array('width' => '500', 'height' => 'auto');
        parent::__construct('kopa_widget_article_list_carousel', __('Kopa Widget Article List Carousel', 'newsmaxx'), $widget_ops, $control_ops);
    }

    function form($instance) {
        $default = array(
            'title' => '',
            'categories' => array(),
            'relation' => 'OR',
            'tags' => array(),
            'posts_per_page' => 4,
            'limit' => 55,
            'kopa_timestamp' => '',
            'orderby' => 'latest',
            'slide_speed'         => 700,
            'is_auto_play'      => 'false',
            'display'      => 'fullwidth_image'
        );
        $instance = wp_parse_args((array) $instance, $default);
        $title = strip_tags($instance['title']);
        $limit = (int)$instance['limit'];

        $form['categories'] = $instance['categories'];
        $form['relation'] = esc_attr($instance['relation']);
        $form['tags'] = $instance['tags'];
        $form['posts_per_page'] = (int) $instance['posts_per_page'];
        $form['kopa_timestamp'] = (int) $instance['kopa_timestamp'];
        $form['orderby'] = $instance['orderby'];
        $form['display'] = $instance['display'];
        $form['slide_speed'] = $instance['slide_speed'];
        $form['is_auto_play'] = $instance['is_auto_play'];
        ?>
    <div class="kopa-one-half">
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'newsmaxx'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'categories' ); ?>"><?php _e( 'Categories', 'newsmaxx' ); ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id( 'categories' ); ?>" name="<?php echo $this->get_field_name( 'categories' ) ?>[]" multiple="multiple" size="5">
                <option value=""><?php _e('--Select--', 'newsmaxx'); ?></option>
                <?php
                $categories = get_categories();
                foreach ($categories as $category) :
                    ?>
                    <option value="<?php echo $category->term_id; ?>" <?php echo in_array($category->term_id, $form['categories']) ? 'selected="selected"' : ''; ?>>
                        <?php echo $category->name.' ('.$category->count.')'; ?></option>
                    <?php
                endforeach;
                ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('relation'); ?>"><?php _e('Relation', 'newsmaxx'); ?>:</label>
            <select class="widefat" name="<?php echo $this->get_field_name('relation'); ?>" id="<?php echo $this->get_field_id('relation'); ?>">
                <option value="OR" <?php selected('OR', $form['relation']); ?>><?php _e('OR', 'newsmaxx'); ?></option>
                <option value="AND" <?php selected('AND', $form['relation']); ?>><?php _e('AND', 'newsmaxx'); ?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'tags' ); ?>"><?php _e( 'Tags', 'newsmaxx' ); ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id( 'tags' ); ?>" name="<?php echo $this->get_field_name( 'tags' ) ?>[]" multiple="multiple" size="5">
                <option value=""><?php _e('--Select--', 'newsmaxx'); ?></option>
                <?php
                $tags = get_tags();
                foreach ($tags as $category) :
                    ?>
                    <option value="<?php echo $category->term_id; ?>" <?php echo in_array($category->term_id, $form['tags']) ? 'selected="selected"' : ''; ?>>
                        <?php echo $category->name.' ('.$category->count.')'; ?></option>
                    <?php
                endforeach;
                ?>
            </select>
        </p>
        <?php kopa_print_timeago($this->get_field_id('kopa_timestamp'), $this->get_field_name('kopa_timestamp'), $form['kopa_timestamp']); ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e( 'Orderby', 'newsmaxx' ); ?></label>
            <select class="widefat" name="<?php echo $this->get_field_name( 'orderby' ); ?>" id="<?php echo $this->get_field_id('orderby' ); ?>">
                <?php $orderby = array(
                'latest'      => __('Latest', 'newsmaxx'),
                'popular'      => __('Popular by view count', 'newsmaxx'),
                'most_comment' => __('Popular by comment count', 'newsmaxx'),
                'random'       => __('Random', 'newsmaxx')
            );

                foreach ($orderby as $value => $label) :
                    ?>
                    <option value="<?php echo $value; ?>" <?php selected($value, $form['orderby']); ?>><?php echo $label; ?></option>
                    <?php
                endforeach;
                ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('posts_per_page'); ?>"><?php _e('Number of items:', 'newsmaxx'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('posts_per_page'); ?>" name="<?php echo $this->get_field_name('posts_per_page'); ?>" value="<?php echo $form['posts_per_page']; ?>" type="number" min="1">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Custom post excerpt length:', 'newsmaxx'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'display' ); ?>"><?php _e( 'Display:', 'newsmaxx' ); ?></label>
            <select class="widefat" name="<?php echo $this->get_field_name( 'display' ); ?>" id="<?php echo $this->get_field_id('display' ); ?>">
                <?php $display = array(
                'grid_layout_random_flexible_size' => __('Display random articles in flexible grid layout', 'newsmaxx'),
                'grid_with_3items_per_page'    => __('Grid with three items per page', 'newsmaxx'),
            );

                foreach ($display as $value => $label) :
                    ?>
                    <option value="<?php echo $value; ?>" <?php selected($value, $form['display']); ?>><?php echo $label; ?></option>
                    <?php
                endforeach;
                ?>
            </select>
        </p>
    </div>
    <div class="kopa-one-half last">
        <p>
            <label for="<?php echo $this->get_field_id('slide_speed'); ?>"><?php _e('Slide speed:', 'newsmaxx'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('slide_speed'); ?>" name="<?php echo $this->get_field_name('slide_speed'); ?>" value="<?php echo $form['slide_speed']; ?>" type="number" min="1">
            <small><?php _e('Slide speed in milliseconds', 'newsmaxx'); ?></small>
        </p>
        <p>
            <input id="<?php echo $this->get_field_id('is_auto_play'); ?>" name="<?php echo $this->get_field_name('is_auto_play'); ?>" type="checkbox" value="true" <?php echo ('true' === $form['is_auto_play']) ? 'checked="checked"' : ''; ?> />
            <label for="<?php echo $this->get_field_id('is_auto_play'); ?>"><?php _e('Auto Play', 'newsmaxx'); ?></label>
        </p>
    </div>
    <div class="kopa-clear"></div>
    <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['categories'] = (empty($new_instance['categories'])) ? array() : array_filter($new_instance['categories']);
        $instance['relation'] = $new_instance['relation'];
        $instance['tags'] = (empty($new_instance['tags'])) ? array() : array_filter($new_instance['tags']);
        $instance['posts_per_page'] = (int) $new_instance['posts_per_page'];
        $instance['kopa_timestamp'] = (int) $new_instance['kopa_timestamp'];
        $instance['orderby'] = $new_instance['orderby'];
        $instance['limit'] = $new_instance['limit'];
        $instance['slide_speed'] = (int) $new_instance['slide_speed'];
        $instance['is_auto_play'] = isset($new_instance['is_auto_play']) ? $new_instance['is_auto_play'] : 'false';
        $instance['display'] = $new_instance['display'];
        return $instance;
    }

    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? __('List Articles Carousel', 'newsmaxx') : $instance['title'], $instance, $this->id_base);
        $limit = (int) $instance['limit'];
        $posts_per_page = (int) $instance['posts_per_page'];
        $query_args['categories'] = $instance['categories'];
        $query_args['relation'] = esc_attr($instance['relation']);
        $query_args['tags'] = $instance['tags'];
        $query_args['posts_per_page'] = (int) $instance['posts_per_page'];
        $query_args['orderby'] = $instance['orderby'];
        if (isset($instance['kopa_timestamp'])){
            $query_args['date_query'] = $instance['kopa_timestamp'];
        }

        $posts = kopa_widget_posttype_build_query($query_args);
        $categories = $instance['categories'];
        $display = $instance['display'];
        $slideSpeed = (int) $instance['slide_speed'];

        ?>

    <?php if ( 'grid_layout_random_flexible_size' === $display) : ?>
        <div class="widget kopa masonry-list-widget">
            <?php if ($title){?>
                <h4 class="widget-title"><?php echo $title; ?></h4>
            <?php }?>
            <div class="masonry-wrapper">
                <?php if ( $posts->have_posts()) : $count = 1; ?>
                    <input type='hidden' id='current_page-<?php echo $this->number;?>' />
                    <input type='hidden' id='show_per_page-<?php echo $this->number; ?>' />
                    <ul class="clearfix masonry-list" id="kopa-masonry-<?php echo $this->number; ?>" data-id="#kopa-masonry-<?php echo $this->number; ?>" data-currentpage="#current_page-<?php echo $this->number; ?>" data-pagenavigation="#page_navigation_<?php echo $this->number; ?>" data-showperpage="#show_per_page-<?php echo $this->number; ?>">
                        <?php while ( $posts->have_posts()) :
                            $posts->the_post();
                            if ( 2 === $count || 3 === $count ) {
                                $li_class = 'masonry-item width-2 height-2';
                                $img_width = 226;
                                $img_height = 224;
                            } else if ( 4 === $count ) {
                                $li_class = 'masonry-item width-3 height-2';
                                $img_width = 457;
                                $img_height = 224;
                                $count = 0;
                            } else {
                                $li_class = 'masonry-item';
                                $img_width = 420;
                                $img_height = 452;
                            }
                        ?>
                            <li class="<?php echo $li_class; ?>">
                                <?php //if ( has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php kopa_the_image(get_the_ID(), get_the_title(), $img_width, $img_height, true, true); ?></a>
                                <?php //endif; ?>
                                <h4 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
                            </li>
                         <?php $count++; ?>
                         <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
            </div>
            <div class="pagination clearfix">
                <ul class="page-numbers clearfix" id='page_navigation_<?php echo $this->number; ?>'>
                </ul><!--page-numbers-->
            </div>
        </div>
    <?php endif; ?>

    <?php if ( 'grid_with_3items_per_page' === $display) : ?>
       <div class="widget kopa-carousel-list-2-widget">
           <?php
            if(!empty($title)){?>
                <h4 class="widget-title"><?php echo $title; ?></h4>
            <?php }
           ?>
            <div class="owl-carousel kopa-owl-carousel-1" data-autoplay="<?php echo $instance['is_auto_play']; ?>" data-slidespeed="<?php echo $slideSpeed;?>">
                <?php
                   if ( $posts->have_posts() ){
                       $i = 0;
                       $before_item = '<div class="item"><ul>';
                       $after_item = '</ul></div>';
                        while ( $posts->have_posts()) {
                            $posts->the_post();
                            //item html
                            $item_html = '<li>';
                            $item_html .= '<article class="entry-item">';
                            if (has_post_thumbnail()){
                               $item_html .= '<div class="entry-thumb">';
                               $img_src = kopa_get_image_src(get_the_ID(), 'full', false);
                               $params = array( 'width' => 217 , 'height' => 168, 'crop' => true );
                               $item_html .= '<a href="'. get_permalink() .'" title="'. get_the_title() .'"><img src="' . bfi_thumb($img_src, $params) . '" alt="' . get_the_title() . '" /></a>';
                               $item_html .= '</div>';
                            }
                            $item_html .= '<div class="entry-content">';
                                $item_html .= '<span class="entry-date"><i class="fa fa-pencil-square-o"></i>'.  get_the_time(get_option('date_format')) . '</span>';
                                $item_html .= '<h6 class="entry-title"><a href="' . get_permalink() . '" title="' . get_the_title() . '">'. get_the_title() . '</a></h6>';
                            $item_html .= '</div>';
                            $item_html .= '</article>';
                            $item_html .= '</li>';

                            if ($i % 3 == 0){
                                echo $before_item;
                            }
                            echo $item_html;
                            if ($i % 3 == 2){
                                echo $after_item;
                            }

                            $i++;
                    }
                    //Check in case don't have multiple of 3 items
                    if ($i % 3 != 0){
                       echo $after_item;
                    }
                }?>
            </div>
        </div>
    <?php endif; ?>
    <?php wp_reset_postdata();
    }
}


/**
 * Sidebar Tab Widget Class
 * @since Newsmaxx 1.0
 */
class Kopa_Widget_Combo extends WP_Widget {
    function __construct() {
        $widget_ops = array('classname' => 'kopa-tab-1-widget', 'description' => __('A widget displays popular articles, recent articles and most comment articles.', 'newsmaxx'));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('kopa_widget_combo', __('Kopa Widget Combo', 'newsmaxx'), $widget_ops, $control_ops);
    }

    function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

        echo $before_widget;

        $query_args['posts_per_page'] = $instance['number_of_article'];
        $tab_args = array();

        if ( $instance['popular_title'] ) {
            $tab_args[] = array(
                'label'   => $instance['popular_title'],
                'orderby' => 'popular',
            );
        }

        if ( $instance['latest_title'] ) {
            $tab_args[] = array(
                'label'   => $instance['latest_title'],
                'orderby' => 'latest',
            );
        }

        if ( $instance['comment_title'] ) {
            $tab_args[] = array(
                'label'   => $instance['comment_title'],
                'orderby' => 'most_comment',
            );
        }
        ?>

        <ul class="nav nav-tabs kopa-tabs-1">
            <?php foreach ( $tab_args as $k => $tab_arg ):?>
                <li class="<?php if(0===$k) echo 'active';?>"><a data-toggle="tab" href="#tab1-<?php echo $this->number .$k; ?>"><?php echo $tab_arg['label']; ?></a></li>
            <?php endforeach; ?>
        </ul> <!-- nav-tabs -->

        <div class="tab-content">
            <?php foreach ( $tab_args as $k1 => $tab_arg ):
            $query_args['orderby'] = $tab_arg['orderby'];
            if (isset($instance['kopa_timestamp'])){
                $query_args['date_query'] = $instance['kopa_timestamp'];
            }
            $posts = kopa_widget_posttype_build_query( $query_args );
            ?>
            <div id="tab1-<?php echo $this->number . $k1; ?>" class="tab-pane<?php if (0 === $k1) echo ' active'; ?>">
                <ul class="clearfix">
                    <?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
                    <li>
                        <article class="entry-item clearfix">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="entry-thumb">
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                        <?php kopa_the_image(get_the_ID(), get_the_title(), 60, 60); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <div class="entry-content">
                                <header>
                                    <?php
                                        if ( kopa_check_title_null(get_the_ID())){?>
                                            <span class="entry-date pull-left"><i class="fa <?php echo kopa_get_post_format_icon(get_the_ID()); ?>"></i><?php the_time(get_option('date_format'));?></span>
                                        <?php }else{ ?>
                                            <span class="entry-date pull-left"><i class="fa <?php echo kopa_get_post_format_icon(get_the_ID()); ?>"></i><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_time(get_option('date_format'));?></a></span>
                                        <?php }
                                    ?>

                                    <span class="entry-meta">&nbsp;/&nbsp;</span>
                                    <span class="entry-author"><?php _e('By', 'newsmaxx'); ?> <?php the_author_posts_link(); ?></span>
                                </header>
                                <h6 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title();?>"><?php the_title(); ?></a></h6>
                            </div>
                        </article>
                    </li>
                    <?php endwhile; ?>
                </ul>
            </div>
            <?php endforeach; ?>
        </div><!-- tab-content -->

    <?php
        echo $after_widget;
        wp_reset_postdata();
    }

    function form($instance) {
        $defaults = array(
            'title'             => '',
            'number_of_article' => 3,
            'popular_title'     => __( 'POPULAR', 'newsmaxx' ),
            'comment_title'     => __( 'COMMENT', 'newsmaxx' ),
            'latest_title'      => __( 'RECENT', 'newsmaxx' ),
            'kopa_timestamp' => '',
        );
        $instance = wp_parse_args( (array) $instance, $defaults );
        $title = strip_tags( $instance['title'] );
        $form['number_of_article'] = $instance['number_of_article'];
        $form['popular_title'] = $instance['popular_title'];
        $form['comment_title'] = $instance['comment_title'];
        $form['latest_title'] = $instance['latest_title'];
        $form['kopa_timestamp'] = (int) $instance['kopa_timestamp'];
        ?>
    <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'newsmaxx'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('number_of_article'); ?>"><?php _e('Number of article:', 'newsmaxx'); ?></label>
        <input class="widefat" type="number" min="1" id="<?php echo $this->get_field_id('number_of_article'); ?>" name="<?php echo $this->get_field_name('number_of_article'); ?>" value="<?php echo esc_attr( $form['number_of_article'] ); ?>">
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('popular_title'); ?>"><?php _e('Popular tab title:', 'newsmaxx'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('popular_title'); ?>" name="<?php echo $this->get_field_name('popular_title'); ?>" type="text" value="<?php echo esc_attr($form['popular_title']); ?>">
        <small><?php _e( 'Leave it <strong>empty</strong> to hide popular tab.', 'newsmaxx' ); ?></small>
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('latest_title'); ?>"><?php _e('Latest tab title:', 'newsmaxx'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('latest_title'); ?>" name="<?php echo $this->get_field_name('latest_title'); ?>" type="text" value="<?php echo esc_attr($form['latest_title']); ?>">
        <small><?php _e( 'Leave it <strong>empty</strong> to hide latest tab.', 'newsmaxx' ); ?></small>
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('comment_title'); ?>"><?php _e('Comment tab title:', 'newsmaxx'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('comment_title'); ?>" name="<?php echo $this->get_field_name('comment_title'); ?>" type="text" value="<?php echo esc_attr($form['comment_title']); ?>">
        <small><?php _e( 'Leave it <strong>empty</strong> to hide comment tab.', 'newsmaxx' ); ?></small>
    </p>

    <?php kopa_print_timeago($this->get_field_id('kopa_timestamp'), $this->get_field_name('kopa_timestamp'), $form['kopa_timestamp']); ?>
    <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number_of_article'] = (int) $new_instance['number_of_article'];
        // validate number of article
        if ( 0 >= $instance['number_of_article'] ) {
            $instance['number_of_article'] = 5;
        }
        $instance['popular_title'] = strip_tags( $new_instance['popular_title'] );
        $instance['comment_title'] = strip_tags( $new_instance['comment_title'] );
        $instance['latest_title'] = strip_tags( $new_instance['latest_title'] );
        $instance['kopa_timestamp'] = $new_instance['kopa_timestamp'];

        return $instance;
    }
}


class Kopa_Widget_List_Gallery extends WP_Widget {
    function __construct() {
        $widget_ops = array('classname' => 'kopa-gallery-widget', 'description' => __('Show list posts (gallery format) of categories', 'newsmaxx'));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('kp-list-gallery-widget', __('Kopa Widget List Galleries', 'newsmaxx'), $widget_ops, $control_ops);
    }

    function form($instance) {
        $default = array(
            'title' => '',
            'categories' => array(),
            'posts_per_page' => 6,
            'kopa_timestamp' => '',
            'orderby' => 'latest'
        );
        $instance = wp_parse_args((array) $instance, $default);
        $title = strip_tags($instance['title']);
        $form['categories'] = $instance['categories'];
        $form['posts_per_page'] = (int) $instance['posts_per_page'];
        $form['kopa_timestamp'] = (int) $instance['kopa_timestamp'];
        $form['orderby'] = $instance['orderby'];
        ?>

    <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'newsmaxx'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'categories' ); ?>"><?php _e( 'Categories', 'newsmaxx' ); ?></label>
        <select class="widefat" id="<?php echo $this->get_field_id( 'categories' ); ?>" name="<?php echo $this->get_field_name( 'categories' ) ?>[]" multiple="multiple" size="5">
            <option value=""><?php _e('--Select--', 'newsmaxx'); ?></option>
            <?php
            $categories = get_categories();
            foreach ($categories as $category) :
                ?>
                <option value="<?php echo $category->term_id; ?>" <?php echo in_array($category->term_id, $form['categories']) ? 'selected="selected"' : ''; ?>>
                    <?php echo $category->name.' ('.$category->count.')'; ?></option>
                <?php
            endforeach;
            ?>
        </select>
    </p>
    <?php kopa_print_timeago($this->get_field_id('kopa_timestamp'), $this->get_field_name('kopa_timestamp'), $form['kopa_timestamp']); ?>
    <p>
        <label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e( 'Orderby', 'newsmaxx' ); ?></label>
        <select class="widefat" name="<?php echo $this->get_field_name( 'orderby' ); ?>" id="<?php echo $this->get_field_id('orderby' ); ?>">
            <?php $orderby = array(
            'latest'      => __('Latest', 'newsmaxx'),
            'popular'      => __('Popular by view count', 'newsmaxx'),
            'most_comment' => __('Popular by comment count', 'newsmaxx'),
            'random'       => __('Random', 'newsmaxx')
        );

            foreach ($orderby as $value => $label) :
                ?>
                <option value="<?php echo $value; ?>" <?php selected($value, $form['orderby']); ?>><?php echo $label; ?></option>
                <?php
            endforeach;
            ?>
        </select>
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('posts_per_page'); ?>"><?php _e('Number of items:', 'newsmaxx'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('posts_per_page'); ?>" name="<?php echo $this->get_field_name('posts_per_page'); ?>" value="<?php echo $form['posts_per_page']; ?>" type="number" min="1">
    </p>
    <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['categories'] = (empty($new_instance['categories'])) ? array() : array_filter($new_instance['categories']);
        $instance['posts_per_page'] = (int) $new_instance['posts_per_page'];
        $instance['kopa_timestamp'] = $new_instance['kopa_timestamp'];
        $instance['orderby'] = $new_instance['orderby'];
        return $instance;
    }

    function widget($args, $instance) {
        extract($args);
        $title = apply_filters( 'widget_title', empty($instance['title'] ) ? __( 'NEW GALLERY', 'newsmaxx' ) : $instance['title'], $instance, $this->id_base );
        $args['categories'] = $instance['categories'];
        $args['posts_per_page'] = (int) $instance['posts_per_page'];
        $args['post_format'] = 'post-format-gallery';
        if (isset($instance['kopa_timestamp'])){
            $args['date_query'] = $instance['kopa_timestamp'];
        }
        $posts = kopa_widget_posttype_build_query($args);
        ?>
            <div class="widget kopa-gallery-widget">
                <?php if (!empty($title)):?>
                    <h4 class="widget-title"><?php echo $title; ?></h4>
                <?php endif; ?>
                <?php
                    if ( $posts->have_posts() ){?>
                        <ul class="clearfix">
                            <?php
                                while( $posts->have_posts()){
                                    $posts->the_post(); ?>
                                    <li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php kopa_the_image(get_the_ID(), get_the_title(), 127, 97, true, true); ?></a></li>
                                <?php }
                            ?>
                        </ul>
                    <?php }
                ?>
            </div>
    <?php wp_reset_postdata();
    }
}

/*
 * Contact Info Widget Class
 */
class Kopa_Widget_Contact_Info extends WP_Widget
{
    function __construct() {
        $widget_ops = array('classname' => 'kopa-contact-info-widget', 'description' => __('Display contact info', 'newsmaxx'));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('kopa_widget_contact_info', __('Kopa Contact Info', 'newsmaxx'), $widget_ops, $control_ops);
    }

    function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __('CONTACT', 'newsmaxx') : $instance['title'], $instance, $this->id_base );
        $sub = apply_filters( 'widget_title_sub', empty( $instance['sub'] ) ? __('US', 'newsmaxx') : $instance['sub'], $instance, $this->id_base );
        $mail = $instance['mail'];
        $phone = $instance['phone'];
        $fax = $instance['fax'];
        $address = $instance['address'];

        echo $before_widget;
        if (!empty($title)){?>
            <h4 class="widget-title"><?php echo $title; ?>
                <?php if (!empty($sub)){ ?>
                    <span><?php echo $sub;?></span>
                <?php }?>
            </h4>
        <?php }
        ?>

        <?php if (!empty($instance['image'])) : ?>
            <div class="contact-map">
                <?php
                    $params = array( 'width' => 247, 'height' => 131, 'crop' => true );
                    echo '<img src="' . bfi_thumb($instance['image'], $params) . '" alt="' . $title . '" title="' . $title . '" />'
                ?>
            </div>
        <?php endif; ?>
        <div class="contact-info">
            <?php if (!empty($mail)): ?>
                <p class="clearfix"><i class="fa fa-envelope"></i><strong><?php _e('Email:', 'newsmaxx'); ?> </strong><a href="mailto:<?php echo $mail; ?>"><?php echo $mail; ?></a></p>
            <?php endif ;?>

            <?php if (!empty($phone)): ?>
                <p class="clearfix"><i class="fa fa-phone"></i><strong><?php _e('Phone:', 'newsmaxx'); ?> </strong><?php echo $phone; ?></p>
            <?php endif ;?>

            <?php if (!empty($fax)): ?>
                <p class="clearfix"><i class="fa fa-print"></i><strong><?php _e('Fax:', 'newsmaxx'); ?> </strong><?php echo $fax; ?></p>
            <?php endif ;?>

            <?php if (!empty($address)): ?>
                <p class="clearfix"><i class="fa fa-map-marker"></i><strong><?php _e('Address:', 'newsmaxx'); ?> </strong><span><?php echo $address; ?></span></p>
            <?php endif ;?>
        </div>
    <?php
        echo $after_widget;
    }

    function form( $instance ) {
        $defaults = array(
            'title'                  => __( 'Contact', 'newsmaxx' ),
            'sub'                  => __( 'Us', 'newsmaxx' ),
            'image'  => '',
            'mail'  => '',
            'phone' => '',
            'fax'            => '',
            'address'            => '',
        );
        $instance = wp_parse_args( (array) $instance, $defaults );
        $title = strip_tags( $instance['title'] );
        $sub = strip_tags( $instance['sub'] );
        $form['mail'] = strip_tags($instance['mail']);
        $form['phone'] = strip_tags ($instance['phone']);
        $form['fax'] = strip_tags($instance['fax']);
        $form['address'] = strip_tags($instance['address']);
        ?>
    <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'newsmaxx'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('sub'); ?>"><?php _e('Sub title:', 'newsmaxx'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('sub'); ?>" name="<?php echo $this->get_field_name('sub'); ?>" type="text" value="<?php echo esc_attr($sub); ?>">
    </p>

    <p class="clearfix">
        <label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php _e( 'Image:', 'newsmaxx' ) ?></label>
        <input class="widefat" type="url" value="<?php echo $instance['image']; ?>" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>">
        <span>&nbsp;</span>
        <button class="left btn btn-success upload_image_button" alt="<?php echo $this->get_field_id( 'image' ); ?>"><i class="icon-circle-arrow-up"></i><?php _e('Upload', 'newsmaxx'); ?></button>
    </p>

    <p>
        <label for="<?php echo $this->get_field_id('mail'); ?>"><?php _e('Email:', 'newsmaxx'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('mail'); ?>" name="<?php echo $this->get_field_name('mail'); ?>" type="text" value="<?php echo esc_attr($form['mail']); ?>">
    </p>

    <p>
        <label for="<?php echo $this->get_field_id('phone'); ?>"><?php _e('Phone:', 'newsmaxx'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo esc_attr($form['phone']); ?>">
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('fax'); ?>"><?php _e('Fax:', 'newsmaxx'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('fax'); ?>" name="<?php echo $this->get_field_name('fax'); ?>" type="text" value="<?php echo esc_attr($form['fax']); ?>">
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('address'); ?>"><?php _e('Address:', 'newsmaxx'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" type="text" value="<?php echo esc_attr($form['address']); ?>">
    </p>
    <?php
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['sub'] = strip_tags( $new_instance['sub'] );
        $instance['image'] = $new_instance['image'];
        $instance['mail'] = strip_tags( $new_instance['mail'] );
        $instance['phone'] = strip_tags( $new_instance['phone'] );
        $instance['fax'] = strip_tags( $new_instance['fax'] );
        $instance['address'] = strip_tags( $new_instance['address'] );
        return $instance;
    }
}

/*
 * Kopa widget video
 */
class Kopa_Widget_Video extends WP_Widget {
    function __construct() {
        $widget_ops = array('classname' => 'widget kopa-video-widget clearfix', 'description' => __('video list widget', 'newsmaxx'));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('kopa_widget_video', __('Kopa Widget List Video', 'newsmaxx'), $widget_ops, $control_ops);
    }

    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? __('List Videos', 'newsmaxx') : $instance['title'], $instance, $this->id_base);


        $query_args['categories'] = $instance['categories'];
        $query_args['relation'] = esc_attr($instance['relation']);
        if (isset($instance['kopa_timestamp'])){
            $query_args['date_query'] = $instance['kopa_timestamp'];
        }

        $query_args['post_format'] = 'post-format-video';
        $query_args['posts_per_page'] = (int) $instance['posts_per_page'];
        $query_args['orderby'] = $instance['orderby'];

        $posts = kopa_widget_posttype_build_query($query_args);
        echo $before_widget;
        ?>
        <?php if ($title) {?>
            <h4 class="widget-title"><?php echo $title; ?></h4>
        <?php }else{?>
            <span class="widget-title no-title"></span>
        <?php }?>

        <?php
            if ($posts->have_posts()){
                $index = 0;
                while($posts->have_posts()){
                    $posts->the_post();
                    $index++;
                    $li_common = '<li>';
                    $li_common .= ' <h6 class="entry-title"><a href="' . get_permalink() . '" title="' . get_the_title() . '"><i class="fa fa-film"></i>' . get_the_title() . '</a></h6>';
                    $li_common .= '</li>';


                    if ( 1 === $index ){?>
                        <article class="last-item">
                        <div class="entry-thumb">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php kopa_the_image(get_the_ID(), get_the_title(), 267, 180, true, true); ?></a>
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="entry-icon fa fa-play"></a>
                            <div class="meta-box clearfix">
                                <span class="entry-date pull-left"><i class="fa fa-film"></i><?php the_time(get_option('date_format')); ?></span>
                                <span class="entry-meta pull-left">&nbsp;/&nbsp;</span>
                                <span class="entry-author pull-left"><?php _e('By', 'newsmaxx'); ?> <?php the_author_posts_link(); ?></span>
                            </div>
                            <!-- meta-box -->
                        </div>
                        <div class="entry-content">
                            <h6 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title();?>"><?php the_title();?></a></h6>
                        </div>
                    </article>
                    <?php }elseif ( 2 === $index ){?>
                        <ul class="older-post clearfix">
                            <?php echo $li_common; ?>
                    <?php }elseif ($index === $posts->post_count){?>
                        <?php echo $li_common; ?>
                        </ul>
                    <?php }else{?>
                        <?php echo $li_common; ?>
                    <?php }
                }
            }
        ?>

    <?php
        echo $after_widget;
        wp_reset_postdata();
    }

    function form($instance) {
        $default = array(
            'title' => '',
            'categories' => array(),
            'relation' => 'OR',
            'tags' => array(),
            'kopa_timestamp' => '',
            'posts_per_page' => 6,
            'orderby' => 'latest',
        );
        $instance = wp_parse_args((array) $instance, $default);
        $title = strip_tags($instance['title']);
        $form['categories'] = $instance['categories'];
        $form['relation'] = esc_attr($instance['relation']);
        $form['tags'] = $instance['tags'];
        $form['kopa_timestamp'] = $instance['kopa_timestamp'];
        $form['posts_per_page'] = (int) $instance['posts_per_page'];
        $form['orderby'] = $instance['orderby'];
        ?>

    <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'newsmaxx'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'categories' ); ?>"><?php _e( 'Categories', 'newsmaxx' ); ?></label>
        <select class="widefat" id="<?php echo $this->get_field_id( 'categories' ); ?>" name="<?php echo $this->get_field_name( 'categories' ) ?>[]" multiple="multiple" size="5">
            <option value=""><?php _e('--Select--', 'newsmaxx'); ?></option>
            <?php
            $categories = get_categories();
            foreach ($categories as $category) :
                ?>
                <option value="<?php echo $category->term_id; ?>" <?php echo in_array($category->term_id, $form['categories']) ? 'selected="selected"' : ''; ?>>
                    <?php echo $category->name.' ('.$category->count.')'; ?></option>
                <?php
            endforeach;
            ?>
        </select>
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('relation'); ?>"><?php _e('Relation', 'newsmaxx'); ?>:</label>
        <select class="widefat" name="<?php echo $this->get_field_name('relation'); ?>" id="<?php echo $this->get_field_id('relation'); ?>">
            <option value="OR" <?php selected('OR', $form['relation']); ?>><?php _e('OR', 'newsmaxx'); ?></option>
            <option value="AND" <?php selected('AND', $form['relation']); ?>><?php _e('AND', 'newsmaxx'); ?></option>
        </select>
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'tags' ); ?>"><?php _e( 'Tags', 'newsmaxx' ); ?></label>
        <select class="widefat" id="<?php echo $this->get_field_id( 'tags' ); ?>" name="<?php echo $this->get_field_name( 'tags' ) ?>[]" multiple="multiple" size="5">
            <option value=""><?php _e('--Select--', 'newsmaxx'); ?></option>
            <?php
            $tags = get_tags();
            foreach ($tags as $category) :
                ?>
                <option value="<?php echo $category->term_id; ?>" <?php echo in_array($category->term_id, $form['tags']) ? 'selected="selected"' : ''; ?>>
                    <?php echo $category->name.' ('.$category->count.')'; ?></option>
                <?php
            endforeach;
            ?>
        </select>
    </p>
    <?php kopa_print_timeago($this->get_field_id('kopa_timestamp'), $this->get_field_name('kopa_timestamp'), $form['kopa_timestamp']); ?>
    <p>
        <label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e( 'Orderby', 'newsmaxx' ); ?></label>
        <select class="widefat" name="<?php echo $this->get_field_name( 'orderby' ); ?>" id="<?php echo $this->get_field_id('orderby' ); ?>">
            <?php $orderby = array(
            'latest'      => __('Latest', 'newsmaxx'),
            'popular'      => __('Popular by view count', 'newsmaxx'),
            'most_comment' => __('Popular by comment count', 'newsmaxx'),
            'random'       => __('Random', 'newsmaxx')
        );

            foreach ($orderby as $value => $label) :
                ?>
                <option value="<?php echo $value; ?>" <?php selected($value, $form['orderby']); ?>><?php echo $label; ?></option>
                <?php
            endforeach;
            ?>
        </select>
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('posts_per_page'); ?>"><?php _e('Number of items:', 'newsmaxx'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('posts_per_page'); ?>" name="<?php echo $this->get_field_name('posts_per_page'); ?>" value="<?php echo $form['posts_per_page']; ?>" type="number" min="1">
    </p>
    <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['categories'] = (empty($new_instance['categories'])) ? array() : array_filter($new_instance['categories']);
        $instance['relation'] = $new_instance['relation'];
        $instance['tags'] = (empty($new_instance['tags'])) ? array() : array_filter($new_instance['tags']);
        $instance['kopa_timestamp'] = $new_instance['kopa_timestamp'];
        $instance['posts_per_page'] = (int) $new_instance['posts_per_page'];
        $instance['orderby'] = $new_instance['orderby'];
        return $instance;
    }
}

