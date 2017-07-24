
<?php
  // get_header();
  get_template_part( 'library/templates/header', 'links' );
  get_template_part( 'library/templates/header', 'extra' );
       get_template_part( 'library/templates/header', 'menu' );

global $kopa_setting;
// if ( is_page(get_the_ID()) && have_posts() ) {
//     while ( have_posts() ) {
//         the_post(); ?>

<div id="main-content">
<section class="main-section">
<div id="page-<?php the_ID(); ?>" class="page-content-area clearfix" style="padding:50px 100px;">

  <p style="background-color:white; color:#006443; width:100%; border-bottom:4px solid #006443; font-size:2em; padding:10px; font-family: 'Condensed-bold-italic';">Ferropedistas</p>

  <div class="col-lg-12 col-md-12 col-sm-12  col-xs-12 container-post-ferropedistas" style="padding-bottom:50px;">
    <?php
        $categories = get_the_category();
        $category_id= $categories[0]->cat_ID;

        $posts= get_posts( array('numberposts' => -1, "post_type"=>"post", 'category'=>$category_id ) );


          foreach($posts as $post){?>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 square" style="text-align:center; padding:20px;">
              <div class="" style="height:100%; border:1px solid white; ">
                  <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'full'); ?>" alt="">
              </div>
              <p style="margin-top:20px;color:white; font-family:'Condensed-bold-italic'; font-size:2em;"><?php $title= the_title_attribute(array("echo" => 0));
                $t=split("//", $title);echo $t[0]; ?> <span style="color:#00b643"><?php echo $t[1] ?></span></p>
                <p  style="color:#7b7b7b; font-family:'Condensed-bold-italic'; font-size:1.3em;"><?php echo get_field('volanta') ?></p>
            </div>

      <?php }  wp_reset_postdata();   ?>
  </div>

  <style>

    .body-quienessomos{
      background-color: #006443;
      padding: 0;
    }

    .body-quienessomos h1{
      color: white;
      font-family: 'Condensed-bold-italic';
      font-size: 3em;
      width: 100%;
      padding: 10px;
      background-color: rgba(0,182,67,.7);
      border-bottom: 2px solid black;
      margin-top: 0;
    }

    .body-quienessomos h3{
      font-size: 1.8em;
      font-family: 'Roboto-bold';
      color: white;
    }


    .body-quienessomos h2{
      font-size: 2.5em;
      font-family: 'Condensed-bold-italic';

    }

    .body-quienessomos p{
      color: white;
      font-family: 'Roboto-regular';
      padding: 10px 50px;
    }

  </style>

  <div class="" style="padding:50px 100px;">



      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 body-quienessomos">
        <?php

  $post_id_5369 = get_post(get_the_ID());

  $content = $post_id_5369->post_content;
  $content = apply_filters('the_content', $content);
  $content = str_replace(']]>', ']]>', $content);
  echo  $content ;
  ?>
      </div>

  </div>



</div>


<?php get_footer();?>

<style media="screen">

  .modal-ferropedistas{
    position: fixed;
    top:0;
    lef:0;
    background-color: rgba(255,255,255,.9);
    height: 100%;
    width: 100%;
  }

</style>


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 modal-ferropedistas">


</div>
