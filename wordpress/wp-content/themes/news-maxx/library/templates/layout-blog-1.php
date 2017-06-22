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
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 first-box bloque">


  <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 fist-left-box" hid="1">

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 first-left-box-inner" >

      <h1>Totales</h1>
      <p>Última actualización: 24 de abril a las 19.00pm</p>

      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <p class="tipo-partido">PARTIDOS JUGADOS</p>
        <p class="puntos-partido">50</p>
        <p class="level-partido"> L 609 &nbsp;&nbsp;<span> V 313</span></p>
      </div>

      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <p class="tipo-partido">PARTIDOS GANADOS</p>
        <p class="puntos-partido">50</p>
        <p class="level-partido"> L 609 &nbsp;&nbsp;<span> V 313</span></p>
      </div>

      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <p class="tipo-partido">PARTIDOS JUGADOS</p>
        <p class="puntos-partido">50</p>
        <p class="level-partido"> L 609 &nbsp;&nbsp;<span> V 313</span></p>
      </div>

      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <p class="tipo-partido">PARTIDOS GANADOS</p>
        <p class="puntos-partido">50</p>
        <p class="level-partido">  L 609&nbsp;&nbsp;<span> V 313</span></p>
      </div>

      <p class="goles"><span>45.000  &nbsp; </span> Goles a favor</p>
      <div class="linea-divisoria-partido"></div>
      <p class="goles"><span>39.000  &nbsp;</span> Goles en contra</p>


    </div>


  </div>

  <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 first-right-box" hid="1">
    <h1>Historial</h1>

    <?php $var =['Campeonatos locales', 'Copas Locales', 'Copas Internacionales'];

    for($i=0; $i<3; $i++){?>

      <p><?php echo $var[$i] ?></p>
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

    <?php } ?>





  </div>

  </div>

  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 second-box bloque">
    <h1>Los jugadores de Ferro</h1>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 second-box-left">



      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 box-left">

        <img src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/ejemplo.png" alt="">
        <p>Jose Perez</p>
        <button type="button" name="button">Ver Ficha</button>
      </div>

      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 box-right">

        <p>Delantero</p>
        <p>Delantero</p>
        <p>Delantero</p>
        <p>Delantero</p>

        <img class="copa-verde" src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/copa-verde.svg" alt="">

      </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 second-box-right">


      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 box-jugador box-mas-jugador">
        <div class="imagen-jugador-violeta">
          <img src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/icono-ficha-jugador-blanco.svg" alt="">
            <label>+ Jugadores</label>
        </div>
      </div>

      <?php for($i=0; $i<5; $i++){ ?>
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 box-jugador">
        <div class="imagen-jugador-violeta">

          <img src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/ejemplo.png" alt="">

          <div class="capa-violeta"></div>
            <label>Nombre de Jugador</label>
        </div>
      </div>

      <?php } ?>

    </div>
  </div>

</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 third-box bloque">

  <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 third-box-left">

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 box-left">
      <img src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/ejemplo-2.png" alt="">
      <div class="triangulo-verde"></div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 box-right">
      <h3> El rincon del mudo</h3>
      <h1> Siempre igual, Todo Igual, Todo lo mismo</h1>
      <p>En el ámbito del deporte y porque no en unos cuanto más, se ha acuñado el término “panquequear” y “panqueque”. Del panqueque la definición es “Dícese de aquella persona...</p>

      <p class="fecha-post-home violeta">15 de Febrero, 2017</p>
      <p class="fecha-post-home verde"> Ver comentarios</p>

    </div>

  </div>

  <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 third-box-right twitter-widget">
    <img style="width: 100%;"src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/twitter-demo-10.png" alt="">
  </div>

</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 fourth-box bloque">


  <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 box-with-title fourth-box-left">

    <h1>Museo</h1>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 fourth-container">

      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
        <img src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/ejemplo-2.png" alt="">
        <div class="triangulo-verde"></div>
      </div>

      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 title-container">
        <p>Titulo del objeto</p>

        <img src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/icono-museo-verde.svg" alt="">


        <div class="info-date">
          <p class="fecha-post-home violeta">15 de Febrero, 2017</p>
        </div>
      </div>

    </div>


    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 fourth-container">

      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
        <img src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/ejemplo-2.png" alt="">
        <div class="triangulo-verde"></div>
      </div>

      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 title-container">
        <p>Titulo del objeto</p>

        <img src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/icono-museo-verde.svg" alt="">

        <div class="info-date">
          <p class="fecha-post-home violeta">15 de Febrero, 2017</p>
          <p class="fecha-post-home verde"> Ver comentarios</p>
        </div>
      </div>

    </div>



  </div>

  <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 fourth-box-right mas-visto-widget">

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 title">
      MAS VISTO
    </div>

    <?php

    $args = array( 'numberposts' => '4', 'post_status' => 'publish' );
    $recent_posts = wp_get_recent_posts( $args );

    $nro=1;

      foreach( $recent_posts as $recent ){
        $post_categories = wp_get_post_categories( $recent["ID"]);
        $date= get_the_date();?>
        <a href="<?php echo get_permalink($recent["ID"]);  ?>" title="<?php echo esc_attr($recent["post_title"])?>">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bloque-widget">
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <p class="widget-numero"><?php   echo $nro ?></p>
          </div>
          <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
            <p><?php   echo $date ?></p>
            <p><?php echo $recent["post_title"]  ?></p>
          </div>
        </div>

        </a>

        <!-- echo $date.'<p ><a style="color:white" href="' . get_permalink($recent["ID"]) . '" title="'.esc_attr($recent["post_title"]).'" >' .   $recent["post_title"].'</a></p>'; -->


    <?php $nro++; } ?>
  </div>





</div>


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 fifth-box bloque"></div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 six-box bloque">

  <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 box-with-title six-box-left">

    <h1>De chiquito mi viejo</h1>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 six-container-left">

      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
        <img src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/ejemplo-2.png" alt="">
        <div class="triangulo-verde"></div>
      </div>

      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 title-container">
        <p>El tren al que dejaron sin vías</p>

        <p>Esta carta es la historia presente del Club Ferro Carril Oeste. Dedicada...</p>

        <div class="info-date">
          <p class="fecha-post-home violeta">15 de Febrero, 2017</p>
          <p class="fecha-post-home verde"> Ver comentarios</p>
        </div>

      </div>

    </div>


    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 six-container-right">

      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 six-inner-container">
        <img class="col-lg-5 col-md-5 col-sm-5 col-xs-5" src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/ejemplo-2.png" alt="">
        <p class="col-lg-7 col-md-7 col-sm-7 col-xs-7">¡Gracias por todo, Ferro! Hasta la victoria, siemprebr <br>  <span> 17 de febrero</span></p>
      </div>

      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 six-inner-container">
        <img class="col-lg-5 col-md-5 col-sm-5 col-xs-5" src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/ejemplo-2.png" alt="">
        <p class="col-lg-7 col-md-7 col-sm-7 col-xs-7">¡Gracias por todo, Ferro! Hasta la victoria, siemprebr <br>  <span> 17 de febrero</span></p>
      </div>

    </div>




  </div>

  <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 six-box-right twitter-widget">
    //ULTIMOS COMENTARIOS
  </div>

</div>



<style media="screen">
  .seven-box{

  }
</style>
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
