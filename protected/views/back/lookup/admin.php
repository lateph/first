<?php
/* @var $this LookupController */
/* @var $model Lookup */

$this->breadcrumbs=array(
	'Lookups'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Lookup', 'url'=>array('index')),
	array('label'=>'Create Lookup', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#lookup-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Lookups</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'lookup-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'itemsCssClass' => 'table table-striped table-hover',
        'pagerCssClass'=>'text-center',    
        'pager'=>array(    
            'header'=>'',
            'prevPageLabel'=>'<',
            'nextPageLabel'=>'>',
                'selectedPageCssClass' => 'active',         
                'hiddenPageCssClass' => '',                        
                'htmlOptions'=>array(
                    'class'=>'pagination',
                ),                  
            ),   
	'columns'=>array(
		'id',
		'nama',
		'kode',
		'tipe',
		'posisi',
		array(
			'class'=>'CButtonColumn',
                        'htmlOptions' => array('style'=>'width:75px;')
		),
	),
)); ?>
