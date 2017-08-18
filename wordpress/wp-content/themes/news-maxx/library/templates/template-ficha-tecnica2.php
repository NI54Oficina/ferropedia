<?php
$model= $GLOBALS["jugador"];
?>
<?php
$aux=$_SERVER[REQUEST_URI];
$aux= substr($aux,strpos($aux,"jugador-"));
if(strpos($aux,"/")){
$aux= substr($aux,strpos($aux,"-")+1,strpos($aux,"/")-2);

}else if(strpos($aux,"?")){
	$aux= substr($aux,strpos($aux,"-")+1,strpos($aux,"?")-2);

}else if(strpos($aux,"#")){
	$aux= substr($aux,strpos($aux,"-")+1,strpos($aux,"#")-2);
}else{
	$aux= substr($aux,strpos($aux,"-")+1);
}
if(!isset($model)){
	$model= Jugador::model()->findByPk($aux);

}


// get_header();

 get_template_part( 'library/templates/header', 'links' );
 get_template_part( 'library/templates/header', 'extra' );
get_template_part( 'library/templates/header', 'menu' );
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
		$lastTorneo= str_replace("Total/",'',$lastTorneo);
		$lastTorneo= str_replace("Totales/",'',$lastTorneo);
		$lastTorneo= str_replace("TOTALES/",'',$lastTorneo);
		$lastTorneo= str_replace("TOTAL/",'',$lastTorneo);
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


<!-- <div id="main-content"> -->

    <div class="widget-area-1">


<div class="prueba-bg">


        <div class="stripe-box">

            <div class="wrapper">


                <?php kopa_the_topnew(); ?>
                <!-- top new -->

            </div>
            <!-- wrapper -->

        </div>
        <!-- stripe-box -->


    <!-- widget-area-1 -->

    <div class="bn-box">

        <div class="wrapper clearfix">

            <?php kopa_the_headline(); ?>
            <!-- kp-headline-wrapper -->

        </div>
        <!-- wrapper -->
  </div>
</div>
    <!-- bn-box -->

    <section class="main-section non-trio">


