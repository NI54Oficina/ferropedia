
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
<div id="page-<?php the_ID(); ?>" class="page-content-area clearfix" >


  <div class="label-name-page">
    <?php the_post_thumbnail( 'full' );   ?>
<div style="padding:0;height:0;">
    <div class="header-text-content">
      <h1><?php the_title(); ?></h1>
      <?php //the_content(); ?>
    </div>
</div>

  </div>

   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding:80px 100px; background-image:url(<?php echo get_template_directory_uri(); ?>/img/tile_home.png);">


		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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




<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-left:100px; padding-right:100px;padding-top:40px;">


  <p style=" background-color:white; color:#006443; width:100%; border-bottom:4px solid #006443; font-size:2em; padding:10px; font-family: 'Condensed-bold-italic';">Equipo</p>
</div>

  <div class="col-lg-12 col-md-12 col-sm-12  col-xs-12 container-post-ferropedistas" style="padding:50px 100px; margin-bottom:100px;">

    <?php
        $categories = get_the_category();
        $category_id= $categories[0]->cat_ID;

        $posts= get_posts( array('numberposts' => -1, "post_type"=>"post", 'category'=>$category_id ) );


          foreach($posts as $post){  ?>

			<div class="col-lg-6 col-md-6 col-sm-4 col-xs-4" style="padding-bottom:60px;">

				<div class="get-post element-f col-lg-6 col-md-6 col-sm-12 col-xs-12 square" style="text-align:center; padding:20px;" id-post="<?php the_ID();?>" >
				  <div class="" style="height:100%; border:1px solid white; ">
					  <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'full'); ?>" alt="">
				  </div>

				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 square"  style="display:table;">
				<div style="display: table-cell;vertical-align:bottom;height:100%;padding-bottom:10px;">
				<p style="margin-top:20px;color:white; font-family:'Condensed-bold-italic'; font-size:2em;"><?php $title= the_title_attribute(array("echo" => 0));
					$t=split("//", $title);echo $t[0]; ?> <span style="color:#00b643"><?php echo $t[1] ?></span></p>
					<p  style="color:#7b7b7b; font-family:'Condensed-bold-italic'; font-size:1.3em;"><?php echo get_field('volanta') ?></p>

				</div>
				</div>

				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<p style="line-height:18px;"><?php echo $post->post_content; ?></p>
				</div>
            </div>






      <?php }  wp_reset_postdata();   ?>
  </div>

  <style>

    .body-quienessomos{

      padding: 0;
	  max-width:800px;
	  float:initial;
	  margin:auto;
    }

    .body-quienessomos h1{
      color: white;
      font-family: 'Condensed-bold-italic';
      font-size: 3em;
      width: 100%;
      padding: 25px;
      background-image:  repeating-linear-gradient( -45deg, rgb(59, 175, 62), rgba(52, 195, 57, 0.75) 2px, #00b643 4px, #00b643 6px );
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



	.body-quienessomos li{
      color: white;
      font-family: 'Roboto-regular';
      padding: 30px 100px;
      margin:10px 0;
      background-color: #006443;
      min-height: 100px;
	  font-size:14px;
	  list-style:none;
	  min-height:140px;
    }

	.body-quienessomos ol{
		padding-left:0;
	}

	.body-quienessomos ol li::before{
		color:#55c792;
		display:block;

		position:absolute;
		left:40px;

		font-family: Georgia;
		font-size: 70px;
		line-height: 60px;
		padding-top: 4px;

		font-family: 'Roboto-bold';
		border-bottom: 3px solid #55c792;

	}

	.body-quienessomos ol li:nth-child(1)::before{content:"01";}
	.body-quienessomos ol li:nth-child(2)::before{content:"02";}
	.body-quienessomos ol li:nth-child(3)::before{content:"03";}
	.body-quienessomos ol li:nth-child(4)::before{content:"04";}
	.body-quienessomos ol li:nth-child(5)::before{content:"05";}
	.body-quienessomos ol li:nth-child(6)::before{content:"06";}
	.body-quienessomos ol li:nth-child(7)::before{content:"07";}
	.body-quienessomos ol li:nth-child(8)::before{content:"08";}
	.body-quienessomos ol li:nth-child(9)::before{content:"09";}
	.body-quienessomos ol li:nth-child(10)::before{content:"10";}
	.body-quienessomos ol li:nth-child(11)::before{content:"11";}
	.body-quienessomos ol li:nth-child(12)::before{content:"12";}
	.body-quienessomos ol li:nth-child(13)::before{content:"13";}
	.body-quienessomos ol li:nth-child(14)::before{content:"14";}
	.body-quienessomos ol li:nth-child(15)::before{content:"15";}
	.body-quienessomos ol li:nth-child(16)::before{content:"16";}
	.body-quienessomos ol li:nth-child(17)::before{content:"17";}
	.body-quienessomos ol li:nth-child(18)::before{content:"18";}
	.body-quienessomos ol li:nth-child(19)::before{content:"19";}
	.body-quienessomos ol li:nth-child(20)::before{content:"20";}
	.body-quienessomos ol li:nth-child(21)::before{content:"21";}
	.body-quienessomos ol li:nth-child(22)::before{content:"22";}
	.body-quienessomos ol li:nth-child(23)::before{content:"23";}
	.body-quienessomos ol li:nth-child(24)::before{content:"24";}
	.body-quienessomos ol li:nth-child(25)::before{content:"25";}
	.body-quienessomos ol li:nth-child(26)::before{content:"26";}
	.body-quienessomos ol li:nth-child(27)::before{content:"27";}
	.body-quienessomos ol li:nth-child(28)::before{content:"28";}
	.body-quienessomos ol li:nth-child(29)::before{content:"29";}
	.body-quienessomos ol li:nth-child(30)::before{content:"30";}



    .body-quienessomos ol li{
		padding-left:160px;
    }

	.page-content-area{
		padding-bottom:0;
	}


  </style>


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
    padding: 50px;
  }

  .modal-ferropedistas .span{
    color: black;
    font-size: 2em;
    position: absolute;
    right: 0;
    top:0;
    padding: 30px;
    user-select: none;
  }

  .modal-ferropedistas .span:hover{
    cursor: pointer;
  }

  .modal-ferropedistas .img-ferropedista, .modal-ferropedistas .info-ferropedista{
    padding: 50px !important;
    /*overflow: hidden;*/
  }

  .modal-ferropedistas .img-ferropedista img{
    width: 100%;
    height: auto;
  }

  .modal-ferropedistas .info-ferropedista  {
    color:black;
  }

  .info-ferropedista .nombre-ferropedista{
    font-family: 'Condensed-bold-italic';
    font-size: 30px;
	padding-top:40px;
  }

  .info-ferropedista .nombre-ferropedista span{
    color:#00B643;
  }

  .info-ferropedista .status-ferropedista{
    font-family: 'Condensed-bold-italic';
    font-size: 15px;
    padding: 10px 0;
	padding-top:0;
	padding-bottom:20px;
  }

  .info-ferropedista .texto-ferropedista{
    font-family: 'Roboto-regular';
	font-size:15px;
	line-height:23px;

  }

  .body-quienessomos a{
	  color:inherit;

		text-decoration:underline !important;
  }

  .body-quienessomos a:hover{
	  color:#F7F7F7;
  }

  .body-quienessomos strong{
	  font-weight:initial;
	  font-family:'Roboto-bold';
  }


</style>


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 modal-ferropedistas modal-gallery" style="display:none">

  <!-- <span class="span">X</span>

  <div class="img-ferropedista square col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <img src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/ejemplo-10.png" alt="">
  </div>

  <div class="info-ferropedista col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <p class="nombre-ferropedista">Pablo<span> Abiad</span></p>
    <p class="status-ferropedista">El mejor ferropedista</p>
    <p class="texto-ferropedista">Un texto sobre el ferropedista bleble
    mucha informacion ble ble ble .</p>
  </div> -->

</div>


<script>

// $(document).ready( function(){ _modalf()});
//
// function _modalf(){
//
//   console.log("Asdasd");
//
//   $(".element-f").on('click', function(){
//
//        var new_url= $(this).find('img').attr('src');
//
//        var id=$(".container-post-ferropedistas .element-f").index(this);
//
//       console.log(new_url);
//
//       $(".img-ferropedista img").attr('src', new_url);
//       $(".info-ferropedista .nombre-ferropedista").html(ListFerropedistas[id].nombre);
//       $(".info-ferropedista .status-ferropedista").html(ListFerropedistas[id].status);
//       $(".info-ferropedista .texto-ferropedista").html(ListFerropedistas[id].texto);
//
//       $(".modal-ferropedistas").fadeIn();
//
//       $(".span").on('click', function(){
//         $(".modal-ferropedistas").fadeOut();
//       })
//   })
// }

</script>
