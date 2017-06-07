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

      <style media="screen">


        .second-box-left .box-left{
          text-align: center;
        }

        .second-box-left .box-left img{
          width: 80%;
          border: 1px solid black;
        }

        .second-box-left .box-left p{
          color: white;
          font-family: 'Condensed-bold-italic';
          font-size: 1.6em;
          padding: 20px 0;
        }

        .second-box-left .box-left button{
          color:white;
          background-color: black;
          font-family: 'Roboto-regular';
          border: none;
          text-decoration: none;
          padding: 5px 20px;
        }

        .second-box-left .box-right{
          border-left: 1px solid black;
          padding-left: 20px;
        }

        .second-box-left .box-right p{
          border-bottom: 1px dashed black;
          color: white;
          padding: 15px 0;
          font-size: 1.2em;
          font-family: 'Condensed-regular';
          margin-bottom: 0;
        }

        .box-jugador{
          padding: 5px;
        }
        .box-jugador > div{
          background-color: #a43c93;
          width: 100%;
          height: 150px;
          position: relative;
        }

        .box-jugador label{
          position: absolute;
          bottom: 0;
          width: 100%;
          background-color: black;
          color:white;
          margin-bottom: 0;
          text-align: center;
        }
      </style>

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
  <style media="screen">

    .third-box{
      padding-left: 2em;
      padding-right: 2em;
    }
    .third-box-left{
      border: 1px solid white;
      padding: 0;
    }

    .third-box-left > div{
      padding: 0;
      margin: 0;
    }

    .third-box-left > div > img{
      width: 100%;
      height: 100%;
      padding: 0;
      margin: 0;
    }

    .triangulo-verde{

      top: 0;
      height: 100%;
      width: 100%;
      position: absolute;
      background: linear-gradient(139deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0) 29%, rgba(0,0,0,0) 49%, rgba(0,182,67,.3) 50%, rgba(0,182,67,.3) 80%, rgba(0,182,67,.3) 100%);
    }

  </style>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 third-box bloque">

  <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 third-box-left">

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
      <img src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/ejemplo.png" alt="">
      <div class="triangulo-verde"></div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 ">
      <h3> El rincon del mudo</h3>
      <h1> Siempre igual, Todo Igual, Todo lo mismo</h1>
      <p>En el ámbito del deporte y porque no en unos cuanto más, se ha acuñado el término “panquequear” y “panqueque”. Del panqueque la definición es “Dícese de aquella persona...</p>

      <span>15 de Febrero  Ver comentarios</span>
    </div>

  </div>

  <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 third-box-right twitter-widget">
    //twitter widget
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
