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

<div class="kopa-page-header">

<div class="header-top">

    <div class="wrapper clearfix">
        <?php kopa_the_current_time(); ?>
        <nav class="top-nav pull-right">
            <?php
            if ( has_nav_menu( 'top-nav' ) ) {
                wp_nav_menu( array(
                    'theme_location'  => 'top-nav',
                    'container'       => false,
                    'items_wrap' => '<ul id="top-menu" class="top-menu clearfix">%3$s</ul>',
                    'depth'           => -1,
                ));
            }
            ?>
            <!-- top-menu -->
        </nav>
        <!-- top-nav -->
    </div>
    <!-- wrapper -->
</div>
<!-- header-top -->

<div class="header-top-2">

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
        <!-- logo-container -->

    </div>
    <!-- wrapper -->

</div>
<!-- header-top-2 -->

<div class="header-middle">

    <div class="wrapper">

        <nav class="main-nav">
            <div class="wrapper clearfix">
                <?php
                if ( has_nav_menu( 'main-nav' )) {
                    wp_nav_menu( array(
                        'theme_location'  => 'main-nav',
                        'container'       => '',
                        'menu_id'         => 'main-menu',
                        'menu_class'      => 'main-menu clearfix',
                    ));
                    echo '<i class="fa fa-align-justify"></i>';
                } ?>

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

<div id="main-content">

    <div class="widget-area-1">

