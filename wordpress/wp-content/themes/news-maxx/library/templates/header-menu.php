
<div class="kopa-page-header">


<!-- header-top -->

<!-- <div class="header-top-2">

    <div class="wrapper clearfix">
        <?php
        $logo_url =  get_option('kopa_theme_options_logo_url', '');
        if( !$logo_url ) {
            $logo_url = get_template_directory_uri().'/images/sample/logo2.png';
        }
        ?>
        <div id="logo-container" class="pull-left">
            <a href="<?php echo esc_url(home_url());?>" title="<?php bloginfo('name'); ?>"><img id="logo-image" src="<?php echo $logo_url; ?>" alt="<?php bloginfo('name'); ?>"/></a>
        </div>


    </div>


</div> -->
<!-- header-top-2 -->

<div class="header-middle">

    <div class="wrapper">

        <nav class="main-nav">
            <div class="wrapper clearfix">
              <ul id="main-menu" class="main-menu clearfix sf-js-enabled sf-arrows">

                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-30"><a href="http://localhost/ferropedia/ficha-jugador/"><img src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/icono-ficha-jugador-blanco.svg" alt=""></a></li>
                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-34"><a href="http://localhost/ferropedia/museo/"><img src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/icono-museo-blanco.svg" alt=""></a></li>
                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-29"><a href="http://localhost/ferropedia/category/cuna-cajon//"><img src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/icono-dechiquitomiviejo-blanco.svg" alt=""></a></li>
                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-37"><a href="http://localhost/ferropedia/rincon-mundo/"><img src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/icono-rinconmudo-blanco.svg" alt=""></a></li>
                <!-- <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-37"><a href="http://localhost/ferropedia/equipo-laferropedia/"><img src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/icono-rinconmudo-blanco.svg" alt=""></a></li> -->
              </ul>


                <!-- <?php
                if ( has_nav_menu( 'main-nav' )) {
                     wp_nav_menu( array(
                        'theme_location'  => 'main-nav',
                        'container'       => '',

                        'menu_id'         => 'main-menu',
                        'menu_class'      => 'main-menu clearfix'
                        // 'echo'            => false

                    ));
                    echo '<i class="fa fa-align-justify"></i>';

                } ?> -->



                <div class="mobile-menu-wrapper">
                    <?php
                    if ( has_nav_menu( 'main-nav' )) {
                        wp_nav_menu( array(
                            'theme_location'  => 'main-nav',
                            'container'       => '',
                            'menu_id'         => 'mobile-menu',
                            'menu_class'      => '',
                        ));
                    }
                    ?>
                    <!-- mobile-menu -->
                </div>
                <!-- mobile-menu-wrapper -->

                <div class="links-sociales" style="display:inline-flex">
                  <i class="fa fa-facebook" aria-hidden="true"></i>
                  <i class="fa fa-twitter" aria-hidden="true"></i>
                  <i class="fa fa-youtube" aria-hidden="true"></i>
                </div>

            </div>
            <!-- wrapper -->

        </nav>
        <!-- main-nav -->

        <?php get_search_form(); ?>
        <!-- search box -->

    </div>
    <!-- wrapper -->

</div>
<!-- header-middle -->

<div class="header-bottom">

    <div class="wrapper">

        <nav class="secondary-nav">
            <?php
            if ( has_nav_menu( 'second-nav' )) {
                wp_nav_menu( array(
                    'theme_location'  => 'second-nav',
                    'container'       => '',
                    'menu_id'         => '',
                    'menu_class'      => 'secondary-menu clearfix',
                ));
            } ?>
            <!-- secondary-menu -->
            <span><?php _e('Menu', 'newsmaxx'); ?></span>
            <div class="secondary-mobile-menu-wrapper">
                <?php
                if ( has_nav_menu( 'main-nav' )) {
                    wp_nav_menu( array(
                        'theme_location'  => 'main-nav',
                        'container'       => '',
                        'menu_id'         => 'secondary-mobile-menu',
                        'menu_class'      => '',
                    ));
                }
                ?>
                <!-- mobile-menu -->
            </div>
            <!-- mobile-menu-wrapper -->
        </nav>
        <!-- secondary-nav -->

    </div>
    <!-- wrapper -->

</div>
<!-- header-bottom -->

</div>
<!-- kopa-page-header -->


    <section class="main-section">
