<?php
//$puestos= $GLOBALS["puestos"];
$puestos= array();
			array_push($puestos,Jugador::model()->findAllByAttributes(array("puesto"=>"arquero","activo"=>1)));
			array_push($puestos,Jugador::model()->findAllByAttributes(array("puesto"=>"defensor","activo"=>1)));
			array_push($puestos,Jugador::model()->findAllByAttributes(array("puesto"=>"mediocampista","activo"=>1)));
			array_push($puestos,Jugador::model()->findAllByAttributes(array("puesto"=>"delantero","activo"=>1)));

			
$query = new WP_Query( array(
    'meta_key' => 'wpb_post_views_count',
    'orderby' => 'meta_value_num',
    'posts_per_page' => 4,
	"category_name"=> "jugador"
) );
$visitados= array();

if ( $query->have_posts() ) {
	// The 2nd Loop
	while ( $query->have_posts() ) {
		$query->the_post();
		$jId=  $query->post->post_name;
		$jId= str_replace("jugador-","",$jId);
		array_push($visitados,Jugador::model()->findByPk($jId));
	}

	// Restore original Post Data
	wp_reset_postdata();
}


			
/*$criteria = new CDbCriteria;
$criteria->limit = 4;
$criteria->order = 'RAND()';
$criteria->select = "*";

$visitados= Jugador::model()->findAll($criteria);*/
//$votados= Jugador::model()->findAll($criteria);

$criteria = new CDbCriteria;
$criteria->limit = 4;
$criteria->order = 'id DESC';
$criteria->select = "*";

$ingresos= Jugador::model()->findAll($criteria);

//$votados= Jugador::model()->findAll($criteria);
$votados= array();
$criteria = new CDbCriteria;
$criteria->limit = 4;
$criteria->order = 'meta_value DESC';
$criteria->select = "*";
$criteria->condition= "meta_key = 'votes'";

$auxVotados= WpPostmeta::model()->findAll($criteria);

foreach($auxVotados as $v){
	//echo $v->meta_id;
	//echo "<br>";
	$jId=  get_post($v->post_id)->post_name;
	$jId= str_replace("jugador-","",$jId);
	array_push($votados,Jugador::model()->findByPk($jId));
}



?>

<?php
  // get_header();
	get_template_part( 'library/templates/header', 'links' );
	  get_template_part( 'library/templates/header', 'extra' );
  get_template_part( 'library/templates/header', 'menu' );


global $kopa_setting;
/*if ( is_page(get_the_ID()) && have_posts() ) {
    while ( have_posts() ) {
        the_post();*/ ?>

