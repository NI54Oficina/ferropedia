

<?php
  // get_header();





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

  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="box-shadow: 0px 0px 16px -1px rgba(0,0,0,0.50);padding-bottom:50px;">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style=";">
        <!-- <img src="<?php echo get_field('foto_portada') ?>" style="position:absolute; bottom:0" alt=""> -->
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
	.max-box-gallery{
		overflow:hidden;
	}
	.max-box-gallery .overlay{
		padding:0;
		
		float:initial;
		width:600px;
		height:100px;
		position:relative;
		z-index:10;
		opacity:1;
	}
	
	.max-box-gallery .box-gallery{
		width:30vw;
		position:absolute;
		z-index:0;
		
		top:-30px;
	}
	.max-box-gallery:hover .overlay{
		 background-color:rgba(0,0,0,0.5);
		opacity:1;
	}
	.max-box-gallery:hover .box-gallery{
		 background-size:200% !important;
	  transition:10s;
	}

    .max-box-gallery{ padding: 0; }
    .max-box-gallery .box-gallery{ transition:1s;}
	
	.overlay{text-align: center; overflow: hidden;  padding: 0; border-style: double; border-width: 4px; box-shadow: 0px 0px 16px -1px rgba(0,0,0,0.50); border-color: #c3c3c3;
	display: table-cell;
	  vertical-align: bottom;
	  float:initial;
	}
    .box-gallery span,.overlay span{
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



	.box-gallery p,.overlay p{
		display:inline-block;
background:rgba(0,0,0,0.5);
color:white;
font-size:16px;
width:100%;
padding:10px;
margin-bottom:0;
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


  <?php
	$categories = get_the_category();
	$category_id= $categories[0]->cat_ID;

    $posts= get_posts( array('numberposts' => -1, "post_type"=>"post", 'category'=>$category_id , 'orderby'  => 'post_date', 'order'    => 'DESC') );
    // echo 'asdasd';
	foreach($posts as $post){
	
	$content = get_post_field( 'post_content', get_the_ID() );

	// Get content parts
	$content_parts = get_extended( $content );

	$new =trim($content_parts['main']);

	$galleries = get_post_galleries_images( $post );
              $gal=$galleries[0];
     ?>

      <a href="<?php the_permalink();?>">

        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 max-box-gallery get-post square" id-post="<?php the_ID();?>" >

		<div class="overlay square">
		  <p><?php echo get_the_title(); ?></p>
		</div>
        <div class="box-gallery square" style="background-image:url(<?php  echo get_the_post_thumbnail_url($post->id,'medium' ); ?>);background-position:center;background-size:100% auto;">
            		
        </div>
       

      </div>
		</a>

    
     <?php } wp_reset_postdata(); ?>

  </div>

 

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

    .img-sector-padre .contenido-dinamico{
      display: none;
    }

	.img-sector-padre .contenido-dinamico p{
			display:block;
			position:relative;
			top:20px;
	}

    .img-sector p, .info-sector .buttons{
      display: inline;
      font-family: 'Condensed-bold';
      padding: 5px 10px;
	  -webkit-touch-callout: none; /* iOS Safari */
    -webkit-user-select: none; /* Safari */
     -khtml-user-select: none; /* Konqueror HTML */
       -moz-user-select: none; /* Firefox */
        -ms-user-select: none; /* Internet Explorer/Edge */
            user-select: none; /* Non-prefixed version, currently
                                  supported by Chrome and Opera */
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
	  max-height:70vh;
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
  
  <ul class="masonry-list">
  <li class="tile-case">
    <a href="#">
      <div class="tile-primary-content">
        <img src="http://albumcoverart.files.wordpress.com/2010/04/fleet-foxes-lp.jpg" alt="">
      </div>
      <div class="tile-secondary-content">
        <h2>Music</h2>
        <p>Fleet Foxes</p>
      </div>
    </a>
  </li>
  <li class="tile-job">
    <a href="#">
      <div class="tile-primary-content">
        <h2>Career</h2>
        <p>We're looking for consultants and other experts in advertising</p>
      </div>
      <div class="tile-secondary-content">
        <p>Apply now and become successful</p>
      </div>
    </a>
  </li>
  <li class="tile-facebook">
    <a href="#">
      <div class="tile-primary-content">
        <h2>Facebook</h2>
        <p>Don't expect to reach us on the phone today. We're BBQing! :)</p>
      </div>
      <div class="tile-secondary-content">
        <p>Like us on Facebook</p>
      </div>
    </a>
  </li>
  <li class="tile-twitter">
    <a href="https://twitter.com/chrisgrabinski">
      <div class="tile-primary-content">
        <h2>Twitter</h2>
        <p>@chrisgrabinski Lol. What's wrong with your CSS, bro?</p>
      </div>
      <div class="tile-secondary-content">
        <p>Follow us on Twitter</p>
      </div>
    </a>
  </li>
  <li class="tile-person">
    <a href="#">
      <div class="tile-primary-content">
        <img src="https://pbs.twimg.com/profile_images/687989817171288064/Y4PzAmSn.jpg" alt="">
      </div>
      <div class="tile-secondary-content">
        <div class="tile-secondary-container">
          <h2>Chris Grabinski</h2>
          <p>Front-end Development</p>
        </div>
      </div>
    </a>
  </li>
  <li class="tile-client">
    <a href="#">
      <div class="tile-primary-content">
        <img src="https://i.imgur.com/I6YDabc.png" alt="">
      </div>
    </a>
  </li>
</ul>
  
  <style>
  .masonry-list {
  left: 50%;
  margin: -320px 0 0 -480px;
  position: absolute;
  top: 50%;
  width: 960px;
}
.masonry-list li {
  float: left;
  height: 320px;
  overflow: hidden;
  padding: 0 1px 1px 0;
  width: 320px;
}
.masonry-list li:focus a::after, .masonry-list li:hover a::after {
  opacity: 1;
  -moz-transform: translate3d(0, 0, 0);
  -webkit-transform: translate3d(0, 0, 0);
  transform: translate3d(0, 0, 0);
}
.masonry-list li:focus .tile-primary-content img, .masonry-list li:hover .tile-primary-content img {
  -moz-transform: scale3d(1.2, 1.2, 0);
  -webkit-transform: scale3d(1.2, 1.2, 0);
  transform: scale3d(1.2, 1.2, 0);
  -moz-transform-origin: 50% 50%;
  -ms-transform-origin: 50% 50%;
  -webkit-transform-origin: 50% 50%;
  transform-origin: 50% 50%;
  -moz-transition: -moz-transform 15000ms cubic-bezier(0, 0, 0.8, 0.9);
  -o-transition: -o-transform 15000ms cubic-bezier(0, 0, 0.8, 0.9);
  -webkit-transition: -webkit-transform 15000ms cubic-bezier(0, 0, 0.8, 0.9);
  transition: transform 15000ms cubic-bezier(0, 0, 0.8, 0.9);
}
.masonry-list li:focus p,
.masonry-list li:focus h2,
.masonry-list li:focus .tile-secondary-content, .masonry-list li:hover p,
.masonry-list li:hover h2,
.masonry-list li:hover .tile-secondary-content {
  opacity: 1;
}
.masonry-list li a::after {
  background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAARCAYAAAA7bUf6AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyNpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNS1jMDE0IDc5LjE1MTQ4MSwgMjAxMy8wMy8xMy0xMjowOToxNSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIChNYWNpbnRvc2gpIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOkY1ODk4MTY1MDNBQTExRTNBN0U2RjUyQkFDMTgxQjI1IiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOkY1ODk4MTY2MDNBQTExRTNBN0U2RjUyQkFDMTgxQjI1Ij4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6RjU4OTgxNjMwM0FBMTFFM0E3RTZGNTJCQUMxODFCMjUiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6RjU4OTgxNjQwM0FBMTFFM0E3RTZGNTJCQUMxODFCMjUiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz6XrhZfAAAAiUlEQVR42qzT0QmAIBQFUJP8aYh2ah0XaYZogtzGJfrsdQUpi6z3tAtXUfHgjw0RqRiNbqogOs4GnVBbgii8xKAznbHhdZKGoUMdXWOlSDWULgK0lED3DS7UJ+f+SeZAnwgHYiFfEBt5g0RIDhqlSA46EM38HSs6oO7psM1c6lEv/cVV+QXZBRgAnat44PE4W1oAAAAASUVORK5CYII=");
  bottom: 40px;
  content: '';
  display: block;
  height: 17px;
  opacity: 0;
  position: absolute;
  right: 40px;
  width: 17px;
  -moz-transform: translate3d(-10px, -10px, 0);
  -webkit-transform: translate3d(-10px, -10px, 0);
  transform: translate3d(-10px, -10px, 0);
  -moz-transition: all 150ms ease-out;
  -o-transition: all 150ms ease-out;
  -webkit-transition: all 150ms ease-out;
  transition: all 150ms ease-out;
}
.masonry-list li.tile-job:focus .tile-primary-content p, .masonry-list li.tile-job:hover .tile-primary-content p, .masonry-list li.tile-facebook:focus .tile-primary-content p, .masonry-list li.tile-facebook:hover .tile-primary-content p, .masonry-list li.tile-twitter:focus .tile-primary-content p, .masonry-list li.tile-twitter:hover .tile-primary-content p {
  -moz-transform: translate3d(150%, 0, 0);
  -webkit-transform: translate3d(150%, 0, 0);
  transform: translate3d(150%, 0, 0);
  -moz-transition: -moz-transform 300ms cubic-bezier(0, 0, 0.4, 1);
  -o-transition: -o-transform 300ms cubic-bezier(0, 0, 0.4, 1);
  -webkit-transition: -webkit-transform 300ms cubic-bezier(0, 0, 0.4, 1);
  transition: transform 300ms cubic-bezier(0, 0, 0.4, 1);
}
.masonry-list li.tile-job:focus .tile-secondary-content p, .masonry-list li.tile-job:hover .tile-secondary-content p, .masonry-list li.tile-facebook:focus .tile-secondary-content p, .masonry-list li.tile-facebook:hover .tile-secondary-content p, .masonry-list li.tile-twitter:focus .tile-secondary-content p, .masonry-list li.tile-twitter:hover .tile-secondary-content p {
  -moz-transform: translate3d(0, 0, 0);
  -webkit-transform: translate3d(0, 0, 0);
  transform: translate3d(0, 0, 0);
  -moz-transition: -moz-transform 300ms cubic-bezier(0, 0, 0.4, 1) 150ms;
  -o-transition: -o-transform 300ms cubic-bezier(0, 0, 0.4, 1) 150ms;
  -webkit-transition: -webkit-transform 300ms cubic-bezier(0, 0, 0.4, 1);
  -webkit-transition-delay: 150ms;
  transition: transform 300ms cubic-bezier(0, 0, 0.4, 1) 150ms;
}
.masonry-list li.tile-job .tile-primary-content p, .masonry-list li.tile-facebook .tile-primary-content p, .masonry-list li.tile-twitter .tile-primary-content p {
  -moz-transform: translate3d(0, 0, 0);
  -webkit-transform: translate3d(0, 0, 0);
  transform: translate3d(0, 0, 0);
  -moz-transition: -moz-transform 300ms cubic-bezier(0, 0, 0.4, 1) 150ms;
  -o-transition: -o-transform 300ms cubic-bezier(0, 0, 0.4, 1) 150ms;
  -webkit-transition: -webkit-transform 300ms cubic-bezier(0, 0, 0.4, 1);
  -webkit-transition-delay: 150ms;
  transition: transform 300ms cubic-bezier(0, 0, 0.4, 1) 150ms;
}
.masonry-list li.tile-job .tile-secondary-content p, .masonry-list li.tile-facebook .tile-secondary-content p, .masonry-list li.tile-twitter .tile-secondary-content p {
  opacity: 1;
  -moz-transform: translate3d(-150%, 0, 0);
  -webkit-transform: translate3d(-150%, 0, 0);
  transform: translate3d(-150%, 0, 0);
  -moz-transition: -moz-transform 300ms cubic-bezier(0, 0, 0.4, 1);
  -o-transition: -o-transform 300ms cubic-bezier(0, 0, 0.4, 1);
  -webkit-transition: -webkit-transform 300ms cubic-bezier(0, 0, 0.4, 1);
  transition: transform 300ms cubic-bezier(0, 0, 0.4, 1);
}
.masonry-list li.tile-job .tile-primary-content {
  background-color: #71964f;
}
.masonry-list li.tile-facebook a::after {
  background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABYAAAAtCAYAAACqCZtVAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyNpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNS1jMDE0IDc5LjE1MTQ4MSwgMjAxMy8wMy8xMy0xMjowOToxNSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6NzcwNjIyOTMwM0FFMTFFM0E3RTZGNTJCQUMxODFCMjUiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6NzcwNjIyOTIwM0FFMTFFM0E3RTZGNTJCQUMxODFCMjUiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIChNYWNpbnRvc2gpIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6RjU4OTgxNjkwM0FBMTFFM0E3RTZGNTJCQUMxODFCMjUiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6RjU4OTgxNkEwM0FBMTFFM0E3RTZGNTJCQUMxODFCMjUiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz61fp6rAAAA6klEQVR42uyUvQrCMBRGk1rcHHQQ3XVyESdx1CdwcPLxnH0H8QGcVKiDIOJkFezqT/wiXVp6k1bJIveDAy1ND7e5uZVKKVEwFVAGr/g+As/0Ij+HqAQmYAoGoJax5gHOIAR7sBC6YgNtsFLFMzdV3AJL0BDFs/aIBxLMvpTqbCnxCPTF99lQ4vEP0jsIqD3u5ZTcwDE+bnXQBLuPnDgNB0vXAzAEXuq9Kujqa0kMSBQPApWObpDpUyixbRylbY884SgsTohVBrYoAydXFYeuxBdX4iuLE83zibnnfwWLWcxiFrOYxX8rfgswAKPozlRQdflcAAAAAElFTkSuQmCC");
  background-repeat: no-repeat;
  height: 45px;
  opacity: 1;
  width: 22px;
  -moz-transform: translate3d(0, 0, 0);
  -webkit-transform: translate3d(0, 0, 0);
  transform: translate3d(0, 0, 0);
}
.masonry-list li.tile-facebook .tile-primary-content {
  background-color: #3b539b;
}
.masonry-list li.tile-twitter a::after {
  background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAC0AAAAlCAYAAADWSWD3AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyNpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNS1jMDE0IDc5LjE1MTQ4MSwgMjAxMy8wMy8xMy0xMjowOToxNSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIChNYWNpbnRvc2gpIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjM2NjFBNUYzMDM2QjExRTM4MUJDQzRENjgzQjYxOEVGIiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjM2NjFBNUY0MDM2QjExRTM4MUJDQzRENjgzQjYxOEVGIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6MzY2MUE1RjEwMzZCMTFFMzgxQkNDNEQ2ODNCNjE4RUYiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6MzY2MUE1RjIwMzZCMTFFMzgxQkNDNEQ2ODNCNjE4RUYiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz64QIJqAAADBklEQVR42syYS0hVURSG773aQxOxIsiyJOiBZTXsgZoURDRoEvQgokESTYygoCAQGtWkBlHWoFkFSUIFOimpKKyghF4SlBphpL0oeyikefpWLGEn55x7zr373nt++PB4Xvxn3bX3XnvFHceJZVF5UA2roBQmwltog8cQzIyYzgIT4AD0O97qhu0Qd3m+GI5A+b8gGxcKoRHyLBueAXed4GqGAvVRDWdgAG6OvdN8+W59qNGi4Wnw0gmvHvhu/D8IC9xMXzduOmUp4s1O+hqBrfo+8TQzYaT3UuO4Hi7D5DQGXQ1sTnPgfoQ6GILT8BBGzKh8c/nKZ1CRYpSbLER52Dj+BSvGp0efx4Ny837ID2E44RGEVCUe1rvl9O0kD3bCxoCmyywalmlytfl+M6fbkuTXYmiFJ7ArSb5PtbggVcF980TcWBFnwRtdpYLoB7TAVWiH98a12fDOkukSGPAyLToGh1N8eS88VbP90AAJC6YLdfbwNC1RvqO1QRQ0qvXKf0oYhUyTFjOb4FZETPe6nRwz/QdqdTDKjWWBK67MqsvPtOiR/pVZYaGkTgRMv0hmuiUWPbW7nTQHYqH+HKURGoSSpn1+kR6EPRHJZdEDN8Mxl3lUUuRgRExf8boQ99gj7tRSsDhHhmUxmQufg0R6TBdgEZyATzkwfcnLsF+kD0G5ftQ8WAv5WTI8rMVZl9cNXkZ64HiOUuO8n2G/SMe1BqnJsmHZXi3xSw2/nJYv2WGxvAyqfckMx5KUjmJ4DXRmyfBFLdqsdJgmQQN8dTKnDm0WBdqDxkP08go0x1fCFh3hNvRKf9H+oA+E2VkMaQEjC06FJcOvYV0Yw2EakJIie6HXYkrc0z5f6J6K30Xpc1TBSfhg0ewonNVApNRuk8WlErbBby1PpTSdD8thSga2T9LmupHWW9R9JVzTKGRC0m06CkU2urHjTyyDc9oPtqHnUA8lNnveXlOe7BM3KLUh9ow/oUN38616bF1B5+kinZfnwHSj7SUV2Redsrq10BrN9NL5V4ABAAD4zZE8N0pmAAAAAElFTkSuQmCC");
  background-repeat: no-repeat;
  height: 37px;
  opacity: 1;
  width: 45px;
  -moz-transform: translate3d(0, 0, 0);
  -webkit-transform: translate3d(0, 0, 0);
  transform: translate3d(0, 0, 0);
}
.masonry-list li.tile-twitter .tile-primary-content {
  background-color: #00afe0;
}
.masonry-list li.tile-case .tile-primary-content, .masonry-list li.tile-client .tile-primary-content, .masonry-list li.tile-person .tile-primary-content {
  padding: 0;
}
.masonry-list li.tile-case .tile-secondary-content, .masonry-list li.tile-client .tile-secondary-content, .masonry-list li.tile-person .tile-secondary-content {
  background-color: rgba(0, 0, 0, 0.7);
  -moz-transition: opacity 100ms ease-out;
  -o-transition: opacity 100ms ease-out;
  -webkit-transition: opacity 100ms ease-out;
  transition: opacity 100ms ease-out;
}
.masonry-list li.tile-client a::after {
  background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABcAAAAWCAYAAAArdgcFAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyNpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNS1jMDE0IDc5LjE1MTQ4MSwgMjAxMy8wMy8xMy0xMjowOToxNSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIChNYWNpbnRvc2gpIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjBFQzVFRUY1MDdEOTExRTM5OTE1QjgyMDNBNDBFQkE1IiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjBFQzVFRUY2MDdEOTExRTM5OTE1QjgyMDNBNDBFQkE1Ij4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6ODFBODJDMDAwN0Q2MTFFMzk5MTVCODIwM0E0MEVCQTUiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6MEVDNUVFRjQwN0Q5MTFFMzk5MTVCODIwM0E0MEVCQTUiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz48Qmb2AAAAuklEQVR42uyTMQ7CMAxF7QTlpJygZ2DNyAILA4ip3I8Bgi3Z1A20IVRIDPnSX9Lk/Z8mwZQSiBz5DsuEwrkpkOXJJ3JcCN6Rj8IDoOaefE6DIu+m0kjeGwbzvJOUYBp0lTvQxmszdtXm7EDu01jxi8asg/wNsBNrA2bBObwmoAh+B58K2GRztiXwFFwDLhnAfi+C2WgeUa7wPPXhVqjsopU+mpdrNAPPIfjB+EgOfqgGb/AG/2f4Q4ABALW94ZuwtKIxAAAAAElFTkSuQmCC");
  height: 22px;
  width: 23px;
  -moz-transform: translate3d(0, 0, 0);
  -webkit-transform: translate3d(0, 0, 0);
  transform: translate3d(0, 0, 0);
}
.masonry-list li.tile-client a:focus .tile-primary-content, .masonry-list li.tile-client a:hover .tile-primary-content {
  background-color: transparent;
}
.masonry-list li.tile-client a:focus .tile-primary-content img, .masonry-list li.tile-client a:hover .tile-primary-content img {
  -moz-transform: scale3d(1, 1, 1);
  -webkit-transform: scale3d(1, 1, 1);
  transform: scale3d(1, 1, 1);
}
.masonry-list li.tile-client .tile-primary-content {
  background-color: #604951;
  -moz-transition: background-color 250ms ease-out;
  -o-transition: background-color 250ms ease-out;
  -webkit-transition: background-color 250ms ease-out;
  transition: background-color 250ms ease-out;
}
.masonry-list li.tile-person {
  text-align: center;
}
.masonry-list li.tile-person .tile-secondary-content {
  display: table;
  height: 100%;
  padding: 0;
  width: 100%;
}
.masonry-list li.tile-person .tile-secondary-container {
  display: table-cell;
  vertical-align: middle;
}
.masonry-list li.tile-person h2 {
  font-size: 24px;
  position: static;
}
.masonry-list li.tile-person p {
  color: #a18e5c;
  font-family: 'Georgia', serif;
  font-size: 17px;
  margin: .2em;
  text-transform: none;
}
.masonry-list a,
.masonry-list button {
  color: white;
  display: block;
  height: 100%;
  position: relative;
  width: 100%;
}
.masonry-list .tile-primary-content,
.masonry-list .tile-secondary-content {
  bottom: 0;
  left: 0;
  overflow: hidden;
  padding: 40px;
  position: absolute;
  right: 0;
  top: 0;
}
.masonry-list .tile-primary-content {
  background-color: #a49058;
}
.masonry-list .tile-primary-content img {
  width: 100%;
  -moz-transform: scale3d(1, 1, 1);
  -webkit-transform: scale3d(1, 1, 1);
  transform: scale3d(1, 1, 1);
  -moz-transition: -moz-transform 200ms ease-out;
  -o-transition: -o-transform 200ms ease-out;
  -webkit-transition: -webkit-transform 200ms ease-out;
  transition: transform 200ms ease-out;
}
.masonry-list .tile-secondary-content {
  opacity: 0;
  -moz-transition: opacity 250ms ease-out;
  -o-transition: opacity 250ms ease-out;
  -webkit-transition: opacity 250ms ease-out;
  transition: opacity 250ms ease-out;
}
.masonry-list .tile-secondary-content p,
.masonry-list .tile-secondary-content h2 {
  opacity: 0;
  -moz-transition: opacity 200ms ease-in 100ms;
  -o-transition: opacity 200ms ease-in 100ms;
  -webkit-transition: opacity 200ms ease-in;
  -webkit-transition-delay: 100ms;
  transition: opacity 200ms ease-in 100ms;
}
.masonry-list p,
.masonry-list h2 {
  text-transform: uppercase;
}
.masonry-list h2 {
  font-size: 12px;
  margin: 0;
  position: absolute;
}
.masonry-list p {
  font-size: 28px;
  font-weight: 300;
  line-height: 1.1em;
  margin: 1em 0 0;
}

*,
*:before,
*:after {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}

* {
  -webkit-font-smoothing: antialiased;
}

body {
  background-color: #242424;
  font-family: 'Source Sans Pro', sans-serif;
}

ul {
  list-style: none;
  margin: 0;
  padding: 0;
}

  </style>
  
  
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 modal-gallery">



  </div>

</div>


<?php //} // endwhile
//} // endif
?>


<script>
document.onkeydown = function(evt) {
    evt = evt || window.event;
    var isEscape = false;
    if ("key" in evt) {
        isEscape = (evt.key == "Escape" || evt.key == "Esc");
    } else {
        isEscape = (evt.keyCode == 27);
    }
    if (isEscape) {
         $('.modal-gallery').empty();
		$('.modal-gallery').fadeOut();
    }
};
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
