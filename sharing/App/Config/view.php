<?php
class view{

  protected function status($status){
    http_response_code($status);
  }

  // muhire heritier //
  // muhire heriter //
  
  protected function response($data){
    echo json_encode($data);
  }
}

?>
