<?php
/* @var $this DataExtraController */
/* @var $model DataExtra */

$this->breadcrumbs=array(
	'Data Extras'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DataExtra', 'url'=>array('index')),
	array('label'=>'Manage DataExtra', 'url'=>array('admin')),
);
?>

<h1>Crear datos adicionales</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>