<?php ?>
  <section class="main-section non-trio">

    <div id="page-<?php the_ID(); ?>" class="page-content-area clearfix">

      <div class="label-name-page">
        <?php the_post_thumbnail( 'full' );   ?>
		<div style="/*padding:0 60px;*/">
        <div class="header-text-content" style="height:0;padding:0;padding-left:30px;">
          <h1>Con la <span class="sub-verde">Verde</span></h1>
          <?php //the_content(); ?>
        </div>
		<div class="bajada-jugador" >
	<p ><?php the_content(); ?></p>
    </div>
		</div>

      </div>

      <div class="wrapper clearfix" style="padding-top:0;">
       
	   <div class="menu-2 menu-dinamico" style="padding-top:30px; padding-bottom:40px;">
          <nav class="menu-jugadores">
			<div><p class="selected">Arqueros</p></div>
            <div><p>Defensores</p></div>
            <div><p>Mediocampistas</p></div>
            <div><p>Delanteros</p></div>
			
			
			<a class="otra-categoria" href="<?php echo home_url(); ?>/con-la-verde-dt">Directores Técnicos</a>

          </nav>


        </div>




        <div class="jugadores-content-one jugadores-content col-lg-12 col-md-12 col-sm-12 col-xs-12" >
          <div class="jugadores-cancha col-lg-5 col-md-5 col-sm-5 col-xs-12">

            <div class="min-height-upper-container" hid="1">
				<img src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/cancha-arquero.png"  alt="">
                <img src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/cancha-defensor.png" style="display:none;" alt="">
                <img src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/cancha-mediocampista.png" style="display:none;" alt="">
				<img src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/cancha-delantero.png" style="display:none;" alt="">
                
                
            </div>


            <h2>Ranking</h2>
            <div class="jugadores-container-ranking menu-dinamico">


                <nav class="menu-interno">
                    <p class="selected" hid="5">Más visitados de la semana</p>
                    <p hid="5" >Más votados</p>
                    <p hid="5">Últimos ingresados</p>
                  </ul>
                </nav>



                <div class="contenido-1 contenido-dinamico">
					<?php $auxPos=1; foreach($visitados as $jugador){ ?>
					<a href="<?php echo home_url(); ?>/jugador-<?php echo $jugador->id; ?>">
					<p><span>0<?php echo $auxPos++; ?></span> <?php echo $jugador->nombre." ".$jugador->apellido; ?></p></a>
					<?php } ?>

                </div>

                <div class="contenido-1 contenido-dinamico">
                  <?php $auxPos=1; foreach($votados as $jugador){ ?>
				  <a href="<?php echo home_url(); ?>/jugador-<?php echo $jugador->id; ?>">
                  <p><span>0<?php echo $auxPos++; ?></span> <?php echo $jugador->nombre." ".$jugador->apellido; ?></p>
				  </a>
				  <?php } ?>
                </div>


                <div class="contenido-1 contenido-dinamico">
					<?php $auxPos=1; foreach($ingresos as $jugador){ ?>
					<a href="<?php echo home_url(); ?>/jugador-<?php echo $jugador->id; ?>">
					<p><span>0<?php echo $auxPos++; ?></span> <?php echo $jugador->nombre." ".$jugador->apellido; ?></p>
					</a>
					<?php } ?>
                </div>


            </div>

          </div>

			<div class="jugadores-grillas col-lg-7 col-md-7 col-sm-7 col-xs-12">
		  <?php foreach($puestos as $puesto){ ?>

          <div class="jugadores-muchosjugadores contenido-dinamico col-lg-12 col-md-12 col-sm-12 col-xs-12" >

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 min-height-upper-container" hid="1">



            <?php
			$auxJ=0;
			foreach($puesto as $jugador){ ?>
			<a href="<?php echo home_url(); ?>/jugador-<?php echo $jugador->id; ?>">
            <div class="jugadores-j">
				<div class="image-container square" style="background-image:url(<?php 
				if($jugador->avatar){
				echo  Yii::app()->request->baseUrl."/".$jugador->avatar[0]->imagen_data()["url"];
				}else{
				echo site_url()."/wp-content/themes/news-maxx/img/avatar-jugador.svg";
				}
				?>);"></div>

              <!-- <img src="" alt=""> -->
			  
			 <label><span style="z-index:100;margin:auto;top:-20px;max-width:30px;min-width:30px;min-height:30px;max-height:35px;" class="escudito" ><?php if(false){ ?>10<?php }else{ ?>&nbsp;<?php } ?></span><?php echo $jugador->nombre." ".$jugador->apellido; ?></label>

            </div>
			</a>
            <?php
			$auxJ++;
			if($auxJ>=15){
				break;
			}
			} ?>



            </div>


            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 jugadores-container-busqueda" >
              <div class="label-busqueda">

                <select class="menu-busqueda" name="">
				
                  <option value="0" disabled selected >Ordenar...</option>
                  <option value="1">Alfabético</option>
                  <option value="2">Popularidad</option>
                  <!--<option value="3">Por campeonato</option>!-->

                </select>
                <!-- <nav class="menu-busqueda">
                  <ul>
                    <li></li>
                    <li>Popularidad</li>
                    <li>Por campeonato</li>
                  </ul>
                </nav> -->

                <input placeholder="Buscar" onkeyup="filterJugadores()"/>
              </div>
              <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 listado-jugadores" style="margin-top:20px;padding-left:0;padding-right:0;">

				<?php $even=true;
						$auxE=0;
					?>
              <?php foreach($puesto as $jugador){ ?>
				<div class="col-lg-6 col-md-6 col-xs-6 col-sm-6 jugador-node <?php
				if($auxE==0){echo " left-side";}else{ echo " right-side";}
				?>" data-nombre="<?php 
				$auxN=$jugador->apellido." ".$jugador->nombre;
				echo strtolower( trim($auxN)); ?>"  data-voto="<?php
					$the_slug = 'jugador-'.$jugador->id;
					$args = array(
					  'name'        => $the_slug
					);
					$my_posts = get_posts($args);
					if( $my_posts ){
						$auxV= get_post_meta($my_posts[0]->ID,"rating",true);
						if($auxV){
							echo $auxV;
						}else{
							echo "0";
						}
					}else{
						echo "0";
					}
				?>">
				<a href="<?php echo home_url(); ?>/jugador-<?php echo $jugador->id; ?>">
                <p class=" resultado <?php
			  /*if($even){ if($auxE==0){echo "even";}else{echo "odd";}}
				if(!$even){ if($auxE==0){echo "odd";}else{echo "even";}}
				$auxE++;
				if($auxE>1){
					$auxE=0;
					$even= !$even;
				}*/
				if($even){ echo "even";}
				if(!$even){echo "odd";}
				$auxE++;
				if($auxE>1){
					$auxE=0;
					$even= !$even;
				}
				?>"><span>-&nbsp; </span> <?php echo $jugador->nombre." ".$jugador->apellido; ?></p></a>
				</div>
              <?php } ?>
                </div>
            </div>
          </div>

          <?php }  ?>
       
			</div>
	   </div>

      </div>


    </div>





<?php //} // endwhile
//} // endif
?>



<?php get_footer();?>
