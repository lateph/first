<?php
/* @var $this KabkotaController */
/* @var $model Kabkota */

$this->breadcrumbs=array(
	'Kabkotas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Kabkota', 'url'=>array('admin')),
);


$this->adminTitle = 'Create Kabkota';
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>