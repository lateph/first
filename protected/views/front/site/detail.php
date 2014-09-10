 
<div id="boxmain">      
    <div class="box col-sm-9 col-md-9 col-xs-12">
        <div class="breadcrumb col-sm-12 col-md-12 col-xs-12">
            <a href="<?php echo Yii::app()->createUrl('site/index'); ?>"> home </a> 
            <span class="glyphicon glyphicon-chevron-right"></span> <a href="<?php echo Yii::app()->createUrl('site/category',array('catslug'=>@$article->kategoriberitas->slug)); ?>">
             <?php echo '@$event->kategoriberitas->nama'; ?> </a><span class="glyphicon glyphicon-chevron-right"></span> <?php echo $event->title; ?>
        </div>
        <div class="author col-md-2 visible-lg visible-md hidden-sm hidden-xs">
            <div id="sideauthor" class="text-center affix-top">               
                <?php
                $this->widget('application.extensions.SocialShareButton.SocialShareButton', array(
                        'style'=>'vertical',
                        'networks' => array('facebook','googleplus','twitter'),
                        'data_via'=>'', //twitter username (for twitter only, if exists else leave empty)
                ));  
                ?>                                        
            </div>                
        </div>

        <div class="article col-md-10 col-sm-12 col-xs-12">
            <h2 class="title"><?php echo @$event->title; ?></h2>      
            <hr>
            <h5><span class="label label-default"><?php echo '@$event->kategoriberitas->nama'; ?></span></h5>  
            <div class="hidden-lg hidden-md visible-sm visible-xs">  
                <?php
                $this->widget('application.extensions.SocialShareButton.SocialShareButton', array(
                        'style'=>'horizontal',
                        'networks' => array('facebook','googleplus','twitter'),
                        'data_via'=>'', //twitter username (for twitter only, if exists else leave empty)
                ));  
                ?>   
            </div>

            <div class="gambar">
                <img src="./images/762x465.gif" alt=""></img>
            </div>            
            <?php
                $kontent = $event->description;
                $kontent = str_replace("<iframe", "<div class=\"video-container\"><iframe", $kontent);
                $kontent = str_replace("</iframe>", "</iframe></div>", $kontent);
                echo $kontent; 
            ?>
        <div>
            <hr>
            <?php $this->widget('ext.yii-facebook-opengraph.plugins.Comments', array(
                'width'=>'100%',
                'href'=>Yii::app()->createAbsoluteUrl('site/detail'),
               //'href' => 'http://example.com/lateph/newday/', // if omitted Facebook will use the OG meta tag
               //'show_faces'=>true,
               //'send' => true
            )); 

            Yii::app()->facebook->ogTags['og:title']=Yii::app()->name.' - '. $event->title;
            Yii::app()->facebook->ogTags['og:type']='article';
            Yii::app()->facebook->ogTags['og:image']=$bfoto= '';
            Yii::app()->facebook->ogTags['og:decription']= '';
            //$this->setPageTitle($this->pageTitle.' - '. $article->judul);
            ?>                
        </div>            
        </div>            
    </div>
    
    <div class="box col-sm-3 col-md-3 col-xs-12" style="padding: 0;">
        
            <?php if(false)://foreach ($related as $key => $value): ?>
                <div class="post item"> 
                    <div class="wellx">
                        <?php
                            $bfoto= Yii::app()->baseUrl.Yii::app()->params->beritathumb.$value->foto.'_284x240.jpg';  // butuh thumb 284x170                    
                            echo CHtml::link(CHtml::image($bfoto, '', array('style'=>'width:100%;')),array('news/'.@$value->kategoriberitas->slug.'/'.$value->id.'/'.$value->slug));                                                                                                    
                        ?>   
                        <img src="./images/284x170.gif" alt="" width="100%">
                        <div class="info">
                            <?php
                                echo CHtml::link($value->judul,array('news/'.@$value->kategoriberitas->slug.'/'.$value->id.'/'.$value->slug));                    
                            ?>
                        </div>
                    </div>
                </div> 
            <?php endif; //endforeach ?>
        
    </div>         
</div>
