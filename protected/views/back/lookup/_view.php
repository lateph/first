<?php
/* @var $this LookupController */
/* @var $data Lookup */
?>

<div class="well well-sm">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama')); ?>:</b>
	<?php echo CHtml::encode($data->nama); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode')); ?>:</b>
	<?php echo CHtml::encode($data->kode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipe')); ?>:</b>
	<?php echo CHtml::encode($data->tipe); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('posisi')); ?>:</b>
	<?php echo CHtml::encode($data->posisi); ?>
	<br />


</div>