<?php


class stockLogsModel extends model
{
    protected $hotel;

    public function __construct(){
        $this->connect();
    }



    public function logs($data){
        try {
            if ($data[1]){
                $query = $this->DB->prepare("SELECT * FROM stock_logs WHERE hotel=? And action=?");
                $query->execute($data);
                $this->hotel = $data[0];
            }else{
                $query = $this->DB->prepare("SELECT * FROM stock_logs WHERE hotel=? ");
                $query->execute(array($data));
                $this->hotel = $data;
            }
            $logs = $query->fetchall(PDO::FETCH_ASSOC);
            $query = $this->DB->prepare("SELECT description,product_name,supplier FROM stock WHERE hotel=? ");
            $query->execute(array($data[0]));
            $product = $query->fetchall(PDO::FETCH_ASSOC);
            $results = [];

            //formatting response in a good way
            foreach ($logs as $log) {
                $results[] = ['log' =>$log];
                $query = $this->DB->prepare("SELECT description,product_name,supplier FROM stock WHERE hotel=? ");
                $query->execute(array($this->hotel));
                $product = $query->fetchall(PDO::FETCH_ASSOC);
                $results[] = ['product'=>$product];
            }
            return ($results);

        } catch (PDOException $e) {
            $error = array('ERROR' => $e->getMessage());
            echo json_encode($error);
         
            die();
        }

    }

    

}
