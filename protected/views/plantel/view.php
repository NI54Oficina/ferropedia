<?php
/* @var $this PlantelController */
/* @var $model Plantel */

$this->breadcrumbs=array(
	'Plantels'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Plantel', 'url'=>array('index')),
	array('label'=>'Create Plantel', 'url'=>array('create')),
	array('label'=>'Update Plantel', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Plantel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Plantel', 'url'=>array('admin')),
);
?>

<h1>Plantel </h1>

<?php if(is_user_logged_in()){ ?><a href="<?php echo Yii::app()->request->baseUrl; ?>/plantel/update/<?php echo $model->id; ?>">Editar plantel</a><br><br><?php } ?>

<?php /*$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombre',
	),
));*/ ?>
<h2><?php echo $model->nombre; ?></h2>
<?php 
$jugadores= RelPlantelJugador::model()->findAllByAttributes(array("plantel"=>$model->id));
if(count($jugadores)>0){
?>
<ul>
<?php foreach($jugadores as $jugador){ 
	$id= $jugador->id;
	$jugador_data= Jugador::model()->findByPk($jugador->jugador);
	?>
	<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/jugador/<?php echo $jugador_data->id; ?>" ><?php if($jugador->camiseta!=0){ ?>  <?php echo $jugador->camiseta; ?> - <?php } ?><?php echo $jugador_data->nombre." ".$jugador_data->apellido; ?></a>
	<?php if(is_user_logged_in()){ ?>
	/ <a href="<?php echo Yii::app()->request->baseUrl; ?>/relPlantelJugador/delete/<?php echo $id; ?>" class="confirmation">Quitar del plantel</a> / 
	<a href="<?php echo Yii::app()->request->baseUrl; ?>/relPlantelJugador/update/<?php echo $id; ?>">Editar</a>
	<?php }
	?></li>
<?php }?>
</ul>
<?php } ?>
<?php if(false){  ?>
<form name="myform" action="<?php echo Yii::app()->request->baseUrl; ?>/relPlantelJugador/create" method="post">

  <input type="hidden" name="plantel"  value="<?php echo $model->id; ?>" />
  <button style="color:white;">Asignar</button>
</form>
<?php } ?>

<hr>
<hr>

<?php if(is_user_logged_in()){ ?>
<h3>Agregar Jugadores al plantel</h3>
<?php
$plantel= $model->id;
 $model=new RelPlantelJugador;
 $model->plantel= $plantel;
 ?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'rel-plantel-jugador-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<input id="RelPlantelJugador_plantel" type="hidden" name="RelPlantelJugador[plantel]" value="<?php echo $model->plantel; ?>" />
	
	<div class="row">
		<?php echo $form->labelEx($model,'jugador'); ?>
		<?php //echo $form->textField($model,'jugador'); ?>
		<input id="RelPlantelJugador_jugador2" type="text" placeholder="" class="form-control"/>
		<input type="hidden" id="RelPlantelJugador_jugador" type="text" name="RelPlantelJugador[jugador]" />
		<?php echo $form->error($model,'jugador'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'campo'); ?>
		<label>Titular</label>
		<?php //echo $form->textField($model,'campo'); ?>
		<select name="RelPlantelJugador[campo]" id="RelPlantelJugador_campo" class="form-control">
		<option value="1">Si</option>
		<option value="0">Suplente</option>
		</select>
		<?php echo $form->error($model,'campo'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'camiseta'); ?>
		<?php echo $form->textField($model,'camiseta',array('size'=>60,'maxlength'=>300,"class"=>"form-control")); ?>
		<?php echo $form->error($model,'camiseta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'detalle'); ?>
		<?php echo $form->textField($model,'detalle',array('size'=>60,'maxlength'=>300,"class"=>"form-control")); ?>
		<?php echo $form->error($model,'detalle'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar',array("class"=>"admin-submit")); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
		
		var data = [
			//{ value: "AL", label: "Alabama" },
			<?php
			$jugadores= Jugador::model()->findAll();
			foreach($jugadores as $jugador){ ?>
				{value:"<?php echo $jugador->id; ?>",label: "<?php echo $jugador->nombre." ".$jugador->apellido; ?>"},
			<?php } ?>
		];
		jQuery(function() {
			
			jQuery("#RelPlantelJugador_jugador2").autocomplete({
				source: data,
				focus: function(event, ui) {
					// prevent autocomplete from updating the textbox
					event.preventDefault();
					// manually update the textbox
					jQuery(this).val(ui.item.label);
				},
				select: function(event, ui) {
					// prevent autocomplete from updating the textbox
					event.preventDefault();
					// manually update the textbox and hidden field
					jQuery(this).val(ui.item.label);
					jQuery("#RelPlantelJugador_jugador").val(ui.item.value);
				}
			});
		});
	</script>
<?php } ?>

