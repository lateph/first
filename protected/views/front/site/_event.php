<?php
	$info = $event->getImageCover();
?>
<div class="item masonry-brick">
    <div class="picture">
      <a class="image" title="Title" href="#">
	      <img alt="" src="<?php echo $info->url; ?>" height="<?php echo $info->height ?>" width="<?php echo $info->width; ?>">
	    </a>
    <div class="item-content">
      <div class="description">
        <p> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </p>
      </div>
      <div class="author"> - John White - </div>
      <div class="meta">
        <span>
          <i class="icon-calendar"></i>
          11 May 2013
        </span>
        <span>
          <i class="icon-user"></i>
          <a href="#">John</a>
        </span>
        <span>
            <i class="icon-heart-empty"></i>
          10
        </span>
      </div>
    </div>
  </div>
</div>