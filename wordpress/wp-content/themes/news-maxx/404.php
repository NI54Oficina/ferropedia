<?php
    // get_header();
    // $kopa_setting = kopa_get_template_setting();
    // $sidebars = $kopa_setting['sidebars'][$kopa_setting['layout_id']];
    // $kopa_layout = unserialize(KOPA_LAYOUT);
    // $kopa_position = $kopa_layout[$kopa_setting['layout_id']]['positions'];
?>

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

<style media="screen">

  .screen-404{
    height: 90vh;
    background-image: url("<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/404.png"), url("<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/pelota-404.png");
    background-position: center, 80% 80%;
    background-size: 50%, 50px;
    background-repeat: no-repeat, no-repeat;
    background-color: #22221f;
  }

    .screen-404 a{
      position: absolute;
      left: 0;
      right: 0;
      color: #a43c93;
      margin: auto;
      text-align: center;
      bottom: 25%;
      font-size: 2em;
      font-family: 'Condensed-italic';
    }

</style>
<div class="wrapper clearfix screen-404">

  <a href="http://localhost/ferropedia">INICIO</a>

</div>
<!-- wrapper -->
<?php //get_footer(); ?>
