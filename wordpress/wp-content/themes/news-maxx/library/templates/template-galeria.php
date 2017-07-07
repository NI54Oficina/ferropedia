
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



  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 container-gallery">

  <h1>Galeria de Imágenes</h1>


      <section class="entry-list">
       <?php  get_template_part( 'library/templates/loop', 'blog-1' ); ?>
     </section>

  </div>

  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 wrapper clearfix">






  </div>

</div>



<?php } // endwhile
} // endif
?>


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pswp" tabindex="-1" role="dialog" aria-hidden="true" style="top:0">


    <div class="pswp__bg"></div>

    <div class="pswp__scroll-wrap">


        <div class="pswp__container">

            <div class="pswp__item">
            <div class="">sometextss</div></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>


        </div>


        <div class="pswp__ui pswp__ui--hidden">

            <div class="pswp__top-bar">

                <!--  Controls are self-explanatory. Order can be changed. -->

                <div class="pswp__counter"></div>

                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

                <button class="pswp__button pswp__button--share" title="Share"></button>

                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                <!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR -->

                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                      <div class="pswp__preloader__cut">
                        <div class="pswp__preloader__donut"></div>
                      </div>
                    </div>
                </div>
            </div>

            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>



            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>


            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="bottom:10%; position:absolute;padding-left:25% ">
              <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">Foto anterior
              </button>

              <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">Siguiente foto
              </button>
            </div>

          </div>

        </div>

</div>

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
