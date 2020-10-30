<?php 
 class login extends Controller {
	 private $username;
	 private $password;
 	 public function index (){
		if(isset($_POST['username']) && isset($_POST['password'])){
			if(strlen($_POST['password'])>=6){
				$this->username=$_POST['username'];
				$this->password = $_POST['password'];
				// call method to check wether provided username and password exists
				$this->logInuser();

			}else{
				$this->view(FAILURE_RESPONSE_STATUS, 'Failure', 'Password too short');
			}
		}else{
			$this->view(FAILURE_RESPONSE_STATUS, 'Failure', 'missing reqired parameters');

		}
	} 

	public function logInuser(){
		$user=$this->model('loginModel','checkuser',[$this->username,$this->password]);
		if($user==0){
			$this->view(FAILURE_RESPONSE_STATUS, 'Failure', 'Incorect username or password');
		}else{
			$IAU = new IndigoAuth;
			$data = ['user_id' => $user['user_id'], 'hotel_id' => $user['hotel']];
			$token = $IAU->Sign($data, '1h');
			$response = ['username' => $user['user_name'], 'token' => $token];
			$this->view(SUCCESS_RESPONSE_STATUS, 'Success', $response);



		}

		
	}
}  
 ?>