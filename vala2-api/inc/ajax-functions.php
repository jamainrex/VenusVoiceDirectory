<?php

function vala2_browse_events_action() {
    if( !session_id())
        session_start();
        
        global $__vala2api;
        
        $retval = array();
        $html = array();
        
        $event_id = ( ( $_POST['dir'] == '/' ) ? '' : (int) str_replace( '/', '', trim( $_POST['dir'] )) );
        
        /* The 2 accounts for . and .. */
        $html[] = '<ul class="jqueryFileTree" style="display: none;">';
        
        if( empty( $event_id )){
            $api = $__vala2api->api_methods->getEvents( $event_id );
            $events = $api->results;
            
            foreach ($events as $event) {
                if( $event->status != 'active' )
                    continue;
                
                $html[] = '<li class="directory collapsed"><a href="#" rel="' . htmlentities( $event->id ) . '/">' . htmlentities( $event->name ) . '</a></li>';
            }
            
        }else{
            $flags = array(
                'semi' => false,
                'finalists' => false,
                'winners' => false,
            );
            list( $eid, $appType ) = explode( "-", $_POST['dir'] );
            $appType = str_replace( '/', '', $appType );
            if( !in_array( $appType, array_keys( $flags ) ) )
            {
                $api = $__vala2api->api_methods->getEventWinnerCircles( $event_id );
                $applications = $api->userApplications;
                
                foreach( $applications as $application )
                {
                    if( !is_null( $application->semifinalist_on ) && !$flags['semi'] )
                    {
                        $html[] = '<li class="directory collapsed"><a data-name="'.htmlentities( $api->event->name ).' - Semi-finalists" href="#" lang="' . htmlentities( $api->event->id ) . '/winner-circles/3" rel="' . htmlentities( $api->event->id ) . '-semi/">' . htmlentities( "Semi-finalists" ) . '</a></li>'; 
                        
                        $flags['semi'] = true;   
                    }
                    
                    if( !is_null( $application->finalist_on ) && !$flags['finalists'] )
                    {
                        $html[] = '<li class="directory collapsed"><a data-name="'.htmlentities( $api->event->name ).' - Finalists" href="#" lang="' . htmlentities( $api->event->id ) . '/winner-circles/4" rel="' . htmlentities( $api->event->id ) . '-finalists/">' . htmlentities( "Finalists" ) . '</a></li>'; 
                        
                        $flags['finalists'] = true;   
                    }
                    
                    if( !is_null( $application->winner_on ) && !$flags['winners'] )
                    {
                        $html[] = '<li class="directory collapsed"><a data-name="'.htmlentities( $api->event->name ).' - Winners" href="#" lang="' . htmlentities( $api->event->id ) . '/winner-circles/5" rel="' . htmlentities( $api->event->id ) . '-winners/">' . htmlentities( "Winners" ) . '</a></li>'; 
                        
                        $flags['winners'] = true;   
                    }

                }
            }
        }

        $html[] = '</ul>';
            
            $retval['html'] = implode('
', $html);
            
    print_r( json_encode( $retval ) );
    die(); 
    return $retval;
}

add_action( 'wp_ajax_vala2_browse_events', 'vala2_browse_events_action' );

function vala2_get_winner_circles_action()
{   
    global $__vala2api;
    
        
        list( $eid, ,$appType ) = explode( "/", $_POST['folder'] );
        //$appType = str_replace( '/', '', $appType );
         
        $api = $__vala2api->api_methods->getEventWinnerCirclesByType( $eid, $appType );
        $applications = $api->UserEventApplications;
        $_apps = array();
        
        foreach( $applications as $application )
        {
            $_apps[] = array(
                        'id' => $application->user->id,
                        'firstname' => $application->user->firstname,
                        'MI' => $application->user->MI,
                        'lastname' => $application->user->lastname,
                        'name' => $application->user->name,
                        'email' => $application->user->email,
                        'biography' => $application->user->profile->biography,
                        'picture' => $application->user->profile->picture
                    ); 
        }
        
        
   print_r( json_encode( $_apps ) );
   die();   
}
add_action( 'wp_ajax_vala2_get_winner_circles', 'vala2_get_winner_circles_action' );

function import_vala2_action()
    {
        global $wpdb;
        $__ngg_picture_table = $wpdb->prefix . 'ngg_pictures';
        $params = $_POST;
        $retval = array();
        $created_gallery = FALSE;
        $gallery_id = intval($_POST['gallery_id']);
        $gallery_name = urldecode($_POST['gallery_name']);
        $gallery_mapper = C_Gallery_Mapper::get_instance();
        $image_mapper = C_Image_Mapper::get_instance();
        $vala2_folder = $_POST['vala2_folder'];
        
            if ($folder = $_POST['folder'] ) {
                $storage = C_Gallery_Storage::get_instance();
                $fs = C_Fs::get_instance();
                try {
                  
                    if (empty($retval['error']) && $gallery_id == 0) {
                        if (strlen($gallery_name) > 0) {
                            $gallery = $gallery_mapper->create(array('title' => $gallery_name));
                            if (!$gallery->save()) {
                                $retval['error'] = $gallery->get_errors();
                            } else {
                                $created_gallery = TRUE;
                                $gallery_id = $gallery->id();
                            }
                        } else {
                            $retval['error'] = __('No gallery name specified', 'nggallery');
                        }
                    }
                    $retval['gallery_id'] = $gallery_id;
                    foreach( $_POST['vala2_applications'] as $vala2_application )
                    {
                        unset( $__vala2_appId );
                        $__vala2_appId = $vala2_application['id'];
                        
                        $__image = $wpdb->get_results("SELECT np.* FROM $wpdb->postmeta pm inner join $__ngg_picture_table np on pm.post_id=np.extras_post_id  WHERE pm.meta_key = '__vala_profile_id' AND  pm.meta_value = '$__vala2_appId' LIMIT 1", ARRAY_A);

                        try {
                            if( $__image )
                            {
                                
                                // Potentially import metadata from WordPress
                                $image = $image_mapper->find( $__image->pid );  
                                $image->alttext = $vala2_application['name'];
                                $image->description = $vala2_application['biography'];
                                $image = apply_filters('ngg_medialibrary_imported_image', $image, $attachment);
                                $image_mapper->save($image);
                                    
                                if ( ! add_post_meta( $image->extras_post_id, '__vala_profile_id', $__vala2_appId, true ) ) { 
                                    update_post_meta( $image->extras_post_id, '__vala_profile_id', $__vala2_appId );
                                }
                            }else{
                            
                                $abspath = $vala2_application['picture'];
                                //$abspath = 'https://storage.googleapis.com/vala-images/051dc9df3b96af817d42da53af374cbd.jpg';
                                $file_data = @file_get_contents($abspath);
                                //$file_name = M_I18n::mb_basename($abspath);
                                $file_name = strtolower( $vala2_application['name'] ).'.jpg';
                                $retval['data'] = json_encode( $file_data );
                                //$attachment = get_post($id);
                                if (empty($file_data)) {
                                    $retval['error'] = __('Image generation failed', 'nggallery');
                                    break;
                                }
                                $image = $storage->upload_base64_image($gallery_id, $file_data, $file_name);
                                if ($image) {
                                    // Potentially import metadata from WordPress
                                    $image = $image_mapper->find($image->id());
                                    $image->alttext = $vala2_application['name'];
                                    $image->description = $vala2_application['biography'];
                                    //$image->appid = $vala2_application['id'];
                                    $image = apply_filters('ngg_medialibrary_imported_image', $image, $attachment);
                                    
                                    $image_mapper->save($image);
                                    
                                    if ( ! add_post_meta( $image->extras_post_id, '__vala_profile_id', $__vala2_appId, true ) ) { 
                                       update_post_meta( $image->extras_post_id, '__vala_profile_id', $__vala2_appId );
                                    }
                                    
                                } else {
                                    $retval['error'] = __('Image generation failed', 'nggallery');
                                    break;
                                }
                                
                            } // end
                        

                            $retval['image_ids'][] = $image->{$image->id_field};
                            } catch (E_NggErrorException $ex) {
                                $retval['error'] = $ex->getMessage();
                                if ($created_gallery) {
                                    $gallery_mapper->destroy($gallery_id);
                                }
                            } catch (Exception $ex) {
                                $retval['error'] = __('An unexpected error occured.', 'nggallery');
                                $retval['error_details'] = $ex->getMessage();
                            }
                    
                    }
                    

                } catch (E_NggErrorException $ex) {
                    $retval['error'] = $ex->getMessage();
                } catch (Exception $ex) {
                    $retval['error'] = __('An unexpected error occured.', 'nggallery');
                    $retval['error_details'] = $ex->getMessage();
                }
            } else {
                $retval['error'] = __('No folder specified', 'nggallery');
            }
        //return $retval;
        print_r( json_encode( $retval ) );
        die();   
    }
    
add_action( 'wp_ajax_import_vala2', 'import_vala2_action' );


?>
