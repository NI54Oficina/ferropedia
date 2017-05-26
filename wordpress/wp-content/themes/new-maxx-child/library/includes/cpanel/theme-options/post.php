<div id="tab-single-post" class="kopa-content-box tab-content tab-content-1">    

    <div class="kopa-box-head">
        <i class="icon-hand-right"></i>
        <span class="kopa-section-title"><?php _e('Featured Post Thumbnail', 'newsmaxx'); ?></span>
    </div><!--kopa-box-head-->
    <div class="kopa-box-body">
        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Show/Hide Featured Post Thumbnail in single post', 'newsmaxx'); ?></span>
            <?php
            $kopa_featured_image_post_status = array(
                'show' => __('Show', 'newsmaxx'),
                'hide' => __('Hide', 'newsmaxx')
            );
            $kopa_featured_image_name = "kopa_theme_options_featured_image_status";
            foreach ($kopa_featured_image_post_status as $value => $label) {
                $kopa_featured_image_status_id = $kopa_featured_image_name . "_{$value}";
                ?>
                <label  for="<?php echo $kopa_featured_image_status_id; ?>" class="kopa-label-for-radio-button"><input type="radio" value="<?php echo esc_attr( $value ); ?>" id="<?php echo $kopa_featured_image_status_id; ?>" name="<?php echo $kopa_featured_image_name; ?>" <?php echo ($value == get_option($kopa_featured_image_name, 'show')) ? 'checked="checked"' : ''; ?>><?php echo $label; ?></label>
                <?php
            } // end foreach
            ?>
        </div>
    </div>

    <div class="kopa-box-head">
        <i class="icon-hand-right"></i>
        <span class="kopa-section-title"><?php _e('Meta data on post', 'newsmaxx'); ?></span>
    </div><!--kopa-box-head-->
    <div class="kopa-box-body">
        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Show/Hide date on post', 'newsmaxx'); ?></span>
            <?php
            $kopa_view_date_status = array(
                'show' => __('Show', 'newsmaxx'),
                'hide' => __('Hide', 'newsmaxx')
            );
            $kopa_view_date_name = "kopa_theme_options_view_date_status";
            foreach ($kopa_view_date_status as $value => $label) {
                $kopa_view_date_id = $kopa_view_date_name . "_{$value}";
                ?>
                <label  for="<?php echo $kopa_view_date_id; ?>" class="kopa-label-for-radio-button"><input type="radio" value="<?php echo esc_attr( $value ); ?>" id="<?php echo $kopa_view_date_id; ?>" name="<?php echo $kopa_view_date_name; ?>" <?php echo ($value == get_option($kopa_view_date_name, 'show')) ? 'checked="checked"' : ''; ?>><?php echo $label; ?></label>
                <?php
            } // end foreach
            ?>
        </div>
    </div>

    <div class="kopa-box-head">
        <i class="icon-hand-right"></i>
        <span class="kopa-section-title"><?php _e('About Author', 'newsmaxx'); ?></span>
    </div><!--kopa-box-head-->
    <div class="kopa-box-body">
        <div class="kopa-element-box kopa-theme-options">            
            <?php
            $about_author_status = array(
                'show' => __('Show', 'newsmaxx'),
                'hide' => __('Hide', 'newsmaxx')
            );
            $about_author_name = "kopa_theme_options_post_about_author";
            foreach ($about_author_status as $value => $label) {
                $about_author_id = $about_author_name . "_{$value}";
                ?>
                <label  for="<?php echo $about_author_id; ?>" class="kopa-label-for-radio-button"><input type="radio" value="<?php echo $value; ?>" id="<?php echo $about_author_id; ?>" name="<?php echo $about_author_name; ?>" <?php echo ($value == get_option($about_author_name, 'show')) ? 'checked="checked"' : ''; ?>><?php echo $label; ?></label>
                <?php
            } // endforeach
            ?>
        </div>
    </div>

    <div class="kopa-box-head">
        <i class="icon-hand-right"></i>
        <span class="kopa-section-title"><?php _e('Post Navigation (previous article and next article)', 'newsmaxx'); ?></span>
    </div><!--kopa-box-head-->
    <div class="kopa-box-body">
        <div class="kopa-element-box kopa-theme-options">            
            <?php
            $post_navigation_status = array(
                'show' => __('Show', 'newsmaxx'),
                'hide' => __('Hide', 'newsmaxx')
            );
            $post_navigation_name = "kopa_theme_options_post_navigation_status";
            foreach ($post_navigation_status as $value => $label) {
                $post_navigation_id = $post_navigation_name . "_{$value}";
                ?>
                <label  for="<?php echo $post_navigation_id; ?>" class="kopa-label-for-radio-button"><input type="radio" value="<?php echo $value; ?>" id="<?php echo $post_navigation_id; ?>" name="<?php echo $post_navigation_name; ?>" <?php echo ($value == get_option($post_navigation_name, 'show')) ? 'checked="checked"' : ''; ?>><?php echo $label; ?></label>
                <?php
            } // endforeach
            ?>
        </div>
    </div>

    <div class="kopa-box-head">
        <i class="icon-hand-right"></i>
        <span class="kopa-section-title"><?php _e('Related Posts', 'newsmaxx'); ?></span>
    </div><!--kopa-box-head-->

    <div class="kopa-box-body">

        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Get By', 'newsmaxx'); ?></span>
            <select class="" id="kopa_theme_options_post_related_get_by" name="kopa_theme_options_post_related_get_by">
                <?php
                $post_related_get_by = array(
                    'hide'     => __('-- Hide --', 'newsmaxx'),
                    'post_tag' => __('Tag', 'newsmaxx'),
                    'category' => __('Category', 'newsmaxx')
                );
                foreach ($post_related_get_by as $value => $title) {
                    printf('<option value="%1$s" %3$s>%2$s</option>', $value, $title, ($value == get_option('kopa_theme_options_post_related_get_by', 'category')) ? 'selected="selected"' : '');
                }
                ?>
            </select>
        </div>

        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Limit', 'newsmaxx'); ?></span>
            <input type="number" value="<?php echo get_option('kopa_theme_options_post_related_limit', 4); ?>" id="kopa_theme_options_post_related_limit" name="kopa_theme_options_post_related_limit">
        </div>
    </div><!--tab-theme-skin-->  

</div><!--tab-container-->