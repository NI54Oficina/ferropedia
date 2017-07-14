<?php 
$model= $GLOBALS["jugador"];
?>
<?php
  get_header();

$model->data;
		$lastTorneo="";
		$debut="";
		$ultimo="";
		$torneos=array();
		$otros= array();
foreach($model->data as $data){ 
	if($data["titulo"]=="Debut"){
		$debut =$data["texto"];
	}else if($data["titulo"]=="Torneo"){
		$auxT= explode("/",$data["texto"]);
		if(count($auxT)>2){
			if(isset($torneos[$auxT[0]])){
				array_push($torneos[$auxT[0]],$auxT);
			}else{
				$torneos[$auxT[0]]= array($auxT);
			}
		}
		$lastTorneo= $data["texto"];
	}else if($data["titulo"]=="Último partido"){
		$ultimo= $data["texto"];
	}else{
		array_push($otros,$data);
	}
 }
 
$lastTorneo= explode("/",$lastTorneo);
$debut= explode(";",$debut);
$debut=str_replace("(","<br>(",$debut);
$ultimo= explode(";",$ultimo);
$ultimo=str_replace("(","<br>(",$ultimo);

 ?>

<?php ?>


<div id="page-<?php the_ID(); ?>" class="page-content-area clearfix">


  <div class="wrapper clearfix">

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 first-box-ficha-tecnica">

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding:0;height:100%;">

          <div class="sector-cancha-float cancha-<?php echo $model->puesto; ?>"></div>
		  <div class="cancha">
		  
		  </div>
			
            <!--<img class="cancha" src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/cancha-transparente-01.svg" alt="">!-->
        </div>

        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 informacion-tecnica">
          <h1><?php echo $model->nombre; ?> <span><?php echo $model->apellido; ?></span></h1>
          
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 informacion-tecnica-inner">
            <h2><?php echo $lastTorneo[0]; ?></h2>
            <p>Todos partidos jugados</p>
            <h3><?php echo $model->detalle_puesto; ?></h3>
            <h4><?php echo $model->puesto; ?></h4>
            <p>Puesto</p>
          </div>
         
		  
		  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 informacion-tecnica-inner">
            <h2>??</h2>
            <p>Total partidos ganados</p>
            <h3><?php if($debut[0]!=""){ echo $debut[0]; }else{ echo "---"; } ?></h3>
            <h4><?php if($debut[1]!=""){ echo "Ferro ".$debut[1]; }else{ echo "---"; } ?></h4>
            <p>Debut</p>
          </div>
		  
		  
		  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 informacion-tecnica-inner">
            <h2><?php if(!isset($lastTorneo[1])||$lastTorneo[1]==""){echo 0;}else{ echo $lastTorneo[1];} ?></h2>
            <p>Total Goles Convertidos</p>
			<h3><?php if($ultimo[0]!=""){ echo $ultimo[0]; }else{ echo "---"; } ?></h3>
            <h4><?php if($ultimo[1]!=""){ echo "Ferro ".$ultimo[1]; }else{ echo "---"; } ?></h4>
            <p>Último partido</p>
          </div>
		
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding:20px 10px;background-color:rgba(32, 32, 31,0.5)">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 info-nacimiento" style="border-right: 2px solid rgba(255,255,255,0.4)">
            <p><span>Fecha y lugar de nacimiento</span><br>
              <?php echo $model->nacimiento; ?> <?php if(isset($model->ciudad_natal)&&$model->ciudad_natal!=""){ ?>| <?php echo $model->ciudad_natal;  }?>
            </p>
          </div>

          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 info-nacimiento">
            <p><span>Fecha y lugar de fallecimiento</span><br>
              <?php echo $model->defuncion; ?>
            </p>
          </div>
		  </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
          <img class="jugador-principal" src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/ejemplo.png" alt="">


            <p style="margin:20px auto auto auto;width:auto;text-align:center; width:50%; border:1px solid white; ">Compartir</p>

        </div>
    </div>


    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 second-box-ficha-tecnica" >

      <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 contenido-interno-tecnica">
	  
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 informacion-dinamica content-shadow" style="margin-bottom:20px;padding-left:0;padding-right:0;"><h2 >Calificación</h2></div></div>
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 informacion-dinamica">
          <!--<h2>¿Qué pensas del jugador?</h2>!-->

          <img class="estrella" src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/ej-2.png" alt="">

        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 informacion-dinamica">
          <!--<h2>Calificar al jugador</h2>!-->

          <img class="estrella" src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/ej-1.png" alt="">

          <!--
                <h2>5.5 pts</h2>

                <?php for($i=0; $i <5 ; $i++){ ?>
                  <img class="estrella" src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/estrella.svg" alt="">
                <?php } ?>

          <div class="vota">
            ¡Votá!
            <?php for($i=0; $i <5 ; $i++){ ?>
              <img class="estrella" src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/estrella.svg" alt="">
            <?php } ?>
          </div>
         -->
        </div>
		</div>
		<?php if(false){ ?>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 informacion-dinamica">
          <h2>Campañas del jugador</h2>

          <div class="menu-anios menu-dinamico">
            <nav>
              <p class="selected">Todos</p>
              <p>1997</p>
              <p>1998</p>
              <p>1999</p>
              <p>2000</p>

          </nav>

          <div class="tabla-anios-jugador">
            <div class="titulo-tabla">
              <div class="col-lg-2">Año</div>
              <div class="col-lg-2">Torneo</div>
              <div class="col-lg-2">Division</div>
              <div class="col-lg-3">Partidos jugados</div>
              <div class="col-lg-3">Goles convertidos</div>
            </div>

          <?php for($i=0; $i<5;$i++){ $m=28; $n=15 ?>

            <div class="col-lg-12 cuerpo-tabla contenido-dinamico">

              <?php for($k=0; $k<3;$k++){ ?>



                <div class="col-lg-2 columna-gris">1190</div>
                <div class="col-lg-2">Torneo</div>
                <div class="col-lg-2 columna-gris">Division</div>
                <div class="col-lg-3 partidos-jugados"><?php echo $m ?></div>
                <div class="col-lg-3 goles-convertidos"><?php echo $n ?></div>

            <?php  $m++; $n++;} ?>


          </div>


          <?php } ?>
          </div>
          </div>

          <p class="col-lg-12 texto-fuente content-shadow">Fuente Hank ham hock tenderloin spare ribs, meatloaf flank pork
              chop biltong. Cow short ribs corned beef, meatball landjaeger ham sausage
              ham hock leberkas pork chop tongue bacon tenderloin alcatra. Kevin picanha
              alcatra tenderloin prosciutto. Pancetta pork belly pig jerky. Filet
              mignon beef shoulder ball tip short ribs, shankle turducken kielbasa.
              Turducken cow pork drumstick filet mignon chuck andouille ribeye tri-tip
              pork belly. Tenderloin ham hock venison kielbasa jowl fatback.
          </p>
        </div>
		<?php } ?>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 informacion-dinamica campanas-jugador" style="margin-top:40px;">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 content-shadow" style="padding:0;" >
			  <h2>Campañas del jugador</h2>

			  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 menu-anios menu-dinamico">
				<nav>
				  <p class="selected">Todos</p>
				  <?php foreach($torneos as $key=>$value){ if(!is_int($key)||strlen($key)!=4){continue;} ?>
				  <p><?php echo $key; ?></p>
				  <?php } ?>

			  </nav>
				<?php //var_dump($torneos); ?>
			  <div class="tabla-anios-jugador">
				<div class="titulo-tabla">
				  <div class="col-lg-2">Año</div>
				  <div class="col-lg-4">Torneo</div>
				  <!--<div class="col-lg-2">Division</div>!-->
				  <div class="col-lg-3">Partidos jugados</div>
				  <div class="col-lg-3">Goles convertidos</div>
				</div>
				
			 

				<div class="col-lg-12 cuerpo-tabla contenido-dinamico">

			   
					<?php foreach($torneos as $key=>$value){ if(!is_int($key)||strlen($key)!=4){continue;} ?>

					<?php foreach($value as $torneo){ ?>
					<div class="row">
					<div class="col-lg-2 columna-gris"><?php echo $torneo[0]; ?></div>
					<div class="col-lg-4"><?php echo $torneo[1]; ?></div>
					<div class="col-lg-3 partidos-jugados"><?php echo $torneo[2]; ?></div>
					<div class="col-lg-3 goles-convertidos"><?php if($torneo[3]==""){echo "0";}else{ echo $torneo[3]; }?></div>
					</div>
					
					
					<?php } } ?>
					
					
		 


			  </div>
			  
			  <?php foreach($torneos as $key=>$value){ if(!is_int($key)||strlen($key)!=4){continue;} ?>
					<div class="col-lg-12 cuerpo-tabla contenido-dinamico">
					<?php foreach($value as $torneo){ ?>
					<div class="row">
					<div class="col-lg-2 columna-gris"><?php echo $torneo[0]; ?></div>
					<div class="col-lg-4"><?php echo $torneo[1]; ?></div>
					<div class="col-lg-3 partidos-jugados"><?php echo $torneo[2]; ?></div>
					<div class="col-lg-3 goles-convertidos"><?php if($torneo[3]==""){echo "0";}else{ echo $torneo[3]; }?></div>
					</div>
					<?php } ?>
					</div>
					
					<?php  } ?>


			  
			  </div>
			  </div>

			  
			</div>
		<p class="col-lg-12 texto-fuente content-shadow">Fuente Hank ham hock tenderloin spare ribs, meatloaf flank pork
              chop biltong. Cow short ribs corned beef, meatball landjaeger ham sausage
              ham hock leberkas pork chop tongue bacon tenderloin alcatra. Kevin picanha
              alcatra tenderloin prosciutto. Pancetta pork belly pig jerky. Filet
              mignon beef shoulder ball tip short ribs, shankle turducken kielbasa.
              Turducken cow pork drumstick filet mignon chuck andouille ribeye tri-tip
              pork belly. Tenderloin ham hock venison kielbasa jowl fatback.
          </p>
        </div>


		<?php if(false){ ?>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tecnica-detalle">
          <h2>Detalle</h2>
          <p><b>Algo destacado <br></b>
            Shank ham hock tenderloin spare ribs, meatloaf flank pork chop biltong. Cow short ribs corned beef, meatball landjaeger ham sausage ham hock leberkas pork chop tongue bacon tenderloin alcatra. Kevin picanha alcatra tenderloin prosciutto. Pancetta pork belly pig jerky. Filet mignon beef shoulder ball tip short ribs, shankle turducken kielbasa. Turducken cow pork drumstick filet mignon chuck andouille ribeye tri-tip pork belly. Tenderloin ham hock venison kielbasa jowl fatback.
          </p>
        </div>
		<?php } ?>
		
		
		
		  <?php foreach($otros as $data){ ?>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tecnica-detalle">
          <h2><?php echo $data["titulo"]; ?></h2>
          <p>
            <?php echo $data["texto"]; ?>
          </p>
       
		<?php } ?>
		 </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tecnica-video ">
          <h2>Video</h2>
          <iframe src="https://www.youtube.com/embed/YoMwrh4_ThE" frameborder="0" allowfullscreen></iframe>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tecnica-galeria contenido-interno-tecnica">
          <h2>Galería de fotos</h2>

          // queda aplicar galeria.

        </div>


        </div>

        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 columna-relacionados">
        <h2>JUGADORES RELACIONADOS</h2>

        <?php
		
		$destacadoId= $model->id;
		$criteria = new CDbCriteria;
$criteria->limit = 5;
$criteria->condition = "id != $destacadoId";
$criteria->order = 'RAND()';
$criteria->select = "*";

		$jugadores= Jugador::model()->findAll($criteria);
		
		foreach($jugadores as $jugador){ 
		?>
        <div class="jugador-relacionado">
        <img src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/ejemplo.png" alt="">
        <label><?php echo $jugador["nombre"]." ".$jugador["apellido"]; ?> <br> <span><?php echo $jugador["puesto"]; ?></span></label>
        </div>

        <?php } ?>
        </div>


        </div>

        </div>

        </div>



    <?php//comments_template(); ?>

<?php 
?>
<style>
.informacion-tecnica-inner h3{text-transform:uppercase;}
.informacion-tecnica-inner h3~p{text-transform:capitalize;}
</Style>


<?php get_footer();?>
