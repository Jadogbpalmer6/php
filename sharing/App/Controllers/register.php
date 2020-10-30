<?php

//Constants are defined in ../config/constants
class register extends Controller{
    private $userEmail;
    private $password;
    private $username;
    private $userTelNo;
    private $user_hotel;
    private $hotelName;    
    private $HotelTelNo;
    private $hotelAddress;
    private $hotelEmail;
    private $hotelPoBox;
    private $tinNo;
    private $userStatus;
    private $userId;
    
    //index function validating data before calling functions to interact with the database
    //some validation may be removed after adding some AJAX on the front-end
    public function index(){

        //check if all required fiels are filled
        if (isset($_POST['hotelName']) && isset($_POST['tinNo']) && isset($_POST['hotelPoBox']) && isset($_POST['hotelAddress']) && isset($_POST['hotel_email'])  && isset($_POST['userEmail'])  && isset($_POST['user_tel']) && isset($_POST['username']) ) {
            
            if (!isset($_POST['hotel_tel'])) {
                
            }
            $this->HotelTelNo = filter_var($_POST['hotel_tel'], FILTER_SANITIZE_NUMBER_INT);
            $this->hotelEmail = filter_var($_POST['hotel_email'], FILTER_VALIDATE_EMAIL);

            if ($this->HotelTelNo == "" || $this->hotelEmail == false) {
                $this->view(FAILURE_RESPONSE_STATUS, 'Failure', 'imvalid telephone number input');
                exit;
            }
            $this->hotelPoBox = $_POST['hotelPoBox'];
            $this->tinNo = filter_var($_POST['tinNo'],FILTER_VALIDATE_INT);
            if(!$this->tinNo){
                $this->view(FAILURE_RESPONSE_STATUS, 'Failure', 'imvalid TIN number input');
                exit;
            }
            $this->hotelName = $_POST['hotelName'];
            $this->hotelAddress = $_POST['hotelAddress'];

            $this->userEmail = $this->email_check($_POST['userEmail']);
            if($this->emailExist()){
                $this->view(FAILURE_RESPONSE_STATUS, 'Failure', 'Email exists');
                exit;
            }
            if($this->usernameExist()){
                $this->view(FAILURE_RESPONSE_STATUS, 'Failure', 'username exists');
                exit;
            }           
            $this->username = $_POST['username'];

            $this->userTelNo = filter_var($_POST['user_tel'], FILTER_SANITIZE_NUMBER_INT);
            if ($this->userTelNo == "" || $this->userTelNo == false) {
                $this->view(FAILURE_RESPONSE_STATUS, 'Failure', 'imvalid telephone number input');
                exit;
            }
            //note that the password hashing algorithm used is 1
            $this->password = password_hash(DEFFAULT_PASSWORD,1);

            //set the  hotel to the addedhotel
            $this->user_hotel = $this->addHotel();
            //call the function adduser to continue the process by adding a user
            $this->userId = $this->adduser();
            if ($this->addStatus()) {
                $this->view(SUCCESS_RESPONSE_STATUS, 'Success', 'Hotel ,user, and status added successfully');
            }else{
                $this->view(FAILURE_RESPONSE_STATUS, 'Failure', 'unknown error');
            }

        } else {
            $this->view(FAILURE_RESPONSE_STATUS, 'Failure', 'missing reqired parameters');
        }
    }
    
    private function addHotel(){
        
        $check = $this->model('registerModel', 'hotelNameExist', $this->hotelName);
        if ($check == 0) {
            $adduser = $this->model('registerModel', 'addhotel',[$this->hotelName,$this->HotelTelNo,$this->hotelAddress,$this->hotelEmail,$this->hotelPoBox,$this->tinNo]);
            return $adduser;
        } else {
            $this->view(FAILURE_RESPONSE_STATUS, 'Failure', 'Hotel name exists');
            exit;
        }
    }

    public function adduser(){
         
        $addeduserId = $this->model('registerModel', 'adduser',[$this->username,$this->userEmail,$this->password,$this->user_hotel,$this->userTelNo]);
        if($addeduserId){
            return $addeduserId;
        }else{
            $this->view(FAILURE_RESPONSE_STATUS, 'Failure', 'hotel added but failed to add user and status');
            exit;
        }
    }

    private function email_check($email){

        if ($email = filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $email;
        }else{
            $this->view(FAILURE_RESPONSE_STATUS, 'Failure', 'imvalid email');
            exit;
        }
    }

    private function emailExist(){
    
        $email = $this->userEmail;
        $check = $this->model('registerModel', 'EmailExist', $email);
        return $check;
    }
    private function usernameExist(){

        $check = $this->model('registerModel', 'UsernameExist', $this->username);
    }
    private function addStatus(){

        $this->userStatus = isset($_POST['user_status'])? $_POST['user_status'] : 'General Manager';
        $addedStatusId = $this->model('registerModel', 'addStatus',[$this->userId,$this->userStatus]);
        if($addedStatusId){
            return $addedStatusId;
        }else{
            $this->view(FAILURE_RESPONSE_STATUS, 'Failure', 'Hotel and user added but status not added succesfully');
        }
    }

}

?>