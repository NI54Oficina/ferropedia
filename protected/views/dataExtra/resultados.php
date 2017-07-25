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
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'data-extra-form',
	'enableAjaxValidation'=>false,
)); ?>

	

	<?php echo $form->errorSummary($model); ?>
	
	<h2>Totales</h2>
	<div class="row">
		<label>Partidos Jugados</label>
		<input name="Totales[linea1]" class="form-control"  value="<?php echo $texto[0]; ?>"/>
	</div>
	
	<div class="row">
		<label>Partidos ganados</label>
		<input name="Totales[linea2]" class="form-control" value="<?php echo $texto[1]; ?>" class="form-control"/>
	</div>
	<div class="row">
		<label>Partidos Empatados</label>
		<input name="Totales[linea3]" class="form-control" value="<?php echo $texto[2]; ?>"/>
	</div>
	<div class="row">
		<label>Partidos perdidos</label>
		<input name="Totales[linea4]" class="form-control" value="<?php echo $texto[3]; ?>"/>
	</div>
	<div class="row">
		<label>Goles a favor</label>
		<input name="Totales[linea5]" class="form-control" value="<?php echo $texto[4]; ?>"/>
	</div>
	<div class="row">
		<label>Goles en contra</label>
		<input name="Totales[linea6]" class="form-control" value="<?php echo $texto[5]; ?>"/>
	</div>
	
	<?php
$texto= explode("/", $primera->texto);
 ?>
	
	<h2>Primera</h2>
	<div class="row">
		<label>Partidos Jugados</label>
		<input name="Primera[linea1]" class="form-control"  value="<?php echo $texto[0]; ?>"/>
	</div>
	
	<div class="row">
		<label>Partidos ganados</label>
		<input name="Primera[linea2]" class="form-control" value="<?php echo $texto[1]; ?>" class="form-control"/>
	</div>
	<div class="row">
		<label>Partidos Empatados</label>
		<input name="Primera[linea3]" class="form-control" value="<?php echo $texto[2]; ?>"/>
	</div>
	<div class="row">
		<label>Partidos perdidos</label>
		<input name="Primera[linea4]" class="form-control" value="<?php echo $texto[3]; ?>"/>
	</div>
	<div class="row">
		<label>Goles a favor</label>
		<input name="Primera[linea5]" class="form-control" value="<?php echo $texto[4]; ?>"/>
	</div>
	<div class="row">
		<label>Goles en contra</label>
		<input name="Primera[linea6]" class="form-control" value="<?php echo $texto[5]; ?>"/>
	</div>
	<?php
$texto= explode("/", $ascenso->texto);
 ?>
	<h2>Ascenso</h2>
	<div class="row">
		<label>Partidos Jugados</label>
		<input name="Ascenso[linea1]" class="form-control"  value="<?php echo $texto[0]; ?>"/>
	</div>
	
	<div class="row">
		<label>Partidos ganados</label>
		<input name="Ascenso[linea2]" class="form-control" value="<?php echo $texto[1]; ?>" class="form-control"/>
	</div>
	<div class="row">
		<label>Partidos Empatados</label>
		<input name="Ascenso[linea3]" class="form-control" value="<?php echo $texto[2]; ?>"/>
	</div>
	<div class="row">
		<label>Partidos perdidos</label>
		<input name="Ascenso[linea4]" class="form-control" value="<?php echo $texto[3]; ?>"/>
	</div>
	<div class="row">
		<label>Goles a favor</label>
		<input name="Ascenso[linea5]" class="form-control" value="<?php echo $texto[4]; ?>"/>
	</div>
	<div class="row">
		<label>Goles en contra</label>
		<input name="Ascenso[linea6]" class="form-control" value="<?php echo $texto[5]; ?>"/>
	</div>
	
	<?php
$texto= explode("/", $local->texto);
 ?>
	
	<h2>Copas Locales</h2>
	<div class="row">
		<label>Partidos Jugados</label>
		<input name="Local[linea1]" class="form-control"  value="<?php echo $texto[0]; ?>"/>
	</div>
	
	<div class="row">
		<label>Partidos ganados</label>
		<input name="Local[linea2]" class="form-control" value="<?php echo $texto[1]; ?>" class="form-control"/>
	</div>
	<div class="row">
		<label>Partidos Empatados</label>
		<input name="Local[linea3]" class="form-control" value="<?php echo $texto[2]; ?>"/>
	</div>
	<div class="row">
		<label>Partidos perdidos</label>
		<input name="Local[linea4]" class="form-control" value="<?php echo $texto[3]; ?>"/>
	</div>
	<div class="row">
		<label>Goles a favor</label>
		<input name="Local[linea5]" class="form-control" value="<?php echo $texto[4]; ?>"/>
	</div>
	<div class="row">
		<label>Goles en contra</label>
		<input name="Local[linea6]" class="form-control" value="<?php echo $texto[5]; ?>"/>
	</div>
	
	<?php
$texto= explode("/", $internacional->texto);
 ?>
	
	<h2>Copas Internacionales</h2>
	<div class="row">
		<label>Partidos Jugados</label>
		<input name="Internacional[linea1]" class="form-control"  value="<?php echo $texto[0]; ?>"/>
	</div>
	
	<div class="row">
		<label>Partidos ganados</label>
		<input name="Internacional[linea2]" class="form-control" value="<?php echo $texto[1]; ?>" class="form-control"/>
	</div>
	<div class="row">
		<label>Partidos Empatados</label>
		<input name="Internacional[linea3]" class="form-control" value="<?php echo $texto[2]; ?>"/>
	</div>
	<div class="row">
		<label>Partidos perdidos</label>
		<input name="Internacional[linea4]" class="form-control" value="<?php echo $texto[3]; ?>"/>
	</div>
	<div class="row">
		<label>Goles a favor</label>
		<input name="Internacional[linea5]" class="form-control" value="<?php echo $texto[4]; ?>"/>
	</div>
	<div class="row">
		<label>Goles en contra</label>
		<input name="Internacional[linea6]" class="form-control" value="<?php echo $texto[5]; ?>"/>
	</div>
	

	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->