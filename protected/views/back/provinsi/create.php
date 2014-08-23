<?php
/* @var $this ProvinsiController */
/* @var $model Provinsi */

$this->breadcrumbs=array(
	'Provinsis'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Provinsi', 'url'=>array('admin')),
);

$this->adminTitle = 'Create Provinsi';
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>