<?php

class SiteController extends ApiController
{
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$this->send(array('ok'));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionLogin()
	{
		$model = new ApiLoginForm();
		$model->attributes = $_POST;
		if($model->validate()){
			$member = Member::model()->find('email = :email',array(':email'=>$model->user));
			if($member === null)
				$member = Member::model()->find('username = :user',array(':user'=>$model->user));
			if($member === null)
				$this->sendErrorMessage('User Not Found');
			if($member->validatePassword($model->password)){
				$member->generateToken();
				$this->send(array(
					'token'=>$member->token,
				));
			}
			else{
				$this->sendErrorMessage('Wrong User or password');
			}
		}else{
			$this->send($model->getErrors(),0);
		}
		
	}

	public function actionRegister(){
		$model = new ApiRegisterForm();
		$model->attributes = $_POST;
		if($model->validate()){
			if($model->password and $model->passwordKonfirm){
				$model->password = $model->hashPassword($model->password);
				$model->passwordKonfirm = $model->hashPassword($model->passwordKonfirm);
			}
			$model->save(false);	
			$model->generateToken();
			$this->send(array(
				'token'=>$model->token,
			));
		}else{
			$this->send($model->getErrors(),0);
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
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}