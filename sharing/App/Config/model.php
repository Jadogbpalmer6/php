<?php
class model{
  private $host='127.0.0.1';
  private $user='root';
  private $password='';
  private $dbname='hms1';
  protected $DB;
  protected function Connect(){
      try {
        $this->DB=new PDO('mysql:host='.$this->host.';dbname='.$this->dbname,$this->user,$this->password);
        $this->DB->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

      } catch (PDOException $e) {
            $error=array('ERROR'=>$e->getMessage());
            echo json_encode($error);
            die();
      }

  }
  protected function getId($table,$id){
    try{
        $alphabets = array('A','B','C','D','D','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
        $randomId = date('20y').rand(1,9).$alphabets[rand(0,25)].$alphabets[rand(0,25)].rand(1,999).$alphabets[rand(0,25)].$alphabets[rand(0,25)].$alphabets[rand(0,25)].rand(1,9);
        $query = $this->DB->prepare("SELECT COUNT(*) AS NUMBER_OF_IDs FROM $table WHERE $id ='$randomId'");
        $query->execute();
        $num = $query->fetchall(PDO::FETCH_ASSOC);
        $num = $query->rowCount();
        if($num){
            return $randomId;
        }else {
            $this->getId($table,$id);
        }
    }catch (PDOException $th) {
        $error = array('ERROR' => $th->getMessage());
        echo json_encode($error);
        die();
    }
}

}

 ?>
