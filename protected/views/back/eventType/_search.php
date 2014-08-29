<?php
/* @var $this EventTypeController */
/* @var $model EventType */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nama'); ?>
		<?php echo $form->textField($model,'nama',array('size'=>60,'maxlength'=>512)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'parent_type'); ?>
		<?php echo $form->textField($model,'parent_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'urut'); ?>
		<?php echo $form->textField($model,'urut'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'aktif'); ?>
		<?php echo $form->textField($model,'aktif',array('size'=>8,'maxlength'=>8)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->