<?php
/* @var $this StaffController */
/* @var $model Staff */

$this->breadcrumbs=array(
	'Staffs'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Staff', 'url'=>array('index')),
	array('label'=>'Create Staff', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#staff-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar directores técnicos</h1>

<?php if(false){ ?>
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
	'id'=>'staff-grid',
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
		'defuncion',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

<?php  } ?>


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
            <th style="min-width:10px;">Activo</th>
            
            <th style="min-width:70px;"></th>
        </tr>
	</thead>
<tbody>
<?php 

foreach($model as $notas){
	
	
	echo "<tr> <td>".$notas->id."</td>";
	echo " <td>".$notas->nombre."</td>";
	echo " <td>".$notas->apellido."</td>";
	echo " <td>".$notas->nacimiento."</td>";
	if($notas->activo){
		echo " <td>Sí</td>";
	}else{
		echo " <td>No</td>";
	}
	
	echo " <td class='btn-tablas'><a href='".Yii::app()->getBaseUrl(true)."/staff/".$notas->id."'><span class='glyphicon glyphicon-pencil'></span> </a>";
	
		//echo "<a href='".Yii::app()->getBaseUrl(true)."/ar/jugador/".$notas->id."'><span class='glyphicon glyphicon-pencil'></span></a>";

			echo "<p style='display:inline-block;margin-left:10px;' class='delete' href='".Yii::app()->getBaseUrl(true)."/staff/delete/".$notas->id."'><span class='glyphicon glyphicon-trash'></span> </p>";
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
		
		if (localStorage.getItem("pageTecnico") === null) {
		
		}	else{
			if(parseInt(localStorage["pageTecnico"] ) <table.page.info().pages){
				table.page( parseInt(localStorage["pageTecnico"] )).draw( false );
			}else{
				localStorage["pageTecnico"]=parseInt(localStorage["pageTecnico"])-1;
				table.page( parseInt(localStorage["pageTecnico"] )).draw( false );
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
		localStorage["pageTecnico"]= table.page();
	});


$(window).load(function(){
	$("#tablePais").css("display","block");
	setTimeout(function(){$("#tablePais").css("opacity","1");
	},1000);
	if (localStorage.getItem("pageTecnico") === null) {
		
		}	else{
			if(parseInt(localStorage["pageTecnico"] ) <table.page.info().pages){
				table.page( parseInt(localStorage["pageTecnico"] )).draw( false );
			}else{
				localStorage["pageTecnico"]=parseInt(localStorage["pageTecnico"])-1;
				table.page( parseInt(localStorage["pageTecnico"] )).draw( false );
			}
		}
	});

</script>