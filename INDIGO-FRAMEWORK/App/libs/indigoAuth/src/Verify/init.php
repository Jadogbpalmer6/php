<?php

class CheckSignature extends AuthConfig
{
    private $token;
    private $data;

    public function mount($token, $data)
    {
        $this->token = $token;
        $this->data = json_decode($data);
        return $this->verify();
    }
    private function verify()
    {
        $enc = base64_decode($this->token);
        $base = explode(strrev("AuTHpasSkEY"), $enc);
        $token = base64_decode($base[0]);
        return $this->decode($token);

    }
    private function decode($token)
    {
        $KEY = '_IndigO_aUTH';
        $METHOD = 'AES-256-CBC';
        $OPT = 0;
        $IV = $this->data->PASSKEY;
        $type = $this->data->type;
        $expiration = strrev($this->data->status);
        $time = time();
        if ($time > $expiration) {
        http_response_code(403);
        $arr=array('message'=>'Session Expired');
        echo json_encode($arr);
        die();
        } else {

            $decoded = openssl_decrypt($token, $METHOD, $KEY, $OPT, base64_decode($IV));
            if ($type == 'array') {
                $result1 = json_decode($decoded);
                $result = (array) $result1;
            } else {
                $result = $decoded;
            }
            $this->data->status = strrev(time() + $this->data->time);
            $path = '../App/Libs/indigoAuth/src/Tokens/' . $this->token . '.json';
            $rehash = new token;
            $rehash->construct($path, json_encode($this->data), $this->token);
            return $result;

        }

    }

}
