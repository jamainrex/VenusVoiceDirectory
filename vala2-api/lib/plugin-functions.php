<?php
class ValaApiMethods {
    
    protected $api;
    public $prefixName = 'website';
    
    public function __construct()
    {
        $this->api = new Vala();   
    }
    
    public function authenticate( $user, $pass )
    {
        $creds = array(
            'user' => $user,
            'password' => $pass
        );
        return $this->api->authenticate( $creds );
    }
    
    public function getAccessToken()
    {
        return $this->api->getAccessToken();
    }
    
    public function test( $args = array() )
    {
        return $this->api->__call( 'user/me', $args );
    }
    
    private function hasAccess()
    {
        if( is_null( $this->api->getAccessToken() ) )
        {
            $plugin_creds = $this->get_option_keys();
            if( !isset( $plugin_creds ) || !$plugin_creds['authenticated'] )
                return FALSE;
            else{
                
                if( isset( $plugin_creds['vala_access_token'] ) ){
                    $this->api->saveAccessToken( $plugin_creds['vala_access_token'] );
                    return TRUE;
                }
                    
                // Lets try to re-auth and store token to Session.
                $resp = $this->authenticate( $plugin_creds['vala_user_key'], $plugin_creds['vala_pass_key'] );
                
                $options = array();
                $options['vala_user_key'] = $plugin_creds['vala_user_key'];
                $options['vala_pass_key'] = $plugin_creds['vala_pass_key'];
                
                if( isset( $resp['error'] ) )
                {
                    $options['authenticated'] = FALSE;
                    $options['vala_access_token'] = null;
                    
                    update_option('vala_api_keys', $options);
                    return FALSE;
                }else{
                    $options['authenticated'] = TRUE;
                    $options['vala_access_token'] = $this->getAccessToken();
                        
                    update_option('vala_api_keys', $options);
                    return TRUE; 
                }
            }
        }   
        
        return TRUE;
    }
    
    public function getMethod( $name, $id = 0, $args = array() )
    {
        if( $this->hasAccess() )
            return $this->{$name}( $id, $args );
    }
    
    public function getEvents( $id = '', $args = array() )
    {
        if( !$this->hasAccess() )
            return FALSE;
            
            
            
        return $this->api->__call( $this->prefixName . '/events/' . $id, $args );
    }
    
    public function getEventWinnerCircles( $id, $args = array() )
    {
        if( !$this->hasAccess() )
            return FALSE;
            
            
            
        return $this->api->__call( $this->prefixName . '/events/' . $id . '/winner-circles', $args );
    }
    
    public function getEventWinnerCirclesByType( $id, $type, $args = array() )
    {
        if( !$this->hasAccess() )
            return FALSE;
            
        return $this->api->__call( $this->prefixName . '/events/' . $id . '/winner-circles/'.$type, $args );
    }
    
    public function getSponsors( $eventId = 0, $args = array() )
    {    
        if( !$this->hasAccess() )
            return FALSE;
            
        return $this->api->__call( $this->prefixName . '/events/'.$eventId.'/sponsor-categories', $args );
    }
    
    public function organisationPhoto( $organisation = 0, $size = 'medium', $binary = false )
    {
        if( !$this->hasAccess() )
            return FALSE;
        
        $sizes = array(
            'small' => array(
                //'width' => '75',
                'height' => '150'
            ),
            'medium' => array(
                //'width' => '150',
                'height' => '350'
            ),
            'large' => array(
                //'width' => '500',
                'height' => '800'
            )
        );
        
        $args = array_merge( 
            array( 'format' => 'png', 'quality' => '80' ),
            $sizes[ $size ]
         ); 
        
        
        //return $args;
        
        if( $binary )
            return $this->api->__call( $this->prefixName . '/photo-by-organisation/'.$organisation, $args );
        else
            return $this->api->buildUrl( $this->prefixName . '/photo-by-organisation/'.$organisation, $args );
    }
    
    public function getImage( $url, $size = 'medium', $args = array() )
    {
        
        if( !$this->hasAccess() )
            return FALSE;
        
        $sizes = array(
            'small' => array(
                'width' => '150',
                'height' => '150'
            ),
            'medium' => array(
                'width' => '350',
                'height' => '350'
            ),
            'large' => array(
                'width' => '800',
                'height' => '800'
            )
        );
        
        $args = array_merge( 
            array( 'format' => 'png', 
                   'url' => $this->api->google_storage_endpoint . $url,
                   'aspectRatio' => true,
                   'quality' => '80' ),
            $sizes[ $size ]
         ); 
        
        
        //return $args;
        
        /*if( $binary )
            return $this->api->__call( $this->prefixName . '/photo-by-organisation/'.$organisation, $args );
        else*/
            return $this->api->buildUrl( $this->prefixName . '/image/', $args );
            //return $this->api->buildUrl( $this->prefixName . '/photo-by-organisation/'.$organisation, $args );
    }
    
    public function get_option_keys()
    {
        return get_option('vala_api_keys'); 
    }
}

?>
