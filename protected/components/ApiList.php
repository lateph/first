<?php
class ApiList implements IApiJSON{
	protected $list;
	protected $status; 
    protected $cols;
    protected $add;
    protected $del;

	function __construct($list,$status=0,$cols=array(),$add=array(),$del=array()) {
    	$this->list = $list;
    	$this->status = $status;
        $this->cols = $cols;
        $this->add = $add;
        $this->del = $del;
    } 

    private function assign(&$_data,$row,$cols){
        $ex = explode('.', $cols);
        if(count($ex) == 1){
            $_data[$cols] = $row->$cols;
        }
        if(count($ex) == 2){
            $ex0 = $ex[0];
            $ex1 = $ex[1];
            if(!isset($_data[$ex0])){
                $_data[$ex0] = array();
            }
            $_data[$ex0][$ex1] = $row->$ex0->$ex1;
        }
    }
    public function render(){
        $data = array();
        $_data = array();
        if(empty($this->cols)){
           foreach($this->list as $row){
                $_data = $row;
            } 
        }
        else{
            foreach($this->list as $row){
                foreach($this->cols as $key=>$col){
                    $this->assign($_data,$row,$col);
                }
            } 
        }

        if(empty($this->add)){
            foreach($this->add as $key=>$col){
                $_data[$col] = $row->$col;
            }
        }

        $data[] = $_data;
        
    	return array(
    		'status'=>$this->status,
    		'data'=>$data,
    	);
    }
}