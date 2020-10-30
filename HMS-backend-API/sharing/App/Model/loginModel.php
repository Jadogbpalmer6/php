<?php
class loginModel extends model
{

    public function __construct(){
        $this->connect();
    }

    public function checkuser($data){
        try {
    $query = $this->DB->prepare("SELECT * FROM users WHERE user_name=?");
    $query->execute(array($data[0]));
    $all = $query->fetch(PDO::FETCH_ASSOC);
    $num=$query->rowCount();
    if($num==1){
        if(password_verify($data[1],$all['user_pwd'])){
                return $all;
        }else{
            
            return 0;
        }
    }else{
        return 0;
        
    }
    


} catch (PDOException $e) {
    $error = array('ERROR' => $e->getMessage());
    echo json_encode($error);
    die();
}

    }


}









?>