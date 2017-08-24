<?php
/* @var $this JugadorController */
/* @var $model Jugador */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'jugador-form',
	'enableAjaxValidation'=>false,
)); ?>

	

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>300,"class"=>"form-control")); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'apellido'); ?>
		<?php echo $form->textField($model,'apellido',array('size'=>60,'maxlength'=>300,"class"=>"form-control")); ?>
		<?php echo $form->error($model,'apellido'); ?>
	</div>

	
	<?php if(false){ ?>
	<div class="form-group">
		<?php echo $form->labelEx($model,'nacimiento'); ?>
		<?php //echo $form->textField($model,'nacimiento',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'nacimiento'); ?>
		<div class="input-group date form_date col-md-5" data-date="<?php echo date('d/m/Y', time()) ?>" data-date-format="dd mm yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input class="form-control" placeholder="Elegí Fecha" size="16" type="text" value="<?php if(isset($model->nacimiento)) echo $model->nacimiento; ?>" readonly >
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
				<input type="hidden" id="dtp_input2" value="<?php if(isset($model->nacimiento)) echo $model->nacimiento; ?>"  name="Jugador[nacimiento]" />
            </div>
			
			
		
	   <div class="form-group">
		<?php //echo $form->labelEx($model,'defuncion'); ?>
		<?php //echo $form->textField($model,'nacimiento',array('size'=>60,'maxlength'=>300)); ?>
		<label>Defunción</label>
		<div class="input-group date form_date col-md-5" data-date="<?php echo date('d/m/Y', time()) ?>" data-date-format="dd mm yyyy" data-link-field="ddtp_input2" data-link-format="yyyy-mm-dd">
                    <input class="form-control" placeholder="Elegí Fecha" size="16" type="text" value="<?php if(isset($model->defuncion)&&$model->defuncion!=0) echo $model->defuncion; ?>" readonly >
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
				<input type="hidden" id="ddtp_input2" value="<?php if(isset($model->defuncion)&&$model->defuncion!=0) echo $model->defuncion; ?>"  name="Jugador[defuncion]" />
            </div>
			
			
		
		<script>
			jQuery('.form_date').datetimepicker({
			language:  'ar',
			weekStart: 0,
			todayBtn:  1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 2,
			minView: 2,
			forceParse: 0
			});
			</script>
	<?php } ?>
	
	<div class="form-group">
		<?php echo $form->labelEx($model,'nacimiento'); ?>
		<?php echo $form->textField($model,'nacimiento',array('size'=>60,'maxlength'=>300,"class"=>"form-control")); ?>
		<?php echo $form->error($model,'nacimiento'); ?>
	</div>

	<?php if(false){ ?>
	<div class="form-group">
		<?php echo $form->labelEx($model,'ciudad_natal'); ?>
		
		<?php echo $form->error($model,'ciudad_natal'); ?>
	</div>
	<?php } ?>
	
	
	<div class="form-group">
		<?php echo $form->labelEx($model,'defuncion'); ?>
		<?php echo $form->textField($model,'defuncion',array('size'=>60,'maxlength'=>300,"class"=>"form-control")); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'puesto'); ?>
		<?php echo $form->textField($model,'puesto',array('size'=>60,'maxlength'=>100,"class"=>"form-control")); ?>
		<?php echo $form->error($model,'puesto'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'detalle_puesto'); ?>
		<?php echo $form->textField($model,'detalle_puesto',array('size'=>60,'maxlength'=>300,"class"=>"form-control")); ?>
		<?php echo $form->error($model,'detalle_puesto'); ?>
	</div>
	
	<div class="form-group">
		<label for="Partido_debut">Debut</label>
		<input size="60" maxlength="300" class="form-control" name="Partido[debut]" id="Partido_debut" type="text" value="<?php if(isset($partido['debut'])){echo $partido['debut'];} ?>">
	</div>
	
	<div class="form-group">
		<label for="Partido_ultimo">Ultimo Partido</label>
		<input size="60" maxlength="300" class="form-control" name="Partido[ultimo]" id="Partido_ultimo" type="text" value="<?php if(isset($partido['ultimo'])){echo $partido['ultimo'];} ?>">
	</div>

	<div class="form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->