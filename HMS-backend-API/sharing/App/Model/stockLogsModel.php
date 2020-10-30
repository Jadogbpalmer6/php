<?php


class stockLogsModel extends model
{
    protected $hotel;

    public function __construct(){
        //conecting to the database
        $this->connect();
    }



    public function logs($data){
        try {
            if ($data[1]){
                $query = $this->DB->prepare("SELECT * FROM stock_logs JOIN stock ON product_ref_id = product_id WHERE hotel=? And action=?");
                $query->execute($data);
                $this->hotel = $data[0];
            }else{
                $query = $this->DB->prepare("SELECT * FROM stock_logs JOIN stock ON product_ref_id = product_id WHERE hotel=? ");
                $query->execute(array($data));
                $this->hotel = $data;
            }
            $results = $query->fetchall(PDO::FETCH_ASSOC);
            return ($results);

        } catch (PDOException $e) {
            $error = array('ERROR' => $e->getMessage());
            echo json_encode($error);
         
            die();
        }

    }

    

}
