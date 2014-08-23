<?php
/* @var $this KabkotaController */
/* @var $model Kabkota */

$this->breadcrumbs=array(
	'Kabkotas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create Kabkota', 'url'=>array('create')),
	array('label'=>'View Kabkota', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Kabkota', 'url'=>array('admin')),
);

$this->adminTitle = 'Update Kabkota';
?>


<?php $this->renderPartial('_form', array('model'=>$model)); ?>