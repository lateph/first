<?php

class EventController extends BackendController
{
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
		//		'actions'=>array('*'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


	public function actions()
    {
        return array(
            'fileUpload'=>array(
                'class'=>'ext.redactor.actions.FileUpload',
                'uploadPath'=>Yii::getPathOfAlias('webroot').'/upload', 
                'uploadUrl'=>Yii::app()->request->baseUrl.'/upload',
                'uploadCreate'=>true,
                'permissions'=>0775,
            ),
            'imageUpload'=>array(
                'class'=>'ext.redactor.actions.ImageUpload',
                'uploadPath'=>Yii::getPathOfAlias('webroot').'/upload', 
                'uploadUrl'=>Yii::app()->request->baseUrl.'/upload',
                'uploadCreate'=>true,
                'permissions'=>0775,
            ),
            'imageList'=>array(
                'class'=>'ext.redactor.actions.ImageList',
                'uploadPath'=>Yii::getPathOfAlias('webroot').'/upload',
                'uploadUrl'=>Yii::app()->request->baseUrl.'/upload',
            ),
        );
    }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Event;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Event']))
		{
			$model->attributes=$_POST['Event'];
			if (is_array($_POST['Tags'])){
                $model->tags = implode(',', $_POST['Tags']);
            }else{
                $model->tags = $_POST['Tags'];
            }  
			if($model->save()){
				if (isset($_POST['Tags'])) {  // Tags exits 

                    $tagsList = explode(',', $_POST['Tags']);
                    foreach ($tagsList as $TagValue) {  // added to list 
                        $isExists = Tags::model()->find('nama=:name', array(':name' => $TagValue));
                        if (count($isExists) > 0) {
                            $isExists->frequency = $isExists->frequency + 1;        
                            $isExists->save();                                
                        } else {
                            $tagNew = new Tags;
                            $tagNew->nama = $TagValue;
                            $tagNew->frequency = 1;
                            $tagNew->save();
                        }
                    }
                    $this->redirect(array('view','id'=>$model->id));
                } 
			}
				
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
                $oldtags=$model->tags;
                $val=true;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Event']))
		{
			$model->attributes=$_POST['Event'];
			if (isset($_POST['Tags'])) { 
                if (is_array($_POST['Tags'])){
                    $model->tags = implode(',', $_POST['Tags']);
                }else{
                    $model->tags = $_POST['Tags'];
                }                        
            }  
			if($model->save()){
				if (isset($_POST['Tags'])) {  
                    $xoldtags = explode(",", $oldtags);
                    $xnewtags = explode(",", $_POST['Tags']);                                        
                    $deletedList=array_diff($xoldtags, $xnewtags); 
                    $addedList=array_diff($xnewtags, $xoldtags);                                           
                    
                    foreach ($addedList as $TagValue) {  // added to list 
                        $isExists = Tags::model()->find('name=:name and iddomain=:iddomain', array(':name' => $TagValue, ':iddomain' => $model->iddomain));
                        if (count($isExists) > 0) {
                            $isExists->frequency = $isExists->frequency + 1;        
                            $isExists->save();                                
                        } else {
                            $tagNew = new Tags;
                            $tagNew->name = $TagValue;
                            $tagNew->iddomain = $model->iddomain;
                            $tagNew->frequency = 1;
                            $tagNew->save();
                        }
                    }
                    foreach ($deletedList as $TagValue) {  // added to list 
                        $isExists = Tags::model()->find('name=:name and iddomain=:iddomain', array(':name' => $TagValue, ':iddomain' => $model->iddomain));
                        if (count($isExists) > 0) {
                            if ($isExists->frequency == 1){
                                $isExists->delete();                                
                            } else {
                                $isExists->frequency = $isExists->frequency - 1;        
                                $isExists->save();   
                            }
                        }
                    }                                        
                }  
                $this->redirect(array('view','id'=>$model->id));
			}
				
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new Event('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Event']))
			$model->attributes=$_GET['Event'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$this->redirect('index');
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Event the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Event::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Event $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='event-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionGalery($id)
	{
		$model=$this->loadModel($id);
		$galery = new EventGalery('create');
		$galery->idEvent = $id;
		//print_r($_POST); exit;
		if(isset($_POST['EventGalery']))
		{
			$galery->attributes=$_POST['EventGalery'];
			$galery->imageFile=CUploadedFile::getInstance($galery,'imageFile');
			$info = getimagesize($galery->imageFile->tempName);
			$galery->width = $info[0];
			$galery->height = $info[1];

			$galery->idEvent = $model->id;
			if($galery->validate()){
				if($galery->imageFile){
					$galery->file = LUpload::upload($galery->imageFile,'EventGalery');
					$galery->save();
					$this->redirect(array('galery','id'=>$model->id));
				}
			}
		}

		$this->render('galery',array(
			'model'=>$model,
			'newGalery'=>$galery,
		));
	}

	public function actionJadwal($id)
	{
		$model=$this->loadModel($id);
		$jadwal = new AddJadwalForm();

		$this->render('jadwal',array(
			'jadwal'=>$jadwal,
			'model'=>$model,
		));
	}
}
