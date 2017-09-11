<?php
    get_header();
    global $kopa_layout;
    global $kopa_setting;
    $sidebars = $kopa_setting['sidebars'][$kopa_setting['layout_id']];
    $kopa_layout = unserialize(KOPA_LAYOUT);
    $kopa_position = $kopa_layout[$kopa_setting['layout_id']]['positions'];
?>

<section class="main-section trio">


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


  <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 first-left-box" >

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 first-left-box-inner" hid="1" >
		<?php $totales= DataExtra::model()->findAllByAttributes(array("model"=>"General","modelId"=>1));
		$general= array_shift($totales);
		$gTexto= explode('/',$general["texto"]);
	?>

      <h2>Todos los partidos<span style="color:#8f8f8f">*</span></h2>


      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="margin-bottom:30px;">
        <p class="tipo-partido">PARTIDOS JUGADOS</p>
        <p class="puntos-partido"><?php echo $gTexto[0]; ?></p>
        <?php if(false){ ?><p class="level-partido"> L 609 &nbsp;&nbsp;<span> V 313</span></p><?php } ?>
      </div>

      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="margin-bottom:30px;">
        <p class="tipo-partido">PARTIDOS GANADOS</p>
        <p class="puntos-partido"><?php echo $gTexto[1]; ?></p>
       <?php if(false){ ?> <p class="level-partido"> L 609 &nbsp;&nbsp;<span> V 313</span></p><?php } ?>
      </div>

      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <p class="tipo-partido">PARTIDOS EMPATADOS</p>
        <p class="puntos-partido"><?php echo $gTexto[2]; ?></p>
       <?php if(false){ ?> <p class="level-partido"> L 609 &nbsp;&nbsp;<span> V 313</span></p><?php } ?>
      </div>

      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <p class="tipo-partido">PARTIDOS PERDIDOS</p>
        <p class="puntos-partido"><?php echo $gTexto[3]; ?></p>
        <?php if(false){ ?><p class="level-partido">  L 609&nbsp;&nbsp;<span> V 313</span></p><?php } ?>
      </div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 goles-totales-home">
      <p class="goles"><span><?php echo $gTexto[4]; ?>  &nbsp; </span> Goles a favor</p>
      <div class="linea-divisoria-partido"></div>
      <p class="goles"><span><?php echo $gTexto[5]; ?>  &nbsp;</span> Goles en contra</p>
	</div>

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<p>* Faltan los campeonatos de 1912 y 1919</p>
	</div>

    </div>


  </div>


  <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 first-right-box" hid="1">

    <style>
      .first-right-box h2 span{
        color: #8f8f8f;
        font-size: 12px;
        font-family: 'Roboto';
      }
    </style>

    <h2>Historial <span> *Última actualización: 24 de abril.</span></h2>

    <?php //$var =['Campeonatos locales', 'Copas Locales', 'Copas Internacionales']; ?>




		<?php foreach($totales as $total){
		$texto= explode("/",$total["texto"]);
		?>
      <div class="" style="background-color:black">

      <p class="title-line-bg"><?php echo $total["titulo"]; ?></p>
          <table style="width:100%;">
            <tr class="first-row">
              <th></th>
              <th>Partidos jugados <br> <span class="even"><?php echo $texto[0]; ?></span></th>
              <th>Ganados<br>  <span class="odd"><?php echo $texto[1]; ?></span></th>
              <th>Empatados<br>  <span class="even"><?php echo $texto[2]; ?></span></th>
              <th>Perdidos<br>  <span class="odd"><?php echo $texto[3]; ?></span></th>
              <th>Goles a favor <br>  <span class="even"><?php echo $texto[4]; ?></span></th>
              <th>Goles en contra<br>  <span class="odd"><?php echo $texto[5]; ?></span></th>

            </tr>
			<?php if(false){ ?>
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
			<?php } ?>
          </table>

        </div>
		<?php } ?>





  </div>

  </div>

  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 second-box bloque">


    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 second-box-left">
		<a href="<?php echo home_url(); ?>/con-la-verde"><h2 class="titulo-home">Con la <span class="sub-verde">Verde</span></h2></a>

		<?php $destacado= Jugador::model()->findByPk(81); ?>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 box-left" style="padding:0 15px;">


		<div class="avatar-destacado" style="background-image:url(<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/avatar-jugador.svg);"></div>
		<div style="width:100%;text-align:center;">
		<div class="escudito"></div></div>
		<div class="second-interior">
        <p><?php echo $destacado->nombre." ".$destacado->apellido; ?></p>
        <a href="<?php echo home_url(); ?>/jugador-<?php echo $destacado->id; ?>"><button type="butto n" name="button">Ficha</button></a>
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
		<div style="padding-top:20px;">
			<?php $destacado->logros;
			if(count($destacado->logros)>0){ 
				foreach($destacado->logros as $logro){ ?>
					<div style="display:inline-block;width:40px;text-align:center;color:white;"><img style="max-width:100%;" src="<?php echo get_template_directory_uri(); ?>/img/<?php echo $logro->tipo; ?>.svg" /><br><?php echo $logro->fecha; ?>
					</div>
			<?php }
			 }else{ ?>
				 
			 <?php } ?>
			 </div>

      </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 second-box-right">

      <a href="<?php echo home_url(); ?>/con-la-verde/">
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 box-jugador box-mas-jugador">
		<div class="border-jugador">
        <div class="imagen-jugador-verde rectangle placeholder-avatar" style="background-image:url(<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/icono_jugador_grande.svg);">

          <label>+ Jugadores</label>
        </div>
		</div>
      </div>
    </a>
		<?php
		$destacadoId= $destacado->id;
		$criteria = new CDbCriteria;
