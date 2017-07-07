<?php
/* @var $this RelImagenController */
/* @var $model RelImagen */

$this->breadcrumbs=array(
	'Rel Imagens'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RelImagen', 'url'=>array('index')),
	array('label'=>'Manage RelImagen', 'url'=>array('admin')),
);
?>

<h1>Cargar imagen para <?php echo $model['model']; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<a href="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $model['model']; ?>/<?php  echo $model['modelId']; ?>">Volver</a>