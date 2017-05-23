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

    <div class="wrapper">

        <div class="row">
            <!-- position 9 -->
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
                <!-- bottom-logo -->

                <?php
                if ( is_active_sidebar( $footer_sidebar[0] ) ) {
                    dynamic_sidebar($footer_sidebar[0]);
                }
                ?>
            </div>
            <!-- col-md-3 -->

            <!-- position 10 -->
            <div class="col-md-3 col-sm-3 widget-area-10">
                <?php
                if ( is_active_sidebar( $footer_sidebar[1] ) ) {
                    dynamic_sidebar($footer_sidebar[1]);
                }
                ?>
            </div>
            <!-- col-md-3 -->

            <!-- position 11 -->
            <div class="col-md-3 col-sm-3 widget-area-11">
                <?php
                if ( is_active_sidebar( $footer_sidebar[2] ) ) {
                    dynamic_sidebar($footer_sidebar[2]);
                }
                ?>
            </div>
            <!-- col-md-3 -->

            <!-- position 12 -->
            <div class="col-md-3 col-sm-3 widget-area-12">

                <?php
                if ( is_active_sidebar( $footer_sidebar[3] ) ) {
                    dynamic_sidebar($footer_sidebar[3]);
                }
                ?>

            </div>
            <!-- col-md-3 -->

        </div>
        <!-- row -->

    </div>
    <!-- wrapper -->

</section>
<!-- bottom-sidebar -->

<footer class="kopa-page-footer">

    <div class="wrapper">
        <?php
        $kopa_theme_options_copyright = get_option('kopa_theme_options_copyright', sprintf(__('Copyright %1$s - Kopasoft. All Rights Reserved.', 'newsmaxx'), date('Y')));
        $kopa_theme_options_copyright = htmlspecialchars_decode(stripslashes($kopa_theme_options_copyright));
        ?>
        <?php if ( ! empty( $kopa_theme_options_copyright ) ) : ?>
            <p id="copyright" ><?php echo $kopa_theme_options_copyright; ?></p>
        <?php endif; ?>

    </div>
    <!-- wrapper -->

</footer>
<!-- kopa-page-footer -->

<?php wp_footer(); ?>
</body>

</html>