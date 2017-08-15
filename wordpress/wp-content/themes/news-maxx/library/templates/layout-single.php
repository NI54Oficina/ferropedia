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
  get_template_part( 'library/templates/header', 'links' );
 get_template_part( 'library/templates/header', 'extra' );
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
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-col pull-left custom-post-template main-section trio-cuna-cajon">

 <?php include("style-inner-slider.php"); ?>
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

        <p class="subtitulo"><?php echo get_field("volanta"); ?></p>

        <h1><?php the_title_attribute(); ?></h1>
		<div class="bajo-titulo">
		<p><?php echo get_the_date(); ?></p>
		<p>&#9652;</p>
		<p><?php $count_key = 'wpb_post_views_count';
    $count = get_post_meta(get_the_ID(), $count_key, true); echo $count; ?> visitas</p>
		</div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 thumbnail-container">
          <?php the_post_thumbnail(array(1000, 520)); ?>

        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 thumbnail-title">
          <p>  <?php echo get_post(get_post_thumbnail_id())->post_excerpt;   ?>  </p>
        </div>
		


        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 post-left-colum">


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
            <div  class="title-left-colum">COMPARTIR <div class="links-sociales" style="padding:0;" >
			
                  <i class="fa fa-facebook" aria-hidden="true" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php echo get_permalink(); ?>','','width=500,height=400')" ></i>
                  <i class="fa fa-twitter" aria-hidden="true" onclick="window.open('https://twitter.com/intent/tweet?url=<?php echo wp_get_shortlink(); ?>&amp;original_referer=<?php echo wp_get_shortlink(); ?>&text=<?php echo get_the_title(); ?>','','width=500,height=400')"></i>

                </div>
                </div>
			

          </div>
        </div>

        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 post-content-text">
          <?php the_content(); ?>


          <?php if(strlen(get_field('fuente'))!=0){ ?>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding:10px;background-color:#eff0ef;box-shadow: 0px 2px 5px 3px rgba(173,173,173,1);margin-top:30px;">


          <div class="fuente">
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" style="padding:0;">
                <img style="max-width:35px;" src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/icono-dechiquitomiviejo-verde.svg" alt="">
            </div>

            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11" style="padding:0;">
              <p style="font-size:0.8em;color:#888888;margin:0; font-family:'Roboto-bold';">Fuentes</p>
              <p style="font-size:0.8em; color:#888888;margin:0"><?php echo get_field('fuente'); ?></p>
            </div>


          </div>

          </div>

        <?php } ?>

        </div>

        <div class="col-lg-12 col-md12 col-sm-12 col-xs-12 container-move-entradas">
            <?php

            $cat = get_the_category();
            $current_cat_id = $cat[0]->cat_ID;

            $args = array(
              'numberposts' => -1, "post_type"=>"post", 'category'=>$current_cat_id , 'orderby'  => 'post_date', 'order'    => 'DESC');
            $posts = get_posts( $args );

            $ids = array();
            foreach ( $posts as $thepost ) {
                $ids[] = $thepost->ID;
            }

            $thisindex = array_search( $id, $ids );
            $previd = $ids[ $thisindex - 1 ];
            $nextid = $ids[ $thisindex + 1 ];
            ?>

            <style >

            .container-move-entradas{
              padding: 50px 10px;
            }

            .container-move-entradas a > p{
              font-family: 'Condensed-bold';
              font-size: 1.2em;
              width: auto;
            }

            .container-move-entradas h6{
              font-family: 'Condensed-bold-italic';
              color: black;
              font-size: 1.4em;
              word-wrap: break-word;
              width: 300px;

            }

            .container-move-entradas h6 span{
              font-family: 'Roboto-regular';
              color:#A43C93;
              font-size: 10px;;
            }

              .siguiente-entrada{
                float:right;
              }

              .anterior-entrada{
                float:left;
              }

              .linea-divisoria{
                width: 100%;
                border:1px solid black;
                margin:15px 0;
              }
				.owl-theme .owl-controls{
					padding-bottom:40px;					
				}
            </style>

            <a href="<?php echo get_permalink($previd); ?>"><p class="anterior-entrada">&lt; Anterior</p></a>


            <a href="<?php echo get_permalink($nextid); ?>"><p class="siguiente-entrada">Siguiente &gt;</p></a>

            <div class="col-lg-12 col-md12 col-sm-12 col-xs-12 linea-divisoria"></div>


            <a href="<?php echo get_permalink($previd); ?>"><h6 class="anterior-entrada"><?php echo get_the_title($previd); ?> <br><span><?php echo get_the_date('D M j' ,$previd); ?> </span></h6></a>


             <a href="<?php echo get_permalink($nextid); ?>"><h6 class="siguiente-entrada"><?php echo get_the_title($nextid); ?><br><span><?php echo get_the_date('D M j' ,$previd); ?> </span></h6></a>




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

              /*$args = array( 'numberposts' => '4', 'post_status' => 'publish' );
              $recent_posts = wp_get_recent_posts( $args );

             */
			   $nro=1;
			  $query = new WP_Query( array(
					'meta_key' => 'wpb_post_views_count',
					'orderby' => 'meta_value_num',
					'posts_per_page' => 4,
					"category_name"=> "cuna-cajon"
				) );


				if ( $query->have_posts() ) {
					// The 2nd Loop
					while ( $query->have_posts() ) {
						$query->the_post();





                $post_categories = wp_get_post_categories( $recent["ID"]);
                $date= get_the_date();?>
                <a href="<?php echo get_permalink($recent["ID"]);  ?>" title="<?php echo esc_attr(the_title())?>">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bloque-widget">
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    <p class="widget-numero"><?php   echo $nro ?></p>
                  </div>
                  <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                    <p><?php   echo $date ?></p>
                    <p><?php echo the_title();  ?></p>
                  </div>
                </div>

              </a>

              <!-- echo $date.'<p ><a style="color:white" href="' . get_permalink($recent["ID"]) . '" title="'.esc_attr($recent["post_title"]).'" >' .   $recent["post_title"].'</a></p>'; -->


              <?php $nro++; }

					// Restore original Post Data
					wp_reset_postdata();
				}

			  ?>
          </div>
        </div>
		

        <div class="clear"></div>


</div>

</div>
<!-- wrapper -->

<?php get_footer(); ?>
