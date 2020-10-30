<?php
class Failure extends view
{
    public function __construct($status, $data)
    {
        $output = array('error' => array('message' => $data));
        $this->status($status);
        $this->response($output);

    }
}
