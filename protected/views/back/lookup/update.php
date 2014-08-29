<?php
/* @var $this LookupController */
/* @var $model Lookup */

$this->breadcrumbs=array(
	'Lookups'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Lookup', 'url'=>array('index')),
	array('label'=>'Create Lookup', 'url'=>array('create')),
	array('label'=>'View Lookup', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Lookup', 'url'=>array('admin')),
);
?>

<h1>Update Lookup <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>