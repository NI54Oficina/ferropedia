<?php
/* @var $this TarjetaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tarjetas',
);

$this->menu=array(
	array('label'=>'Create Tarjeta', 'url'=>array('create')),
	array('label'=>'Manage Tarjeta', 'url'=>array('admin')),
);
?>

<h1>Tarjetas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
