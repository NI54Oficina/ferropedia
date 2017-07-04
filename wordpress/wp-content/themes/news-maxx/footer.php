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

<footer class="kopa-page-footer">



</footer>
<!-- kopa-page-footer -->

<?php wp_footer(); ?>
</body>

</html>
