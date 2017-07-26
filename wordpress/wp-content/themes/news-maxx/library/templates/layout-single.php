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
    $sidebars = $kopa_setting['sidebars'][$kopa_setting['layout_id']];
    $kopa_layout = unserialize(KOPA_LAYOUT);
    $kopa_position = $kopa_layout[$kopa_setting['layout_id']]['positions'];
?>

<div class="stripe-box">

    <div class="wrapper">


        <?php kopa_the_topnew(); ?>
        <!-- top new -->

    </div>
    <!-- wrapper -->

</div>
<!-- stripe-box -->

<div class="bn-box">

<div class="wrapper clearfix">

    <?php kopa_the_headline(); ?>
    <!-- kp-headline-wrapper -->

</div>
<!-- wrapper -->

</div>

<div class="wrapper clearfix">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-col pull-left custom-post-template">

  <style media="screen">
    .custom-post-template .nombre-categoria{
      color:#00b643;
      border-bottom: 2px solid #00b643;
      padding: 5px 0;
      font-family: 'Roboto-regular';
      font-size: 1.2em;
      margin: 30px 0;
    }

    .custom-post-template .subtitulo{
      color:#00b643;
      font-family: 'Condensed-regular';
      font-size: 1.2em;
      margin: 10px 0;
    }

    .custom-post-template h1{
      color:black;
      font-size: 3em;
      font-family: 'Condensed-bold-italic';
      margin: 20px 0 40px 0;
    }

    .custom-post-template .thumbnail-container{
      background-color: #006443;
      position: relative;
      min-height: 500px;
      overflow: hidden;
    }

    .custom-post-template .thumbnail-container img{
      position: absolute;
      left: 0;
      right: 0;
      margin:auto;
    }

    .custom-post-template .post-content-text{
      color:#5c585d;
      font-family: 'Roboto-regular';
	  font-size:1.2em;
    }

    .custom-post-template .post-left-colum > div{
      padding: 20px 0;
    }
    .custom-post-template .post-left-colum .fuente img{
      max-width: 30px;
    }

    .custom-post-template .post-left-colum .fuente p{
      color:#006443;
      font-family: 'Condensed-bold-italic';
    }

    .custom-post-template .post-left-colum p.title-left-colum{
      border: 1px solid black;
      padding: 10px;
      font-family: 'Condensed-bold-italic';
      color:black;
      font-size: 1.2em;
    }

    .custom-post-template .post-left-colum .tags label a {
      color:#a43c93;
      font-size: 'Roboto-regular';
      display: inline;
    }

    .custom-post-template .post-left-colum .related p.relacionados{
      color:#a43c93;
      font-size: 'Roboto-regular';
      border-bottom: 1px solid #5c585d;
    }

      .custom-post-template .post-left-colum .related p.relacionados:last-child{
        border: none;
      }

    .custom-post-template .post-left-colum .related p.relacionados span{
      font-size: .8em;
    }

    .custom-post-template .widget{
      padding: 50px 20px 0 20px;
    }

    .custom-post-template .thumbnail-title{
      padding: 10px 0;
    }

    .custom-post-template .thumbnail-title p{
      color:black;
      font-family: 'Condensed-bold-italic';
      font-size: 1.1em;
    }


  </style>

  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">



        <?php kopa_breadcrumb();?>
        <!-- breadcrumb -->

        <?php// get_template_part( 'library/templates/loop', 'single' ); ?>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nombre-categoria">
          <?php 	$post_categories = wp_get_post_categories( get_the_ID() );
            foreach($post_categories as $c){
            $cat = get_category( $c );
            echo $cat->name."  ";

            }?>
        </div>

        <p class="subtitulo">Volanta</p>

        <h1><?php the_title_attribute(); ?></h1>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 thumbnail-container">
          <?php the_post_thumbnail(array(1000, 520)); ?>

        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 thumbnail-title">
          <p>  <?php echo get_post(get_post_thumbnail_id())->post_excerpt;   ?>  </p>
        </div>



        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 post-left-colum">
          <?php if(strlen(get_field('fuente'))!=0){ ?>

          <div class="fuente">
            <img src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/icono-dechiquitomiviejo-verde.svg" alt="">
            <p>Fuente:</p>
            <p><?php echo get_field('fuente'); ?></p>
          </div>

        <?php } ?>

        <?php if(has_tag()){ ?>
          <div class="tags">
            <p class="title-left-colum">ETIQUETAS</p>

            <?php the_tags( '<label>', '</label>, <label>', '</label>' ); ?>

          </div>

          <?php  }?>



            <?php
                $tags = wp_get_post_terms( get_queried_object_id(), 'post_tag', ['fields' => 'ids'] );
                $args = [
                    'post__not_in'        => array( get_queried_object_id() ),
                    'posts_per_page'      => 5,
                    'ignore_sticky_posts' => 1,
                    'orderby'             => 'rand',
                    'tax_query' => [
                        [
                            'taxonomy' => 'post_tag',
                            'terms'    => $tags
                        ]
                    ]
                ];
                $my_query = new wp_query( $args );
                 $max=0;
                if( $my_query->have_posts() ) {?>


                  <div class="related">
                    <p  class="title-left-colum">RELACIONADOS</p>

                    <?php     while( $my_query->have_posts() && $max<4) {
                            $my_query->the_post(); ?>

                            <a href="<?php the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>" rel="nofollow">
                            <p class="relacionados">
                              <span><?php echo  get_the_date( 'l F j, Y' ) ?><br></span>
                                <?php the_title(); ?>
                            </p>
                            </a>
                        <?php $max++; }
                        wp_reset_postdata();?>
                       </div>

              <?php   }
                ?>

            <!-- <p class="relacionados"><span>Fecha</span><br>
            titulo noticia</p>

            <p class="relacionados"><span>Fecha</span><br>
            titulo noticia</p> -->



          <div class="share">
            <p  class="title-left-colum">COMPARTIR</p>

          </div>
        </div>

        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 post-content-text">
          <?php the_content(); ?>

        </div>

        </div>
        <!-- main-col -->
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 widget">


          <div class="twitter-container">
          <?php echo do_shortcode("[custom-twitter-feeds]"); ?>
          </div>


          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 six-box-right mas-visto-widget">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 title">
              MAS VISTO
            </div>

              <?php

              $args = array( 'numberposts' => '4', 'post_status' => 'publish' );
              $recent_posts = wp_get_recent_posts( $args );

              $nro=1;

              foreach( $recent_posts as $recent ){
                $post_categories = wp_get_post_categories( $recent["ID"]);
                $date= get_the_date();?>
                <a href="<?php echo get_permalink($recent["ID"]);  ?>" title="<?php echo esc_attr($recent["post_title"])?>">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bloque-widget">
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    <p class="widget-numero"><?php   echo $nro ?></p>
                  </div>
                  <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                    <p><?php   echo $date ?></p>
                    <p><?php echo $recent["post_title"]  ?></p>
                  </div>
                </div>

              </a>

              <!-- echo $date.'<p ><a style="color:white" href="' . get_permalink($recent["ID"]) . '" title="'.esc_attr($recent["post_title"]).'" >' .   $recent["post_title"].'</a></p>'; -->


              <?php $nro++; } ?>
          </div>
        </div>

        <div class="clear"></div>


</div>

</div>
<!-- wrapper -->

<?php get_footer(); ?>
