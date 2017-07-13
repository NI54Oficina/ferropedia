
<?php
  get_header();


global $kopa_setting;
// if ( is_page(get_the_ID()) && have_posts() ) {
//     while ( have_posts() ) {
//         the_post(); ?>



<div id="page-<?php the_ID(); ?>" class="page-content-area clearfix">

  <div class="label-name-page">
    <?php the_post_thumbnail( 'full' );   ?>

  </div>



  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 container-gallery">

    <style>

    .max-box-gallery{ padding: 30px;}
    .box-gallery{   padding: 0; border-style: double; border-width: 4px; box-shadow: 0px 0px 16px -1px rgba(0,0,0,0.50); border-color: #c3c3c3;}
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
  <?php  $posts= get_posts( array('numberposts' => -1, "post_type"=>"post", 'category'=>3 ) );

  foreach($posts as $post){
    ?>

    <script>

    //Arreglar esta parte con las cosas q corresponden
      object={};
      object['title']='<?php the_title(); ?>';
      object['content']='<?php echo(get_the_excerpt($post->ID)); ?>';
      object['volanta']='<?php the_title(); ?>';
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


        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 box-gallery">
            <?php  echo the_post_thumbnail('full' ); ?>

           <span> Ver</span>
        </div>

      </div>


     <!-- </a> -->
     <?php } wp_reset_postdata(); ?>

  </div>

  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 wrapper clearfix"></div>

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
      <img src="" alt="">
      <p>"<" Foto anterior</p> <p>1</p> <p>Foto siguiente ">"</p>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 info-sector">
      <p class="volanta"></p>
      <h1 class="title"></h1>
      <p class="notas"></p>
      <p class="content">
      </p>
      <p  class="buttons prev-post">Anterior</p>|<p  class="buttons next-post">Siguiente</p>
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
