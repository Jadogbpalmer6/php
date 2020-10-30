<?php
class Success extends view
{
    public function __construct($status, $data)
    {
        $output = array('success' => array('message' => $data));
        $this->status($status);
        $this->response($output);

    }
}
