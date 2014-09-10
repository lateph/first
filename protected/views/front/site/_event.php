<?php
	$info = $event->getImageCover();
?>
<div class="item masonry-brick" id="brick-<?php echo $event->id; ?>" data-id="<?php echo $event->id; ?>">
    <div class="picture">
      <a class="image" title="Title" href="<?php echo Yii::app()->createUrl('site/detail',array('id'=>$event->id)); ?>">
	      <img alt="" src="<?php echo $info->url; ?>" height="<?php echo $info->height ?>" width="<?php echo $info->width; ?>">
	    </a>
    <div class="item-content">
      <div class="description">
        <p> <?php echo $event->excerpt(); ?> </p>
      </div>
      <div class="author"> <?php echo $event->title; ?> </div>
      <div class="meta">
        <span>
          <i class="icon-calendar"></i>
          11 May 2013
        </span>
      </div>
    </div>
  </div>
</div>