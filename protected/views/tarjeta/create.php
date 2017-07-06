<?php
/* @var $this TarjetaController */
/* @var $model Tarjeta */

$this->breadcrumbs=array(
	'Tarjetas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Tarjeta', 'url'=>array('index')),
	array('label'=>'Manage Tarjeta', 'url'=>array('admin')),
);
?>

<h1>Create Tarjeta</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>