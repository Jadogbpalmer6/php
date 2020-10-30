<?php
class Controller
{
    protected function model($model,$func=null,$params=null){
        require_once '../App/Model/'.$model.'.php';
        $method = (isset($func)) ? $func :'index';
        $class = new $model;
        return $class->$method($params);
        
    }

    protected function view($code,$view,$params){
      require_once '../App/Views/'.$view.'.php';
      $output=new $view($code,$params);

    }

}

 ?>
