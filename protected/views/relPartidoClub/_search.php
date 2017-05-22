<?php
/* @var $this RelPartidoClubController */
/* @var $model RelPartidoClub */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'partido'); ?>
		<?php echo $form->textField($model,'partido'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'club'); ?>
		<?php echo $form->textField($model,'club'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lado'); ?>
		<?php echo $form->textField($model,'lado'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->