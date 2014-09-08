

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
					'id'=>'event-form',
					'enableAjaxValidation'=>false,
				)); ?>
		      <fieldset>
				  <legend>Tambah Jadwal</legend>
				  <span class="help-block">Judul</span>
				  <?php echo $form->textField($jadwal,'judul',array("placeholder"=>"event title","class"=>"form-control input-small")); ?>
				  <span class="help-block">Dari</span>
				  <div class="input-group date form_datetime" data-date-format="yyyy-mm-dd hh:ii" data-link-field="from">
						<?php echo $form->textField($jadwal,'from',array( 'class'=>'form-control')); ?>
		                <span class="input-group-addon">
		                    <span class="glyphicon glyphicon-remove"></span>                        
		                </span>
		                <span class="input-group-addon">
		                    <span class="glyphicon glyphicon-th"></span>                        
		                </span>                           
		          </div>
				  <span class="help-block">Sampai</span>
				  <div class="input-group date form_datetime" data-date-format="yyyy-mm-dd hh:ii" data-link-field="end">
						<?php echo $form->textField($jadwal,'end',array( 'class'=>'form-control')); ?>
		                <span class="input-group-addon">
		                    <span class="glyphicon glyphicon-remove"></span>                        
		                </span>
		                <span class="input-group-addon">
		                    <span class="glyphicon glyphicon-th"></span>                        
		                </span>                           
		          </div>
				  <br>
				  <button id="add-event" type="button" class="btn btn-sm btn-default">Add Event</button>
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
	Yii::app()->clientScript->registerScript('calendar','
		$(function () { CalendarInit(); });
	');