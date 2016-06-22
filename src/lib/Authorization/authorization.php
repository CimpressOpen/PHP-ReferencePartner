<?php

class authorization
{
    private $JWT = "";

    function __construct() {
   }
   
   public function readFile()
   {
        $file = file_get_contents('lib/Authorization/JWT.txt', FILE_USE_INCLUDE_PATH);
        return $file;
   }

   private function writeToFile($JWT)
   {
        file_put_contents('lib/Authorization/JWT.txt', $JWT);
   }

    public function getNewJWT(){

        $credentialsInputFile = parse_ini_file("../config/credentials.txt");
        $username = $credentialsInputFile['username'];
        $password = $credentialsInputFile['password'];

        $Auth0URL = 'https://cimpress.auth0.com/oauth/ro';
        $ch = curl_init($Auth0URL);

        $RequestBody = 
            '{ 
            "client_id": "4GtkxJhz0U1bdggHMdaySAy05IV4MEDV",
            "username": "'.$username.'",
            "password": "'.$password.'",
            "connection": "default",
            "device": "none",
            "scope": "openid email app_metadata" 
            }';

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //Don't validate the trust chain
        curl_setopt($ch, CURLOPT_POSTFIELDS, $RequestBody); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json')
        );     

        $result = curl_exec($ch);  
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $ret = json_decode($result)->id_token;
        return $ret;
    }

    private function isJWTExpired($jwt){
        if(strlen($jwt) == 0 || $jwt == null){
            return true;
        }
        $var = base64_decode($jwt);
        preg_match_all('/
        \{              # { character
            (?:         # non-capturing group
                [^{}]   # anything that is not a { or }
                |       # OR
                (?R)    # recurses the entire pattern
            )*          # previous group zero or more times
        \}              # } character
        /x',
                $var, $json);
        $output = json_decode($json[0][1], true);
        $expTime= $output['exp'];
        if($expTime >= time()){
            return false;
        }
        else{
            return true;
        }
    }

    public function getJWT(){
        $this->JWT = $this->readFile();
        if(!$this->isJWTExpired($this->JWT))
        {
            return 'Bearer '. $this->JWT;
        }
        else
        {
            $this->JWT = $this->getNewJWT();;
            $this->writeToFile($this->JWT);
            return 'Bearer '. $this->JWT;
        }
    }
}
?>