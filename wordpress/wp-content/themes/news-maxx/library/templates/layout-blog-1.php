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

<!-- PARTE COMENTADA -->
        <!-- <?php kopa_breadcrumb(); ?> -->
        <!-- breadcrumb -->

     <!-- <section class="entry-list">
          <?php // get_template_part( 'library/templates/loop', 'blog-1' ); ?>
        </section> -->
        <!-- entry-list -->
<!-- PARTE COMENTADA -->

  <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 fist-left-box">

    <div class="first-left-box-inner">

      <h1>Totales</h1>
      <p></p>

      <div class="">

      </div>

    </div>

  </div>

  <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 second-right-box">

  </div>




</div>
<!-- main-col -->

<div class="sidebar widget-area-2 pull-left">
    <?php
    if ( is_active_sidebar( $sidebars[$kopa_position[0]] ) ) {
        dynamic_sidebar($sidebars[$kopa_position[0]]);
    }
    ?>

<div class="widget-area-7 pull-left">

    <?php
    if ( is_active_sidebar( $sidebars[$kopa_position[1]] ) ) {
        dynamic_sidebar($sidebars[$kopa_position[1]]);
    }
    ?>

</div>
<!-- widget-area-7 -->

<div class="widget-area-8 pull-left">

    <?php
    if ( is_active_sidebar( $sidebars[$kopa_position[2]] ) ) {
        dynamic_sidebar($sidebars[$kopa_position[2]]);
    }
    ?>

</div>
<!-- widget-area-8 -->

<div class="clear"></div>

    <?php
    if ( is_active_sidebar( $sidebars[$kopa_position[3]] ) ) {
        dynamic_sidebar($sidebars[$kopa_position[3]]);
    }
    ?>

</div>
<!-- widget-area-2 -->

<div class="clear"></div>

</div>
<!-- wrapper -->

<?php get_footer();?>
