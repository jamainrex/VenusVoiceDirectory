<?php
if( !function_exists( "file_get_contents_curl" ) ){
   function file_get_contents_curl($url, $opt) {
       $header = $opt['https'];
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_HEADER, FALSE);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set curl to return the data instead of printing it to the browser.
      curl_setopt($ch, CURLOPT_URL, $url);
      $data = curl_exec($ch);
      curl_close($ch);
      
      return $data;
      }
}
?>

<?php
  
  Class Vala {
  
     /**
     * Current version.
     * @TODO Update version number for new releases
     * @var    string
     */
    const CURRENT_VERSION = '2.0';

    /**
     * Translation domain
     * @var string
     */
    const TEXT_DOMAIN = 'vala';
    
    var $api_endpoint = "https://local.vala2.com/api/";
    var $google_bucket = "vala2-development";
    var $google_storage_endpoint = "https://storage.googleapis.com/";
    var $auth_tokens;
    var $api_url;
      
    function __construct( $user = null, $password = null ) {
        $this->api_url = parse_url($this->api_endpoint);
        $this->auth_tokens = array();
        
        $this->auth_tokens['user'] = $user;
        $this->auth_tokens['password'] = $password;
    }

      public function get_google_endpoint(){
          return $this->google_storage_endpoint . "/" . $this->google_bucket . "/";
      }

      public static function getGoogleUri(){
          return self::get_google_endpoint();
      }
    
    /*function test()
    {
        return $this->api_url;
    }*/
    
    function authenticate( $tokens ){
        $params = array(
            'grant_type'=>'authorization_code',
            'email'=> $tokens['user'],
            'password'=> $tokens['password'] );

        $request_url = $this->api_endpoint . 'authenticate';
        
        //return $request_url;

        // TODO: Replace the cURL code with something a bit more modern -
        //$context = stream_context_create(array('http' => array(
        //    'method'  => 'POST',
        //    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        //    'content' => http_build_query($params))));
        //$json_data = file_get_contents_curl( $request_url, false, $context );

        // CURL-POST implementation -
        // WARNING: This code may require you to install the php5-curl package
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_URL, $request_url);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $json_data = curl_exec($ch);
        $resp_info = curl_getinfo($ch);
        curl_close($ch);
        
        $response = get_object_vars(json_decode($json_data));
        
        try{
            if( !array_key_exists('token', $response) || array_key_exists('error', $response) )
            throw new Exception( $response['message'] );
        
            $this->auth_tokens['code'] = $response['token'];    
            $this->saveAccessToken( $response['token'] );
        }catch( \Exception $e )
        {
            return array(
                'error' => TRUE,
                'message' => $e->getMessage(),
                'code' => 404
            );
        }
        
        return array_merge($tokens, $response);
    }
    
    function __call( $method, $args ) {      
        // Unpack our arguments
        if( is_array( $args ) && array_key_exists( 0, $args ) && is_array( $args[0]) ){
            $params = $args[0];
        }else{
            $params = array();
        }

        // Build our request url, urlencode querystring params
        $request_url = $this->api_url['scheme']."://".$this->api_url['host'].$this->api_url['path'].$method.'?'.http_build_query( $params,'','&');
        
        // Call the API
       $options = array(
           'http'=>array( 'method'=> 'GET',
           'header'=> "Authorization: Bearer " . $this->getAccessToken())
       );

       //return $request_url;
       
       //$resp = file_get_contents_curl( $request_url, false, stream_context_create($options));
       $resp = file_get_contents_curl( $request_url, $options );
        
        // parse our response
        if($resp){
            $resp = json_decode( $resp );

            if( isset( $resp->error ) && isset($resp->message) ){
                throw new Exception( $resp->message );
            }
        }
        return $resp;
    }
    
    function buildUrl( $method, $args ) {
        // Unpack our arguments
        /*if( is_array( $args ) && array_key_exists( 0, $args ) && is_array( $args[0]) ){
            $params = $args[0];
        }else{
            $params = array();
        }
        
        return $params;*/

        // Build our request url, urlencode querystring params
        $request_url = $this->api_url['scheme']."://".$this->api_url['host'].$this->api_url['path'].$method.'?'.http_build_query( $args,'','&');
        
        // Call the API
       $options = array(
           'http'=>array( 'method'=> 'GET',
           'header'=> "Authorization: Bearer " . $this->getAccessToken())
       );

       return $request_url;
    }
    
    public static function getAccessToken( ) {
        if( isset($_SESSION['VALA_ACCESS_TOKEN']) ){
            return $_SESSION['VALA_ACCESS_TOKEN'];
        }else{
            return null;
        }
    }

    public static function saveAccessToken( $access_token ) {
        // this function should save the existing user's access_token.
        $_SESSION['VALA_ACCESS_TOKEN'] = $access_token;
    }

    public static function deleteAccessToken( ) {
        // this function should remove the existing user's access_token.
        unset($_SESSION['VALA_ACCESS_TOKEN']);
    }
    
  }
?>
