<div class="kopa-content-box tab-content tab-content-1" id="tab-general">

    <!--tab-logo-favicon-icon-->
    <div class="kopa-box-head">
        <i class="icon-hand-right"></i>
        <span class="kopa-section-title"><?php _e('Logo, Favicon, Apple Icon', 'newsmaxx'); ?></span>
    </div><!--kopa-box-head-->

    <div class="kopa-box-body">
        <div class="kopa-element-box kopa-theme-options">

            <span class="kopa-component-title"><?php _e('Logo 1', 'newsmaxx'); ?></span>
            <p class="kopa-desc"><?php _e('Upload your own logo.', 'newsmaxx'); ?></p>
            <div class="clearfix">
                <input class="left" type="text" value="<?php echo get_option('kopa_theme_options_logo_url'); ?>" id="kopa_theme_options_logo_url" name="kopa_theme_options_logo_url">
                <button class="left btn btn-success upload_image_button" alt="kopa_theme_options_logo_url"><i class="icon-circle-arrow-up"></i><?php _e('Upload', 'newsmaxx'); ?></button>
            </div>
            <p class="kopa-desc"><?php _e('Logo margin', 'newsmaxx'); ?></p>
            <label class="kopa-label"><?php _e('Top margin:', 'newsmaxx'); ?> </label>
            <input type="text" value="<?php echo get_option('kopa_theme_options_logo_margin_top'); ?>" id="kopa_theme_options_logo_margin_top" name="kopa_theme_options_logo_margin_top" class=" kopa-short-input">
            <label class="kopa-label"><?php _e('px', 'newsmaxx'); ?></label>

            <span class="kopa-spacer"></span>

            <label class="kopa-label"><?php _e('Left margin:', 'newsmaxx'); ?> </label>
            <input type="text" value="<?php echo get_option('kopa_theme_options_logo_margin_left'); ?>" id="kopa_theme_options_logo_margin_left" name="kopa_theme_options_logo_margin_left" class=" kopa-short-input">
            <label class="kopa-label"><?php _e('px', 'newsmaxx'); ?></label>

            <span class="kopa-spacer"></span>

            <label class="kopa-label"><?php _e('Right margin:', 'newsmaxx'); ?> </label>
            <input type="text" value="<?php echo get_option('kopa_theme_options_logo_margin_right'); ?>" id="kopa_theme_options_logo_margin_right" name="kopa_theme_options_logo_margin_right" class=" kopa-short-input">
            <label class="kopa-label"><?php _e('px', 'newsmaxx'); ?></label>

            <span class="kopa-spacer"></span>

            <label class="kopa-label"><?php _e('Bottom margin:', 'newsmaxx'); ?> </label>
            <input type="text" value="<?php echo get_option('kopa_theme_options_logo_margin_bottom'); ?>" id="kopa_theme_options_logo_margin_bottom" name="kopa_theme_options_logo_margin_bottom" class=" kopa-short-input">
            <label class="kopa-label"><?php _e('px', 'newsmaxx'); ?></label>
        </div><!--kopa-element-box-->


        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Favicon', 'newsmaxx'); ?></span>

            <p class="kopa-desc"><?php _e('Upload your own favicon.', 'newsmaxx'); ?></p>
            <div class="clearfix">
                <input class="left" type="text" value="<?php echo get_option('kopa_theme_options_favicon_url'); ?>" id="kopa_theme_options_favicon_url" name="kopa_theme_options_favicon_url">
                <button class="left btn btn-success upload_image_button" alt="kopa_theme_options_favicon_url"><i class="icon-circle-arrow-up"></i><?php _e('Upload', 'newsmaxx'); ?></button>
            </div>
        </div><!--kopa-element-box-->

        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Apple Icons', 'newsmaxx'); ?></span>

            <p class="kopa-desc"><?php _e('Iphone (57px - 57px)', 'newsmaxx'); ?></p>
            <div class="clearfix">
                <input class="left" type="text" value="<?php echo get_option('kopa_theme_options_apple_iphone_icon_url'); ?>" id="kopa_theme_options_apple_iphone_icon_url" name="kopa_theme_options_apple_iphone_icon_url">
                <button class="left btn btn-success upload_image_button" alt="kopa_theme_options_apple_iphone_icon_url"><i class="icon-circle-arrow-up"></i><?php _e('Upload', 'newsmaxx'); ?></button>
            </div>
            <p class="kopa-desc"><?php _e('Iphone Retina (114px - 114px)', 'newsmaxx'); ?></p>
            <div class="clearfix">
                <input class="left" type="text" value="<?php echo get_option('kopa_theme_options_apple_iphone_retina_icon_url'); ?>" id="kopa_theme_options_apple_iphone_retina_icon_url" name="kopa_theme_options_apple_iphone_retina_icon_url">
                <button class="left btn btn-success upload_image_button" alt="kopa_theme_options_apple_iphone_retina_icon_url"><i class="icon-circle-arrow-up"></i><?php _e('Upload', 'newsmaxx'); ?></button>
            </div>

            <p class="kopa-desc"><?php _e('Ipad (72px - 72px)', 'newsmaxx'); ?></p>
            <div class="clearfix">
                <input class="left" type="text" value="<?php echo get_option('kopa_theme_options_apple_ipad_icon_url'); ?>" id="kopa_theme_options_apple_ipad_icon_url" name="kopa_theme_options_apple_ipad_icon_url">
                <button class="left btn btn-success upload_image_button" alt="kopa_theme_options_apple_ipad_icon_url"><i class="icon-circle-arrow-up"></i><?php _e('Upload', 'newsmaxx'); ?></button>
            </div>

            <p class="kopa-desc"><?php _e('Ipad Retina (144px - 144px)', 'newsmaxx'); ?></p>
            <div class="clearfix">
                <input class="left" type="text" value="<?php echo get_option('kopa_theme_options_apple_ipad_retina_icon_url'); ?>" id="kopa_theme_options_apple_ipad_retina_icon_url" name="kopa_theme_options_apple_ipad_retina_icon_url">
                <button class="btn btn-success upload_image_button" alt="kopa_theme_options_apple_ipad_retina_icon_url"><i class="icon-circle-arrow-up"></i><?php _e('Upload', 'newsmaxx'); ?></button>
            </div>
        </div><!--kopa-element-box-->


    </div><!--tab-logo-favicon-icon-->

    <?php
    /**
     * Show/hide breadcrumb
     */
    ?> 
    <div class="kopa-box-head">
        <i class="icon-hand-right"></i>
        <span class="kopa-section-title"><?php _e('Breadcrumb', 'newsmaxx'); ?></span>
    </div><!--kopa-box-head-->
    <div class="kopa-box-body">
        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Show/Hide Breadcrumb:', 'newsmaxx'); ?></span>
            <?php
            $kopa_breadcrumb_status = array(
                'show' => __('Show', 'newsmaxx'),
                'hide' => __('Hide', 'newsmaxx')
            );
            $kopa_breadcrumb_status_name = "kopa_theme_options_breadcrumb_status";
            foreach ($kopa_breadcrumb_status as $value => $label) {
                $kopa_breadcrumb_id = $kopa_breadcrumb_status_name . "_{$value}";
                ?>
                <label  for="<?php echo $kopa_breadcrumb_id; ?>" class="kopa-label-for-radio-button"><input type="radio" value="<?php echo esc_attr( $value ); ?>" id="<?php echo $kopa_breadcrumb_id; ?>" name="<?php echo $kopa_breadcrumb_status_name; ?>" <?php echo ($value == get_option($kopa_breadcrumb_status_name, 'show')) ? 'checked="checked"' : ''; ?>><?php echo $label; ?></label>
                <?php
            } // end foreach
            ?>
        </div>
    </div>

    
    <div class="kopa-box-head">
        <i class="icon-hand-right"></i>
        <span class="kopa-section-title"><?php _e('Excerpt length', 'newsmaxx'); ?></span>
    </div><!--kopa-box-head-->
    <div class="kopa-box-body">
        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Blog excerpt length', 'newsmaxx'); ?></span>
            <input type="number" value="<?php echo get_option('kopa_theme_options_blog_excerpt_length', 10); ?>" id="kopa_theme_options_blog_excerpt_length" name="kopa_theme_options_blog_excerpt_length">
        </div>
    </div>

    <div class="kopa-box-head">
        <i class="icon-hand-right"></i>
        <span class="kopa-section-title"><?php _e('Blog', 'newsmaxx'); ?></span>
    </div><!--kopa-box-head-->
    <div class="kopa-box-body">
        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Show/Hide Read more:', 'newsmaxx'); ?></span>
            <?php
            $kopa_blog_readmore_status = array(
                'show' => __('Show', 'newsmaxx'),
                'hide' => __('Hide', 'newsmaxx')
            );
            $kopa_blog_readmore_status_name = "kopa_theme_options_blog_readmore_status";
            foreach ($kopa_blog_readmore_status as $value => $label) {
                $kopa_blog_readmore_id = $kopa_blog_readmore_status_name . "_{$value}";
                ?>
                <label  for="<?php echo $kopa_blog_readmore_id; ?>" class="kopa-label-for-radio-button"><input type="radio" value="<?php echo esc_attr( $value ); ?>" id="<?php echo $kopa_blog_readmore_id; ?>" name="<?php echo $kopa_blog_readmore_status_name; ?>" <?php echo ($value == get_option($kopa_blog_readmore_status_name, 'show')) ? 'checked="checked"' : ''; ?>><?php echo $label; ?></label>
                <?php
            } // end foreach
            ?>
        </div>
    </div>

    <?php
    /*
     * Top news
     */
    ?>
    <div class="kopa-box-head">
        <i class="icon-hand-right"></i>
        <span class="kopa-section-title"><?php _e('Top news', 'newsmaxx'); ?></span>
    </div><!-- kopa-box-head-->
    <div class="kopa-box-body">
        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Title', 'newsmaxx'); ?></span>
            <input type="text" value="<?php echo get_option('kopa_theme_options_topnew_title', __('FROM AROUND THE WORLD', 'newsmaxx')); ?>" id="topnew_title" name="kopa_theme_options_topnew_title">
        </div>
        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Categories', 'newsmaxx'); ?></span>
            <?php
            $terms = get_terms('category');
            $topnew_cats = get_option('kopa_theme_options_topnew_cats');
            ?>
            <select id="topcontent_cats" name="kopa_theme_options_topnew_cats[]" class="kopa-ui-taxonomy kopa-ui-select form-control" multiple="multiple" autocomplete="off" size="5">
                <option value="">-- Select --</option>
                <?php foreach($terms as $v) :?>
                <?php if ( !empty($topnew_cats) ) :?>
                    <option value="<?php echo $v->term_id; ?>" <?php echo in_array($v->term_id, $topnew_cats) ? 'selected="selected"' : ''; ?>><?php echo $v->name . '(' . $v->count . ')'; ?></option>
                    <?php else: ?>
                    <option value="<?php echo $v->term_id; ?>"><?php echo $v->name . '(' . $v->count . ')'; ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Number of posts', 'newsmaxx'); ?></span>
            <?php
            $topnew_limit = get_option('kopa_theme_options_topnew_limit', 8);
            ?>
            <select id="kopa_theme_options_topnew_limit" name="kopa_theme_options_topnew_limit" class="kopa-ui-taxonomy kopa-ui-select form-control" autocomplete="off">
                <?php for ( $i=1; $i<20; $i++ ) {?>
                <option value='<?php echo $i;?>' <?php if (isset($topnew_limit) && $topnew_limit == $i) echo 'selected="selected"'; ?>><?php echo $i;?></option>
                <?php }?>
            </select>
        </div>
        <div class="kopa-element-box kopa-theme-options">
            <?php $topnew_timestamp = get_option('kopa_theme_options_topnew_timestamp'); ?>
            <?php kopa_print_timeago('kopa_theme_options_topnew_timestamp', 'kopa_theme_options_topnew_timestamp', $topnew_timestamp, true);?>
        </div>
    </div>
    <?php
    /*
     * Headline
     */
    ?>

    <div class="kopa-box-head">
        <i class="icon-hand-right"></i>
        <span class="kopa-section-title"><?php _e('Headline', 'newsmaxx'); ?></span>
    </div><!-- kopa-box-head-->

    <div class="kopa-box-body">
        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Prefix', 'newsmaxx'); ?></span>
            <input type="text" value="<?php echo get_option('kopa_theme_options_headline_prefix', __('BREAKING NEWS', 'newsmaxx')); ?>" id="headline_prefix" name="kopa_theme_options_headline_prefix">
        </div>
        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Categories', 'newsmaxx'); ?></span>
            <?php
                $terms = get_terms('category');
                $headline_cats = get_option('kopa_theme_options_headline_cats');
            ?>
            <select id="headline_cats" name="kopa_theme_options_headline_cats[]" class="kopa-ui-taxonomy kopa-ui-select form-control" multiple="multiple" autocomplete="off" size="5">
                <option value="">-- Select --</option>
                <?php foreach($terms as $v) :?>
                    <?php if ( !empty($headline_cats) ) :?>
                    <option value="<?php echo $v->term_id; ?>" <?php echo in_array($v->term_id, $headline_cats) ? 'selected="selected"' : ''; ?>><?php echo $v->name . '(' . $v->count . ')'; ?></option>
                    <?php else: ?>
                    <option value="<?php echo $v->term_id; ?>"><?php echo $v->name . '(' . $v->count . ')'; ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Number of posts', 'newsmaxx'); ?></span>
            <?php
                $headline_limit = get_option('kopa_theme_options_headline_limit', 5);
            ?>
            <select id="kopa_theme_options_headline_limit" name="kopa_theme_options_headline_limit" class="kopa-ui-taxonomy kopa-ui-select form-control" autocomplete="off">
                <?php for ( $i=1; $i<20; $i++ ) {?>
                   <option value='<?php echo $i;?>' <?php if (isset($headline_limit) && $headline_limit == $i) echo 'selected="selected"'; ?>><?php echo $i;?></option>
                <?php }?>
            </select>
        </div>

        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Duration', 'newsmaxx'); ?></span>
            <p class="kopa-desc">Speed in milliseconds</p>
            <input type="number" value="<?php echo get_option('kopa_theme_options_headline_duration', 700); ?>" id="headline_duration" name="kopa_theme_options_headline_duration">
        </div>

        <div class="kopa-element-box kopa-theme-options">
            <?php $headline_timestamp = get_option('kopa_theme_options_headline_timestamp'); ?>
            <?php kopa_print_timeago('kopa_theme_options_headline_timestamp', 'kopa_theme_options_headline_timestamp', $headline_timestamp, true);?>
        </div>
    </div>

    <?php 
    /**
     * Footer
     */
    ?> 
    <div class="kopa-box-head">
        <i class="icon-hand-right"></i>
        <span class="kopa-section-title"><?php _e('Footer', 'newsmaxx'); ?></span>
    </div><!--kopa-box-head-->

    <div class="kopa-box-body">

        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Custom Footer Description', 'newsmaxx'); ?></span>
            <p class="kopa-desc"><?php _e('Enter the content you want to display in your footer (e.g. copyright text).', 'newsmaxx'); ?></p>
            <textarea rows="6" id="kopa_setting_copyrights" name="kopa_theme_options_copyright"><?php echo esc_attr(get_option('kopa_theme_options_copyright', sprintf(__( 'Copyright %1$s - Kopasoft. All Rights Reserved.', 'newsmaxx' ), date('Y')))); ?></textarea>
        </div><!--kopa-element-box-->


    </div>

</div><!--kopa-content-box-->

