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
 ?>
 <?php
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
			<label>Partidos Jugados</label>
			<input name="DataExtra[linea2]" class="form-control" value="<?php echo $texto[1]; ?>" class="form-control"/>
		</div>
		<div class="row">
			<label>Goles convertidos</label>
			<input name="DataExtra[linea3]" class="form-control" value="<?php echo $texto[2]; ?>"/>
		</div>
	
	<?php }else{ ?>
	<div class="row">
		<label>Año</label>
		<input name="DataExtra[linea1]" class="form-control"  value="<?php echo $texto[0]; ?>"/>
	</div>
	
	<div class="row">
		<label>Torneo</label>
		<input name="DataExtra[linea2]" class="form-control" value="<?php echo $texto[1]; ?>" class="form-control"/>
	</div>
	<div class="row">
		<label>Partidos Jugados</label>
		<input name="DataExtra[linea3]" class="form-control" value="<?php echo $texto[2]; ?>"/>
	</div>
	<div class="row">
		<label>Goles convertidos</label>
		<input name="DataExtra[linea4]" class="form-control" value="<?php echo $texto[3]; ?>"/>
	</div>
	
	<?php  } ?>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->