<!-- SLIDER AGREGADO -->

      <div class="widget kopa-home-slider-widget">
            <h4 class="widget-title">Home slider</h4>
                                <div class="kopa-md-slider owl-carousel kopa-home-slider owl-theme" data-autoplay="true" data-slidespeed="700" style="opacity: 1; display: block;">
                                                        <div class="owl-wrapper-outer"><div class="owl-wrapper" style="width: 12610px; left: 0px; display: block; transform: translate3d(-3783px, 0px, 0px); transition: all 800ms ease;"><div class="owl-item" style="width: 1261px;"><div class="item">
                        <article class="entry-item">
                                                                <div class="entry-thumb">
                                        <img src="http://upsidethemes.net/demo/news-maxx/wp-content/uploads/bfi_thumb/Smile-2xau11nxy9ejeotj9qwr9m.jpg" alt="Haute Couture fact file bibendum">                                    </div>
                                                            <!-- entry-thumb -->
                            <div class="flex-caption">
                                <h3 class="entry-title"><a href="http://upsidethemes.net/demo/news-maxx/?p=742" title="Haute Couture fact file bibendum">Haute Couture fact file bibendum</a></h3>
                                <p>Curabitur ullamcorper, felis bibendum rutrum consectetur, justo felis elementum metus, sed feugiat nisl ligula non magna. Pellentesque vel accumsan odio.…</p>
                                    <span class="arrow-wrapper">
                                        <span class="arrow-left"></span>
                                        <span class="arrow-right"></span>
                                    </span>
                            </div>
                            <!-- flex-caption -->
                        </article>
                        <!-- entry-item -->
                    </div></div><div class="owl-item" style="width: 1261px;"><div class="item">
                        <article class="entry-item">
                                                                <div class="entry-thumb">
                                        <img src="http://upsidethemes.net/demo/news-maxx/wp-content/uploads/bfi_thumb/unsplash-49-2xau11nxy9ejeotj9qwr9m.jpg" alt="J-Lo’s divisive Versace dress-trouser hybrid">                                    </div>
                                                            <!-- entry-thumb -->
                            <div class="flex-caption">
                                <h3 class="entry-title"><a href="http://upsidethemes.net/demo/news-maxx/?p=773" title="J-Lo’s divisive Versace dress-trouser hybrid">J-Lo’s divisive Versace dress-trouser hybrid</a></h3>
                                <p>Curabitur ullamcorper, felis bibendum rutrum consectetur, justo felis elementum metus, sed feugiat nisl ligula non magna. Pellentesque vel accumsan odio.…</p>
                                    <span class="arrow-wrapper">
                                        <span class="arrow-left"></span>
                                        <span class="arrow-right"></span>
                                    </span>
                            </div>
                            <!-- flex-caption -->
                        </article>
                        <!-- entry-item -->
                    </div></div><div class="owl-item" style="width: 1261px;"><div class="item">
                        <article class="entry-item">
                                                                <div class="entry-thumb">
                                        <img src="http://upsidethemes.net/demo/news-maxx/wp-content/uploads/bfi_thumb/unsplash-79-2xau11nxy9ejeotj9qwr9m.jpg" alt="The Model Trainer: how to get legs like Gisele">                                    </div>
                                                            <!-- entry-thumb -->
                            <div class="flex-caption">
                                <h3 class="entry-title"><a href="http://upsidethemes.net/demo/news-maxx/?p=532" title="The Model Trainer: how to get legs like Gisele">The Model Trainer: how to get legs like Gisele</a></h3>
                                <p>Sed nec neque purus. Nulla faucibus, lectus vitae gravida mattis, ligula magna malesuada purus, vel semper nibh risus sed libero.…</p>
                                    <span class="arrow-wrapper">
                                        <span class="arrow-left"></span>
                                        <span class="arrow-right"></span>
                                    </span>
                            </div>
                            <!-- flex-caption -->
                        </article>
                        <!-- entry-item -->
                    </div></div><div class="owl-item" style="width: 1261px;"><div class="item">
                        <article class="entry-item">
                                                                <div class="entry-thumb">
                                        <img src="http://upsidethemes.net/demo/news-maxx/wp-content/uploads/bfi_thumb/unsplash-18-2xau11nxy9ejeotj9qwr9m.jpg" alt="Extreme places to visit in the U.S.">                                    </div>
                                                            <!-- entry-thumb -->
                            <div class="flex-caption">
                                <h3 class="entry-title"><a href="http://upsidethemes.net/demo/news-maxx/?p=778" title="Extreme places to visit in the U.S.">Extreme places to visit in the U.S.</a></h3>
                                <p>Ut feugiat aliquet orci luctus euismod. Fusce egestas eget erat eget dignissim. Nullam placerat mauris a urna cursus, egestas eleifend…</p>
                                    <span class="arrow-wrapper">
                                        <span class="arrow-left"></span>
                                        <span class="arrow-right"></span>
                                    </span>
                            </div>
                            <!-- flex-caption -->
                        </article>
                        <!-- entry-item -->
                    </div></div><div class="owl-item" style="width: 1261px;"><div class="item">
                        <article class="entry-item">
                                                                <div class="entry-thumb">
                                        <img src="http://upsidethemes.net/demo/news-maxx/wp-content/uploads/bfi_thumb/358881847_95d7a65f87_o-2xau12o4olo1n2sicoe03u.jpg" alt="Jodie Foster marries Alexandra Hedison">                                    </div>
                                                            <!-- entry-thumb -->
                            <div class="flex-caption">
                                <h3 class="entry-title"><a href="http://upsidethemes.net/demo/news-maxx/?p=693" title="Jodie Foster marries Alexandra Hedison">Jodie Foster marries Alexandra Hedison</a></h3>
                                <p>Curabitur ullamcorper, felis bibendum rutrum consectetur, justo felis elementum metus, sed feugiat nisl ligula non magna. Pellentesque vel accumsan odio.quis…</p>
                                    <span class="arrow-wrapper">
                                        <span class="arrow-left"></span>
                                        <span class="arrow-right"></span>
                                    </span>
                            </div>
                            <!-- flex-caption -->
                        </article>
                        <!-- entry-item -->
                    </div></div></div></div>




                                                <div class="owl-controls clickable"><div class="owl-pagination"><div class="owl-page"><span class=""></span></div><div class="owl-page"><span class=""></span></div><div class="owl-page"><span class=""></span></div><div class="owl-page active"><span class=""></span></div><div class="owl-page"><span class=""></span></div></div></div></div>


            <div style="display: block; opacity: 0;" class="kopa-sd-slider owl-carousel kopa-home-slider owl-theme" data-autoplay="true" data-slidespeed="700">
                                        <div class="owl-wrapper-outer"><div class="owl-wrapper" style="width: 1000px; left: 0px; display: block; transition: all 800ms ease; transform: translate3d(-400px, 0px, 0px);"><div class="owl-item" style="width: 100px;"><div class="item">
                    <article class="entry-item">
                                                    <div class="entry-thumb">
                                <img src="http://upsidethemes.net/demo/news-maxx/wp-content/uploads/bfi_thumb/Smile-2xau11nw8xw8xm567y53pm.jpg" alt="Haute Couture fact file bibendum">                            </div>
                                                    <!-- entry-thumb -->
                        <div class="flex-caption">
                            <h3 class="entry-title"><a href="http://upsidethemes.net/demo/news-maxx/?p=742" title="Haute Couture fact file bibendum">Haute Couture fact file bibendum</a></h3>
                            <p>Curabitur ullamcorper, felis bibendum rutrum consectetur, justo felis elementum metus, sed feugiat nisl ligula non magna. Pellentesque vel accumsan odio.…</p>
                                    <span class="arrow-wrapper">
                                        <span class="arrow-left"></span>
                                        <span class="arrow-right"></span>
                                    </span>
                        </div>
                        <!-- flex-caption -->
                    </article>
                    <!-- entry-item -->
                </div></div><div class="owl-item" style="width: 100px;"><div class="item">
                    <article class="entry-item">
                                                    <div class="entry-thumb">
                                <img src="http://upsidethemes.net/demo/news-maxx/wp-content/uploads/bfi_thumb/unsplash-49-2xau11nw8xw8xm567y53pm.jpg" alt="J-Lo’s divisive Versace dress-trouser hybrid">                            </div>
                                                    <!-- entry-thumb -->
                        <div class="flex-caption">
                            <h3 class="entry-title"><a href="http://upsidethemes.net/demo/news-maxx/?p=773" title="J-Lo’s divisive Versace dress-trouser hybrid">J-Lo’s divisive Versace dress-trouser hybrid</a></h3>
                            <p>Curabitur ullamcorper, felis bibendum rutrum consectetur, justo felis elementum metus, sed feugiat nisl ligula non magna. Pellentesque vel accumsan odio.…</p>
                                    <span class="arrow-wrapper">
                                        <span class="arrow-left"></span>
                                        <span class="arrow-right"></span>
                                    </span>
                        </div>
                        <!-- flex-caption -->
                    </article>
                    <!-- entry-item -->
                </div></div><div class="owl-item" style="width: 100px;"><div class="item">
                    <article class="entry-item">
                                                    <div class="entry-thumb">
                                <img src="http://upsidethemes.net/demo/news-maxx/wp-content/uploads/bfi_thumb/unsplash-79-2xau11nw8xw8xm567y53pm.jpg" alt="The Model Trainer: how to get legs like Gisele">                            </div>
                                                    <!-- entry-thumb -->
                        <div class="flex-caption">
                            <h3 class="entry-title"><a href="http://upsidethemes.net/demo/news-maxx/?p=532" title="The Model Trainer: how to get legs like Gisele">The Model Trainer: how to get legs like Gisele</a></h3>
                            <p>Sed nec neque purus. Nulla faucibus, lectus vitae gravida mattis, ligula magna malesuada purus, vel semper nibh risus sed libero.…</p>
                                    <span class="arrow-wrapper">
                                        <span class="arrow-left"></span>
                                        <span class="arrow-right"></span>
                                    </span>
                        </div>
                        <!-- flex-caption -->
                    </article>
                    <!-- entry-item -->
                </div></div><div class="owl-item" style="width: 100px;"><div class="item">
                    <article class="entry-item">
                                                    <div class="entry-thumb">
                                <img src="http://upsidethemes.net/demo/news-maxx/wp-content/uploads/bfi_thumb/unsplash-18-2xau11nw8xw8xm567y53pm.jpg" alt="Extreme places to visit in the U.S.">                            </div>
                                                    <!-- entry-thumb -->
                        <div class="flex-caption">
                            <h3 class="entry-title"><a href="http://upsidethemes.net/demo/news-maxx/?p=778" title="Extreme places to visit in the U.S.">Extreme places to visit in the U.S.</a></h3>
                            <p>Ut feugiat aliquet orci luctus euismod. Fusce egestas eget erat eget dignissim. Nullam placerat mauris a urna cursus, egestas eleifend…</p>
                                    <span class="arrow-wrapper">
                                        <span class="arrow-left"></span>
                                        <span class="arrow-right"></span>
                                    </span>
                        </div>
                        <!-- flex-caption -->
                    </article>
                    <!-- entry-item -->
                </div></div><div class="owl-item" style="width: 100px;"><div class="item">
                    <article class="entry-item">
                                                    <div class="entry-thumb">
                                <img src="http://upsidethemes.net/demo/news-maxx/wp-content/uploads/bfi_thumb/358881847_95d7a65f87_o-2xau12o2za5r6045avmcju.jpg" alt="Jodie Foster marries Alexandra Hedison">                            </div>
                                                    <!-- entry-thumb -->
                        <div class="flex-caption">
                            <h3 class="entry-title"><a href="http://upsidethemes.net/demo/news-maxx/?p=693" title="Jodie Foster marries Alexandra Hedison">Jodie Foster marries Alexandra Hedison</a></h3>
                            <p>Curabitur ullamcorper, felis bibendum rutrum consectetur, justo felis elementum metus, sed feugiat nisl ligula non magna. Pellentesque vel accumsan odio.quis…</p>
                                    <span class="arrow-wrapper">
                                        <span class="arrow-left"></span>
                                        <span class="arrow-right"></span>
                                    </span>
                        </div>
                        <!-- flex-caption -->
                    </article>
                    <!-- entry-item -->
                </div></div></div></div>





        <div class="owl-controls clickable"><div class="owl-pagination"><div class="owl-page"><span class=""></span></div><div class="owl-page"><span class=""></span></div><div class="owl-page"><span class=""></span></div><div class="owl-page"><span class=""></span></div><div class="owl-page active"><span class=""></span></div></div></div></div>




                <!-- owl-carousel top content -->

            <div class="left-box">
                <div class="triangle"></div>
                <div class="triangle-2"></div>
                <div class="rectangle"></div>
                <span class="square-1"></span>
                <span class="square-2"></span>
                <span class="square-3"></span>
                <span class="square-4"></span>
            </div>
            <!-- left-box -->

        </div>

<!-- SLIDER AGREGADO -->

        <div class="stripe-box">

            <div class="wrapper">

                <div class="left-color"></div>

                <?php kopa_the_topnew(); ?>
                <!-- top new -->

                <div class="right-color"></div>
            </div>
            <!-- wrapper -->

        </div>
        <!-- stripe-box -->

    </div>
    <!-- widget-area-1 -->

    <div class="bn-box">

        <div class="wrapper clearfix">

            <?php kopa_the_headline(); ?>
            <!-- kp-headline-wrapper -->

        </div>
        <!-- wrapper -->

    </div>
    <!-- bn-box -->

    <section class="main-section">
