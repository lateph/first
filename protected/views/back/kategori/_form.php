<?php
/* @var $this KategoriController */
/* @var $model Kategori */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'kategori-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'form-horizontal', 'role'=>'form'), 
)); ?>

	<div class="alert alert-info">
		Fields with <span class="required">*</span> are required.
		<?php echo $form->errorSummary($model); ?>
	</div>

	<div class="form-group">            
            <?php echo $form->labelEx($model,'nama',array('class'=>'col-sm-2 control-label')); ?>            
            <div class="col-sm-10">
			<?php echo $form->textField($model,'nama',array('size'=>60,'maxlength'=>200,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'nama'); ?>
		</div>                            
	</div>

    <div class="form-group">            
        <?php echo $form->labelEx($model,'parent.nama',array('class'=>'col-sm-2 control-label')); ?>            
        <div class="col-sm-10">
            <?php echo $form->dropDownList($model,'idParent',Kategori::listParent($model->id),array('maxlength'=>200,'class'=>'form-control')); ?>
            <?php echo $form->error($model,'idParent'); ?>
        </div>                            
    </div>

	<div class="form-group">            
        <?php echo $form->labelEx($model,'aktif',array('class'=>'col-sm-2 control-label')); ?>            
        <div class="col-sm-10">
    		<?php echo $form->dropDownList($model,'aktif',Kategori::listStatus(),array('maxlength'=>200,'class'=>'form-control')); ?>
    		<?php echo $form->error($model,'aktif'); ?>
    	</div>                            
	</div>

	<div class="form-group">            
        <?php echo $form->labelEx($model,'urut',array('class'=>'col-sm-2 control-label')); ?>            
        <div class="col-sm-10">
			<?php echo $form->textField($model,'urut',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'urut'); ?>
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
Yii::app()->clientScript->registerScript('slug',
        "
        $( '#Kategori_nama' ).keyup(function() {
            var Text = $(this).val();
             Text = Text.toLowerCase();
             Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
             $('#Kategori_slug').val(Text);  
        });                
        ",
        CClientScript::POS_READY);

Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/assets/css/bootstrap-fileupload.min.css');

Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/assets/plugins/jasny/js/bootstrap-fileupload.js',  CClientScript::POS_END);
