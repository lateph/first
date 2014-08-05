<?php
/* @var $this PostController */
/* @var $model Post */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'post-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
		'htmlOptions'=>array('class'=>'form-horizontal', 'role'=>'form','enctype'=>'multipart/form-data'),
)); ?>

	<div class="alert alert-info">
		Fields with <span class="required">*</span> are required.
		<?php echo $form->errorSummary($model); ?>
	</div>

	<div class="form-group">            
            <?php echo $form->labelEx($model,'judul',array('class'=>'col-sm-2 control-label')); ?>            
            <div class="col-sm-10">
			<?php echo $form->textField($model,'judul',array('size'=>60,'maxlength'=>150,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'judul'); ?>
		</div>
	</div>

	<div class="form-group">            
        <?php echo $form->labelEx($model,'slug',array('class'=>'col-sm-2 control-label')); ?>            
        <div class="col-sm-10">
			<?php echo $form->textField($model,'slug',array('size'=>60,'maxlength'=>150,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'slug'); ?>
		</div>
	</div>

	<div class="form-group">            
		<?php echo $form->labelEx($model,'idKategori',array('class'=>'col-sm-2 control-label')); ?>            
		<div class="col-sm-10">
			<?php echo $form->dropDownList($model,'idKategori',CHtml::listData(Kategori::model()->findAll(),'id','nama'),array('maxlength'=>200,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'idKategori'); ?>
		</div>                            
	</div>

	<div class="form-group">            
		<?php echo $form->labelEx($model,'kontent',array('class'=>'col-sm-2 control-label')); ?>            
		<div class="col-sm-10">
		<?php echo $form->textArea($model,'kontent',array('class'=>'form-control','id'=>'cleditor')); ?>
		<?php echo $form->error($model,'kontent'); ?>
		</div>
	</div>

	<div class="form-group">            
		          
		<div class="col-sm-10">
		
		<?php echo $form->error($model,'foto'); ?>
		</div>
	</div>

	 <div class="form-group">
        <?php echo $form->labelEx($model,'foto',array('class'=>'col-sm-2 control-label')); ?> 
        <div class="col-sm-10">
            <div class="fileupload fileupload-new" data-provides="fileupload">
            	<?php if ($model->foto): ?>
            		<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="<?php echo LUpload::thumbs('Post',$model->foto,'200x150'); ?>" alt="" /></div>
                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
            	<?php else: ?>
            		<div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;"></div>
            	<?php endif ?>
                <div>
                    <span class="btn btn-file btn-success"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><?php echo $form->fileField($model,'fotoFile'); ?>  </span>
                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a>
                </div>
            </div>
        </div>
    </div>

	<div class="form-group">            
		<?php echo $form->labelEx($model,'status',array('class'=>'col-sm-2 control-label')); ?>            
		<div class="col-sm-10">
		<?php echo $form->dropDownList($model,'status',Post::listStatus(),array('maxlength'=>200,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'status'); ?>
		</div>
	</div>

	<div class="form-group ">            
            <div class="col-sm-10 col-sm-offset-2 "> 
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-danger')); ?>
            </div>
	</div>  

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php
$this->renderPartial('/layouts/cleditor');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/assets/css/bootstrap-fileupload.min.css');

Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/assets/plugins/jasny/js/bootstrap-fileupload.js');

Yii::app()->clientScript->registerScript('slug',
        "
        $( '#Post_judul' ).keyup(function() {
            var Text = $(this).val();
             Text = Text.toLowerCase();
             Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
             $('#Post_slug').val(Text);  
        });                
        ",
        CClientScript::POS_READY);