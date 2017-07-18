<?php
    get_header();
    global $kopa_layout;
    global $kopa_setting;
    $sidebars = $kopa_setting['sidebars'][$kopa_setting['layout_id']];
    $kopa_layout = unserialize(KOPA_LAYOUT);
    $kopa_position = $kopa_layout[$kopa_setting['layout_id']]['positions'];
?>

<div class="wrapper clearfix home">

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-col pull-left">




<!-- PARTE COMENTADA -->
        <!-- <?php kopa_breadcrumb(); ?> -->
        <!-- breadcrumb -->

     <!-- <section class="entry-list">
          <?php // get_template_part( 'library/templates/loop', 'blog-1' ); ?>
        </section> -->
        <!-- entry-list -->
<!-- PARTE COMENTADA -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 first-box bloque">


  <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 fist-left-box" >

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 first-left-box-inner" hid="1" >

      <h2>Totales</h2>
      <p>Última actualización: 24 de abril a las 19.00pm</p>

      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <p class="tipo-partido">PARTIDOS JUGADOS</p>
        <p class="puntos-partido">50</p>
        <p class="level-partido"> L 609 &nbsp;&nbsp;<span> V 313</span></p>
      </div>

      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <p class="tipo-partido">PARTIDOS GANADOS</p>
        <p class="puntos-partido">50</p>
        <p class="level-partido"> L 609 &nbsp;&nbsp;<span> V 313</span></p>
      </div>

      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <p class="tipo-partido">PARTIDOS JUGADOS</p>
        <p class="puntos-partido">50</p>
        <p class="level-partido"> L 609 &nbsp;&nbsp;<span> V 313</span></p>
      </div>

      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <p class="tipo-partido">PARTIDOS GANADOS</p>
        <p class="puntos-partido">50</p>
        <p class="level-partido">  L 609&nbsp;&nbsp;<span> V 313</span></p>
      </div>

      <p class="goles"><span>45.000  &nbsp; </span> Goles a favor</p>
      <div class="linea-divisoria-partido"></div>
      <p class="goles"><span>39.000  &nbsp;</span> Goles en contra</p>


    </div>


  </div>

  <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 first-right-box" hid="1">
    <h2>Historial</h2>

    <?php $var =['Campeonatos locales', 'Copas Locales', 'Copas Internacionales'];

    for($i=0; $i<3; $i++){?>

      <div class="" style="background-color:black">

      <p class="title-line-bg"><?php echo $var[$i] ?></p>
          <table style="width:100%;">
            <tr class="first-row">
              <th></th>
              <th>Partidos jugados <br> <span>1049</span></th>
              <th>Ganados<br>  <span>1049</span></th>
              <th>Empatados<br>  <span>1049</span></th>
              <th>Perdidos<br>  <span>1049</span></th>
              <th>Goles a favor <br>  <span>1049</span></th>
              <th>Goles en contra<br>  <span>1049</span></th>

            </tr>
            <tr class="second-row">
              <td>Local</td>
              <td>148</td>
              <td>50</td>
              <td>148</td>
              <td>50</td>
              <td>148</td>
              <td>50</td>
            </tr>
            <tr class="third-row">
              <td>Visitante</td>
              <td>148</td>
              <td>50</td>
              <td>148</td>
              <td>50</td>
              <td>148</td>
              <td>50</td>
            </tr>
          </table>

        </div>

    <?php } ?>





  </div>

  </div>

  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 second-box bloque">
    

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 second-box-left">
		<h2>Con la verde</h2>

		<?php $destacado= Jugador::model()->findByPk(26); ?>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 box-left">

        <img src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/ejemplo.png" alt="">
		<div class="second-interior">
        <p><?php echo $destacado->nombre." ".$destacado->apellido; ?></p>
        <a href="<?php echo home_url(); ?>/jugador/ver/<?php echo $destacado->id; ?>"><button type="butto n" name="button">Ver Ficha</button></a>
		</div>
      </div>

      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 box-right">
		<?php $destacado->data;
		$lastTorneo="";
		$debut="";
		foreach($destacado->data as $data){ ?>
			<?php if($data["titulo"]=="Debut"){
				$debut =$data["texto"];
			}else if($data["titulo"]=="Torneo"){
				$lastTorneo= $data["texto"];
			}
		 }
		$lastTorneo= explode("/",$lastTorneo);
		$debut= explode(";",$debut);
		 ?>
        <p><?php echo $destacado->detalle_puesto; ?></p>
        <p><?php echo $lastTorneo[0]; ?> partidos jugados</p>
        <p><?php echo $lastTorneo[1]; ?> goles</p>
		
		
        <p>Debút <br>
		<?php echo $debut[0]; ?><br>
		Ferro <?php echo $debut[1]; ?>
		</p>

        <img class="copa-verde" src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/copa-verde.svg" alt="">

      </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 second-box-right">

      <a href="http://localhost/ferropedia/ficha-jugador/">
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 box-jugador box-mas-jugador">
		<div class="border-jugador">
        <div class="imagen-jugador-violeta rectangle placeholder-avatar" style="background-image:url(<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/icono-ficha-jugador-blanco.svg);">
          
          <label>+ Jugadores</label>
        </div>
		</div>
      </div>
    </a>
		<?php
		$destacadoId= $destacado->id;
		$criteria = new CDbCriteria;
