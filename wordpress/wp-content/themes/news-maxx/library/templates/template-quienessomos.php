
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
