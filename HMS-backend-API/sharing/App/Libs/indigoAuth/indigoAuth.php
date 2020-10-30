<?php
$Config=[
    'SIGN'=>'src/Sign/init.php',
    'VERIFY'=>'src/Verify/init.php',
    'Enc'=>'src/config.php'
];
require_once $Config['Enc'];
require_once $Config['SIGN'];
require_once $Config['VERIFY'];
class IndigoAuth extends CreateSignature
{   private $token  = '../App/Libs/indigoAuth/src/Tokens/';
    private $suff='.json';
    public $signature;
    public function Sign($data,$expiry)
    {   
        return $this->Tokenize($data,$expiry,$this->token);
    }


    public function checkSignature($signature){
            $handler=$this->token.$signature.$this->suff;
            if (file_exists($handler)) {
                $file=fopen($handler,'r');
                $data=fread($file,1000);
                $sign = new checkSignature;
                return $sign ->mount($signature,$data);

            } else {
                http_response_code(401);
                $resp=['message'=>'Invalid Token'];
                echo json_encode($resp);
                die();
            }
            
            
    }
}

class token{
   public function construct($handler,$ext,$fin)
   {
       $target=fopen($handler,'w');
       $token=fwrite($target,$ext);
       fclose($target);
       return $fin;         
       
   }
}




?>