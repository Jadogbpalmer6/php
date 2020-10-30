<?php
class stockLogs extends Controller{
    private $hotelId;
    
    public function __construct(){

		$userdata = parent::user_data();
		$this->hotelId = $userdata['hotel_id'];
	}


    public function deletionLogs(){

        $logs = $this->model('stockLogsModel', 'logs', [$this->hotelId, STOCK_DELETION]);
        $resp = $logs;
        $this->view(SUCCESS_RESPONSE_STATUS,'success',$resp);    
    }
    public function insertionLogs(){
        
        $logs = $this->model('stockLogsModel', 'logs', [$this->hotelId, STOCK_ADDITION]);
        $resp = $logs;
        $this->view(SUCCESS_RESPONSE_STATUS,'success',$resp); 
    
    }

    public function allLogs(){
        $logs = $this->model('stockLogsModel', 'logs', $this->hotelId);
        $resp = $logs;
        $this->view(SUCCESS_RESPONSE_STATUS,'success',$resp); 
    }
}