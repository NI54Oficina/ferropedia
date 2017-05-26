<?php
$kopa_url = 'http://kopatheme.com';
?>
<div id="kopa-admin-wrapper" class=" kopa-sidebar-manager clearfix">
    <div id="kopa-loading-gif"></div>
    <div class="kopa-content ">
        <div class="kopa-page-header clearfix">
            <div class="pull-left">
                <h4><i class="icon-cog"></i>Sidebar Manager</h4>
            </div>
            <div class="pull-right">
                <div class="kopa-copyrights">
                    <span>Visit author URL: </span><a href="<?php echo $kopa_url; ?>"><?php echo $kopa_url; ?></a>
                </div><!--="kopa-copyrights-->
            </div>
        </div><!--kopa-page-header-->
        <div class="kopa-content-box" id="template-home">
            <div class="kopa-box-head">
                <i class="icon-hand-right"></i>
                <span class="kopa-section-title">Sidebar Manager</span>
            </div><!--kopa-box-head-->
            <div class="kopa-box-body clearfix"> 
                <div class="kopa-add-sidebar-box">
                    <div class="kopa-sidebar-box kopa-element-box">
                        <span class="kopa-component-title">Add sidebar</span>
                        <label class="kopa-label">Add your sidebars below and then you can assign one of these sidebars from the individual posts/pages. </label>                        
                        <div class="clearfix mt5">
                            <input type="text" class="kopa-sidebar-input left" id="kopa-sidebar-new" placeholder="Sidebar name" >
                            <input type="text" class="kopa-sidebar-input left" id="kopa-sidebar-des-new" placeholder="Sidebar description" >
                            <span title="Add" rel="tooltip" class="btn btn-primary left" data-original-title="Add" onclick="kopa_add_sidebar_clicked(jQuery(this))"><i class="icon-plus-sign"></i>Add sidebar</span>
                        </div>
                    </div><!--kopa-sidebar-box-->
                </div><!--kopa-add-sidebar-box-->
                <div class="kopa-edit-sidebar-box">
                    <div class="kopa-sidebar-box kopa-element-box">
                        <span class="kopa-component-title">Existing Sidebars</span>
                        <?php
                        $kopa_sidebar = get_option("kopa_sidebar");
                        $is_empty_array = true;
                        if ($kopa_sidebar) {
                            foreach ($kopa_sidebar as $elm) {
                                if (count($elm) > 0)
                                    $is_empty_array = false;
                                else
                                    $is_empty_array = true;
                            }
                        }
                        if (!$is_empty_array) {
                            ?>
                            <table class="table table-nomargin">
                                <thead>
                                    <tr>
                                        <th>Sidebar Name</th>
                                        <th>Sidebar Description</th>
                                        <th>Remove</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody id="kopa-sidebar-list">
                                    <?php
                                    foreach ($kopa_sidebar as $kopa_sidebar_element_key => $kopa_sidebar_element_value) {
                                        if (!empty($kopa_sidebar_element_value)) {
                                            ?>
                                            <tr <?php if ($kopa_sidebar_element_value['sidebar_name'] === "-- None --") echo 'style ="display:none;"'; ?>>
                                                <td><?php echo $kopa_sidebar_element_value['sidebar_name']; ?></td>
                                                <td><?php echo $kopa_sidebar_element_value['sidebar_des']; ?></td>
                                                <td><a onclick="kopa_remove_sidebar_clicked(jQuery(this), '<?php echo $kopa_sidebar_element_key; ?>')" title="" lang="" rel="tooltip" class="button button-basic button-icon" data-original-title="Remove"><i class="icon-trash"></i></a></td>
                                                <td>
                                                    <a href="#TB_inline?width=600&height=350&inlineId=my-edit-content" onclick="kopa_show_edit_form(jQuery(this), '<?php echo $kopa_sidebar_element_value['sidebar_name']; ?>', '<?php echo $kopa_sidebar_element_value['sidebar_des']; ?>', '<?php echo $kopa_sidebar_element_key; ?>')" class="thickbox button button-basic button-icon"><i class="icon-pencil"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        <?php } else {
                            ?>
                            <label id="kopa-nosidebar-label" class="kopa-label">No sidebar defined</label>
                            <table class="table table-nomargin hidden">
                                <thead>
                                    <tr>
                                        <th>Sidebar Name</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody id="kopa-sidebar-list">

                                </tbody>
                            </table>
                            <?php
                        }
                        ?>
                    </div><!--kopa-sidebar-box-->

                    <?php add_thickbox(); ?>
                    <div id="my-edit-content" style="display:none;">
                        <div class="kopa-content-box">
                            <div class="kopa-box-head">
                                <i class="icon-hand-right"></i>
                                <span class="kopa-section-title">Sidebar Manager</span>
                            </div>
                            <div class="kopa-box-body clearfix">
                                <div class="divtable">
                                    <div class="divrow">
                                        <div class="divcol1">
                                            Sidebar Name:
                                        </div>
                                        <div class="divcol2">
                                            <input type="text" name="kopa-remove-sidebar-key" id="kopa-remove-sidebar-key" style="display: none;"/>
                                            <input type="text" name="kopa-sidebar-name" id="kopa-sidebar-name" />
                                        </div>
                                    </div>
                                    <div class="divrow">
                                        <div class="divcol1">
                                            Sidebar Description:
                                        </div>
                                        <div class="divcol2">
                                            <textarea rows="5" cols="8" name="kopa-sidebar-des" id="kopa-sidebar-des"></textarea>
                                        </div>
                                    </div>
                                    <div class="divrow">
                                        <div class="divcolspan">
                                            <a onclick="kopa_edit_sidebar_clicked(jQuery(this))" class="button button-basic button-icon">Update</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--kopa-edit-sidebar-box-->


            </div><!--kopa-box-body-->           
        </div><!--kopa-content-box-->       
    </div><!--kopa-content-->
</div><!--kopa-admin-wrapper-->

<?php wp_nonce_field("save_sidebar_setting", "nonce_id_save_sidebar"); ?>
<?php wp_nonce_field("kopa_rename_sidebar", "kopa_rename_sidebar_ajax_nonce"); ?>