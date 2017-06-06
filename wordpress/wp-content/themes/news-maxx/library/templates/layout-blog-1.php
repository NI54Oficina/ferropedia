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


    </div>


  </div>

  <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 first-right-box">
    <h1>Historial</h1>

    <p>Campeonatos Locales</p>
        <table style="width:100%;">
          <tr class="first-row">
            <th></th>
            <th>Partidos jugados <br> <span>1049</span></th>
            <th>Ganados<br>  <span>1049</span></th>
            <th>Empatados<br>  <span>1049</span></th>
            <th>Perdidos<br>  <span>1049</span></th>
            <th>Goles a favor <br>  <span>1049</span></th>
            <th>Goles en contra<br>  <span>1049</span></th>

          </tr>
          <tr class="second-row">
            <td>Local</td>
            <td>148</td>
            <td>50</td>
            <td>148</td>
            <td>50</td>
            <td>148</td>
            <td>50</td>
          </tr>
          <tr class="third-row">
            <td>Visitante</td>
            <td>148</td>
            <td>50</td>
            <td>148</td>
            <td>50</td>
            <td>148</td>
            <td>50</td>
          </tr>
        </table>


        <p>Campeonatos Locales</p>
            <table style="width:100%;">
              <tr class="first-row">
                <th></th>
                <th>Partidos jugados <br> <span>1049</span></th>
                <th>Ganados<br>  <span>1049</span></th>
                <th>Empatados<br>  <span>1049</span></th>
                <th>Perdidos<br>  <span>1049</span></th>
                <th>Goles a favor <br>  <span>1049</span></th>
                <th>Goles en contra<br>  <span>1049</span></th>

              </tr>
              <tr class="second-row">
                <td>Local</td>
                <td>148</td>
                <td>50</td>
                <td>148</td>
                <td>50</td>
                <td>148</td>
                <td>50</td>
              </tr>
              <tr class="third-row">
                <td>Visitante</td>
                <td>148</td>
                <td>50</td>
                <td>148</td>
                <td>50</td>
                <td>148</td>
                <td>50</td>
              </tr>
            </table>



  </div>

  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 second-box">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 second-boz-lef">
      <h1>Los jugadores de Ferro</h1>

      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

        <img src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/ejemplo.png" alt="">
        <p>Jose Perez</p>
        <button type="button" name="button"></button>
      </div>

      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

        <p>Delantero</p>
        <p>Delantero</p>
        <p>Delantero</p>
        <p>Delantero</p>

      </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

      <div class="">
          <label>Nombre de Jugador</label>
      </div>

    </div>
  </div>





</div>
<!--

<div class="sidebar widget-area-2 pull-left">
    <?php
  //  if ( is_active_sidebar( $sidebars[$kopa_position[0]] ) ) {
  //      dynamic_sidebar($sidebars[$kopa_position[0]]);
  //  }
    ?>

<div class="widget-area-7 pull-left">

    <?php
      //if ( is_active_sidebar( $sidebars[$kopa_position[1]] ) ) {
      //  dynamic_sidebar($sidebars[$kopa_position[1]]);
      //}
    ?>

</div>


<div class="widget-area-8 pull-left">

    <?php
  //  if ( is_active_sidebar( $sidebars[$kopa_position[2]] ) ) {
        dynamic_sidebar($sidebars[$kopa_position[2]]);
  //  }
  //  ?>

</div>


<div class="clear"></div>

    <?php
    //if ( is_active_sidebar( $sidebars[$kopa_position[3]] ) ) {
    //    dynamic_sidebar($sidebars[$kopa_position[3]]);
    //}
    ?>

</div> -->


<div class="clear"></div>

</div>


<?php get_footer();?>
