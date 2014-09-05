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
  			<span class="label label-danger"><i class="glyphicon glyphicon-remove remove"></i>Provinsi Jakarta</span>
  			<span class="label label-danger"><i class="glyphicon glyphicon-remove remove"></i>Jakarta</span>
  			<span class="label label-danger"><i class="glyphicon glyphicon-remove remove"></i>Jakarta</span>
  		</div>
  		<div class="form-group">
		    <label for="exampleInputPassword1">Provinsi</label>
        <?php echo CHtml::dropDownList('kode_provinsi','',CHtml::listData(Provinsi::model()->findAll(),'kode','nama'),array('class'=>'form-control','empty'=>'- Provisinsi -','id'=>'provinsi')); ?>
		 </div>
	 
		<div class="form-group">
		    <label for="exampleInputPassword1">Category</label>
		     	<select class="form-control" placeholder="Enter email">
			  	<option>Category</option>
			 </select>
		 </div>

		<div class="form-group">
			<label>Even</label>
			<input type="text" placeholder="Even" class="form-control">
		</div>
	  	<button type="submit" class="btn btn-default">Submit</button>
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
Yii::app()->clientScript->registerScript('waterfall','
    $container = $("#items");

      $container.masonry({
        itemSelector:".item",
        columnWidth: 290,
        isAnimated: true
      });
      
      var page = 1;
      var finish = false;
      var provinsi = "";

      function redraw(){
        page = 1;
        
        var url = "'.Yii::app()->createUrl('site/loadJson').'";   
        var data = { page : page }; 
        $.post(url,data,function(ret){
            if(ret.length > 0){
              $("#items .item").removeAttr( "id" );
              $container.masonry("remove",$("#items .item"));
              $container.masonry()

              $.each(ret,function(key,event){
                $container.append( event.body ).masonry( "appended", $("#brick-"+event.id) );
              });
            }
            else{
              finish = true;
            }
        },"json");
      }
      $("#provinsi").change(function(){
        provinsi=$(this).val();
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
          var data = { page : pageNumber }; 
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

      
  '
);