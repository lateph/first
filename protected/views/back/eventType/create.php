<?php
/* @var $this EventTypeController */
/* @var $model EventType */

$this->breadcrumbs=array(
	'Event Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Event Type', 'url'=>array('admin')),
);


$this->adminTitle = 'Create Event Type';
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>