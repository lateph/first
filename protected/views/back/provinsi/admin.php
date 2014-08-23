<?php
/* @var $this ProvinsiController */
/* @var $model Provinsi */

$this->breadcrumbs=array(
	'Provinsis'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create Provinsi', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#provinsi-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
$this->adminTitle = 'List Provisi';
?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
'id'=>'kategori-grid',
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