<div id="page-<?php the_ID(); ?>" class="page-content-area clearfix">



  <div class="wrapper clearfix">

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 first-box-ficha-tecnica">

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding:0;height:100%;padding-top:90px;">
          <!--<div class="sector-cancha-float cancha-<?php echo $model->puesto; ?>"></div>!-->
		  <div class="cancha cancha-<?php echo $model->puesto; ?>">

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
            <h2>&nbsp;<!--<?php echo rand(1,8); ?>!--></h2>
            <p>&nbsp;<!--Total partidos ganados!--></p>
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

		  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
        </div>

        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="text-align:center;padding-top:90px;padding-left:20px;padding-right:20px;">
			<?php if($model->avatar){ ?>
			<div class="jugador-principal square" style="background-image:url(<?php
echo  Yii::app()->request->baseUrl."/".$model->avatar[0]->imagen_data()["url"]; ?>);"></div>
			<?php }else{ ?>
			<div class="jugador-principal square" style="background-image:url(<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/avatar-jugador.svg);"></div>
			<?php } ?>
			<!--<img class="jugador-principal" src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/ejemplo.png" alt="">!-->

			<div class="compartir-jugador">
			<p style="">Compartir</p>
			<div class="links-sociales" >

                  <i class="fa fa-facebook" aria-hidden="true" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php echo get_permalink(); ?>','','width=500,height=400')" ></i>
                  <i class="fa fa-twitter" aria-hidden="true" onclick="window.open('https://twitter.com/intent/tweet?url=<?php echo get_permalink(); ?>&amp;original_referer=<?php echo get_permalink(); ?>&text=Mirá la ficha de <?php echo $model->nombre." ".$model->apellido; ?> en LaFerropedia','','width=500,height=400')"></i>

                </div>

			</div>

        </div>
    </div>
	<?php
	if(is_user_logged_in()){ ?>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align:center;height:0;position:relative;top:-115px;">
	<a href="<?php echo home_url(); ?>/jugador/<?php echo $model->id; ?>"><h4 style="color:white;padding:20px;background-color:#a43c93;display:inline-block;">Editar jugador</h4></a>
	</div>
	<?php } ?>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 second-box-ficha-tecnica" >

      <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 contenido-interno-tecnica">

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 informacion-dinamica content-shadow" style="margin-bottom:20px;padding-left:0;padding-right:0;"><h2 >Calificación</h2></div></div>
		<?php if(false){ ?>
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

		<?php } ?>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<?php echo do_shortcode("[rate2]") ?>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" >
		<?php echo do_shortcode("[rate]") ?>
		</div>

		</div>

		<div	 class="col-lg-12 col-md-12 col-sm-12 col-xs-12 informacion-dinamica campanas-jugador" style="margin-top:40px;">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 content-shadow" style="padding:0;" >
			  <h2>Campañas de <?php echo $model->nombre; ?> <span class="sub-verde"><?php echo $model->apellido; ?></span></h2>

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
			<?php if(false){ ?>
		<p class="col-lg-12 texto-fuente content-shadow">Fuente Hank ham hock tenderloin spare ribs, meatloaf flank pork
              chop biltong. Cow short ribs corned beef, meatball landjaeger ham sausage
              ham hock leberkas pork chop tongue bacon tenderloin alcatra. Kevin picanha
              alcatra tenderloin prosciutto. Pancetta pork belly pig jerky. Filet
              mignon beef shoulder ball tip short ribs, shankle turducken kielbasa.
              Turducken cow pork drumstick filet mignon chuck andouille ribeye tri-tip
              pork belly. Tenderloin ham hock venison kielbasa jowl fatback.
          </p>
		  <?php } ?>
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
		</div>
		<?php } ?>

		<?php if(false){ ?>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tecnica-video ">
          <h2>Video</h2>
          <iframe src="https://www.youtube.com/embed/LoETC4jtASI" frameborder="0" allowfullscreen></iframe>
        </div>
		<?php } ?>

		<?php if($model->imagenes){ ?>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tecnica-galeria contenido-interno-tecnica">
          <h2>Galería de fotos</h2>



					<style media="screen">

						.container-img-gallery:first-child{
							width: 50%;
						}

						.container-img-gallery:not:first-child{
							width: 25%;
						}
					.cover-green-gallery{
						position: absolute;
						background-color: rgba(0,182,67, .6);
						top: 0;
						height: 95%;
						width: 95%;
					}

					.container-img-gallery:hover .cover-green-gallery{
						/*display: none;*/
						opacity: 0;
						transition: opacity .8s;
					}

					</style>
					<!-- photoswipe -->

					<div class="row">
			      <div id="demo-test-gallery" class="demo-gallery col-lg-12 col-md-12 col-sm-12 col-xs-12" data-pswp-uid="1">

							<?php for($i=0; $i<count($model->imagenes); $i++){   ?>


								<div style="padding:0 2.5px 5px 2.5px;" class="<?php	if($i==0){ echo "col-lg-6 col-md-6 col-sm-6 col-xs-6 square"; }else{ echo "col-lg-3 col-md-3 col-sm-3 col-xs-3 square";} ?> container-img-gallery">
			        <a href="<?php echo home_url(); ?>/<?php echo $model->imagenes[$i]->imagen_data['url']; ?>" data-size="1600x1600" data-med="<?php echo home_url(); ?>/<?php echo $model->imagenes[$i]->imagen_data['url']; ?>" data-med-size="1024x1024" data-author="Nombre autor" class="demo-gallery__img--main">

									<!--<img class="img-g-j" src="<?php echo home_url(); ?>/<?php echo $model->imagenes[$i]->imagen_data['url']; ?>" alt="">!-->
									<div class="thumb-gallery-jugador" style="background-image:url(<?php echo home_url(); ?>/<?php echo $model->imagenes[$i]->imagen_data['url']; ?>);"></div>
				          <!-- <figure>Descripcion de imagen</figure> -->

									<?php	//if($i!=0){ echo "<div class='cover-green-gallery'></div>"; } ?>
									<?php	echo "<div class='cover-green-gallery'></div>"; ?>
			        </a>

							</div>



							<?php } ?>

						</div>


			      </div>


			    </div>

		<?php } ?>
		    <div id="gallery" class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
		        <div class="pswp__bg"></div>

		        <div class="pswp__scroll-wrap">

		          <div class="pswp__container" style="transform: translate3d(0px, 0px, 0px);">
					<div class="pswp__item" style="display: block; transform: translate3d(-982px, 0px, 0px);"><div class="pswp__zoom-wrap" style="transform: translate3d(36px, 44px, 0px) scale(1);"><img class="pswp__img pswp__img--placeholder" src="./PhotoSwipe_ Responsive JavaScript Image Gallery_files/14985868676_4b802b932a_m.jpg" style="width: 805px; height: 537px;"><img class="pswp__img" src="./PhotoSwipe_ Responsive JavaScript Image Gallery_files/14985868676_b51baa4071_h.jpg" style="width: 805px; height: 537px;"></div></div>
					<div class="pswp__item" style="transform: translate3d(0px, 0px, 0px);"><div class="pswp__zoom-wrap" style="transform: translate3d(503.5px, 262px, 0px) scale(0.212357);"><img class="pswp__img pswp__img--placeholder" src="./PhotoSwipe_ Responsive JavaScript Image Gallery_files/15008465772_383e697089_m.jpg" style="width: 805px; height: 537px;"><img class="pswp__img" src="./PhotoSwipe_ Responsive JavaScript Image Gallery_files/15008465772_d50c8f0531_h.jpg" style="display: block; width: 805px; height: 537px;"></div></div>
					<div class="pswp__item" style="display: block; transform: translate3d(982px, 0px, 0px);"><div class="pswp__zoom-wrap" style="transform: translate3d(160px, 44px, 0px) scale(1);"><img class="pswp__img pswp__img--placeholder" src="./PhotoSwipe_ Responsive JavaScript Image Gallery_files/15008518202_b016d7d289_m.jpg" style="width: 557px; height: 557px;"><img class="pswp__img" src="./PhotoSwipe_ Responsive JavaScript Image Gallery_files/15008518202_c265dfa55f_h.jpg" style="width: 557px; height: 557px;"></div></div>
		          </div>

		          <div class="pswp__ui pswp__ui--fit pswp__ui--hidden">

		            <div class="pswp__top-bar">

						<div class="pswp__counter">5 / 5</div>

						<button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

						<button class="pswp__button pswp__button--share" title="Share"></button>

						<button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

						<button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

						<div class="pswp__preloader">
							<div class="pswp__preloader__icn">
							  <div class="pswp__preloader__cut">
							    <div class="pswp__preloader__donut"></div>
							  </div>
							</div>
						</div>
		            </div>


					<!-- <div class="pswp__loading-indicator"><div class="pswp__loading-indicator__line"></div></div> -->

		            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
			            <div class="pswp__share-tooltip">
			            </div>
			        </div>

		            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
		            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
		            <div class="pswp__caption">
		              <div class="pswp__caption__center">It's a dummy caption. He who searches for meaning here will be sorely disappointed.<br></div>
		            </div>
		          </div>

		        </div>


		    </div>


		    <script type="text/javascript">
		    (function() {

				var initPhotoSwipeFromDOM = function(gallerySelector) {

					var parseThumbnailElements = function(el) {
					    var thumbElements = el.childNodes,
					        numNodes = thumbElements.length,
					        items = [],
					        el,
					        childElements,
					        thumbnailEl,
					        size,
					        item;

					    for(var i = 0; i < numNodes; i++) {
					        el = thumbElements[i];

					        // include only element nodes
					        if(el.nodeType !== 1) {
					          continue;
					        }

					        childElements = el.children;

					        size = el.getAttribute('data-size').split('x');

					        // create slide object
					        item = {
								src: el.getAttribute('href'),
								w: parseInt(size[0], 10),
								h: parseInt(size[1], 10),
								author: el.getAttribute('data-author')
					        };

					        item.el = el; // save link to element for getThumbBoundsFn

					        if(childElements.length > 0) {
					          item.msrc = childElements[0].getAttribute('src'); // thumbnail url
					          if(childElements.length > 1) {
					              item.title = childElements[1].innerHTML; // caption (contents of figure)
					          }
					        }


							var mediumSrc = el.getAttribute('data-med');
				          	if(mediumSrc) {
				            	size = el.getAttribute('data-med-size').split('x');
				            	// "medium-sized" image
				            	item.m = {
				              		src: mediumSrc,
				              		w: parseInt(size[0], 10),
				              		h: parseInt(size[1], 10)
				            	};
				          	}
				          	// original image
				          	item.o = {
				          		src: item.src,
				          		w: item.w,
				          		h: item.h
				          	};

					        items.push(item);
					    }

					    return items;
					};

					// find nearest parent element
					var closest = function closest(el, fn) {
					    return el && ( fn(el) ? el : closest(el.parentNode, fn) );
					};

					var onThumbnailsClick = function(e) {
					    e = e || window.event;
					    e.preventDefault ? e.preventDefault() : e.returnValue = false;

					    var eTarget = e.target || e.srcElement;

					    var clickedListItem = closest(eTarget, function(el) {
					        return el.tagName === 'A';
					    });

					    if(!clickedListItem) {
					        return;
					    }

					    var clickedGallery = clickedListItem.parentNode;

					    var childNodes = clickedListItem.parentNode.childNodes,
					        numChildNodes = childNodes.length,
					        nodeIndex = 0,
					        index;

					    for (var i = 0; i < numChildNodes; i++) {
					        if(childNodes[i].nodeType !== 1) {
					            continue;
					        }

					        if(childNodes[i] === clickedListItem) {
					            index = nodeIndex;
					            break;
					        }
					        nodeIndex++;
					    }

					    if(index >= 0) {
					        openPhotoSwipe( index, clickedGallery );
					    }
					    return false;
					};

					var photoswipeParseHash = function() {
						var hash = window.location.hash.substring(1),
					    params = {};

					    if(hash.length < 5) { // pid=1
					        return params;
					    }

					    var vars = hash.split('&');
					    for (var i = 0; i < vars.length; i++) {
					        if(!vars[i]) {
					            continue;
					        }
					        var pair = vars[i].split('=');
					        if(pair.length < 2) {
					            continue;
					        }
					        params[pair[0]] = pair[1];
					    }

					    if(params.gid) {
					    	params.gid = parseInt(params.gid, 10);
					    }

					    return params;
					};

					var openPhotoSwipe = function(index, galleryElement, disableAnimation, fromURL) {
					    var pswpElement = document.querySelectorAll('.pswp')[0],
					        gallery,
					        options,
					        items;

						items = parseThumbnailElements(galleryElement);

					    // define options (if needed)
					    options = {

					        galleryUID: galleryElement.getAttribute('data-pswp-uid'),

					        getThumbBoundsFn: function(index) {
					            // See Options->getThumbBoundsFn section of docs for more info
					            var thumbnail = items[index].el.children[0],
					                pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
					                rect = thumbnail.getBoundingClientRect();

					            return {x:rect.left, y:rect.top + pageYScroll, w:rect.width};
					        },

					        addCaptionHTMLFn: function(item, captionEl, isFake) {
								if(!item.title) {
									captionEl.children[0].innerText = '';
									return false;
								}
								captionEl.children[0].innerHTML = item.title +  '<br/><small>Photo: ' + item.author + '</small>';
								return true;
					        },

					    };


					    if(fromURL) {
					    	if(options.galleryPIDs) {
					    		// parse real index when custom PIDs are used
					    		// http://photoswipe.com/documentation/faq.html#custom-pid-in-url
					    		for(var j = 0; j < items.length; j++) {
					    			if(items[j].pid == index) {
					    				options.index = j;
					    				break;
					    			}
					    		}
						    } else {
						    	options.index = parseInt(index, 10) - 1;
						    }
					    } else {
					    	options.index = parseInt(index, 10);
					    }

					    // exit if index not found
					    if( isNaN(options.index) ) {
					    	return;
					    }



						var radios = document.getElementsByName('gallery-style');
						for (var i = 0, length = radios.length; i < length; i++) {
						    if (radios[i].checked) {
						        if(radios[i].id == 'radio-all-controls') {

						        } else if(radios[i].id == 'radio-minimal-black') {
						        	options.mainClass = 'pswp--minimal--dark';
							        options.barsSize = {top:0,bottom:0};
									options.captionEl = false;
									options.fullscreenEl = false;
									options.shareEl = false;
									options.bgOpacity = 0.85;
									options.tapToClose = true;
									options.tapToToggleControls = false;
						        }
						        break;
						    }
						}

					    if(disableAnimation) {
					        options.showAnimationDuration = 0;
					    }

					    // Pass data to PhotoSwipe and initialize it
					    gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);

					    // see: http://photoswipe.com/documentation/responsive-images.html
						var realViewportWidth,
						    useLargeImages = false,
						    firstResize = true,
						    imageSrcWillChange;

						gallery.listen('beforeResize', function() {

							var dpiRatio = window.devicePixelRatio ? window.devicePixelRatio : 1;
							dpiRatio = Math.min(dpiRatio, 2.5);
						    realViewportWidth = gallery.viewportSize.x * dpiRatio;


						    if(realViewportWidth >= 1200 || (!gallery.likelyTouchDevice && realViewportWidth > 800) || screen.width > 1200 ) {
						    	if(!useLargeImages) {
						    		useLargeImages = true;
						        	imageSrcWillChange = true;
						    	}

						    } else {
						    	if(useLargeImages) {
						    		useLargeImages = false;
						        	imageSrcWillChange = true;
						    	}
						    }

						    if(imageSrcWillChange && !firstResize) {
						        gallery.invalidateCurrItems();
						    }

						    if(firstResize) {
						        firstResize = false;
						    }

						    imageSrcWillChange = false;

						});

						gallery.listen('gettingData', function(index, item) {
						    if( useLargeImages ) {
						        item.src = item.o.src;
						        item.w = item.o.w;
						        item.h = item.o.h;
						    } else {
						        item.src = item.m.src;
						        item.w = item.m.w;
						        item.h = item.m.h;
						    }
						});

					    gallery.init();
					};

					// select all gallery elements
					var galleryElements = document.querySelectorAll( gallerySelector );
					for(var i = 0, l = galleryElements.length; i < l; i++) {
						galleryElements[i].setAttribute('data-pswp-uid', i+1);
						galleryElements[i].onclick = onThumbnailsClick;
					}

					// Parse URL and open gallery if it contains #&pid=3&gid=1
					var hashData = photoswipeParseHash();
					if(hashData.pid && hashData.gid) {
						openPhotoSwipe( hashData.pid,  galleryElements[ hashData.gid - 1 ], true, true );
					}
				};

				initPhotoSwipeFromDOM('.demo-gallery');

			})();

			</script>


					<!-- photoswipe -->

          <!-- <img src="<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/galeria-imagenes.png" alt=""> -->




        </div>

        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 columna-relacionados" style="text-align:center;">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:inline-block;float:initial;max-width:250px;">
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
		<a href="<?php echo home_url(); ?>/jugador-<?php echo $jugador->id; ?>">
        <div class="jugador-relacionado">
		<?php if($jugador->avatar){ ?>
		<div class="avatar-relacionado" style="background-image:url(<?php
echo  Yii::app()->request->baseUrl."/".$jugador->avatar[0]->imagen_data()["url"]; ?>);" ></div>
		<?php }else{ ?>
        <div class="avatar-relacionado placeholder" style="background-image:url(<?php echo site_url(); ?>/wp-content/themes/news-maxx/img/avatar-jugador.svg);" ></div>
		<?php } ?>
        <label><?php echo $jugador["nombre"]." ".$jugador["apellido"]; ?> <br> <span><?php echo $jugador["puesto"]; ?></span></label>
        </div>
		</a>
        <?php } ?>
        </div>
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
