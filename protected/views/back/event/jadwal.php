

        <!--PAGE CONTENT -->

                <div class="row">
                    <div class="col-lg-12">


                        <h2> Full Calendar </h2>



                    </div>
                </div>

                <hr />
                  <div class="row">
                    <div class="col-lg-12">

                <div class="box">
  <header>
      <h5>Calendar</h5>
  </header>
  <div class="body">
      <div class="row">
	  <div class="col-lg-3">
	      <div class="well well-small">
		  <div id="add-event-form">
		  	  <?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'jadwal-form',
					'enableAjaxValidation'=>false,
				)); ?>
		      <fieldset>
				  <legend>Tambah Jadwal</legend>
				  <span class="help-block">Judul</span>
				  <?php echo $form->textField($jadwal,'judul',array("placeholder"=>"Title","class"=>"form-control input-small")); ?>
				  <?php echo $form->error($jadwal,'judul',array('class'=>'text-danger')); ?>
				  <span class="help-block">Dari</span>
				  <div class="input-group date form_datetime" data-date-format="yyyy-mm-dd hh:ii" data-link-field="from">
						<?php echo $form->textField($jadwal,'from',array( 'class'=>'form-control',"placeholder"=>"From")); ?>
		                <span class="input-group-addon">
		                    <span class="glyphicon glyphicon-remove"></span>                        
		                </span>
		                <span class="input-group-addon">
		                    <span class="glyphicon glyphicon-th"></span>                        
		                </span>                           
		          </div>
		          <?php echo $form->error($jadwal,'from',array('class'=>'text-danger')); ?>
				  <span class="help-block">Sampai</span>
				  <div class="input-group date form_datetime" data-date-format="yyyy-mm-dd hh:ii" data-link-field="end">
						<?php echo $form->textField($jadwal,'end',array( 'class'=>'form-control',"placeholder"=>"End")); ?>
		                <span class="input-group-addon">
		                    <span class="glyphicon glyphicon-remove"></span>                        
		                </span>
		                <span class="input-group-addon">
		                    <span class="glyphicon glyphicon-th"></span>                        
		                </span>                           
		          </div>
		          <?php echo $form->error($jadwal,'end',array('class'=>'text-danger')); ?>
				  
		          <span class="help-block">Pengulangan</span>
				  <?php echo $form->dropDownlist($jadwal,'repeat',AddJadwalForm::listRepeat(),array("empty"=>"None","class"=>"form-control input-small")); ?>
				  <?php echo $form->error($jadwal,'repeat',array('class'=>'text-danger')); ?>

				  <span class="help-block pengulangan-0">Batas Pengulangan</span>
				  <div class="input-group date form_datetime pengulangan-0" data-date-format="yyyy-mm-dd hh:ii" data-link-field="repeatEndDate">
						<?php echo $form->textField($jadwal,'repeatEndDate',array( 'class'=>'form-control',"placeholder"=>"Batas Pengulangan")); ?>
		                <span class="input-group-addon">
		                    <span class="glyphicon glyphicon-remove"></span>                        
		                </span>
		                <span class="input-group-addon">
		                    <span class="glyphicon glyphicon-th"></span>                        
		                </span>                           
		          </div>
		          <?php echo $form->error($jadwal,'repeatEndDate',array('class'=>'text-danger pengulangan-0')); ?>
				  <br>
				  <button id="add-event" type="submit" class="btn btn-sm btn-default">Tambah Jadwal</button>
		      </fieldset>
		      <?php $this->endWidget(); ?>
		  </div>

	      </div>
	      <div class="well well-small">
		  <h4>Draggable Events</h4>
		  <ul id='external-events' class="list-inline">
		      <li class="external-event"><span class="label label-default">My Event 1</span></li>
		      <li class="external-event"><span class="label label-danger">My Event 2</span></li>
		      <li class="external-event"><span class="label label-success">My Event 3</span></li>
		      <li class="external-event"><span class="label label-warning">My Event 4</span></li>
		      <li class="external-event"><span class="label label-info">My Event 5</span></li>
		  </ul>

		  <label class="checkbox inline" for='drop-remove'>
		      <input type="checkbox" id="drop-remove">
		      remove after drop
		  </label>
	      </div>
	  </div>
	  <div id="calendar" class="col-lg-9"></div>
      </div>
  </div>


            </div>

</div>
                      </div>
 
         <!--PAGE CONTENT -->

<?php 
//registerCssFile registerScriptFile
	Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/assets/plugins/fullcalendar-1.6.2/fullcalendar/fullcalendar.css');
	Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/assets/css/calendar.css');
	Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/assets/plugins/fullcalendar-1.6.2/fullcalendar/fullcalendar.min.js');
	Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/assets/js/jquery-ui.min.js');
	Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/assets/js/calendarInit.js');
	
	$jadwals = array();
	foreach ($model->jadwals as $key => $value) {
		$jadwals[] = array(
			'title'=>$value->judul,
			'start'=>$value->from,
			'end'=>$value->end,
		);
	}
	Yii::app()->clientScript->registerScript('calendar','
		EVENTS_DATA = '.CJSON::encode($jadwals).';
		$(function () { CalendarInit(); });
		function hiddenPengulangan(){
			var val = $("#AddJadwalForm_repeat").val();
			if(val == 0){
				$(".pengulangan-0").hide();
			}
			else{
				$(".pengulangan-0").show();
			}
		}
		$("#AddJadwalForm_repeat").change(hiddenPengulangan);
		hiddenPengulangan();
	');
	Yii::app()->clientScript->registerScript('datetime-picker',"
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