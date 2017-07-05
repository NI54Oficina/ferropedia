<?php
/* @var $this RelPlantelJugadorController */
/* @var $model RelPlantelJugador */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'rel-plantel-jugador-form',
	'enableAjaxValidation'=>false,
)); ?>

	

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'plantel'); ?>
		<?php //echo $form->textField($model,'plantel'); ?>
		<input id="RelPlantelJugador_plantel2" type="text" class="form-control" name="plantel" value="<?php $plantel= Plantel::model()->findByPk($model->plantel); echo $plantel->nombre; ?>"  disabled />
		<input id="RelPlantelJugador_plantel" type="hidden" name="RelPlantelJugador[plantel]" value="<?php echo $model->plantel; ?>" />
		<?php echo $form->error($model,'plantel'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'jugador'); ?>
		<?php //echo $form->textField($model,'jugador'); ?>
		<input id="RelPlantelJugador_jugador2" type="text" placeholder="" class="form-control" <?php if(isset($model->jugador)){ ?> disabled value="<?php 
		$jugador= Jugador::model()->findByPk($model->jugador);
		echo $jugador->nombre." ".$jugador->apellido;
		?>" <?php } ?> />
		<input type="hidden" id="RelPlantelJugador_jugador" type="text" name="RelPlantelJugador[jugador]" <?php if(isset($model->jugador)){ ?> value="<?php echo $model->jugador; ?>"<?php } ?> />
		<?php echo $form->error($model,'jugador'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'campo'); ?>
		<?php //echo $form->textField($model,'campo'); ?>
		<select name="RelPlantelJugador[campo]" id="RelPlantelJugador_campo" class="form-control">
		<option value="1" <?php if(isset($model->campo)&&$model->campo==1){echo "selected";} ?>>Titular</option>
		<option value="0" <?php if(isset($model->campo)&&$model->campo==0){echo "selected";} ?>>Suplente</option>
		</select>
		<?php echo $form->error($model,'campo'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'camiseta'); ?>
		<?php echo $form->textField($model,'camiseta',array('size'=>3,'maxlength'=>3,"class"=>"form-control")); ?>
		<?php echo $form->error($model,'camiseta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'detalle'); ?>
		<?php echo $form->textField($model,'detalle',array('size'=>60,'maxlength'=>300,"class"=>"form-control")); ?>
		<?php echo $form->error($model,'detalle'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar'); ?>
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