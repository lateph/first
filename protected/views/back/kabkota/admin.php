<?php
/* @var $this KabkotaController */
/* @var $model Kabkota */

$this->breadcrumbs=array(
	'Kabkotas'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create Kabkota', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#kabkota-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");

$this->adminTitle = 'List Kabupaten Kota';
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'post-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
                 'itemsCssClass' => 'table table-striped table-hover',   
                    // text format change    
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
		'kode',
		'kode_provinsi',
		'nama',
				array(
            			'class'=>'CButtonColumn',
                         'buttons'=>array (
                            'update'=> array(
                                'label' => '<i class="icon-edit"></i>',
                                                'imageUrl' => false,
                            ),
                            'view'=>array(
                                'label' => '<i class="icon-search"></i>',
                                                'imageUrl' => false,
                            ),
                            'delete'=>array(
                                'label' => '<i class="icon-trash"></i>',
                                                'imageUrl' => false,
                            ),
                        ),
                         'htmlOptions' => array('style'=>'width:80px')
            		),
	),
)); ?>
