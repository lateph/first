<?php
/* @var $this EventController */
/* @var $model Event */

$this->breadcrumbs=array(
	'Events'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Event', 'url'=>array('index')),
	array('label'=>'Create Event', 'url'=>array('create')),
);

$this->adminTitle = 'List Event';
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
		'title',
		'date_publish',
		//'description',
		'tags',
		'thumb',
		/*
		'type',
		'provinsi_id',
		'kabkota_id',
		'organizer_id',
		'status_bayar',
		'status_proses',
		'date_create',
		'user_create',
		'status',
		*/
		 array(
    			'class'=>'CButtonColumn',
         		 'template'=>'{view}{update}{galery}{delete}{jadwal}',
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
                    'galery'=>array(
                      'label' => '<i class="icon-film"></i>',
                                        'imageUrl' => false,
                      'url'=>'Yii::app()->createUrl("event/galery", array("id"=>$data->id))',
                    ),
                    'jadwal'=>array(
                      'label' => '<i class="icon-calendar"></i>',
                                        'imageUrl' => false,
                      'url'=>'Yii::app()->createUrl("event/jadwal", array("id"=>$data->id))',
                    ),
                ),
                 'htmlOptions' => array('style'=>'width:100px')
    		),
	),
)); ?>
