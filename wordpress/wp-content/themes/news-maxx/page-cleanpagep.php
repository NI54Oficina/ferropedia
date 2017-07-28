<?php
/**
 * Template Name: Clean Page
 * This template will only display the content you entered in the page editor
 */
?>

    <?php
    global $post;
	if(isset($_POST["id"])){
		$id=$_POST["id"];

    $mypost = get_post( $id );

    $globalCat = get_the_category($id);

    // echo $globalCat[0]->slug;
    if( $globalCat[0]->slug != "ferropedistas"){

    ?>


      <span class="span" id="close-modal">X</span>

      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 img-sector" style="padding:0 60px;">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 img-sector-padre" style="text-align:center;" >
          <!-- <?php echo get_the_post_thumbnail($id );  ?><br> -->

          <img class="contenido-dinamico" src="<?php echo get_the_post_thumbnail_url($id );  ?>" alt="">

          <?php  $galleries = get_post_galleries_images( $id );
                  $gal=$galleries[0];

          if($gal){

          foreach ($gal as $g) {?>

              <img class="contenido-dinamico" src=" <?php echo $g; ?>" alt="">

          <?php  }} ?>

        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 20px 0; text-align:center">
          <div style="position:absolute; left:0; right:0; margin:auto">
            <p class="button-img-post prev-image prev">&lt; Foto anterior</p>   <!-- <p class="nro-image">1</p>--> <p class="button-img-post next next-image">Siguiente foto &gt;</p>
          </div>

        </div>

      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 info-sector" style="overflow:hidden">
        <p class="volanta"><?php echo get_field('volanta', $id); ?></p>
        <h1 class="title"><?php $title= the_title_attribute(array("post"=> $id,"echo" => 0));
          $t=split("//", $title);echo $t[0]; ?> <span style="color:#00b643"><?php echo $t[1] ?></span></h1>
        <!-- <p class="notas"><?php  ?></p> -->
        <p class="content" style="font-size: .8em;overflow: auto;max-height: 60vh;">
          <?php
          $content = get_post_field( 'post_content', $id);

          $content_parts = get_extended( $content );

          echo $content_parts['main']; ?>
        </p>
        <?php

        $cat = get_the_category($id);
        $current_cat_id = $cat[0]->cat_ID; // current category ID

        $args = array(
          'numberposts' => -1, "post_type"=>"post", 'category'=>$current_cat_id , 'orderby'  => 'post_date', 'order'    => 'DESC');
        $posts = get_posts( $args );

        // var_dump($posts);
        // get IDs of posts retrieved from get_posts
        $ids = array();
        foreach ( $posts as $thepost ) {
            $ids[] = $thepost->ID;
        }

        // echo var_dump($ids);
        // get and echo previous and next post in the same category
        $thisindex = array_search( $id, $ids );
        $previd = $ids[ $thisindex - 1 ];
        $nextid = $ids[ $thisindex + 1 ];




         ?>
        <p  class="buttons prev-post get-post<?php if (  empty( $previd ) ) { echo "-not";} ?>" id-post="<?php if ( ! empty( $previd ) ) { echo $previd;} ?>">Entrada anterior</p>|<p  class="buttons next-post get-post<?php if (  empty( $nextid ) ) { echo "-not";} ?>" id-post="<?php if ( ! empty( $nextid ) ) { echo $nextid;}  ?>">Siguiente entrada</p>
      </div>




    <!-- <script>
      get_post();
      close_modal();
    </script> -->

  <?php
} else{ ?>


  <span class="span" id="close-modal">X</span>

  <div class="img-ferropedista square col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <img src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/ejemplo-10.png" alt="">
  </div>

  <div class="info-ferropedista col-lg-6 col-md-6 col-sm-6 col-xs-12">

    <p class="nombre-ferropedista"><?php $title= the_title_attribute(array("post"=> $id,"echo" => 0));
      $t=split("//", $title);echo $t[0]; ?> <span style="color:#00b643"><?php echo $t[1] ?></span></p>

    <p class="status-ferropedista"><?php echo get_field('volanta', $id); ?></p>

    <p class="texto-ferropedista">
      <?php
      $content = get_post_field( 'post_content', $id);

      $content_parts = get_extended( $content );

      echo $content_parts['main']; ?>
    </p>

  </div>


   <?php  }


}wp_reset_postdata();



    ?>
