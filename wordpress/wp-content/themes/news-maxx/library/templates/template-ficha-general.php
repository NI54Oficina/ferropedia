<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="utf-8">
    <title><?php wp_title('|', true, 'right'); ?></title>
    <?php
    if ('enable' === get_option('kopa_theme_options_responsive_status', 'enable')) {
        ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
    }
    ?>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <!-- Le fav and touch icons -->
    <?php if (get_option('kopa_theme_options_favicon_url')) { ?>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo get_option('kopa_theme_options_favicon_url'); ?>">
    <?php } ?>
    <?php if (get_option('kopa_theme_options_apple_iphone_icon_url')) { ?>
    <link rel="apple-touch-icon" sizes="57x57"
          href="<?php echo get_option('kopa_theme_options_apple_iphone_icon_url'); ?>">
    <?php } ?>

    <?php if (get_option('kopa_theme_options_apple_ipad_icon_url')) { ?>
    <link rel="apple-touch-icon" sizes="72x72"
          href="<?php echo get_option('kopa_theme_options_apple_ipad_icon_url'); ?>">
    <?php } ?>

    <?php if (get_option('kopa_theme_options_apple_iphone_retina_icon_url')) { ?>
    <link rel="apple-touch-icon" sizes="114x114"
          href="<?php echo get_option('kopa_theme_options_apple_iphone_retina_icon_url'); ?>">
    <?php } ?>

    <?php if (get_option('kopa_theme_options_apple_ipad_retina_icon_url')) { ?>
    <link rel="apple-touch-icon" sizes="144x144"
          href="<?php echo get_option('kopa_theme_options_apple_ipad_retina_icon_url'); ?>">
    <?php } ?>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
  // get_header();
  get_template_part( 'library/templates/header', 'menu' );


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

        <div class="menu-2 menu-dinamico">
          <nav class="menu-jugadores">

            <p class="selected">Arqueros</p>
            <p>Defensores</p>
            <p>Mediocampista</p>
            <p>Delanteros</p>


          </nav>

            <p class="ver-dts">Ver Dt's</p>

        </div>




        <div class="jugadores-content-one jugadores-content">
          <div class="jugadores-cancha col-lg-5 col-md-5 col-sm-5 col-xs-12">

            <div class="min-height-upper-container" hid="1">
                <img src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/cancha.png" alt="">
            </div>


            <h2>Ranking</h2>
            <div class="jugadores-container-ranking menu-dinamico">


                <nav class="menu-interno">
                    <p class="selected">Más visitados de la semana</p>
                    <p>Más votados</p>
                    <p>Últimos ingresados</p>
                  </ul>
                </nav>

                <?php for($i=0; $i<3; $i++){ ?>

                <div class="contenido-1 contenido-dinamico">
                  <p><span>01</span> 08 Nombre</p>
                  <p><span>01</span> 08 Nombre</p>
                  <p><span>01</span> 08 Nombre</p>
                  <p><span>01</span> 08 Nombre</p>
                </div>

                <?php } ?>

            </div>

          </div>

          <?php for($m=0; $m<4; $m++){ ?>

          <div class="jugadores-muchosjugadores contenido-dinamico col-lg-7 col-md-7 col-sm-7 col-xs-12">

            <div class="min-height-upper-container" hid="1">



            <?php for($i=0; $i<15 ; $i++){ ?>
            <div class="jugadores-j">
              <img src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/ejemplo.png" alt="">

              <!-- <img src="" alt=""> -->
              <label><span>10</span>Nombre jugador</label>

            </div>
            <?php  }?>

            </div>


            <div class="jugadores-container-busqueda">
              <div class="label-busqueda">

                <select class="menu-busqueda" name="">
                  <option value="">Alfabeto</option>
                  <option value="">Popularidad</option>
                  <option value="">Por campeonato</option>

                </select>
                <!-- <nav class="menu-busqueda">
                  <ul>
                    <li></li>
                    <li>Popularidad</li>
                    <li>Por campeonato</li>
                  </ul>
                </nav> -->

                <p>Busqueda avanzada</p>
              </div>
              <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">


              <?php for($i=0; $i<27; $i++){?>
                <p class="col-lg-6 col-md-6 col-xs-6 col-sm-6 resultado"><span>09 </span> Nombre de juego</p>
              <?php } ?>
                </div>
            </div>
          </div>

          <?php }  ?>
        </div>

      </div>


    </div>





<?php } // endwhile
} // endif
?>



<?php get_footer();?>
