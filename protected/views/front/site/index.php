<style>

#items {}

#items .item {
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    background: linear-gradient(to bottom, #F6F6F6 0%, #EAEAEA 100%) repeat scroll 0 0 transparent;
    border-radius: 4px 4px 4px 4px;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.15), 0 2px 1px rgba(0, 0, 0, 0.1), 0 3px 1px rgba(0, 0, 0, 0.05);
    text-shadow: 0 1px 0 #DDDDDD;
    width: 270px;
    margin: 10px;
    float: left;
}

#items .item .item-content {
  padding: 10px;
}

#items .item .picture .description {
    margin-top: 10px;
}

#items .item .meta span {
    font-size: 12px !important;
    line-height: 16px !important;
    margin-right: 5px;
}

#items .item .picture {
    display: block;
    position: relative;
    z-index: 5;
    border-top: 1px solid #999999;
    border-radius: 4px 4px 4px 4px;
}

#items .item .picture a.image {
    display: block;
    height: auto;
    width: 100%;
}

#items .item .picture img {
    border-radius: 2px 2px 0px 0px;
    height: auto;
    position: relative;
    width: 100%;
    z-index: -1;
}

.picture img {
    height: auto;
    width: 100%;
}
</style>

<div class="col-md-3">
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Filter Pencarian</h3>
  </div>

  <div class="panel-body left-searchbar">
  	<form role="form" class="left-searchbar-form">
  		<div class="form-group">
  			<label style="width:100%">Enabled Filter</label>
  			<span class="label label-danger" id="filter-provinsi" style='display:none'><i class="glyphicon glyphicon-remove remove" class="remove-filter"></i><span class="text-filter"></span></span>
  		  <span class="label label-danger" id="filter-eventtype" style='display:none'><i class="glyphicon glyphicon-remove remove" class="remove-filter"></i><span class="text-filter"></span></span>
        <span class="label label-danger" id="filter-from" style='display:none'><i class="glyphicon glyphicon-remove remove" class="remove-filter"></i><span class="text-filter"></span></span>
        <span class="label label-danger" id="filter-end" style='display:none'><i class="glyphicon glyphicon-remove remove" class="remove-filter"></i><span class="text-filter"></span></span>
      </div>
  		<div class="form-group">
		    <label for="exampleInputPassword1">Provinsi</label>
        <?php echo CHtml::dropDownList('kode_provinsi','',CHtml::listData(Provinsi::model()->findAll(),'id','nama'),array('class'=>'form-control','empty'=>'- Provinsi -','id'=>'provinsi')); ?>
		 </div>
	 
		 <div class="form-group">
		    <label for="exampleInputPassword1">Type</label>
		    <?php echo CHtml::dropDownList('type','',CHtml::listData(EventType::model()->findAll(),'id','nama'),array('class'=>'form-control','empty'=>'- Event Type -','id'=>'eventtype')); ?>
		 </div>

  		<div class="form-group">
  			<label>Even</label>
        <?php echo CHtml::textField('search','',array("placeholder"=>"Even", "class"=>"form-control",'search')); ?>
  		</div>

      <div class="form-group">
        <span class="help-block">Dari</span>
        <div class="input-group date form_datetime_from" data-date-format="yyyy-mm-dd hh:ii" data-link-field="from">
             <?php echo CHtml::textField('from','',array( 'class'=>'form-control',"placeholder"=>"Dari")); ?>
              <span class="input-group-addon">
                  <span class="glyphicon glyphicon-remove"></span>                        
              </span>
              <span class="input-group-addon">
                  <span class="glyphicon glyphicon-th"></span>                        
              </span>                           
        </div>
      </div>

      <div class="form-group">
        <span class="help-block">Sampai</span>
        <div class="input-group date form_datetime_end" data-date-format="yyyy-mm-dd hh:ii" data-link-field="end">
             <?php echo CHtml::textField('end','',array( 'class'=>'form-control',"placeholder"=>"Sampai")); ?>
              <span class="input-group-addon">
                  <span class="glyphicon glyphicon-remove"></span>                        
              </span>
              <span class="input-group-addon">
                  <span class="glyphicon glyphicon-th"></span>                        
              </span>                           
        </div>
      </div>
	  	<button type="submit" class="btn btn-default" id="btn-search">Submit</button>
	</form>
  </div>
</div>
</div>

<div class="col-md-9">
	<div id="content">
		<ol class="breadcrumb">
		  <li><a href="#">Home</a></li>
		  <li><a href="#">Library</a></li>
		  <li class="active">Data</li>
		</ol>

		<div id="items">
			
			<?php foreach ($events as $key => $event): ?>
				<?php $this->renderPartial('_event',array(
					'event'=>$event,
				)); ?>
			<?php endforeach ?>

		</div>
		<!-- item end -->
	</div>
</div>


<?php 
$mpros = Provinsi::model()->findAll();
$listProvinsi = array();
foreach ($mpros as $keyp => $valuep) {
  $listProvinsi[$valuep->id] = $valuep;
}

