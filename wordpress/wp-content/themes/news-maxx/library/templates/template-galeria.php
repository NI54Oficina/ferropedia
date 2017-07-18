
<?php
  get_header();


global $kopa_setting;
// if ( is_page(get_the_ID()) && have_posts() ) {
//     while ( have_posts() ) {
//         the_post(); ?>



<div id="page-<?php the_ID(); ?>" class="page-content-area clearfix">

  <div class="label-name-page" style="max-height:400px;overflow:hidden">
    <?php the_post_thumbnail( 'full' );   ?>

  </div>

  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="box-shadow: 0px 0px 16px -1px rgba(0,0,0,0.50); max-height:400px;">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="height:400px;">
        <img src="<?php echo get_field('foto_portada') ?>" style="position:absolute; bottom:0" alt="">
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding:20px;">
      <h1 style="border-bottom:2px solid black;font-size:48px; line-height:60px;"><?php $title= the_title_attribute(array("echo" => 0));
        $t=split("//", $title);echo $t[0]; ?> <span style="color:#00b643"><?php echo $t[1] ?></span></h1>
      <div style="font-size:15px;color:black; font-family='Roboto-Regular'"><?php the_content(); ?></div>
    </div>


  </div>



  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 container-gallery">

    <style>
    .max-box-gallery:hover{
      cursor: pointer;
    }

    .max-box-gallery{ padding: 30px;}
    .box-gallery{ overflow: hidden;  padding: 0; border-style: double; border-width: 4px; box-shadow: 0px 0px 16px -1px rgba(0,0,0,0.50); border-color: #c3c3c3;}
    .box-gallery span{
      opacity: 0;
      width: 100%;
      height: 100%;
      background:  rgba(0,0,0,.5);
      position: absolute;
      top:0;
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
    </style>

  <h1>Galeria de Imágenes</h1>

  <script>
  //  imgPerObject={};
    ListElements=[];

  </script>

  <?php
  $categories = get_the_category();
   $category_id= $categories[0]->cat_ID;

    $posts= get_posts( array('numberposts' => -1, "post_type"=>"post", 'category'=>$category_id ) );

  foreach($posts as $post){
    ?>

    <script>

    //Arreglar esta parte con las cosas q corresponden
      object={};
      object['title']='<?php the_title(); ?>';
      object['content']='<?php  $content = get_post_field( 'post_content', get_the_ID() );

// Get content parts
$content_parts = get_extended( $content );

// Output part before <!--more--> tag
echo $content_parts['main']; ?>';
      object['volanta']='<?php echo get_field('volanta')?>';
      object['category']='<?php the_title(); ?>';
      object['notes']='<?php the_title(); ?>';

      innerImgs=[];

      <?php  $galleries = get_post_galleries_images( $post );
              $gal=$galleries[0];
      foreach ($gal as $g) {?>

        innerImgs.push('<?php echo $g; ?>');

      <?php  } ?>

      object['images']=innerImgs;

      ListElements.push(object);

    </script>

      <!-- <a href="<?php the_permalink();?>"> -->
          <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 max-box-gallery">


        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 box-gallery square">
            <?php  echo the_post_thumbnail('full' ); ?>

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


    .img-sector p, .info-sector .buttons{
      display: inline;
      font-family: 'Condensed-bold';
      padding: 5px 10px;
    }

    .img-sector p:hover, .info-sector .buttons:hover,.modal-gallery span:hover{
      cursor: pointer;
      opacity: .5;
      transition: all .5s;
    }

    .img-sector .nro-image{
      color: #a43c93;
    }

    .img-sector img{
      width: 80%;
      box-shadow: 0px 0px 16px -1px rgba(0,0,0,0.50);
      border-style: double;
      border-width: 4px;
      border-color: #c3c3c3;
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

    .modal-gallery span{
      position: absolute;
      right: 0;
      top:0
      /*right:5%;
      top:15%;*/
    }
  </style>
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 modal-gallery">

    <span id="close-modal">X</span>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 img-sector">
      <img src="" alt=""><br>
      <div class="" style="position: absolute;
    left: 0;
    right: 0;
    margin: auto;
    width: 70%;
    padding: 20px 0;">
          <p class="prev-image">&lt; Foto anterior</p> <p class="nro-image">1</p> <p class="next-image">Siguiente foto &gt;</p>
      </div>

    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 info-sector">
      <p class="volanta"></p>
      <h1 class="title"></h1>
      <p class="notas"></p>
      <p class="content">
      </p>
      <p  class="buttons prev-post">Entrada anterior</p>|<p  class="buttons next-post">Siguiente entrada</p>
    </div>
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
