<?php
class model{
  private $host='127.0.0.1';
  private $user='root';
  private $password='';
  private $dbname='';
  protected $DB;
  protected function Connect(){
      try {
        $this->DB=new PDO('mysql:host='.$this->host.';dbname='.$this->dbname,$this->user,$this->password);
        $this->DB->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

      } catch (PDOException $e) {
            echo $e->getMessage();
            die();
      }

  }
}

 ?>
