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

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 first-left-box-inner">

      <h1>Totales</h1>
      <p>Última actualización: 24 de abril a las 19.00pm</p>

      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <p class="tipo-partido">PARTIDOS JUGADOS</p>
        <p class="puntos-partido">50</p>
        <p class="level-partido"> L609 <span> V313</span></p>
      </div>

      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <p class="tipo-partido">PARTIDOS JUGADOS</p>
        <p class="puntos-partido">50</p>
        <p class="level-partido"> L609 <span> V313</span></p>
      </div>

      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <p class="tipo-partido">PARTIDOS JUGADOS</p>
        <p class="puntos-partido">50</p>
        <p class="level-partido"> L609 <span> V313</span></p>
      </div>

      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <p class="tipo-partido">PARTIDOS JUGADOS</p>
        <p class="puntos-partido">50</p>
        <p class="level-partido"> L609 <span> V313</span></p>
      </div>

      <p class="goles"><span>45.000</span> Goles a favor</p>
      <div class="linea-divisoria-partido"></div>
      <p class="goles"><span>39.000</span> Goles en contra</p>

      <style >

        .linea-divisoria-partido{
          border-bottom: 2px dashed white;
        }

        .goles span {
          background-color: rgba(0,0,0,.20);
          color:#00b643;
        }

        .goles{
          color:white;
        }

      </style>

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
