<?php
/* @var $this ProvinsiController */
/* @var $model Provinsi */

$this->breadcrumbs=array(
	'Provinsis'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create Provinsi', 'url'=>array('create')),
	array('label'=>'View Provinsi', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Provinsi', 'url'=>array('admin')),
);


$this->adminTitle = 'Update Provinsi';
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>