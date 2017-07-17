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
     get_template_part( 'library/templates/header', 'menu' );

    global $kopa_layout;
    global $kopa_setting;
    $sidebars = $kopa_setting['sidebars'][$kopa_setting['layout_id']];
    $kopa_layout = unserialize(KOPA_LAYOUT);
    $kopa_position = $kopa_layout[$kopa_setting['layout_id']]['positions'];
?>


<div class="wrapper clearfix" style="background-color:white">
<?php
  $post_categories = wp_get_post_categories( get_the_ID() );
  $c= $post_categories[0];
  $cat = get_category( $c );

  if($cat->slug =="cuna-cajon"){?>

    <div class="" style="height:400px;">

    </div>

    <div class="" style="background-color:black; padding: 0 30px; position:relative">
      <div class="" style="position:absolute; bottom:70%; height:150px; width:90%; left:0; right:0; margin:auto;font-family:'Condensed-bold-italic';padding-top:50px; padding-left:50px;color:white; font-size:3em; background-image:url('<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/tablon.png');"> <?php echo $cat->name ?></div>
      <p style="font-size:1.2em;color:white; padding:50px 20px; font-family:'Roboto-Regular'"><?php echo $cat->description ?></p>
    </div>

  <?php  }  ?>




  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-col pull-left custom-search">


    <section class="col-lg-9 col-md-9 col-sm-12 col-xs-12 entry-list">
         <?php get_template_part( 'library/templates/loop', 'blog-1' ); ?>
   </section>


   <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
      <?php echo do_shortcode("[custom-twitter-feeds]"); ?>
   </div>

    <div class="clear"></div>

  </div>
</div>

<?php get_footer();?>
