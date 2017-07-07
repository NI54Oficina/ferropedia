<?php
/* @var $this TarjetaController */
/* @var $model Tarjeta */

$this->breadcrumbs=array(
	'Tarjetas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Tarjeta', 'url'=>array('index')),
	array('label'=>'Create Tarjeta', 'url'=>array('create')),
	array('label'=>'View Tarjeta', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Tarjeta', 'url'=>array('admin')),
);
?>

<h1>Update Tarjeta <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>