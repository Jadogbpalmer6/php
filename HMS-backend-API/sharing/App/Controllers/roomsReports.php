<?php
class roomsReports extends Controller{
 	private $userId;
	private $hotelId;

	public function __construct()
	{
		$userdata=parent::user_data();
		$this->userId=$userdata['user_id'];
		$this->hotelId=$userdata['hotel_id'];
	}


	public function inRooms(){
		if (isset($_POST['date1'])) {
			$date1 = $_POST['date1'];
			$date2 = isset($_POST['date2'])? $_POST['date2']:$date1;
			$resp = $this->model('roomsReportsModel','inRooms',[$this->hotelId,$date1,$date2]);
			$this->view(SUCCESS_RESPONSE_STATUS, 'success',$resp);
		}else{
			$this->view(FAILURE_RESPONSE_STATUS, 'Failure',"missing required parameters");
		}
	}public function availableRooms(){
		if (isset($_POST['date1'])) {

			$date1 = $_POST['date1'];
			$date2 = isset($_POST['date2'])? $_POST['date2']:$date1;

			$allRoomsAvailable = $this->model('roomsModel','availableRooms',[1,$date1,$date2]);
			$roomsAvailableByHotel = $this->model('roomsReportsModel','roomsByHotel',[$this->hotelId,$allRoomsAvailable]);
			echo
			 json_encode($roomsAvailableByHotel);
			 exit;
		}else{
			$this->view(FAILURE_RESPONSE_STATUS, 'Failure',"missing required parameters");
		}
	}


}