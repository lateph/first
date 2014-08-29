<?php
/* @var $this EventController */
/* @var $data Event */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_publish')); ?>:</b>
	<?php echo CHtml::encode($data->date_publish); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tags')); ?>:</b>
	<?php echo CHtml::encode($data->tags); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('thumb')); ?>:</b>
	<?php echo CHtml::encode($data->thumb); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('provinsi_id')); ?>:</b>
	<?php echo CHtml::encode($data->provinsi_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kabkota_id')); ?>:</b>
	<?php echo CHtml::encode($data->kabkota_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('organizer_id')); ?>:</b>
	<?php echo CHtml::encode($data->organizer_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status_bayar')); ?>:</b>
	<?php echo CHtml::encode($data->status_bayar); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status_proses')); ?>:</b>
	<?php echo CHtml::encode($data->status_proses); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_create')); ?>:</b>
	<?php echo CHtml::encode($data->date_create); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_create')); ?>:</b>
	<?php echo CHtml::encode($data->user_create); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	*/ ?>

</div>