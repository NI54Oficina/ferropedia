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

<h1>Administrar Jugadores</h1>



<?php if(false){ ?>
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
} ?>

<?php 
/*
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
*/
?>

<style>


#tablePais {
	display:none;
	opacity:0;
	transition:1s;
}
.delete{
	color:#337ab7;
	cursor:pointer;
}
.delete:hover{
	color:#23527c;
	text-decoration:underline;
}
</style>



<table id="tablePais" style="width:100%;">
<thead> <tr>
            <th style="min-width:10px;">ID</th>
            <th style="min-width:100px;">Nombre</th>
            <th style="min-width:100px;">Apellido</th>
            <th style="min-width:100px;">Fecha y lugar de nacimiento</th>
            <th style="min-width:100px;">Puesto</th>
            <th style="min-width:10px;">Activo</th>
            <th style="min-width:70px;"></th>
        </tr>
	</thead>
<tbody>
<?php 

foreach($model as $notas){
	
	echo "<tr>";
	echo " <td>".$notas->id."</td>";
	echo " <td>".$notas->nombre."</td>";
	echo " <td>".$notas->apellido."</td>";
	echo " <td>".$notas->nacimiento."</td>";
	echo " <td>".$notas->puesto."</td>";
	if($notas->activo){
		echo " <td>Sí</td>";
	}else{
		echo " <td>No</td>";
	}
	echo " <td class='btn-tablas'><a href='".Yii::app()->getBaseUrl(true)."/jugador/".$notas->id."'><span class='glyphicon glyphicon-pencil'></span> </a>";
	
		//echo "<a href='".Yii::app()->getBaseUrl(true)."/ar/jugador/".$notas->id."'><span class='glyphicon glyphicon-pencil'></span></a>";

			echo "<p style='display:inline-block;margin-left:10px;' class='delete' href='".Yii::app()->getBaseUrl(true)."/jugador/delete/".$notas->id."'><span class='glyphicon glyphicon-trash'></span> </p>";
	echo "</td></tr>";
	
}

?>
</tbody>
</table>

<script>
var table;
$(document).ready(function(){
    table=$('#tablePais').DataTable({"columnDefs": [ {
"targets": 2,
"orderable": false
} ]});
	$("[type='search']").attr("placeholder","Busqueda");
});

jQuery(document).on('click','.delete',function() {
	if(!confirm('Are you sure you want to delete this item?')) return false;
	$(".loading").show();
	var row=this;
	
	$.post( $(this).attr('href'), function( data ) {
		console.log("borrado");
		 table
        .row( $(row).parents('tr') )
        .remove()
        .draw();
		$(".loading").hide();
		
		if (localStorage.getItem("pageJugador") === null) {
		
		}	else{
			if(parseInt(localStorage["pageJugador"] ) <table.page.info().pages){
				table.page( parseInt(localStorage["pageJugador"] )).draw( false );
			}else{
				localStorage["pageJugador"]=parseInt(localStorage["pageJugador"])-1;
				table.page( parseInt(localStorage["pageJugador"] )).draw( false );
			}
		}
	});
	
	
	/*jQuery('#notas-grid').yiiGridView('update', {
		type: 'POST',
		url: jQuery(this).attr('href'),
		success: function(data) {
			//jQuery('#notas-grid').yiiGridView('update');
			//afterDelete(th, true, data);
			console.log("borradoooo");
		},
		error: function(XHR) {
			return afterDelete(th, false, XHR);
		}
	});*/
	//return false;
	


});

$(document).on("click",".pagination",function(){
		console.log("pagina?");
		localStorage["pageJugador"]= table.page();
	});

$(window).load(function(){
	$("#tablePais").css("display","block");
	setTimeout(function(){$("#tablePais").css("opacity","1");
	},1000);
	if (localStorage.getItem("pageJugador") === null) {
		
		}	else{
			if(parseInt(localStorage["pageJugador"] ) <table.page.info().pages){
				table.page( parseInt(localStorage["pageJugador"] )).draw( false );
			}else{
				localStorage["pageJugador"]=parseInt(localStorage["pageJugador"])-1;
				table.page( parseInt(localStorage["pageJugador"] )).draw( false );
			}
		}
});

</script>