$criteria->limit = 2;
$criteria->condition = "id != $destacadoId and activo = 1";
$criteria->order = 'RAND()';
$criteria->select = "*";

		$jugadores= Jugador::model()->findAll($criteria);

		?>
      <?php foreach($jugadores as $jugador){

	  ?>
	  <a href="<?php echo home_url(); ?>/jugador-<?php echo $jugador->id; ?>">
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 box-jugador">
		<div class="border-jugador">
        <div class="imagen-jugador-verde rectangle" style="background-image:url(<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/avatar-jugador.svg);">



          <div class="capa-verde"></div>
            <label><?php echo $jugador["nombre"]." ".$jugador["apellido"]; ?></label>
        </div>
		</div>
      </div>
	</a>
      <?php } ?>


      <!-- dt -->


	<?php if(true){

		$criteria = new CDbCriteria;
		$criteria->limit = 2;
		$criteria->condition = "activo = 1";
		$criteria->order = 'RAND()';
		$criteria->select = "*";

		$dts= Staff::model()->findAll($criteria);
		foreach($dts as $dt){
	?>


		 <a href="<?php echo home_url(); ?>/director-tecnico-<?php echo $dt->id; ?>">
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 box-jugador">
		<div class="border-jugador">
        <div class="imagen-jugador-violeta rectangle" style="background-image:url(<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/avatar-jugador.svg);">



          <div class="capa-violeta"></div>
          <label><?php echo $dt->nombre." ".$dt->apellido; ?></label>
        </div>
		</div>
      </div>
	  </a>

      <?php } ?>
      <a href="<?php echo home_url(); ?>/con-la-verde-dt/">
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 box-jugador box-mas-jugador">
		<div class="border-jugador">
        <div class="imagen-jugador-violeta rectangle placeholder-avatar" style="background-image:url(<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/director-tecnico-grande.svg);">

            <label>+ Directores Técnicos</label>
        </div>
		</div>
      </div>
    </a>
	<?php } ?>

    </div>
  </div>

</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 third-box bloque">

<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 ">

