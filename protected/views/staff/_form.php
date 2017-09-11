<?php
/* @var $this StaffController */
/* @var $model Staff */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'staff-form',
	'enableAjaxValidation'=>false,
)); ?>

	

	<?php echo $form->errorSummary($model); ?>
	
	<div class="form-group">
		<?php echo $form->labelEx($model,'activo'); ?>
		<?php echo $form->checkBox($model,'activo'); ?>
		<?php echo $form->error($model,'activo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>300,"class"=>"form-control")); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'apellido'); ?>
		<?php echo $form->textField($model,'apellido',array('size'=>60,'maxlength'=>300,"class"=>"form-control")); ?>
		<?php echo $form->error($model,'apellido'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nacimiento'); ?>
		<?php echo $form->textField($model,'nacimiento',array('size'=>60,'maxlength'=>300,"class"=>"form-control")); ?>
		<?php echo $form->error($model,'nacimiento'); ?>
	</div>
	
	<?php if(false){ ?>
	<div class="row">
		<?php echo $form->labelEx($model,'ciudad_natal'); ?>
		<?php echo $form->textField($model,'ciudad_natal',array('size'=>60,'maxlength'=>300,"class"=>"form-control")); ?>
		<?php echo $form->error($model,'ciudad_natal'); ?>
	</div>
	<?php } ?>

	<div class="row">
		<?php echo $form->labelEx($model,'puesto'); ?>
		<?php echo $form->textField($model,'puesto',array('size'=>60,'maxlength'=>100,"class"=>"form-control")); ?>
		<?php echo $form->error($model,'puesto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'detalle_puesto'); ?>
		<?php echo $form->textField($model,'detalle_puesto',array('size'=>60,'maxlength'=>300,"class"=>"form-control")); ?>
		<?php echo $form->error($model,'detalle_puesto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'defuncion'); ?>
		<?php echo $form->textField($model,'defuncion',array('size'=>60,'maxlength'=>300,"class"=>"form-control")); ?>
		<?php echo $form->error($model,'defuncion'); ?>
	</div>
	
	<div class="form-group">
		<label for="Partido_debut">Debut</label>
		<input size="60" maxlength="300" class="form-control" name="Partido[debut]" id="Partido_debut" type="text" value="<?php if(isset($partido['debut'])){echo $partido['debut'];} ?>">
	</div>
	
	<div class="form-group">
		<label for="Partido_ultimo">Ultimo Partido</label>
		<input size="60" maxlength="300" class="form-control" name="Partido[ultimo]" id="Partido_ultimo" type="text" value="<?php if(isset($partido['ultimo'])){echo $partido['ultimo'];} ?>">
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->