<?php
class Router{
  public $routes=array();
  public $routesController=array();
  public $ActiveRoute;
  public function addroute($routes,$routesController){
      $this->routes[]=$routes;
      $this->routesController[]=$routesController;
  }
  public function init(){
    $path=isset($_GET['url'])? '/'.$_GET['url']:'/';
    $routeKey=array_search($path,$this->routes);
    if ($routeKey!==false) {
      $routeset=explode('@',$this->routesController[$routeKey]);
      $controller=$routeset[0];
      $method = (isset($routeset[1])) ? $routeset[1]: 'index';
      if (file_exists('../App/Controllers/'.$controller.'.php')) {
          require_once '../App/Controllers/'.$controller.'.php';
          $exec=new $controller;
          $exec ->$method();
      } else {
          $text="<?php \n class ".$controller." extends Controller {\n \t public function ".$method." (){\n \n\t} \n}  \n ?>";
          $file=fopen('../App/Controllers/'.$controller.'.php','w');
          fwrite($file,$text);
          fclose($file);
          require_once '../App/Controllers/'.$controller.'.php';
          $exec=new $controller;
          $exec ->$method();
      }

    }else{
        echo "ROUTE NOT FOUND";
    }
  }
}
 ?>
