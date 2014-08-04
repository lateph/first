<?php
/* @var $this KategoriController */
/* @var $model Kategori */

$this->breadcrumbs=array(
	'Kategoris'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Kategori', 'url'=>array('index')),
	array('label'=>'Manage Kategori', 'url'=>array('admin')),
);

$this->adminTitle = 'Create Kategori';
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>