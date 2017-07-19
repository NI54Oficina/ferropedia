
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
      <?php //echo do_shortcode("[custom-twitter-feeds]"); ?>
      <img style="width: 100%;"src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/twitter-demo-10.png" alt="">

   </div>

    <div class="clear"></div>

  </div>
</div>

<?php get_footer();?>
