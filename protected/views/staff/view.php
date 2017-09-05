<?php
/* @var $this StaffController */
/* @var $model Staff */

$this->breadcrumbs=array(
	'Staffs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Staff', 'url'=>array('index')),
	array('label'=>'Create Staff', 'url'=>array('create')),
	array('label'=>'Update Staff', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Staff', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Staff', 'url'=>array('admin')),
);
?>

<h1>Director Tecnico</h1> <?php if(is_user_logged_in()){ ?><a href="<?php echo Yii::app()->request->baseUrl; ?>/staff/update/<?php echo $model->id; ?>">Editar</a> / <a href="<?php echo Yii::app()->request->baseUrl; ?>/director-tecnico-<?php echo $model->id; ?>">Ver en Ferropedia</a><br><br><?php } ?>
<?php if(isset($model->avatar[0])){ ?>
<img src="<?php 
echo  Yii::app()->request->baseUrl."/".$model->avatar[0]->imagen_data()["url"]; ?>" style="max-width:200px;" />
<?php } ?>
<p><strong>Nombre:</strong> <?php echo $model->nombre; ?></p>
<p><strong>Apellido:</strong> <?php echo $model->apellido; ?></p>
<p><strong>Fecha y lugar de nacimiento:</strong> <?php echo $model->nacimiento; ?></p>
<?php if(isset($model->defuncion)&&$model->defuncion!=0){ ?>
<p><strong>Fecha y lugar de defunción:</strong> <?php echo $model->defuncion; ?></p>
<?php } ?>
<?php if(false){ ?>
<p><strong>Ciudad Natal:</strong> <?php echo $model->ciudad_natal; ?></p>
<?php } ?>
<p><strong>Puesto:</strong> Director Técnico
<?php if(isset($model->detalle_puesto)&&$model->detalle_puesto!=""){ ?>
<p><?php echo $model->detalle_puesto; ?></p>
<?php } ?>

<p><strong>Primer partido:</strong> <?php $debut= DataExtra::model()->findByAttributes(array("model"=>"Staff","modelId"=>$model->id,"titulo"=>"Primer partido"));
if(isset($debut)){echo $debut->texto; } ?></p>
<p><strong>Último Partido:</strong> <?php 
		$ultimo= DataExtra::model()->findByAttributes(array("model"=>"Staff","modelId"=>$model->id,"titulo"=>"Último partido"));
if(isset($ultimo)){echo $ultimo->texto; }
		?></p><br><br>

<?php if(count($model->data())>0|| is_user_logged_in()){ ?>
<h4>Data adicional</h4>
<ul>
<?php foreach($model->data as $data){ if($data->titulo=="Torneo"||$data->titulo=="Primer partido"||$data->titulo=="Último partido"){continue;}?>
	<li>
	<strong><?php echo $data->titulo; ?></strong>
	<p><?php echo $data->texto; ?></p> <?php if(is_user_logged_in()){ ?>
	<a href="<?php echo Yii::app()->request->baseUrl; ?>/dataExtra/delete/<?php echo $data->id; ?>" class="confirmation">Borrar</a> / 
	<a href="<?php echo Yii::app()->request->baseUrl; ?>/dataExtra/update/<?php echo $data->id; ?>">Editar</a>
	<?php } ?>
	</li>
	
<?php } ?></ul>
<?php } ?>

