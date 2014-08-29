<?php
/* @var $this EventTypeController */
/* @var $model EventType */

$this->breadcrumbs=array(
	'Event Types'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Create Event Type', 'url'=>array('create')),
	array('label'=>'Update Event Type', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Event Type', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Event Type', 'url'=>array('admin')),
);
?>

<h1>View EventType #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nama',
		'urut',
		array(
			'name'=>'aktif',
			'value'=>$model->getStatus(),
		),
	),
	 'htmlOptions' => array('class' => 'table table-hover'),  
)); ?>
