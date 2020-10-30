<?php
class registerModel extends model
{

    public function __construct(){
        $this->connect();
    }

    public function hotelNameExist($name){
        try {
            $query = $this->DB->prepare("SELECT COUNT(*) AS NUMBER_OF_NAMES FROM hotels WHERE hotel_name=?");
            $query->execute(array($name));
            $num = $query->fetchall(PDO::FETCH_ASSOC);
            return ($num[0]['NUMBER_OF_NAMES']);

        } catch (PDOException $e) {
            $error = array('ERROR' => $e->getMessage());
            echo json_encode($error);
            die();
        }

    }

    public function addHotel($hotelInfo){
        try {
            $id = $this->getId('hotels','hotel_id');
            $query = $this->DB->prepare("INSERT INTO hotels(hotel_id,hotel_name,hotel_tel_no,hotel_location_address,hotel_email_address,hotel_po_box,hotel_tin_no) VALUES('$id',?,?,?,?,?,?)");
            $query->execute($hotelInfo);
            return $id;
        } catch (PDOException $th) {
            $error = array('ERROR' => $th->getMessage());
            echo json_encode($error);
            die();
        }

    }

    public function EmailExist($email){

        try {
            $query = $this->DB->prepare("SELECT COUNT(*) AS NUMBER_OF_EMAILS FROM users WHERE user_email=?");
            $query->execute(array($email));
            $num = $query->fetchall(PDO::FETCH_ASSOC);
            return $num[0]['NUMBER_OF_EMAILS'];
        } catch (PDOException $e) {
            $error = array('ERROR' => $e->getMessage());
            echo json_encode($error);
            die();
        }
    }
    public function UsernameExist($username){
        try {
            $query = $this->DB->prepare("SELECT COUNT(*) AS NUMBER_OF_USERNAME FROM users WHERE user_name=?");
            $query->execute(array($username));
            $num = $query->fetchall(PDO::FETCH_ASSOC);
            return ($num[0]['NUMBER_OF_USERNAME']);

        } catch (PDOException $e) {
            $error = array('ERROR' => $e->getMessage());
            echo json_encode($error);
            die();
        }

    }

    public function adduser($userinfo){
        try {
            $id = $this->getId('users','user_id');
            $query = $this->DB->prepare("INSERT INTO users(user_id,user_name,user_email,user_pwd,hotel,user_tel_no) VALUES('$id',?,?,?,?,?)");
            $query->execute($userinfo);
            return $id;
        } catch (PDOException $th) {
            $error = array('ERROR' => $th->getMessage());
            echo json_encode($error);
            die();
        }

    }

    public function addStatus($status){
        try {
            $id = $this->getId('user_statuses','user_status_id');
            $query = $this->DB->prepare("INSERT INTO user_statuses(user_status_id,user_id,user_status) VALUES('$id',?,?)");
            $query->execute($status);
            return 1;
        } catch (PDOException $th) {
            $error = array('ERROR' => $th->getMessage());
            echo json_encode($error);
            die();
        }
    }

}
