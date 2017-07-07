<?php
    get_header();
    global $kopa_layout;
    global $kopa_setting;
    $sidebars = $kopa_setting['sidebars'][$kopa_setting['layout_id']];
    $kopa_layout = unserialize(KOPA_LAYOUT);
    $kopa_position = $kopa_layout[$kopa_setting['layout_id']]['positions'];
?>

<div class="wrapper clearfix">

  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-col pull-left">


    <section class="entry-list">
         <?php get_template_part( 'library/templates/loop', 'blog-1' ); ?>
   </section>

    <div class="clear"></div>

  </div>
</div>

<?php get_footer();?>
