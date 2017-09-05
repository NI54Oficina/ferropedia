
<?php
get_template_part( 'library/templates/header', 'links' );
get_template_part( 'library/templates/header', 'extra' );
     get_template_part( 'library/templates/header', 'menu' );

    global $kopa_layout;
    global $kopa_setting;
    $sidebars = $kopa_setting['sidebars'][$kopa_setting['layout_id']];
    $kopa_layout = unserialize(KOPA_LAYOUT);
    $kopa_position = $kopa_layout[$kopa_setting['layout_id']]['positions'];
?>

<section class="main-section trio-<?php $categories = get_the_category();$cat= $categories[0];echo $cat->slug;?>">
<div class="wrapper clearfix" style="background-color:white">
<?php
  $post_categories = wp_get_post_categories( get_the_ID() );
  $c= $post_categories[0];
  $cat = get_category( $c );

  if($cat->slug =="cuna-cajon"){?>

	<div class="label-name-page">
        <?php echo get_the_post_thumbnail(21);   ?>


	 <!-- para seo !-->
	  <div class="header-text-content" style="padding:0 60px;height:0;padding-left:30px;">
	<h1 >De la Cuna <span class="sub-verde">hasta el Cajón</span></h1>
	</div>
	<div class="bajada-cuna">
	<p ><?php 
	$page= get_page_by_path("cuna-cajon");
	echo $page->post_content;
	?></p>
    </div>
    </div>




  <?php  }  ?>

<hr>


  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-col pull-left custom-search">



    <section class="col-lg-9 col-md-9 col-sm-12 col-xs-12 entry-list">
         <?php get_template_part( 'library/templates/loop', 'blog-1' ); ?>
   </section>


   <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
      <div class="twitter-container widget widget-content" style="border:none;">
		<!-- widget twitter -->
		<?php echo do_shortcode("[custom-twitter-feeds screenname='notibaenred']"); ?>
		
		<!-- widget twitter -->
	</div>

   </div>

    <div class="clear"></div>

  </div>
</div>

<?php get_footer();?>
