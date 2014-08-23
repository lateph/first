<?php
/* @var $this KabkotaController */
/* @var $model Kabkota */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'kabkota-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'form-horizontal', 'role'=>'form'), 
)); ?>

		<div class="alert alert-info">
		Fields with <span class="required">*</span> are required.
		<?php echo $form->errorSummary($model); ?>
	</div>

	<div class="form-group">            
            <?php echo $form->labelEx($model,'kode',array('class'=>'col-sm-2 control-label')); ?>            
            <div class="col-sm-10">
		<?php echo $form->textField($model,'kode',array('size'=>8,'maxlength'=>8,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'kode'); ?>
	</div></div>

	<div class="form-group">            
            <?php echo $form->labelEx($model,'kode_provinsi',array('class'=>'col-sm-2 control-label')); ?>            
            <div class="col-sm-10">
		<?php echo $form->dropDownList($model,'kode_provinsi',CHtml::listData(Provinsi::model()->findAll(),'kode','nama'),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'kode_provinsi'); ?>
	</div></div>

	<div class="form-group">            
            <?php echo $form->labelEx($model,'nama',array('class'=>'col-sm-2 control-label')); ?>            
            <div class="col-sm-10">
		<?php echo $form->textField($model,'nama',array('size'=>60,'maxlength'=>256,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'nama'); ?>
	</div></div>

	<div class="form-group ">            
            <div class="col-sm-10 col-sm-offset-2 "> 
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-danger')); ?>
            </div>
	</div>  


<?php $this->endWidget(); ?>

</div><!-- form -->