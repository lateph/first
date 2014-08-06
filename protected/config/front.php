<?php
return CMap::mergeArray(
    require(dirname(__FILE__).'/main.php'),
    array(
        // Put front-end settings there
        // (for example, url rules).
        'theme'=>'front',
        'components'=>array(
        	'urlManager'=>array(
	        	'urlFormat'=>'path',
	        	'showScriptName'=>false,
				'rules'=>array(
					'kategori/<id:.*?>/<slug:.*?>'=>'post/kategori', 
				),
			),
        ),
    )
);