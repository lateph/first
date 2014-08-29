<?php
/* @var $this EventTypeController */
/* @var $model EventType */

$this->breadcrumbs=array(
	'Event Types'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create Event Type', 'url'=>array('create')),
);


$this->adminTitle = 'List Event Type';
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
		'nama',
		'urut',
		array(
            'filter'=>Kategori::listStatus(),
            'name'=>'aktif',
            'value'=>'$data->getStatus()',
        ),
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
