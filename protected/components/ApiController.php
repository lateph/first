<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class ApiController extends CController
{
	public function send($data,$status=1){
		header('Content-Type: application/json');
		echo CJSON::encode(array(
			'status'=>$status,
			'data'=>$data
		));
		Yii::app()->end();
	}

	public function sendErrorMessage($msg,$status=0){
		$this->send(array(
			'message'=>$msg,
		),$status);
	}

	public function sendSuccessMessage($msg,$status=0){
		$this->send(array(
			'message'=>$msg,
		),$status);
	}
}