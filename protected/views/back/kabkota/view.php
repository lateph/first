<?php
/* @var $this KabkotaController */
/* @var $model Kabkota */

$this->breadcrumbs=array(
	'Kabkotas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Create Kabkota', 'url'=>array('create')),
	array('label'=>'Update Kabkota', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Kabkota', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Kabkota', 'url'=>array('admin')),
);
?>

<h1>View Kabkota #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'kode',
		'kode_provinsi',
		'nama',
	),
	 'htmlOptions' => array('class' => 'table table-hover'),  
)); ?>
