<?php
/* @var $this RelPlantelJugadorController */
/* @var $model RelPlantelJugador */

$this->breadcrumbs=array(
	'Rel Plantel Jugadors'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RelPlantelJugador', 'url'=>array('index')),
	array('label'=>'Create RelPlantelJugador', 'url'=>array('create')),
	array('label'=>'View RelPlantelJugador', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage RelPlantelJugador', 'url'=>array('admin')),
);
?>

<h1>Editar jugador en el plantel </h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>