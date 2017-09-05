<?php
/* @var $this DataExtraController */
/* @var $model DataExtra */
/* @var $form CActiveForm */
?>
<?php
$texto= explode("/", $model->texto);
 ?>
 <?php 
 if($guardado=="si"){ ?>
	 <h4 style="background-color:green;padding:10px;color:white;">Guardado</h4>
 <?php }
 if(!isset($model->id)){
	 ?>
	 <h1>Agregar Torneo</h1>
	 <?php
	 }else{
		 ?>
	<h1>Editar Torneo</h1>	 
		 <?php
	 }
 ?>
 
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'data-extra-form',
	'enableAjaxValidation'=>false,
)); ?>

	<input type="hidden" name="modelId" value="<?php echo $model->modelId; ?>" />
	
	<input type="hidden" name="model" value="<?php echo $model->model; ?>" />

	<?php echo $form->errorSummary($model); ?>
	
	<?php if(strtolower($texto[0])=="total"){ ?>
		<div class="row">
			
			<input name="DataExtra[linea1]" class="form-control"  value="<?php echo $texto[0]; ?>" readonly />
		</div>
		<br>
		
		<div class="row">
		<label>Pj</label>
		<input name="DataExtra[linea3]" class="form-control" value="<?php echo $texto[2]; ?>"/>
	</div>
	<div class="row">
		<label>Pg</label>
		<input name="DataExtra[linea4]" class="form-control" value="<?php echo $texto[3]; ?>"/>
	</div>
	<div class="row">
		<label>Pe</label>
		<input name="DataExtra[linea5]" class="form-control" value="<?php echo $texto[4]; ?>"/>
	</div>
	<div class="row">
		<label>Pp</label>
		<input name="DataExtra[linea6]" class="form-control" value="<?php echo $texto[5]; ?>"/>
	</div>
	<div class="row">
		<label>Gf</label>
		<input name="DataExtra[linea7]" class="form-control" value="<?php echo $texto[6]; ?>"/>
	</div>
	<div class="row">
		<label>Gc</label>
		<input name="DataExtra[linea8]" class="form-control" value="<?php echo $texto[7]; ?>"/>
	</div>
	
	<?php }else{ ?>
	<div class="row">
		<label>Temporada</label>
		<input name="DataExtra[linea1]" class="form-control"  value="<?php echo $texto[0]; ?>"/>
	</div>
	
	<div class="row">
		<label>Division</label>
		<input name="DataExtra[linea2]" class="form-control" value="<?php echo $texto[1]; ?>" class="form-control"/>
	</div>
	<div class="row">
		<label>Pj</label>
		<input name="DataExtra[linea3]" class="form-control" value="<?php echo $texto[2]; ?>"/>
	</div>
	<div class="row">
		<label>Pg</label>
		<input name="DataExtra[linea4]" class="form-control" value="<?php echo $texto[3]; ?>"/>
	</div>
	<div class="row">
		<label>Pe</label>
		<input name="DataExtra[linea5]" class="form-control" value="<?php echo $texto[4]; ?>"/>
	</div>
	<div class="row">
		<label>Pp</label>
		<input name="DataExtra[linea6]" class="form-control" value="<?php echo $texto[5]; ?>"/>
	</div>
	<div class="row">
		<label>Gf</label>
		<input name="DataExtra[linea7]" class="form-control" value="<?php echo $texto[6]; ?>"/>
	</div>
	<div class="row">
		<label>Gc</label>
		<input name="DataExtra[linea8]" class="form-control" value="<?php echo $texto[7]; ?>"/>
	</div>
	
	
	<?php  } ?>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