$mtypes = EventType::model()->findAll();
$eventTypes = array();
foreach ($mtypes as $keyt => $valuet) {
  $eventTypes[$valuet->id] = $valuet;
}
Yii::app()->clientScript->registerScript('waterfall','
    var listProvinsi = '.CJSON::encode($listProvinsi).';
    var eventType = '.CJSON::encode($eventTypes).';
    $container = $("#items");
    $("#AddJadwalForm_from").change(function(){
      alert("koplak");
    });
      $container.masonry({
        itemSelector:".item",
        columnWidth: 290,
        isAnimated: true
      });
      
      var page = 1;
      var finish = false;
      var provinsi = "";
      var eventtype = "";
      var search="";
      var from = "";
      var end = "";

      function redraw(){
        page = 1;
        finish = false;
        var url = "'.Yii::app()->createUrl('site/loadJson').'";   
        var data = { page : page , idProvinsi : provinsi , idEventType : eventtype, search : search, from : from , end : end}; 
        $.post(url,data,function(ret){
              $.each($("#items .item"),function(key,brick){
                var _id = $(brick).attr("data-id");
                var _id_html = $(brick).attr("id");
                if(typeof(ret[_id]) == "undefined"){
                  console.log(_id_html);
                  $("#"+_id_html).addClass( "item-to-remove" );
                }
              });
              $("#items .item-to-remove").removeAttr( "id" );
              $container.masonry("remove",$("#items .item-to-remove"));
              $("#items .item-to-remove").remove();
              $container.masonry()

              $.each(ret,function(key,event){
                if($("#brick-"+event.id).length == 0){
                  $container.append( event.body ).masonry( "appended", $("#brick-"+event.id) );    
                }
                else{
                  console.log($("#brick-"+event.id));
                }
              });
        },"json");
      }
      function setProvinsi(idProv){
        provinsi=idProv;
        if(idProv !=""){
          $("#provinsi").val(idProv);
          $("#filter-provinsi").fadeIn();
          $("#filter-provinsi .text-filter").text(listProvinsi[idProv].nama);
        }
        else{
          $("#provinsi").val(idProv);
          $("#filter-provinsi").fadeOut();
        }
      }
      function setEventType(idEventType){
        eventtype=idEventType;
        if(idEventType !=""){
          $("#eventtype").val(idEventType);
          $("#filter-eventtype").fadeIn();
          $("#filter-eventtype .text-filter").text(eventType[idEventType].nama);
        }
        else{
          $("#eventtype").val(idEventType);
          $("#filter-eventtype").fadeOut();
        }
      }
      function setFrom(valFrom){
          from=valFrom;
          if(valFrom !=""){
            $("#from").val(valFrom);
            $("#filter-from").fadeIn();
            $("#filter-from .text-filter").text("Dari:"+valFrom);
          }
          else{
            $("#from").val(valFrom);
            $("#filter-from").fadeOut();
          }
      }
      function setEnd(valEnd){
          end=valEnd;
          if(valEnd !=""){
            $("#end").val(valEnd);
            $("#filter-end").fadeIn();
            $("#filter-end .text-filter").text("Sampai:"+valEnd);
          }
          else{
            $("#end").val(valEnd);
            $("#filter-end").fadeOut();
          }
      }
      $("#btn-search").click(function(){
        setProvinsi($("#provinsi").val());
        redraw();
      });
      $("#provinsi").change(function(){
        setProvinsi($(this).val());
        redraw();
      });
       $("#eventtype").change(function(){
        setEventType($(this).val());
        redraw();
      });
      $("#filter-provinsi .remove").on("click",function(){
        setProvinsi("");
        redraw();
      });
      $("#filter-eventtype .remove").on("click",function(){
        setEventType("");
        redraw();
      });
      $("#filter-from .remove").on("click",function(){
        setFrom("");
        redraw();
      });
      $("#filter-end .remove").on("click",function(){
        setEnd("");
        redraw();
      });
      // $(window).scroll(function(){
      //         if  ($(window).scrollTop() == $(document).height() - $(window).height()){
      //            page++;
      //            loadArticle(page);
      //         }
      // }); 
      setInterval(function(){
          if  ($(window).scrollTop() == $(document).height() - $(window).height()){
             page++;
             if(finish == false){
                loadArticle(page);
             }
          }
      }, 200);

      function loadArticle(pageNumber){ 
          var url = "'.Yii::app()->createUrl('site/loadJson').'";   
          var data = { page : pageNumber , idProvinsi : provinsi , idEventType : eventtype , search : search , from : from , end : end}; 
          $.post(url,data,function(ret){
              if(ret.length > 0){
                $.each(ret,function(key,event){
                  $container.append( event.body ).masonry( "appended", $("#brick-"+event.id) );
                });
              }
              else{
                finish = true;
              }
          },"json");
      }
      setProvinsi("");
      setEventType("");
      setFrom("");
      setEnd("");
  '
);
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
     $('.form_datetime_from').datetimepicker({
          weekStart: 1,
          todayBtn:  1,
                  autoclose: 1,
                  todayHighlight: 1,
                  startView: 2,
                  forceParse: 0,
          pickerPosition: 'bottom-left', 
          showMeridian: 0
      }).on('changeDate',function(){
        setFrom($('#from').val());
        redraw();
      }); 
      $('.form_datetime_end').datetimepicker({
          weekStart: 1,
          todayBtn:  1,
                  autoclose: 1,
                  todayHighlight: 1,
                  startView: 2,
                  forceParse: 0,
          pickerPosition: 'bottom-left', 
          showMeridian: 0
      }).on('changeDate',function(){
        setEnd($('#end').val());
        redraw();
      }); 
  ");