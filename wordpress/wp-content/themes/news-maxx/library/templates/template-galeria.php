
<?php
  get_header();


global $kopa_setting;
if ( is_page(get_the_ID()) && have_posts() ) {
    while ( have_posts() ) {
        the_post(); ?>

<?php ?>


<div id="page-<?php the_ID(); ?>" class="page-content-area clearfix">

  <div class="label-name-page">
    <?php the_post_thumbnail( 'full' );   ?>

  </div>



  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <?php the_content(); ?>
  </div>
  <div class="wrapper clearfix">






  </div>

</div>



    <?php comments_template(); ?>

<?php } // endwhile
} // endif
?>



<?php get_footer();?>