<a href="<?php echo home_url(); ?>/rincon-del-mudo"><h2 class="titulo-home">El Rincón <span class="sub-verde">del Mudo</span></h2></a>

  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 third-box-left" style="overflow:hidden;">


    <?php    $posts= get_posts( array('numberposts' => 1, "post_type"=>"post", 'category'=>2 ) );


    foreach($posts as $post){
    ?>
<a href="<?php the_permalink($posts[0]->ID ); ?>" style="display:block;width:100%;height:500px;">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 box-left hover-black " style="background-image:url(<?php echo get_the_post_thumbnail_url($post->ID, 'full'); ?>);" >
		<h4 style="color:white;"> </h4>
      <!-- <div class="triangulo-verde"></div> -->
    </div>


    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 box-right">
      <h2><?php the_title_attribute($posts[0]->ID ); ?></h2>
      <p>
        <?php // Fetch post content
              $content = get_post_field( 'post_content',$posts[0]->ID );

              // Get content parts
              $content_parts = get_extended( $content );

			$main=$content_parts['main'];
			$main= substr($main,0,300);
			$main= substr($main,0,strrpos($main," "));

              // Output part before <!--more--> tag
             echo $main.'...'; ?>
    </p>

      <p class="fecha-post-home violeta"><?php echo  get_the_date( 'j' )." de ".get_the_date( 'F' )." de ".get_the_date( 'Y' ); ?></p>
    </div>
</a>
  <?php }  wp_reset_postdata();  ?>

  </div>



</div>
<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 third-box-right twitter-widget">
      <?php // echo do_shortcode("[custom-twitter-feeds]"); ?>
    <!--<img style="width: 100%;"src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/twitter-demo-10.png" alt="">!-->
	<div class="twitter-container widget widget-content" style="border:none;">
		<!-- widget twitter -->
		<?php echo do_shortcode("[custom-twitter-feeds screenname='notibaenred']"); ?>
		
		<!-- widget twitter -->
	</div>
  </div>
</div>


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 six-box bloque">

  <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 box-with-title six-box-left">

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <a href="<?php echo home_url(); ?>/cuna-cajon"><h2 class="titulo-home">De la Cuna <span class="sub-verde">hasta el Cajón</span></h2></a>
	</div>

    <?php
    $posts_cuna= get_posts( array('numberposts' => 5, "post_type"=>"post", 'category'=>4 ) );
?>
    <a href="<?php the_permalink($posts_cuna[0]->ID ); ?>">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 six-container-left ">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding content-shadow">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding" >
				<div class="thumb hover-black " style="background-image:url(<?php echo get_the_post_thumbnail_url($posts_cuna[0]->ID, 'full'); ?>);"></div>
                <?php //echo the_post_thumbnail( 'thumbnail' );?>
                <!-- <div class="triangulo-verde"></div> -->
              </div>

              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 title-container">
				<p class="volanta top-shadow"><?php echo get_field("volanta",$posts_cuna[0]->ID); ?></p>
				<div style="padding:0 25px;">
				<hr>
				</div>
                <h6><?php echo $posts_cuna[0]->post_title; ?></h6>

                <p class="bajada"><?php // Fetch post content
                      $content = get_post_field( 'post_content',$posts_cuna[0]->ID );

                      // Get content parts
                      $content_parts = get_extended( $content );

                      $main=$content_parts['main'];
			$main= substr($main,0,140);
			$main= substr($main,0,strrpos($main," "));

              // Output part before <!--more--> tag
             echo $main.'...'; ?></p>

                <div class="info-date">
                  <p class="fecha-post-home violeta"><?php echo  get_the_date( 'j' , $posts_cuna[0]->ID)." de ".get_the_date( 'F' , $posts_cuna[0]->ID)." de ".get_the_date( 'Y' , $posts_cuna[0]->ID); ?></p>
                  <?php if(false){ ?><p class="fecha-post-home verde"> Ver comentarios</p><?php } ?>
                </div>

              </div>
				</div>
            </div>
        </a>



    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 six-container-right">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

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

		<div class="col-lg-4 col-md-4 mini-thumb hover-black" style="background-image:url(<?php echo get_the_post_thumbnail_url($post->ID, 'thumbnail'); ?>);"></div>
		
        <p class="col-lg-8 col-md-8 col-sm-8 col-xs-8"><?php the_title_attribute($post->ID ); ?> <br>  <span> <?php echo  get_the_date( 'j')." de ".get_the_date( 'F')." de ".get_the_date( 'Y'); ?></span></p>

      </div></a>

          <?php }  wp_reset_postdata();  ?>
      <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 six-inner-container">
        <img class="col-lg-5 col-md-5 col-sm-5 col-xs-5" src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/ejemplo-2.png" alt="">
        <p class="col-lg-7 col-md-7 col-sm-7 col-xs-7">¡Gracias por todo, Ferro! Hasta la victoria, siemprebr <br>  <span> 17 de febrero</span></p>
      </div> -->

    </div>




	</div>
  </div>

  <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 six-box-right mas-visto-widget">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 title">
      MAS VISTO
    </div>

      <?php
		$nro=1;
			  $query = new WP_Query( array(
					'meta_key' => 'wpb_post_views_count',
					'orderby' => 'meta_value_num',
					'posts_per_page' => 3,
					"category_name"=> "cuna-cajon"
				) );


				if ( $query->have_posts() ) {
					// The 2nd Loop
					while ( $query->have_posts() ) {
						$query->the_post();


        $post_categories = wp_get_post_categories( $recent["ID"]);
        ?>
        <a href="<?php echo get_permalink($recent["ID"]);  ?>" title="<?php echo esc_attr(the_title())?>">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bloque-widget">
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <p class="widget-numero"><?php   echo $nro ?></p>
          </div>
          <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
            <p><?php echo  get_the_date( 'j')." de ".get_the_date( 'F')." de ".get_the_date( 'Y'); ?></p>
            <p><?php echo the_title();  ?></p>
          </div>
        </div>

      </a>

      <!-- echo $date.'<p ><a style="color:white" href="' . get_permalink($recent["ID"]) . '" title="'.esc_attr($recent["post_title"]).'" >' .   $recent["post_title"].'</a></p>'; -->


				<?php $nro++; } }?>
  </div>