$criteria->limit = 2;
$criteria->condition = "id != $destacadoId";
$criteria->order = 'RAND()';
$criteria->select = "*";

		$jugadores= Jugador::model()->findAll($criteria);
		
		?>
      <?php foreach($jugadores as $jugador){ 
		
	  ?>
	  <a href="<?php echo home_url(); ?>/jugador/ver/<?php echo $jugador->id; ?>">
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 box-jugador">
		<div class="border-jugador">
        <div class="imagen-jugador-violeta rectangle" style="background-image:url(<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/ejemplo.png);">

          

          <div class="capa-violeta"></div>
            <label><?php echo $jugador["nombre"]." ".$jugador["apellido"]; ?></label>
        </div>
		</div>
      </div>
	</a>
      <?php } ?>


      <!-- dt -->



      <?php for($i=0; $i<2; $i++){ ?>


      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 box-jugador">
		<div class="border-jugador">
        <div class="imagen-jugador-verde rectangle" style="background-image:url(<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/ejemplo.png);">

          

          <div class="capa-verde"></div>
          <label>Nombre deL Dt</label>
        </div>
		</div>
      </div>

      <?php } ?>
      <a href="http://localhost/ferropedia/ficha-jugador/">
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 box-jugador box-mas-jugador">
		<div class="border-jugador">
        <div class="imagen-jugador-verde rectangle placeholder-avatar" style="background-image:url(<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/icono-ficha-jugador-blanco.svg);">
          
            <label>+ Dts</label>
        </div>
		</div>
      </div>
    </a>

    </div>
  </div>

</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 third-box bloque">

  <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 third-box-left" style="overflow:hidden;">

    <?php    $posts= get_posts( array('numberposts' => 1, "post_type"=>"post", 'category'=>2 ) );


    foreach($posts as $post){
    ?>
<a href="<?php the_permalink($posts[0]->ID ); ?>" style="display:block;width:100%;height:500px;">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 box-left" style="background-image:url(<?php echo get_the_post_thumbnail_url($post->ID, 'full'); ?>);" >
		<h4 style="color:white;"> </h4>
      <div class="triangulo-verde"></div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 box-right">
      <h3> El rincón del Mudo</h3>
      <h2><?php the_title_attribute($posts[0]->ID ); ?></h2>
      <p>
        <?php // Fetch post content
              $content = get_post_field( 'post_content',$posts[0]->ID );

              // Get content parts
              $content_parts = get_extended( $content );

              // Output part before <!--more--> tag
              echo $content_parts['main'].'...'; ?>
    </p>

      <p class="fecha-post-home violeta"><?php echo  get_the_date( 'l F j, Y' ) ?></p>
    </div>
</a>
  <?php }  wp_reset_postdata();  ?>

  </div>

  <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 third-box-right twitter-widget">
      <?php echo do_shortcode("[custom-twitter-feeds]"); ?>
    <!-- <img style="width: 100%;"src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/twitter-demo-10.png" alt=""> -->
  </div>

</div>


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 six-box bloque">

  <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 box-with-title six-box-left">

    <h2>De la cuna hasta el cajón</h2>

    <?php
    $posts_cuna= get_posts( array('numberposts' => 6, "post_type"=>"post", 'category'=>4 ) );
