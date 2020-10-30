<?php 
 class roomsCatController extends Controller {
 	private $userId;
	private $hotelId;
	private $catname;
	private $price;

	public function __construct()
	{
		$userdata=parent::user_data();
		$this->userId=$userdata['user_id'];
		$this->hotelId=$userdata['hotel_id'];
	}
 	 public function create (){
 		if (isset($_POST['catname']) && isset($_POST['price'])) {
 			$this->price=floatval($_POST['price']);
 			$this->catname=$_POST['catname'];
 			return $this->uploadphotos();
 			
 		}else{
 			$this->view(FAILURE_RESPONSE_STATUS, 'Failure', 'Missing required Params');
 		}
	} 
	private function uploadphotos(){
		$basepath='assets/roomcat/';
		$dirname=$basepath.base64_encode(strtolower($this->catname));
		if(is_dir($dirname)){
			$this->view(FAILURE_RESPONSE_STATUS, 'Failure', 'Category Exists');
		}else{
			mkdir($dirname);
		}
		$images=['img1','img2','img3','img4','img5','img6','img7','img8'];
		foreach ($images as $name) {
			if(isset($_FILES[$name])){
				$imageInfo=pathinfo($_FILES[$name]['name']);
				$filename=$imageInfo['filename'];
				$extension=$imageInfo['extension'];
				$destination=$dirname.'/'.base64_encode(time().$name).'.'.$extension;
				$tmp=$_FILES[$name]['tmp_name'];
				try {
					move_uploaded_file($tmp,$destination);
				} catch (Exception $e) {
					$this->view(FAILURE_RESPONSE_STATUS, 'Failure',$e->getMessage());
				}
			}
		}

		return $this->addtodb();


	}
	private function addtodb(){
		$data=[$this->catname,$this->price,$this->hotelId];
		$cat=$this->model('roomscatModel','addroomcat',$data);
		$response=['txt'=>'New Category Was added','catId'=>$cat];
		$this->view(SUCCESS_RESPONSE_STATUS, 'success',$response);

	}

	public function availableCategories(){
		$date1 = $_POST['date1'];
		$date2 = isset($_POST['date2'])? $_POST['date2']:$date1;

		$rooms = $this->model('roomsModel','availableRooms',[1,$date1,$date2] );

		$rooms_never_taken = $this->model('roomsModel','roomsNeverTaken',[1]);

		if($rooms_never_taken){
			foreach ($rooms_never_taken as $room) {
				array_push($rooms, $room);
			}
		}
		$categories = $this->model('roomscatModel','categoriesAvailable',[$this->hotelId,$rooms]);
		
		$this->view(SUCCESS_RESPONSE_STATUS, 'success',$categories);
		
	}
}  
 ?>