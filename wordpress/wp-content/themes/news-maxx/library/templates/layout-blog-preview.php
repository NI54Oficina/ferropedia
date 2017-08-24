<?php
    //get_header();
	get_template_part( 'library/templates/header', 'style-preview' );
	  
  
    global $kopa_layout;
    global $kopa_setting;
    $sidebars = $kopa_setting['sidebars'][$kopa_setting['layout_id']];
    $kopa_layout = unserialize(KOPA_LAYOUT);
    $kopa_position = $kopa_layout[$kopa_setting['layout_id']]['positions'];
	
?>

<?php get_footer();?>
