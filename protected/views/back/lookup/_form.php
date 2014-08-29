<?php
/* @var $this LookupController */
/* @var $model Lookup */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'lookup-form',
        'htmlOptions'=>array(
            'class'=>'form-horizontal','role'=>'form'
            ),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

         <div class="alert alert-info">
        Fields with <span class="required">*</span> are required.
	<?php echo $form->errorSummary($model); ?>
         </div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nama',array('class'=>'col-sm-2 control-label')); ?>
             <div class="col-sm-10">
		<?php echo $form->textField($model,'nama',array('size'=>60,'maxlength'=>64,'class'=>'form-control')); ?>
             </div>
		<?php echo $form->error($model,'nama'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'kode',array('class'=>'col-sm-2 control-label')); ?>
             <div class="col-sm-10">
		<?php echo $form->textField($model,'kode',array('size'=>8,'maxlength'=>8,'class'=>'form-control')); ?>
             </div>
		<?php echo $form->error($model,'kode'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'tipe',array('class'=>'col-sm-2 control-label')); ?>
             <div class="col-sm-10">
		<?php echo $form->textField($model,'tipe',array('size'=>32,'maxlength'=>32,'class'=>'form-control')); ?>
             </div>
		<?php echo $form->error($model,'tipe'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'posisi',array('class'=>'col-sm-2 control-label')); ?>
             <div class="col-sm-10">
		<?php echo $form->textField($model,'posisi',array('class'=>'form-control')); ?>
             </div>
		<?php echo $form->error($model,'posisi'); ?>
	</div>

	<div class="form-group">            
            <div class="col-sm-10 col-sm-offset-2 "> 
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-primary')); ?>
            </div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->