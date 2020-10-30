<?php

class AuthConfig{
    protected $IV;
    protected $KEY;
    protected $METHOD;
    protected $OPT;
    protected $tokenfolder;
    protected function init($path)
    {
        $this->KEY = '_IndigO_aUTH';
        $this->METHOD = 'AES-256-CBC';
        $this->OPT = 0;
        $this->IV = openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->METHOD));
        $this->tokenfolder=$path;
    }
    protected function create($data,$val,$suffix){
        $encoded=base64_encode(base64_encode($data).$suffix);
        $filepath=$this->tokenfolder.$encoded.'.json';
        $create=new token;
        return $create->construct($filepath,$val,$encoded);
        
        
         
    }

}



?>