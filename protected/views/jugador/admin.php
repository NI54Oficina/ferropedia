<?php
/* @var $this JugadorController */
/* @var $model Jugador */

$this->breadcrumbs=array(
	'Jugadors'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Jugador', 'url'=>array('index')),
	array('label'=>'Create Jugador', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#jugador-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Jugadors</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'jugador-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'nombre',
		'apellido',
		'nacimiento',
		'ciudad_natal',
		'puesto',
		/*
		'detalle_puesto',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

<?php 

$jugadores= Jugador::model()->findAll();
foreach($jugadores as $jugador){
	if($jugador->puesto==""||!isset($jugadro->puesto)){
	$jugador->puesto= GetPuesto($jugador->detalle_puesto);
	$jugador->save();
	}
	
}

function GetPuesto($detalle){
	switch($detalle){
		case "Centrodelantero": case "Delantero": case "Insider derecho": case "Insider derecho o izquierdo": case "Insider iquierdo": case "Insider izquierdo": case "Puntero derecho": case "Puntero derecho e izquierdo": case "Puntero izquierdo": case "Puntero derecho o izquierdo":
		return "delantero"; break;
		case "Half izquierdo": case "Back  derecho": case "Back derecho": case "Back central": case "Back izquierdo": case "Centre half":  case "Defensor": case "Half derecho": case "Half derecho o izquierdo": case "Back  derecho o izquierdo": case "Back derecho y centromedio": 
		return "defensor"; break;
		case "Arquero":
		return "arquero";break;
		case "Centromedio": case "Entreala derecho": case "Enterala izquierdo": case "Entreala": case "Entreala izquierdo": case "Polifuncional": case "Volante": case "Volante central": 
		return "mediocampista"; break;
		
		
		
	}
	
}

?>
