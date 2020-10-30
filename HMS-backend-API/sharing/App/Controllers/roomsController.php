<?php 
 
 class roomsController extends Controller{
 	private $userId;
	private $hotelId;
	private $number;
	private $prefix;
	private $category;
	

	public function __construct()
	{
		$userdata=parent::user_data();
		$this->userId=$userdata['user_id'];
		$this->hotelId=$userdata['hotel_id'];
	}
 	 public function create (){
 		if (isset($_POST['category']) && isset($_POST['number']) && isset($_POST['prefix'])) {
 			$this->number=intval($_POST['number']);
 			$this->prefix=$_POST['prefix'];
 			return $this->catExist($_POST['category']);
 		}else{
 			$this->view(FAILURE_RESPONSE_STATUS, 'Failure', 'Missing required Params');
 		}
	} 

	private function catExist($category){
		$cats=$this->model('roomsModel','exists',[$category,$this->hotelId]);
		if($cats==0){
			$this->view(FAILURE_RESPONSE_STATUS, 'Failure',"category doesn't exists");
		}else{
			$this->category=$category;
			$this->addtodb();
		}
	}
	private function addtodb(){
		for ($i=1; $i <=$this->number; $i++) { 
			$data=[$this->hotelId,$this->prefix];
			$this->model('roomsModel','addroom',$data);
		}
		$response=[$this->number.' Rooms Added'];
		$this->view(SUCCESS_RESPONSE_STATUS, 'success',$response);
	}

	public function grantRoom(){

		if (isset($_POST['name']) && isset($_POST['nationality']) && isset($_POST['id']) && isset($_POST['age']) && isset($_POST['gender']) && isset($_POST['address']) && isset($_POST['category']) && $_POST['date1']) {

			$date1 = $_POST['date1'];
			$date2 = isset($_POST['date2'])? $_POST['date2']:$date1;
			$client = [
				$_POST['name'],
				$_POST['nationality'],
				$_POST['id'],
				$_POST['age'],
				$_POST['gender'],
				$_POST['address']
			];
			$clientId = $this->model('roomsModel','addClient',$client);
			if ($clientId) {
				$rooms_never_taken = $this->model('roomsModel','roomsNeverTaken',[0,$_POST['category']]);
				if($rooms_never_taken){
					$room = $rooms_never_taken[array_rand($rooms_never_taken,1)];
				}
				else{
					$rooms = $this->model('roomsModel','availableRooms',[0, $_POST['category'],$date1,$date2] );
					if ($rooms) {
						$room = $this->model('roomsModel','getRoom',$rooms);
					}else{
						$this->view(FAILURE_RESPONSE_STATUS, 'Failure',"failed to assign room");
					}
				}
					if ($room) {
						$roomInfo = $this->model('roomsModel','grantRoom',[$room,$date1,$date2,$clientId]);
						$resp =['txt'=>'room granted seccesfully','room_info'=>$roomInfo];
						$this->view(SUCCESS_RESPONSE_STATUS, 'Success',$resp);
					}else{
						$this->view(FAILURE_RESPONSE_STATUS, 'Failure',"failed to assign room");
					}
			}else{
				$this->view(FAILURE_RESPONSE_STATUS, 'Failure',"failed to add client");
			}
		}else{
			$this->view(FAILURE_RESPONSE_STATUS, 'Failure',"missing required parameters");
		}
	}  

	public function checkOut(){
		if (isset($_GET['reference'])){
			$client = trim($_GET['reference']);
			$check = $this->model('roomsModel','checkOut',$client);
			if($check){
				$this->view(SUCCESS_RESPONSE_STATUS, 'Success','client checked out of the room successfully');
			}else{
				$this->view(FAILURE_RESPONSE_STATUS, 'Failure',"unable to perform action");
			}

		}else{
			$this->view(FAILURE_RESPONSE_STATUS, 'Failure',"missing required parameters");
		}
	}

}