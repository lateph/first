<?php
/* @var $this EventController */
/* @var $model Event */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'event-form',
	'enableAjaxValidation'=>false,
		'htmlOptions'=>array('class'=>'form-horizontal', 'role'=>'form','enctype'=>'multipart/form-data'),
)); ?>

		<div class="alert alert-info">
		Fields with <span class="required">*</span> are required.
		<?php echo $form->errorSummary($model); ?>
	</div>

	<div class="form-group">            
            <?php echo $form->labelEx($model,'title',array('class'=>'col-sm-2 control-label')); ?>            
            <div class="col-sm-10">
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>512,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'title'); ?>
	</div></div>


	<div class="form-group">
		<?php echo $form->labelEx($model,'date_publish',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-5 input-group date form_datetime" data-date-format="yyyy-mm-dd hh:ii" data-link-field="date_publish">
				<?php echo $form->textField($model,'date_publish',array( 'class'=>'form-control')); ?>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-remove"></span>                        
                </span>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>                        
                </span>                           
            </div>
            <div class="col-sm-10 col-sm-offset-2 "> 
		<?php echo $form->error($model,'date_publish'); ?>                    
            </div>
	</div>

	<div class="form-group">               
	     <?php echo $form->labelEx($model,'description',array('class'=>'col-sm-2 control-label')); ?>
	     <div class="col-sm-10">
	        <?php
	            $this->widget('ext.redactor.ERedactorWidget',array(
	                'model'=>$model,
	                'attribute'=>'description',
	                'options'=>array(
	                    'fileUpload'=>Yii::app()->createUrl('event/fileUpload',array(
	                        'attr'=>'full',
	                    )),
	                    'fileUploadErrorCallback'=>new CJavaScriptExpression(
	                        'function(obj,json) { alert(json.error); }'
	                    ),
	                    'imageUpload'=>Yii::app()->createUrl('event/imageUpload',array(
	                        'attr'=>'full',
	                    )),
	                    'imageGetJson'=>Yii::app()->createUrl('event/imageList',array(
	                        'attr'=>'full',
	                    )),
	                    'imageUploadErrorCallback'=>new CJavaScriptExpression(
	                        'function(obj,json) { alert(json.error); }'
	                    ),
	                    'blurCallback'=>'js:function(){ 
	                      
	                    }',
	                    'style'=>'height:200px'
	                ),          
	            
	            ));
	        ?>
	         <?php echo $form->error($model,'description'); ?>
	     </div>   
	   </div>      

	<div class="form-group">            
		<?php echo $form->labelEx($model,'tags',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-10">
                <?php                               
                    echo CHtml::textField('Tags','',array('id'=>'tags','class'=>'form-control'));                
                        $this->widget('ext.select2.ESelect2',array(
                          'selector'=>'#tags',
                          'options'=>array(
                            'tags'=> Tags::loadItems(), // you tags list 
//                              'tokenSeparators' => array(',', ' ')
                          ),
                            'htmlOptions' => array(
                                'multiple' => 'multiple','class'=>'form-control'
                            ),
                        ));
                ?>                
		<?php echo $form->error($model,'tags'); ?>
            </div>                            
	</div> 

	<div class="form-group">            
            <?php echo $form->labelEx($model,'type',array('class'=>'col-sm-2 control-label')); ?>            
            <div class="col-sm-10">
		<?php echo $form->dropDownlist($model,'type',CHtml::listData(EventType::model()->findAll(),'id','nama'),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'type'); ?>
	</div></div> 

	<div class="form-group">            
            <?php echo $form->labelEx($model,'provinsi_id',array('class'=>'col-sm-2 control-label')); ?>            
            <div class="col-sm-10">
		<?php echo $form->dropDownlist($model,'provinsi_id',CHtml::listData(Provinsi::model()->findAll(),'id','nama'),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'provinsi_id'); ?>
	</div></div> 

	<div class="form-group">            
            <?php echo $form->labelEx($model,'kabkota_id',array('class'=>'col-sm-2 control-label')); ?>            
            <div class="col-sm-10">
		<?php echo $form->dropDownlist($model,'kabkota_id',CHtml::listData(Kabkota::model()->findAll(),'id','nama'),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'kabkota_id'); ?>
	</div></div> 

	<div class="form-group">            
            <?php echo $form->labelEx($model,'organizer_id',array('class'=>'col-sm-2 control-label')); ?>            
            <div class="col-sm-10">
		<?php echo $form->textField($model,'organizer_id',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'organizer_id'); ?>
	</div></div> 

	<div class="form-group">            
        <?php echo $form->labelEx($model,'status_bayar',array('class'=>'col-sm-2 control-label')); ?>            
            <div class="col-sm-10">
        <?php echo $form->DropDownList($model,'status_bayar',Lookup::items(Event::TIPE_STATUS_BAYAR),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'status_bayar'); ?>
	</div></div> 

	<div class="form-group">            
            <?php echo $form->labelEx($model,'status_proses',array('class'=>'col-sm-2 control-label')); ?>            
            <div class="col-sm-10">
         <?php echo $form->DropDownList($model,'status_proses',Lookup::items(Event::TIPE_STATUS_PROSES),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'status_proses'); ?>
	</div></div> 

	<div class="form-group">            
            <?php echo $form->labelEx($model,'status',array('class'=>'col-sm-2 control-label')); ?>            
            <div class="col-sm-10">
        <?php echo $form->DropDownList($model,'status',Lookup::items(Event::TIPE_STATUS),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div></div> 

	<div class="form-group ">            
            <div class="col-sm-10 col-sm-offset-2 "> 
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-danger')); ?>
            </div>
	</div> </div> 

<?php $this->endWidget(); ?>


<?php
Yii::app()->clientScript->registerScript('datetime-picker',"
	var cursim = ". json_encode($model->tags) .";
 	if(typeof(cursim) != 'undefined' && cursim !== null) {    
        temp = cursim.split(',');
        $('#tags').select2('val',temp);
    }  

	$('.form_datetime').datetimepicker({
        weekStart: 1,
        todayBtn:  1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                forceParse: 0,
        pickerPosition: 'bottom-left', 
        showMeridian: 0
    }); 
");