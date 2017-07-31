

<?php
  // get_header();




  get_template_part( 'library/templates/header', 'links' );
	  get_template_part( 'library/templates/header', 'extra' );
  get_template_part( 'library/templates/header', 'menu' );
 $current_id_slide;
global $kopa_setting;
// if ( is_page(get_the_ID()) && have_posts() ) {
//     while ( have_posts() ) {
//         the_post(); ?>
<div id="main-content">
<section class="main-section trio-<?php $categories = get_the_category();$cat= $categories[0];echo $cat->slug;?>">


<div id="page-<?php the_ID(); ?>" class="page-content-area clearfix">

  <div class="label-name-page" style="max-height:400px;overflow:hidden">
    <?php the_post_thumbnail( 'full' );   ?>

  </div>

  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="box-shadow: 0px 0px 16px -1px rgba(0,0,0,0.50); min-height:400px;padding-bottom:50px;">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="height:400px;">
        <img src="<?php echo get_field('foto_portada') ?>" style="position:absolute; bottom:0" alt="">
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding:20px;">
      <h1 style="border-bottom:2px solid black;font-size:48px; line-height:50px;padding-bottom:10px;"><?php $title= the_title_attribute(array("echo" => 0));
        $t=split("//", $title);echo $t[0]; ?> <span style="color:#00b643"><?php echo $t[1] ?></span></h1>
      <div style="font-size:15px;color:black; font-family='Roboto-Regular'"><?php

$post_id_5369 = get_post(get_the_ID());

$content = $post_id_5369->post_content;
$content = apply_filters('the_content', $content);
$content = str_replace(']]>', ']]>', $content);
echo  $content ;
?>
</div>
    </div>


  </div>



  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 container-gallery">

    <style>
    .max-box-gallery:hover{
      cursor: pointer;
    }

    .max-box-gallery{ padding: 30px;}
    .box-gallery{text-align: center; overflow: hidden;  padding: 0; border-style: double; border-width: 4px; box-shadow: 0px 0px 16px -1px rgba(0,0,0,0.50); border-color: #c3c3c3;}
    .box-gallery span{
      opacity: 0;
      width: 100%;
      height: 100%;
      background:  rgba(0,0,0,.5);
      position: absolute;
      top:0;
      left: 0;
      color: white;
      text-align: center;
      padding-top: 45%;
      font-size:4em;
      font-family: 'Condensed-bold-italic';
    }

    .box-gallery span:hover{
      opacity: 1;
      transition: 1s all;
    }

    .box-gallery img{
      height: 100%;
      width: auto;

    }
    </style>



  <script>
  //  imgPerObject={};
    ListElements=[];

  </script>

  <?php
  $categories = get_the_category();
   $category_id= $categories[0]->cat_ID;

    $posts= get_posts( array('numberposts' => -1, "post_type"=>"post", 'category'=>$category_id , 'orderby'  => 'post_date', 'order'    => 'DESC') );
    // echo 'asdasd';
  foreach($posts as $post){

    // echo var_dump()post;
    ?>



    <!-- <script>

    //Arreglar esta parte con las cosas q corresponden
      object={};
      object['title']='<?php the_title(); ?>';
      var content;


    <?php  $content = get_post_field( 'post_content', get_the_ID() );

// Get content parts
$content_parts = get_extended( $content );

$new =trim($content_parts['main']);
//echo $new;

?>

  object['content']="hola";

  // <?php $post_id_5369 = get_post(get_the_ID());
  //
  // $content = $post_id_5369->post_content;
  // // $content = apply_filters('the_content', $content);
  // $content = str_replace(']]>', ']]>', $content);
  // // $content = explode(' ', $content);
  // // $content = explode(":<!--more-->", $content);
  // // $content = explode(' ', $content[0]);
  // // foreach($content as $con){
  // //   echo $con.' ';
  // // }
  //
  // //print($content);
  // ?> ;

      object['volanta']='<?php echo get_field('volanta')?>';
      object['category']='<?php the_title(); ?>';
      object['notes']='<?php the_title(); ?>';

      innerImgs=[];

      innerImgs.push("<?php echo get_the_post_thumbnail_url(get_the_ID(),'full'); ?>");

      <?php  $galleries = get_post_galleries_images( $post );
              $gal=$galleries[0];


      if($gal){


      foreach ($gal as $g) {?>

        innerImgs.push('<?php echo $g; ?>');

      <?php  }} ?>



      object['images']=innerImgs;

      ListElements.push(object);

    </script> -->

      <!-- <a href="<?php the_permalink();?>"> -->
          <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 max-box-gallery get-post" id-post="<?php the_ID();?>">


        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 box-gallery square" style="background-image:url(<?php  echo get_the_post_thumbnail_url($post->id,'medium' ); ?>);background-position:center;background-size:cover;">
            <?php  //echo the_post_thumbnail('full' ); ?>


           <span> Ver</span>
        </div>

      </div>


     <!-- </a> -->
     <?php } wp_reset_postdata(); ?>

  </div>

  <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 wrapper clearfix"></div> -->

  <style>
    .modal-gallery{
      font-size: 1.3em;
      border: 15px solid transparent;
      position: fixed;
      top:0;
      height: 100%;
      width: 100%;
      background-color:white;
      /*opacity: .5;*/
      z-index: 2;
      color: black;
      padding: 4em 3em;
      display: none;
      border-image: url("<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/marco_museo.png") 30 round;
    }

    .img-sector-padre img{
      display: none;
    }

    .img-sector p, .info-sector .buttons{
      display: inline;
      font-family: 'Condensed-bold';
      padding: 5px 10px;
    }

    .img-sector p:hover, .info-sector .buttons:hover,.modal-gallery .span:hover, .get-post-not{
      cursor: pointer;
      opacity: .5;
      transition: all .5s;
    }

    .img-sector .nro-image{
      color: #a43c93;
    }



    .img-sector img{
      max-width: 100%;
      height: auto;
	  max-height:400px;
      box-shadow: 0px 0px 16px -1px rgba(0,0,0,0.50);
      border-style: double;
      border-width: 4px;
      border-color: #c3c3c3;
      padding:0 !important;
    }

    .info-sector .volanta, .info-sector .content{
      font-family: 'Roboto-regular'
    }
    .info-sector .notas{
      font-family: 'Condensed-bold-italic'
    }

    .info-sector .volanta{
      font-family: 'Condensed-regular';
    }

    .info-sector .title{
      font-family: 'Condensed-bold-italic';
      color: #00b643;
    }

    .modal-gallery .span{
      position: absolute;
      right: 0;
      top:0;
      padding: 30px;
      font-size: 25px;
    }
  </style>
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 modal-gallery">



  </div>

</div>


<?php //} // endwhile
//} // endif
?>


<script>

</script>


<style media="screen">
  .pswp__button{
    display: inline-block;
    float: none;
    position: relative;
    width: 150px;
  }
  ç
  .pswp__button--arrow--left:before{
    right: 100%;
    }

  .pswp__button--arrow--right:before {
    left: 100%;
  }
</style>

<?php get_footer();?>
