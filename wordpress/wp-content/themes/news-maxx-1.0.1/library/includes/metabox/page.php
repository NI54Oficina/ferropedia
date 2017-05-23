<?php
// register the meta box
add_action('add_meta_boxes', 'kopa_edit_extra_page_fields');

function kopa_edit_extra_page_fields() {
    add_meta_box(
        'kopa-page-edit', // this is HTML id of the box on edit screen
        'Layout and Sidebar Options', // title of the box
        'kopa_sidebar_option_box_content_page', // function to be called to display the checkboxes, see the function below
        'page', // on which edit screen the box should appear
        'normal', // part of page where the box should appear
        'default'      // priority of the box
    );
}

// display the metabox
function kopa_sidebar_option_box_content_page($kopa_page) {
    // Use nonce for verification
    wp_nonce_field(plugin_basename(__FILE__), 'kopa_noncename');

    $kopa_page_setting_key = "kopa_page_setting_" . $kopa_page->ID;
    $kopa_setting = get_option('kopa_setting');
    $kopa_page_setting = get_option($kopa_page_setting_key, array());
    $kopa_disable = '';
    if (empty($kopa_page_setting)) {
        $kopa_disable = ' disabled';
        $kopa_checked = '';
        $kopa_checked_value = "No";
        $kopa_page_setting = $kopa_setting["page"];
    } else {
        $kopa_checked = 'checked ="checked"';
        $kopa_disable = '';
        $kopa_checked_value = "Yes";
    }
    $current_layout_sidebar = $kopa_page_setting['sidebars'][$kopa_page_setting['layout_id']];

    $kopa_template_hierarchy = unserialize(KOPA_TEMPLATE_HIERARCHY);
    $kopa_layout = unserialize(KOPA_LAYOUT);
    $kopa_sidebar_position = unserialize(KOPA_SIDEBAR_POSITION);
    $kopa_sidebar = get_option('kopa_sidebar');
    wp_nonce_field("save_layout_setting", "nonce_id_save");
    ?>
<div id="kopa-post-edit" class="kopa-post-edit kopa-content-main-box">
    <div class="kopa-box-head clearfix">
        <input onchange="show_on_checked(jQuery(this));" autocomplete="off" type="checkbox" name="kopa_custom_layout_setting" id="kopa_custom_layout_setting" class="kopa_custom_layout_setting" value="<?php echo $kopa_checked_value; ?>" <?php echo $kopa_checked; ?> >
        <label class="kopa-label">Check if you would like to use custom setting</label>
    </div><!--kopa-box-head-->
    <div class="kopa-box-body clearfix">
        <div class="kopa-layout-box pull-left">
            <div class="kopa-select-layout-box kopa-element-box">

                <span class="kopa-component-title">Select the layout</span>
                <select name ="kopa_select_layout" class="kopa-layout-select"  onchange="show_onchange(jQuery(this));" autocomplete="off" <?php echo $kopa_disable; ?>>
                    <?php
                    foreach ($kopa_template_hierarchy['page']['layout'] as $keys => $value) {
                        echo '<option value="' . $value . '"';
                        if ($value === $kopa_page_setting['layout_id']) {
                            echo 'selected="selected"';
                        }
                        echo '>' . $kopa_layout[$value]['title'] . '</option>';
                    }
                    ?>
                </select>
            </div><!--kopa-select-layout-box-->
            <?php

            foreach ($kopa_template_hierarchy['page']['layout'] as $keys => $value) {
                foreach ($kopa_layout as $layout_key => $layout_value) {
                    if ($layout_key == $value) {
                        ?>
                        <div class="<?php echo 'kopa-sidebar-box-wrapper sidebar-position-' . $layout_key; ?>">
                            <?php
                            foreach ($layout_value['positions'] as $postion_key => $postion_id) {
                                ?>
                                <div class="kopa-sidebar-box kopa-element-box">
                                    <span class="kopa-component-title"><?php echo $kopa_sidebar_position[$postion_id]['title']; ?></span>
                                    <label class="kopa-label">Select sidebars</label>
                                    <?php
                                    echo '<select class="kopa-sidebar-select"  autocomplete="off" ' . $kopa_disable . '>';
                                    if(!empty($kopa_sidebar)){
                                        foreach ($kopa_sidebar as $sidebar_list_key => $sidebar_list_value) {
                                            $__selected_sidebar = '';
                                            if( isset($current_layout_sidebar[$postion_id]) && $current_layout_sidebar[$postion_id] === $sidebar_list_value['sidebar_key']){
                                                $__selected_sidebar = 'selected="selected"';
                                            }
                                            echo '<option value="'.$sidebar_list_value['sidebar_key'].'" ' . $__selected_sidebar . '>' . $sidebar_list_value['sidebar_name'] . '</option>';
                                            $__selected_sidebar = '';
                                        }
                                    }
                                    echo '</select>';
                                    ?>
                                </div><!--kopa-sidebar-box-->
                                <?php } ?>
                        </div><!--kopa-sidebar-box-wrapper-->
                        <?php
                    }
                }
            }
            ?>
        </div><!--kopa-layout-box-->
        <div class="kopa-thumbnails-box pull-right">
            <?php
            foreach ($kopa_template_hierarchy['page']['layout'] as $thumbnails_key => $thumbnails_value) {
                ?>
                    <image class="responsive-img <?php echo 'kopa-cpanel-thumbnails kopa-cpanel-thumbnails-' . $thumbnails_value; ?>" src="<?php echo KOPA_CPANEL_IMAGE_DIR . $kopa_layout[$thumbnails_value]['thumbnails']; ?>" class="img-polaroid" alt="">
                    <?php
            }
            ?>
        </div><!--kopa-thumbnails-box-->
    </div><!--kopa-box-body-->
</div><!--kopa-content-box-->
<?php
}
add_action('save_post', 'kopa_save_page_data');

