<style>


#tablePais td{
	
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


<h1>Administrar torneos de <span class="sub-verde"><?php echo $jugador->nombre." ".$jugador->apellido; ?></span></h1>
<a href="<?php echo Yii::app()->request->baseUrl; ?>/jugador/<?php echo $jugador->id; ?>">Volver</a>

<table id="tablePais" style="width:100%;">
<thead> <tr>
            <th style="min-width:50px;">Año</th>
            <th style="min-width:50px;">Torneo</th>
            <th style="min-width:50px;">Partidos Jugados</th>
            <th style="min-width:50px;">Coles convertidos</th>
            <th style="min-width:70px;"></th>
        </tr>
	</thead>
<tbody>
<?php 

foreach($torneos as $notas){
	
	$dataT= explode("/",$notas->texto);
	if(strtolower($dataT[0])=="total"){
		echo " <td><strong>".$dataT[0]."</strong></td>";
		echo " <td>"." "."</td>";
		echo " <td>".$dataT[1]."</td>";
		echo " <td>".$dataT[2]."</td>";
	}else{
		echo " <td>".$dataT[0]."</td>";
		echo " <td>".$dataT[1]."</td>";
		echo " <td>".$dataT[2]."</td>";
		echo " <td>".$dataT[3]."</td>";
	}
	
	echo " <td class='btn-tablas'>";
	
		echo "<a href='".Yii::app()->getBaseUrl(true)."/jugador/editTorneo/".$notas->id."'><span class='glyphicon glyphicon-pencil'></span></a>";
			
			if(strtolower($dataT[0])!="total"){
			echo "<p class='delete' href='".Yii::app()->getBaseUrl(true)."/dataExtra/delete/".$notas->id."'><span class='glyphicon glyphicon-trash'></span> </p>";
			}
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

</script>