</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 fifth-box bloque"></div>


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 fourth-box bloque">


  <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 box-with-title fourth-box-left">

    <a href="<?php echo home_url(); ?>/museo-verdolaga"><h2 class="titulo-home">Museo de la <span class="sub-verde">Emoción Verdolaga</span></h2></a>

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
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding content-shadow">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
          <div class="thumb hover-black" style="background-image:url(<?php echo get_the_post_thumbnail_url($post->ID, 'full'); ?>);"></div>
            <!-- <div class="triangulo-verde"></div> -->
          </div>

          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 title-container top-shadow">

		  <img src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/icono-museo-verde.svg" alt="">
            <p><?php the_title_attribute($post->ID ); ?></p>



            <div class="info-date">
              <p class="fecha-post-home violeta"><?php echo  get_the_date( 'j')." de ".get_the_date( 'F')." de ".get_the_date( 'Y'); ?></p>
              
            </div>
          </div>

        </div>
        </div>

        </a>

    <?php  }  wp_reset_postdata();   ?>



  </div>
	<?php if(false){ ?>
  <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 fourth-box-right ultimos-comentarios-widget" style="overflow:hidden;">
		<div style="width:100%; background-color:#a43c93;">
      <h3 style="color:white;text-align:center;margin-top:0;padding-top:15px; font-family:'Condensed-bold-italic'">ÚLTIMOS COMENTARIOS</h3>


        <?php// get_recent_comments(); ?>

        <?php

        $posts= get_posts( array('numberposts' =>-1 , "post_type"=>"post") );
        $count =0;

        foreach ($posts as $post) {

            if($count < 3){

            $comments = get_comments(array('post_id' => $post->ID,  ));

            if($comments[0]->comment_content!= ''){?>

              <div class=""style=" border-bottom: 1px solid black; padding: 20px 30px 20px 30px">



              <p style="text-align:left; font-family:'Roboto-bold'; color:white"><?php echo $comments[0]->comment_author;  ?>
                <span style="color:rgba(255,255,255,.4); float:right;font-family:'Roboto-regular'"><?php echo $comments[0]->comment_date; ?></span>
              </p>
              <p style="text-align:left; font-family:'Roboto-regular'; color:white" ><?php echo $comments[0]->comment_content; ?></p>

              </div>
             <?php $count ++; }


          }
        } wp_reset_postdata();

        ?>
        </div>
      <!-- <img style="width: 100%;"src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/comentarios-demo.png" alt=""> -->


    </div>

	<?php } ?>



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