// When the post is saved, saves our custom data 
function kopa_save_page_data($post_id) {
    if (!isset($_POST['kopa_noncename']) || !wp_verify_nonce($_POST['kopa_noncename'], plugin_basename(__FILE__)))
        return;
    $post_ID = $_POST['post_ID'];
    $kopa_page_setting_key = "kopa_page_setting_" . $post_ID;
    if (empty($_POST['kopa_custom_layout_setting'])) {
        delete_option($kopa_page_setting_key);
    }
    $kopa_layout = unserialize(KOPA_LAYOUT);
    $kopa_position = $kopa_layout[$_POST['kopa_select_layout']]['positions'];

    if (!empty($_POST['kopa_custom_layout_setting']) && !empty($_POST['kopa_select_layout']) && !empty($_POST['sidebar'])) {
        if ($_POST['kopa_custom_layout_setting'] == 'Yes') {
            $before_setting = get_option($kopa_page_setting_key);
            $after_setting = array();
            $after_setting['layout_id'] =  $_POST['kopa_select_layout'];


            $new_sidebars = ($_POST['sidebar']);
            $kopa_sidebar = array();
            foreach ($new_sidebars as $__k => $__v) {
                $kopa_sidebar[$kopa_position[$__k]] = $__v;
            }

            //get sidebars for $before_setting['sidebars']
            if ( !empty($before_setting['sidebars'])) {
                if (in_array($_POST['kopa_select_layout'], $before_setting['sidebars'])){
                    $after_setting['sidebars'][$_POST['kopa_select_layout']] =  $kopa_sidebar;
                } else {
                    $temp_sidebar =  $before_setting['sidebars'];
                    $temp_sidebar[$_POST['kopa_select_layout']] =  $kopa_sidebar;
                    $after_setting['sidebars'] =  $temp_sidebar;
                }
            } else {
                $after_setting['sidebars'][$_POST['kopa_select_layout']] =  $kopa_sidebar;
            }
            update_option($kopa_page_setting_key, $after_setting);
        }
    }
}
