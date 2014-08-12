<?php
class ApiMessage implements IApiJSON{
	protected $message;
	protected $status; 
	function __construct($message,$status=0) {
    	$this->message = $message;
    	$this->status = $status;
    } 
    public function render(){
    	return array(
    		'status'=>$this->status,
    		'message'=>$this->message,
    	);
    }
}