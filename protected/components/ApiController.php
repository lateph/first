<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class ApiController extends CController
{
	public function send($data,$status=1){
		header('Content-Type: application/json');
		$_json = '';
		if($data instanceof IApiJSON){
			$_json = $data->render();
		}
		else{
			$_json = array(
				'status'=>$status,
				'data'=>$data
			);
		}
		echo CJSON::encode($_json);
		Yii::app()->end();
	}

	public function sendErrorMessage($msg,$status=0){
		$this->send(new ApiMessage($msg,0));
	}

	public function sendSuccessMessage($msg,$status=0){
		$this->send(array(
			'message'=>$msg,
		),$status);
	}
}