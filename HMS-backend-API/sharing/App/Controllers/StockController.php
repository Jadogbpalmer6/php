<?php
class StockController extends Controller
{
	private $userId;
	private $hotelId;
	public function __construct()
	{
		$userdata=parent::user_data();
		$this->userId=$userdata['user_id'];
		$this->hotelId=$userdata['hotel_id'];
	}

    public function create()
    {
        if (isset($_POST['product_name']) && isset($_POST['unit']) && isset($_POST['quantity']) && isset($_POST['mfg_date']) && isset($_POST['exp_date'])) {
            $data = [
                $_POST['product_name'],
				$_POST['unit'],
				$_POST['quantity'],
				$_POST['mfg_date'],
				$_POST['exp_date'],
				$_POST['supplier'],
				$_POST['comment'],
				$this->hotelId
			];
			$product=$this->model('StockModel','addItem',$data);
			$resp=['status'=>'success','product_id'=>$product];
			$this->view(SUCCESS_RESPONSE_STATUS,'success',$resp);
        } else {
            $this->view(FAILURE_RESPONSE_STATUS, 'Failure', 'Missing required Params');

        }
	}
	

	public function outflow(){
		if(isset($_POST['product_id']) && isset($_POST['quantity'])){
			$data=[$_POST['product_id'],$_POST['quantity']];
			$product = $this->model('StockModel', 'removeItem', $data);
			if($product==1){
				$this->view(SUCCESS_RESPONSE_STATUS, 'success', 'Product Removed!');

			}else{
				$err=$_POST['quantity']." Items  Are not available in stock";
				$this->view(FAILURE_RESPONSE_STATUS, 'Failure',$err);

			}
			



		}else{
			$this->view(FAILURE_RESPONSE_STATUS, 'Failure', 'Missing required Params');
		}
	}
}
