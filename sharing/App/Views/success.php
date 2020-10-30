<?php
class success extends view{
  public function __construct($status,$data){
    
      $output = array('resp'=>array('message'=>$data));
      $this->status($status);
      $this->response($output);

  }
}

?>
