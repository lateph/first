<?php
/* @var $this EventTypeController */
/* @var $data EventType */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama')); ?>:</b>
	<?php echo CHtml::encode($data->nama); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('parent_type')); ?>:</b>
	<?php echo CHtml::encode($data->parent_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('urut')); ?>:</b>
	<?php echo CHtml::encode($data->urut); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('aktif')); ?>:</b>
	<?php echo CHtml::encode($data->aktif); ?>
	<br />


</div>