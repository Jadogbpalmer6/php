<?php
class Controller
{
    protected function model($model, $func = null, $params = null)
    {
        require_once '../App/Model/' . $model . '.php';
        $method = (isset($func)) ? $func : 'index';
        $class = new $model;
        return $class->$method($params);

    }

    protected function view($code, $view, $params)
    {
        require_once '../App/Views/' . $view . '.php';
        $output = new $view($code, $params);

    }

    protected function user_data()
    {
        $headers = apache_request_headers();
        if (isset($headers['Authorization'])) {
            $authorization = $headers['Authorization'];
            $decode = new IndigoAuth();
            $token = $decode->checkSignature($authorization);
            return $token;
        } else {
            http_response_code(401);
            echo json_encode(['message' => 'Missing Authorization Header']);
            die();

        }

    }

}
