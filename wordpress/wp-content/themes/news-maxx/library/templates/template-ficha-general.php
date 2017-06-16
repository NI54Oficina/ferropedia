
<?php
  get_header();


global $kopa_setting;
if ( is_page(get_the_ID()) && have_posts() ) {
    while ( have_posts() ) {
        the_post(); ?>

<?php ?>


    <div id="page-<?php the_ID(); ?>" class="page-content-area clearfix">

      <div class="label-name-page">
        <?php the_post_thumbnail( 'full' );   ?>
        <div class="header-text-content">
          <h1>Los jugadores</h1>
          <?php the_content(); ?>
        </div>

      </div>

      <div class="wrapper clearfix">

        <nav class="menu-jugadores">
          <ul>
            <li class="selected">Arqueros</li>
            <li>Defensores</li>
            <li>Mediocampista</li>
            <li>Delanteros</li>
          </ul>
          <p>Ver Dt's</p>
        </nav>


        <div class="jugadores-content-one jugadores-content">
          <div class="jugadores-cancha col-lg-5 col-md-5 col-sm-5 col-xs-12">
            <img src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/cancha.png" alt="">

            <h2>Ranking</h2>
            <div class="jugadores-container-ranking">


                <nav class="menu-interno">
                  <ul>
                    <li class="selected">Más visitados de la semana</li>
                    <li>Más votados</li>
                    <li>Últimos ingresados</li>
                  </ul>
                </nav>

                <p><span>01</span> 08 Nombre</p>
                <p><span>01</span> 08 Nombre</p>
                <p><span>01</span> 08 Nombre</p>
                <p><span>01</span> 08 Nombre</p>

            </div>

          </div>

          <div class="jugadores-muchosjugadores col-lg-7 col-md-7 col-sm-7 col-xs-12">

            <?php for($i=0; $i<16 ; $i++){ ?>
            <div class="jugadores-j">
              <img src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/ejemplo.png" alt="">

              <!-- <img src="" alt=""> -->
              <label><span>10</span>Nombre jugador</label>

            </div>
            <?php  }?>


            <div class="jugadores-container-busqueda">
              <div class="label-busqueda">
                <nav class="menu-busqueda">
                  <ul>
                    <li>Alfabeto</li>
                    <li>Popularidad</li>
                    <li>Por campeonato</li>
                  </ul>
                </nav>

                <p>Busqueda avanzada</p>
              </div>

              <?php for($i=0; $i<27; $i++){?>
                <p class="resultado"><span>09 </span> Nombre de juego</p>
              <?php } ?>

            </div>
          </div>
        </div>

      </div>


    </div>





<?php } // endwhile
} // endif
?>



<?php get_footer();?>
