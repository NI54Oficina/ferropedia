<?php
/* @var $this GolController */
/* @var $model Gol */

$this->breadcrumbs=array(
	'Gols'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Gol', 'url'=>array('index')),
	array('label'=>'Create Gol', 'url'=>array('create')),
	array('label'=>'View Gol', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Gol', 'url'=>array('admin')),
);
?>

<h1>Editar Gol de <?php echo $model->jugador_data->nombre." ".$model->jugador_data->apellido; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>