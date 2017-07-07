<?php
/* @var $this TarjetaController */
/* @var $model Tarjeta */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tarjeta-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'tarjeta'); ?>
		<?php echo $form->textField($model,'tarjeta'); ?>
		<?php echo $form->error($model,'tarjeta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rel'); ?>
		<?php echo $form->textField($model,'rel'); ?>
		<?php echo $form->error($model,'rel'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comentario'); ?>
		<?php echo $form->textField($model,'comentario',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'comentario'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->