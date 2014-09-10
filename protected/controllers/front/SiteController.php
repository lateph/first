<?php

class SiteController extends Controller
{
	public $limit=10;
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$criteria = new CDbCriteria();
		$criteria->limit = $this->limit;
		$events = Event::model()->findAll($criteria);
		$this->render('index',array(
			'events'=>$events
		));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new FrontLoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['FrontLoginForm']))
		{
			$model->attributes=$_POST['FrontLoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	public function actionRegister(){
		$model = new RegisterForm();
		if(isset($_POST['RegisterForm'])){
			$model->attributes = $_POST['RegisterForm'];
			if($model->validate()){
				$password = $model->password;
				$model->password = $model->hashPassword($password);
				if($model->save(false)){
					$_identity=new FrontUserIdentity($model->username,$password);
					if($_identity->authenticate()){
						Yii::app()->user->login($_identity,3600*24);
						$this->redirect('site/index');
					}
				}
			}	
		}

		$this->render('register',array(
			'model'=>$model,
		));
	}

	public function actionLoadJson(){
		$criteria = new CDbCriteria();
		$criteria->limit = $this->limit;
		$criteria->compare('t.provinsi_id',@$_POST['idProvinsi']);
		$criteria->compare('t.type',@$_POST['idEventType']);
		if(isset($_POST['from']) and trim($_POST['from']) and isset($_POST['end']) and trim($_POST['end'])){
			$criteria->addCondition('EXISTS (   
			  SELECT 1    
			  FROM t_event_jadwal j  
			  WHERE j.idEvent = t.id   
			  AND j.from >= :from and j.end <= :end
			)');
			$criteria->params[':from'] = $_POST['from'];
			$criteria->params[':end'] = $_POST['end'];
		}
		else{
			if(isset($_POST['from']) and trim($_POST['from'])){
				$criteria->addCondition('EXISTS (   
				  SELECT 1    
				  FROM t_event_jadwal j  
				  WHERE j.idEvent = t.id   
				  AND j.from >= :from
				)');
				$criteria->params[':from'] = $_POST['from'];
			}
			if(isset($_POST['end']) and trim($_POST['end'])){
				$criteria->addCondition('EXISTS (   
				  SELECT 1    
				  FROM t_event_jadwal j  
				  WHERE j.idEvent = t.id   
				  AND j.end <= :end
				)');
				$criteria->params[':end'] = $_POST['end'];
			}
		}
		$criteria->offset = ((int)(@$_POST['page'])-1) * $this->limit; 
		$events = Event::model()->findAll($criteria);
		$json = array();
		foreach ($events as $key => $event) {
			$json[$event->id] = array(
				'id'=>$event->id,
				'body'=>$this->renderPartial('_event',array(
					'event'=>$event,
				),true),
			);
		}
		echo CJSON::encode($json);
	}

	public function actionDetail($id){
        $event = Event::model()->findByPk($id);
        if($event===null)
            throw new CHttpException("Article Not Found");
        
        // if($article->related_article){
        //     $ids = explode(',', $article->related_article);
        //     $criteria = new CDbCriteria();
        //     $criteria->addInCondition('t.id',$ids); 
        //     $criteria->with = array('kategoriberitas');
        //     $related = Event::model()->findAll($criteria);
        // }
        // else{
        //     $criteria = new CDbCriteria();
        //     $criteria->addCondition("t.idkategori=:idk"); 
        //     $criteria->params[':idk'] = $article->idkategori;
        //     $criteria->with = array('kategoriberitas');
        //     $criteria->limit = 4;
        //     $related = Event::model()->findAll($criteria);           
        // }

        Yii::app()->clientScript->registerMetaTag('text/html; charset=utf-8',null,'content-type');
        Yii::app()->clientScript->registerMetaTag(YII::app()->language,'language');
        Yii::app()->clientScript->registerMetaTag('2014 diamondmatcher.com','copyright');
        // Yii::app()->clientScript->registerMetaTag('diamondmatcher','author');
        Yii::app()->clientScript->registerMetaTag('all,index,follow','robots');
        Yii::app()->clientScript->registerMetaTag('index,follow,noodp','googlebot');
        Yii::app()->clientScript->registerMetaTag('all,index,follow','msnbot');                    
        // Yii::app()->clientScript->registerMetaTag(YII::app()->name .' - '.$article->summary, 'description');
        // Yii::app()->clientScript->registerMetaTag(YII::app()->name .', '.$article->tags, 'keywords');  
                        
        $this->render('detail',array(
            'event'=>$event,
            // 'related'=>$related,
        ));
    }

	public function actionTest(){
		$criteria = new CDbCriteria();
		$criteria->with = array('jadwals');
		$criteria->addCondition('jadwals.`from` > \'2014-09-09 15:00:00\'');
	//	$criteria->limit = 1;
		$events = Event::model()->findAll($criteria);
		$json = array();
		foreach ($events as $key => $event) {
			$json[$event->id] = array(
				'id'=>$event->id,
			);
		}
		echo CJSON::encode($json);
	}
}