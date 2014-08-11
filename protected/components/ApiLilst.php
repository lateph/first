<?php
class ApiList implements IApiJSON{
	protected $list;
	protected $status; 
    protected $add;
    protected $delete;
	function __construct($list,$status=0) {
    	$this->list = $list;
    	$this->status = $status;
    } 
    public function render(){
    	return array(
    		'status'=>$this->status,
    		'data'=>$this->list,
    	);
    }
}