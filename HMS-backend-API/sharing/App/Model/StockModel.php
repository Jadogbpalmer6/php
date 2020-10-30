<?php

class StockModel extends model
{
    public function __construct()
    {
        $this->connect();
    }
    public function addItem($product)
    {
        try {
            $id = $this->getId('stock', 'product_id');
            $query = $this->DB->prepare("INSERT INTO stock(product_id,inflow_date,product_name,unit,quantity,mfg_date,exp_date,supplier,description,hotel) VALUES('$id',NOW(),?,?,?,?,?,?,?,?)");
            $query->execute($product);
            return $id;
        } catch (PDOException $th) {
            $error = array('ERRORss' => $th->getMessage());
            echo json_encode($error);
            die();
        }

    }
    public function removeItem($product)
    {
        try {
            $query = $this->DB->prepare("SELECT quantity FROM stock WHERE product_id=?");
            $query->execute(array($product[0]));
            $fetch = $query->fetch(PDO::FETCH_ASSOC);
            $current_quantity = intval($fetch['quantity']) - intval($product[1]);
            if ($current_quantity >= 0) {
                $update_query = $this->DB->prepare("UPDATE stock SET quantity='$current_quantity' WHERE product_id=?");
                $update_query->execute(array($product[0]));
                return 1;
            }else{
                return 0;
            }

        } catch (PDOException $th) {
            $error = array('ERRORss' => $th->getMessage());
            echo json_encode($error);
            die();
        }

    }
}
