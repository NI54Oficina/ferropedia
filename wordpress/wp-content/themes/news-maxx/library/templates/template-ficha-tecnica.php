
<?php
  get_header();


global $kopa_setting;
if ( is_page(get_the_ID()) && have_posts() ) {
    while ( have_posts() ) {
        the_post(); ?>

<?php ?>


<div id="page-<?php the_ID(); ?>" class="page-content-area clearfix">


  <div class="wrapper clearfix">

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 first-box-ficha-tecnica">

        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">

          <div class="sector-cancha-float"></div>
            <img src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/cancha-transparente-01.svg" alt="">
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 informacion-tecnica">
          <h1>Nombre <span>Apellido</span></h1>
          <?php for($i=0; $i<3; $i++){ ?>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 informacion-tecnica-inner">
            <h2>350</h2>
            <p>Todos partidos jugados</p>
            <h3>MEDIO DERECHO</h3>
            <p>Puesto</p>
          </div>
          <?php } ?>

          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 info-nacimiento">
            <p><span>Fecha y lugar de nacimiento</span><br>
              10 de Octubre de 1980 | Merlo, San Luis
            </p>
          </div>

          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 info-nacimiento">
            <p><span>Fecha y lugar de fallecimiento</span><br>
              10 de Octubre de 1980 | Merlo, San Luis
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
          <img class="jugador-principal" src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/ejemplo.png" alt="">


            <p style="margin:20px auto auto auto;width:auto;text-align:center; width:50%; border:1px solid white; ">Compartir</p>

        </div>
    </div>


    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 second-box-ficha-tecnica">

      <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 contenido-interno-tecnica">

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 informacion-dinamica">
          <h1>¿Qué pensas del jugador?</h1>

          <img class="estrella" src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/ej-2.png" alt="">

        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 informacion-dinamica">
          <h1>Calificar al jugador</h1>

          <img class="estrella" src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/ej-1.png" alt="">

          <!--
                <h2>5.5 pts</h2>

                <?php for($i=0; $i <5 ; $i++){ ?>
                  <img class="estrella" src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/estrella.svg" alt="">
                <?php } ?>

          <div class="vota">
            ¡Votá!
            <?php for($i=0; $i <5 ; $i++){ ?>
              <img class="estrella" src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/estrella.svg" alt="">
            <?php } ?>
          </div>
         -->
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 informacion-dinamica">
          <h1>Campañas del jugador</h1>

          <div class="">
            <nav>
              <p>Todos</p>
              <p>1997</p>
              <p>1998</p>
              <p>1999</p>
              <p>2000</p>

          </nav>

          <?php for($i=0; $i<5;$i++){ ?>

          <div class="tabla-años-jugador">
            <div class="titulo-tabla">
              <div class="col-lg-2">Año</div>
              <div class="col-lg-2">Torneo</div>
              <div class="col-lg-2">Division</div>
              <div class="col-lg-3">Partidos jugados</div>
              <div class="col-lg-3">Goles convertidos</div>
            </div>

          </div>

          <?php } ?>
          </div>

          <p>Fuente Hank ham hock tenderloin spare ribs, meatloaf flank pork
              chop biltong. Cow short ribs corned beef, meatball landjaeger ham sausage
              ham hock leberkas pork chop tongue bacon tenderloin alcatra. Kevin picanha
              alcatra tenderloin prosciutto. Pancetta pork belly pig jerky. Filet
              mignon beef shoulder ball tip short ribs, shankle turducken kielbasa.
              Turducken cow pork drumstick filet mignon chuck andouille ribeye tri-tip
              pork belly. Tenderloin ham hock venison kielbasa jowl fatback.
          </p>
        </div>



        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tecnica-detalle contenido-interno-tecnica">
          <h1>Detalle</h1>
          <p><b>Algo destacado <br></b>
            Shank ham hock tenderloin spare ribs, meatloaf flank pork chop biltong. Cow short ribs corned beef, meatball landjaeger ham sausage ham hock leberkas pork chop tongue bacon tenderloin alcatra. Kevin picanha alcatra tenderloin prosciutto. Pancetta pork belly pig jerky. Filet mignon beef shoulder ball tip short ribs, shankle turducken kielbasa. Turducken cow pork drumstick filet mignon chuck andouille ribeye tri-tip pork belly. Tenderloin ham hock venison kielbasa jowl fatback.
          </p>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tecnica-video contenido-interno-tecnica">
          <h1>Video</h1>
          <iframe src="https://www.youtube.com/embed/YoMwrh4_ThE" frameborder="0" allowfullscreen></iframe>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tecnica-galeria contenido-interno-tecnica">
          <h1>Galería de fotos</h1>

          // queda aplicar galeria.

        </div>


        </div>

        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 columna-relacionados">
        <h1>JUGADORES RELACIONADOS</h1>

        <?php for($i=0; $i<5; $i++){ ?>
        <div class="jugador-relacionado">
        <img src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/ejemplo.png" alt="">
        <label>Nombre del Jugador <br> <span>Puesto</span></label>
        </div>

        <?php } ?>
        </div>


        </div>

        </div>

        </div>



    <?php comments_template(); ?>

<?php } // endwhile
} // endif
?>



<?php get_footer();?>
