<?php

class CreateSignature extends AuthConfig
{
    private $expiry;
    private $path;
    private $data;
    private $token;

    protected function Tokenize($data, $expiry,$path)
    {
        $this->init($path);
        $this->expirize($expiry);
        $this->path=$path;
        return $this->encode($data);

    }
    private function expirize($expiry)
    {
        $data = strtolower($expiry);
        $index = strlen($data) - 1;
        $timespan = $data[$index];
        $explode = explode($timespan, $data);
        $duration = intval($explode[0]);
        if ($timespan == 's') {
            $this->expiry = $duration;

        } elseif ($timespan == 'm') {
            $calc = ($duration * 60);

            $this->expiry = $calc;

        } elseif ($timespan == 'h') {
            $calc = ($duration * 3600);


            $this->expiry = $calc;
        } else {
            $error = array("error" => "invalid suffix '" . $expiry[$index] . "' in token expiration argument");
            return json_encode($error);
            die();
        }
    }
    private function encode($data)
    {
        $method = $this->METHOD;
        $iv = $this->IV;
        $opt = $this->OPT;
        $key = $this->KEY;
        $expiration = $this->expiry;
        $hash = time() + $expiration;
        $expiry = strrev($hash);
        $typeof = gettype($data);
        $raw = '';
        if ($typeof == 'string') {
            $raw = $data;
        } else if ($typeof == 'array') {
            $raw = json_encode($data);
        }
        $rand = random_int(1,9);
        $passwordkey = $rand;
        $suffix = base64_encode($passwordkey);
        $array = array('status' => $expiry, 'type' => $typeof,'PASSWORD'=>$passwordkey,'time'=>$this->expiry, 'PASSKEY' => base64_encode($this->IV));
        $encode = json_encode($array);
        $comlex = strrev('AuTHpasSkEY') . $suffix;
        $enc = openssl_encrypt($raw, $method, $key, $opt, $iv);
        return $this->create($enc, $encode, $comlex);


    }



}
