<?php
/* @var $this LookupController */
/* @var $model Lookup */

$this->breadcrumbs=array(
	'Lookups'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Lookup', 'url'=>array('index')),
	array('label'=>'Create Lookup', 'url'=>array('create')),
	array('label'=>'Update Lookup', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Lookup', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Lookup', 'url'=>array('admin')),
);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3>View Lookup #<?php echo $model->id; ?></h3>
    </div>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nama',
		'kode',
		'tipe',
		'posisi',
	),
     'htmlOptions' => array('class' => 'table table-hover'),
)); ?>
</div>
