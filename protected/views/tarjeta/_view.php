<?php
/* @var $this TarjetaController */
/* @var $data Tarjeta */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tarjeta')); ?>:</b>
	<?php echo CHtml::encode($data->tarjeta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rel')); ?>:</b>
	<?php echo CHtml::encode($data->rel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comentario')); ?>:</b>
	<?php echo CHtml::encode($data->comentario); ?>
	<br />


</div>