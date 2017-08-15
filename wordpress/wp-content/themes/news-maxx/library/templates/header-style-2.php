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
   
   <link rel="icon" href="<?php echo home_url(); ?>/fav-icon.png" type="image/png" sizes="16x16">
    
    
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

<!-- //header-menu -->

<?php// get_template_part( 'library/templates/header', 'menu' ); ?>
  <?php get_template_part( 'library/templates/header', 'slider' ); ?>

<div id="main-content">

    <div class="widget-area-1">

<div class="prueba-bg">


        <div class="stripe-box">

            <div class="wrapper">


                <?php kopa_the_topnew(); ?>
                <!-- top new -->

            </div>
            <!-- wrapper -->

        </div>
        <!-- stripe-box -->


    <!-- widget-area-1 -->

    <div class="bn-box">

        <div class="wrapper clearfix">

            <?php kopa_the_headline(); ?>
            <!-- kp-headline-wrapper -->

        </div>
        <!-- wrapper -->
  </div>
</div>
    <!-- bn-box -->
