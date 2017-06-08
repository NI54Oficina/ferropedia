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

  </div>

  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 second-box bloque">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 second-box-left">

      <h1>Los jugadores de Ferro</h1>

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

      </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 second-box-right">

      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 box-jugador">
        <div class="">
            <label>Nombre de Jugador</label>
        </div>
      </div>

      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 box-jugador">
        <div class="">
            <label>Nombre de Jugador</label>
        </div>
      </div>

      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 box-jugador">
        <div class="">
            <label>Nombre de Jugador</label>
        </div>
      </div>

      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 box-jugador">
        <div class="">
            <label>Nombre de Jugador</label>
        </div>
      </div>

      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 box-jugador">
        <div class="">
            <label>Nombre de Jugador</label>
        </div>
      </div>

      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 box-jugador">
        <div class="">
            <label>Nombre de Jugador</label>
        </div>
      </div>

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

      <span>15 de Febrero  Ver comentarios</span>
    </div>

  </div>

  <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 third-box-right twitter-widget">
    //WIDGET TWITTER
  </div>

</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 fourth-box bloque">


  <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 fourth-box-left">

    <h1>MUSEO</h1>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 fourth-container">

      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
        <img src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/ejemplo-2.png" alt="">
        <div class="triangulo-verde"></div>
      </div>

      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 title-container">
        <p>titulo del objeto</p>

        <label>14 de Febrero</label>
      </div>

    </div>


    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 fourth-container">

      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
        <img src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/ejemplo-2.png" alt="">
        <div class="triangulo-verde"></div>
      </div>

      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 title-container">
        <p>titulo del objeto</p>

        <label>14 de Febrero</label>
      </div>

    </div>



  </div>

  <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 fourth-box-right twitter-widget">
    //MÀS VISTO
  </div>

</div>


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 fifth-box bloque"></div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 six-box bloque">
  <style media="screen">
    .six-box .six-box-left h1{
      background-color: #006443;
      color:white;
      border-bottom: 3px solid black;
    }

    .six-container-left > div  img{
      height: 250px;
    }

    .six-container-left .title-container{
      background-color: #006443;
      color:white;
      padding-top: 20px;
      padding-left: 0;
      height: 200px;
    }

    .six-container-left .title-container p:first-child{
      font-family: 'Condensed-bold-italic';
      font-size: 2em;
    }

    .six-container-left .title-container p:last-child{
      font-family: 'Roboto-regular';
      font-size: 1em;
    }

    .six-container-left .title-container label{
      background-color: black;
      color:#a43c93;
      position: absolute;
      bottom:0;
      width: 100%;
      margin: 0;
      padding: 10px;
    }

    .six-container-right .six-inner-container{
      padding: 15px 0;
    }

    .six-container-right .six-inner-container img{
      /*width: 100%;*/
      height:150px;
      display: inline;
    }

    .six-container-right .six-inner-container p{
      color:white;
    }

    .six-container-right .six-inner-container p span{
      color:#a43c93;
    }
    


  </style>

  <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 six-box-left">

    <h1>De chiquito mi viejo</h1>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 six-container-left">

      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
        <img src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/ejemplo-2.png" alt="">
        <div class="triangulo-verde"></div>
      </div>

      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 title-container">
        <p>titulo del objeto</p>

        <p>Esta carta es la historia presente del Club Ferro Carril Oeste. Dedicada...</p>

        <label>14 de Febrero</label>
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
    //MÀS VISTO
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