?>
    <a href="<?php the_permalink($posts_cuna[0]->ID ); ?>">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 six-container-left">

              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding" >
				<div class="thumb" style="background-image:url(<?php echo get_the_post_thumbnail_url($posts_cuna[0]->ID, 'full'); ?>);"></div>
                <?php //echo the_post_thumbnail( 'thumbnail' );?>
                <div class="triangulo-verde"></div>
              </div>

              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 title-container">
                <p><?php the_title_attribute($posts_cuna[0]->ID ); ?></p>

                <p><?php // Fetch post content
                      $content = get_post_field( 'post_content',$posts_cuna[0]->ID );

                      // Get content parts
                      $content_parts = get_extended( $content );

                      // Output part before <!--more--> tag
                      echo $content_parts['main'].'...'; ?></p>

                <div class="info-date">
                  <p class="fecha-post-home violeta"><?php echo  get_the_date( 'l F j, Y' ) ?></p>
                  <p class="fecha-post-home verde"> Ver comentarios</p>
                </div>

              </div>

            </div>
        </a>



    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 six-container-right">


      <?php
      //CATEGORIA 4  = DE LA CUNA HASTA EL CAJON
      $first=FALSE;

        foreach ($posts_cuna as $post) {

          if ($first != TRUE)
             {
                 $first = TRUE;
                 continue;
             }


         ?>
         <a href="<?php the_permalink($post->ID ); ?>">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 six-inner-container">
        
		<div class="col-lg-3 col-md-3 mini-thumb" style="background-image:url(<?php echo get_the_post_thumbnail_url($post->ID, 'thumbnail'); ?>);"></div>
        <p class="col-lg-7 col-md-7 col-sm-7 col-xs-7"><?php the_title_attribute($post->ID ); ?> <br>  <span> <?php echo  get_the_date( 'l F j, Y' ) ?></span></p>
		
      </div></a>

          <?php }  wp_reset_postdata();  ?>
      <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 six-inner-container">
        <img class="col-lg-5 col-md-5 col-sm-5 col-xs-5" src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/ejemplo-2.png" alt="">
        <p class="col-lg-7 col-md-7 col-sm-7 col-xs-7">¡Gracias por todo, Ferro! Hasta la victoria, siemprebr <br>  <span> 17 de febrero</span></p>
      </div> -->

    </div>




  </div>

  <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 six-box-right mas-visto-widget">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 title">
      MAS VISTO
    </div>

      <?php

      $args = array( 'numberposts' => '4', 'post_status' => 'publish' );
      $recent_posts = wp_get_recent_posts( $args );

      $nro=1;

      foreach( $recent_posts as $recent ){
        $post_categories = wp_get_post_categories( $recent["ID"]);
        $date= get_the_date();?>
        <a href="<?php echo get_permalink($recent["ID"]);  ?>" title="<?php echo esc_attr($recent["post_title"])?>">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bloque-widget">
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <p class="widget-numero"><?php   echo $nro ?></p>
          </div>
          <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
            <p><?php   echo $date ?></p>
            <p><?php echo $recent["post_title"]  ?></p>
          </div>
        </div>

      </a>

      <!-- echo $date.'<p ><a style="color:white" href="' . get_permalink($recent["ID"]) . '" title="'.esc_attr($recent["post_title"]).'" >' .   $recent["post_title"].'</a></p>'; -->


      <?php $nro++; } ?>
  </div>

</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 fifth-box bloque"></div>


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 fourth-box bloque">


  <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 box-with-title fourth-box-left">

    <h2>Museo</h2>

    <!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 fourth-container">

      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
        <img src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/ejemplo-2.png" alt="">
        <div class="triangulo-verde"></div>
      </div>

      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 title-container">
        <p>Titulo del objeto</p>

        <img src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/icono-museo-verde.svg" alt="">


        <div class="info-date">
          <p class="fecha-post-home violeta">15 de Febrero, 2017</p>
        </div>
      </div>

    </div>

 -->
    <?php
      	$posts= get_posts( array('numberposts' => 2, "post_type"=>"post", 'category'=>3 ) );

        // echo var_dump($posts);

      foreach ($posts as $post) {
        // $post_categories = wp_get_post_categories($post->ID );
        // $cat = get_category($post_categories[0]);
        // if( $cat->slug=='museo'){
        ?>


        <a href="<?php the_permalink($post->ID ); ?>">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 fourth-container">

          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
          <div class="thumb" style="background-image:url(<?php echo get_the_post_thumbnail_url($post->ID, 'full'); ?>);"></div>
            <div class="triangulo-verde"></div>
          </div>

          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 title-container">
            <p><?php the_title_attribute($post->ID ); ?></p>

            <img src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/icono-museo-verde.svg" alt="">

            <div class="info-date">
              <p class="fecha-post-home violeta"><?php echo  get_the_date( 'l F j, Y' ) ?></p>
              <p class="fecha-post-home verde"> Ver comentarios</p>
            </div>
          </div>

        </div>

        </a>

    <?php  }  wp_reset_postdata();   ?>



  </div>

  <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 fourth-box-right ultimos-comentarios-widget" style="overflow:hidden;">
		<div style="width:100%;height:400px; background-color:#a43c93;"><h3 style="color:white;text-align:center;margin-top:0;padding-top:10px;">Ultimos comentarios <br><span style="font-size:8px;">(placeholder)</span></div>
        <?php// get_recent_comments(); ?>

    </div>





  </div>


<style media="screen">
  .seven-box{

  }
</style>
<!--

<div class="sidebar widget-area-2 pull-left">
    <?php
  //  if ( is_active_sidebar( $sidebars[$kopa_position[0]] ) ) {
  //      dynamic_sidebar($sidebars[$kopa_position[0]]);
  //  }
    ?>

<div class="widget-area-7 pull-left">

    <?php
      //if ( is_active_sidebar( $sidebars[$kopa_position[1]] ) ) {
      //  dynamic_sidebar($sidebars[$kopa_position[1]]);
      //}
    ?>

</div>


<div class="widget-area-8 pull-left">

    <?php
  //  if ( is_active_sidebar( $sidebars[$kopa_position[2]] ) ) {
        dynamic_sidebar($sidebars[$kopa_position[2]]);
  //  }
  //  ?>

</div>


<div class="clear"></div>

    <?php
    //if ( is_active_sidebar( $sidebars[$kopa_position[3]] ) ) {
    //    dynamic_sidebar($sidebars[$kopa_position[3]]);
    //}
    ?>

</div> -->


<div class="clear"></div>

</div>


<?php get_footer();?>
