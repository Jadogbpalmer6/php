<?php
class home extends view{
  public function __construct($status,$data){
      $this->status($status);
      $this->response($data);

  }
}

?>