<?php if(is_user_logged_in()){ ?>
<form name="myform" action="<?php echo Yii::app()->request->baseUrl; ?>/dataExtra/create" method="post" >
	<input name="model" value="<?php echo get_class($model); ?>" type="hidden" />
  <input type="hidden" name="modelId"  value="<?php echo $model->id; ?>" />
  <button style="color:white;">Agregar data</button>
</form>


<?php 
$model->logros; ?>
<?php if(count($model->logros)>0){ ?>
<hr>
<h4>Logros</h4>
<?php } ?>
<?php 
$model->logros;
foreach($model->logros as $logro){
	?>
	<div style="display:inline-block;width:100px;">
		<p><strong>Año:</strong> <?php echo $logro->fecha; ?></p>
		<p><img src="<?php echo get_template_directory_uri(); ?>/img/<?php echo $logro->tipo; ?>.svg" /></p>
		<a href="<?php echo home_url(); ?>/staff/deleteLogro/<?php echo $logro->id; ?>">Borrar</a>
	</div>
	<?php
}
?>
<br>
<br>
<hr>

<form id="logro"name="logro" action="<?php echo Yii::app()->request->baseUrl; ?>/staff/crearLogro" method="post" >
	<input name="model" value="<?php echo get_class($model); ?>" type="hidden" />
  <input type="hidden" name="modelId"  value="<?php echo $model->id; ?>" />
  <input id="copa" style="display:inline-block;"  type="radio" name="tipo" value="copa" checked> <label for="copa"><img src="<?php echo get_template_directory_uri(); ?>/img/copa-verde.svg" /></label></input>
  <input id="ascenso" style="display:inline-block;"   type="radio" name="tipo" value="ascenso"><label for="ascenso"><img src="<?php echo get_template_directory_uri(); ?>/img/ascenso.svg" /></label></input>
  <input id="descenso" style="display:inline-block;"  type="radio" name="tipo" value="descenso"><label for="descenso"><img src="<?php echo get_template_directory_uri(); ?>/img/descenso.svg" /></label></input><br>
  <input   name="fecha" placeholder="Año" value="" />
  
  <button style="color:white;background:gray;font-size:13px;padding-top:5px;padding-bottom:5px;margin-left:10px;">Agregar logro</button>
</form>
<br>


<style>
#logro input[type=radio]:checked{
	opacity:0;
}
#logro input:checked + label{
	opacity:1;
}

#logro input[type=radio]{
	opacity:0;
}
#logro input + label{
	opacity:0.5;
}
</style>
<hr>
<br>
<a class="button-like" href="<?php echo Yii::app()->request->baseUrl; ?>/staff/torneos/<?php echo $model->id; ?>">Ver Campañas</a>
<br>
<br>

<hr>
<br>
<?php if(false){ ?>
<form name="myform" action="<?php echo Yii::app()->request->baseUrl; ?>/relImagen/create" method="post" target="_blank">

  <input type="hidden" name="modelId"  value="<?php echo $model->id; ?>" />
  <input type="hidden" name="model"  value="<?php echo get_class($model); ?>" />
  <button style="color:white;">Agregar Imagen</button>
</form>
<?php } ?>
<?php } ?>

<div id="imagenes">
<?php if(count($model->imagenes)>0){ ?>
<h3>Imagenes</h3>

<?php 
foreach($model->imagenes as $imagen){
	?> 
	<div style="display:inline-block;">
	<img style="max-width:200px;"src="<?php echo  Yii::app()->request->baseUrl."/".$imagen->imagen_data["url"];?>" />
	
	<?php
	if(is_user_logged_in()){ ?>
	<br>
		<button type="button" class="assign-avatar" image-id="<?php echo $imagen->id; ?>" style="color:white;" >Asignar como avatar</button><br>
		<a href="<?php echo Yii::app()->request->baseUrl; ?>/relImagenJugador/delete/<?php echo $imagen->id; ?>" class="confirmation">Quitar relación</a> / 
		<a href="<?php echo Yii::app()->request->baseUrl; ?>/imagen/delete/<?php echo $imagen->imagen_data["id"]; ?>" class="confirmation">Borrar</a> 
	<?php } ?>
	</div>
	<?php
} }
?>
</div>
<?php if(is_user_logged_in()){ ?>
<script>
jQuery("body").on("click",".assign-avatar",function(){
	var auxThis=jQuery(this);
	jQuery.post("<?php echo  Yii::app()->request->baseUrl.'/relImagen/destacada/modelClass/'.get_class($model).'/id/'.$model->id.'/imagen/'; ?>"+jQuery(this).attr("image-id"),function(data){
		if(data=="1"){
			console.log("entra");
			console.log(jQuery(auxThis));
			jQuery(auxThis).css("background-color","green");
			location.reload();
		}
	});
});
</script>

<?php } 
?>
<?php $auxM=array( "model"=>"Staff","modelId"=>$model->id ); ?>
<?php echo $this->renderPartial('../relImagen/_form', array('model'=>$auxM)); ?>