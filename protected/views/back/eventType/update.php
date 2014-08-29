<?php
/* @var $this EventTypeController */
/* @var $model EventType */

$this->breadcrumbs=array(
	'Event Types'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create Event Type', 'url'=>array('create')),
	array('label'=>'View Event Type', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Event Type', 'url'=>array('admin')),
);

$this->adminTitle = 'Create Event Type';
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>