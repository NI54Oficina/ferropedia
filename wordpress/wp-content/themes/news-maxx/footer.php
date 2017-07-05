<?php
$kopa_setting = kopa_get_template_setting();
$sidebars = $kopa_setting['sidebars'];
$sidebars = $sidebars[$kopa_setting['layout_id']];
$total = count( $sidebars );
$kopa_layout = unserialize(KOPA_LAYOUT);
$kopa_position = $kopa_layout[$kopa_setting['layout_id']]['positions'];
$footer_sidebar[0] = ($kopa_setting) ? $sidebars[$kopa_position[($total - 4)]] : 'position_9';
$footer_sidebar[1] = ($kopa_setting) ? $sidebars[$kopa_position[($total - 3)]] : 'position_10';
$footer_sidebar[2] = ($kopa_setting) ? $sidebars[$kopa_position[($total - 2)]] : 'position_11';
$footer_sidebar[3] = ($kopa_setting) ? $sidebars[$kopa_position[($total-1)]] : 'position_12';
?>

</section>
<!-- main-section -->
</div>
<!-- main-content -->
<section class="dark-box">

    <div class="wrapper">

        <nav id="bottom-nav" class="text-center">
            <?php
            if ( has_nav_menu( 'bottom-nav' )) {
                wp_nav_menu( array(
                    'theme_location'  => 'bottom-nav',
                    'container'       => false,
                    'items_wrap' => '<ul id="bottom-menu" class="clearfix">%3$s</ul>',
                    'depth'           => -1,
                ));
            }
            ?>

            <i class='fa fa-align-justify'></i>
            <div class="bottom-mobile-menu-wrapper">
                <?php
                if ( has_nav_menu( 'bottom-nav' )) {
                    wp_nav_menu( array(
                        'theme_location'  => 'bottom-nav',
                        'container'       => false,
                        'items_wrap' => '<ul id="bottom-mobile-menu">%3$s</ul>',
                        'depth'           => -1,
                    ));
                }
                ?>
                <!-- mobile-menu -->
            </div>
            <!-- mobile-menu-wrapper -->
        </nav>
        <!-- bottom-nav -->

    </div>
    <!-- wrapper -->
</section>
<!-- dark-box -->
<section id="bottom-sidebar">



      <h1> LA FERROPEDIA <br> <span>CLUB FERRO CARRIL OESTE</span></h1>
      <p>Seguinos</p>

      <a href="#"><i class="fa fa-facebook fa-2x" aria-hidden="true"></i></a>
      <a href="#"><i class="fa fa-twitter fa-2x" aria-hidden="true"></i></a>
      <a href="#"><i class="fa fa-youtube fa-2x" aria-hidden="true"></i></a>

        <p id="copyright">© 2013 - 2017 FERROPEDIA • LEGALES</p>
<!--
    <div class="wrapper">

        <div class="row">

            <div class="col-md-3 col-sm-3 widget-area-9">
                <div class="bottom-logo">
                    <?php
                    $logo_url =  get_option('kopa_theme_options_logo_url_2');
                    if( !$logo_url ) {
                        $logo_url = get_template_directory_uri().'/images/sample/logo1.png';
                    }
                    ?>
                    <a href="<?php echo esc_url(home_url());?>" title="<?php bloginfo('name'); ?>"><img id="logo-image2" src="<?php echo $logo_url; ?>" alt="<?php bloginfo('name'); ?>"/></a>
                </div>


                <?php
                if ( is_active_sidebar( $footer_sidebar[0] ) ) {
                    dynamic_sidebar($footer_sidebar[0]);
                }
                ?>
            </div>

            <div class="col-md-3 col-sm-3 widget-area-10">
                <?php
                if ( is_active_sidebar( $footer_sidebar[1] ) ) {
                    dynamic_sidebar($footer_sidebar[1]);
                }
                ?>
            </div>

            <div class="col-md-3 col-sm-3 widget-area-11">
                <?php
                if ( is_active_sidebar( $footer_sidebar[2] ) ) {
                    dynamic_sidebar($footer_sidebar[2]);
                }
                ?>
            </div>

            <div class="col-md-3 col-sm-3 widget-area-12">

                <?php
                if ( is_active_sidebar( $footer_sidebar[3] ) ) {
                    dynamic_sidebar($footer_sidebar[3]);
                }
                ?>

            </div>


        </div>


    </div> -->
    <!-- wrapper -->

</section>
<!-- bottom-sidebar -->

<footer class="kopa-page-footer">





</footer>
<!-- kopa-page-footer -->

<?php wp_footer(); ?>
</body>

</html>
