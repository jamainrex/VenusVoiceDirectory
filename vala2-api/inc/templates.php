<?php

function vala2_carousel_sc_template( $contracts = array(), $title = '', $parameters = array() )
{
    global $__vala2api;
    
    //$id = 'sponsors';
    
    $klcadmin = new kiwi_logo_carousel_admin();
    $parameters = $klcadmin->find_parameters( $id );
    
    //return $parameters;
    $title;
    $returnstring = '';
    
    $returnstring = '<ul class="kiwi-logo-carousel kiwi-logo-carousel-'.$id.' '.$parameters['klco_style'].' align-'.$parameters['klco_alignment'].' col4">';
            foreach ( $contracts as $s ):
                if( is_null( $s->organization_contract ) )
                    continue;
            
                $logo = $s->organization_contract->organization;
                $image = $__vala2api->api_methods->getImage( $logo->picture );// $logo->picture;
                //$image = $logo->picture;
                $url = '#';
                if ( !isset( $parameters['klco_clickablelogos'] )) { $parameters['klco_clickablelogos'] = 'newtab'; }
                if ( !empty($url) && $parameters['klco_clickablelogos']!="off" ) {
                    if ( $parameters['klco_clickablelogos'] == "newtab" ) { $returnstring.= '<li style="height:'.$parameters['klco_height'].'px;"><a target="_blank" href="'.$url.'"><div class="helper" style="height:'.$parameters['klco_height'].'px; width:'.$parameters['slideWidth'].'px;" ><img src="'.$image.'" alt="'.$title.'" title="'.$title.'"></div></a></li>'; }
                    else if ( $parameters['klco_clickablelogos'] == "samewindow" ) { $returnstring.= '<li style="height:'.$parameters['klco_height'].'px;"><a href="'.$url.'"><div class="helper" style="height:'.$parameters['klco_height'].'px; width:'.$parameters['slideWidth'].'px;" ><img src="'.$image.'" alt="'.$title.'" title="'.$title.'"></div></a></li>'; }
                }
                else { $returnstring.= '<li style="height:'.$parameters['klco_height'].'px;" ><div class="helper" style="height:'.$parameters['klco_height'].'px; width:'.$parameters['slideWidth'].'px;" ><img src="'.$image.'" alt="'.$title.'" title="'.$title.'" style="max-width:'.$parameters['slideWidth'].'px; padding-left: '.$parameters['slideMargin']/ 2 .'px; padding-right:'.$parameters['slideMargin']/ 2 .'px" ></div></li>'; }
            endforeach;
            $returnstring.= '</ul>';
            
            return $returnstring;
}

function vala2_sponsors_logo_sc_template( $catSponsors, $columns, $type = 'portfolio' ){
    global $post, $paged, $wp_query, $__vala2api;    
    
    wp_enqueue_style( 'newvala-css' );
    wp_enqueue_script( 'newvala-js' );
    
    /** get appropriate columns, image height and image width*/
    //$_values = zp_portfolio_items_values( $columns );
    $_values['width'] = 245;
    $_values['height'] = 160;
    /** determines if it will be a portfolio layout or gallery layout*/
    $class = ( $type == 'portfolio' ) ? 'sponsor-element' : 'gallery';

    $html='';
    $output ='';
    //$html .='<div id="container-" class="filter_container" style="height: auto; width: 100%;"> ';
    //return $catSponsors;
    foreach( $catSponsors as $catSponsor ){
        //echo '<pre>' . print_r( $catSponsor, true ) . '</pre>';
        // Set to empty Array
        //$organisation = array();
        //$category = array();
        //$contractType = array();
                
        $category = $catSponsor->category;
        $organisation = $catSponsor->organization_contract->organization;
        $contractType = $catSponsor->type;

            $logo = ""; 
            $logo = $organisation->picture;     
            $isLogoValid = true;
            if( !isset( $organisation->picture ) || empty( $organisation->picture ) ) $isLogoValid = false;
    
            $_allowed = array('jpg','jpeg','png','gif');
            
            $_logo = explode( '.', $organisation->picture ); 
            $_format = strtolower( $_logo[sizeof($_logo)-1] );
            if( !in_array( $_format, $_allowed) ) $isLogoValid = false;

            $sp = trim( $organisation->name );
            if( empty( $sp ) || !$isLogoValid ) continue;
            
            $t=$contractType->name;
            $permalink='#';
            $link = isset($organisation->website) ? $organisation->website : '';
            $twitter = isset( $organisation->twitter ) ? $organisation->twitter : '';
            $linkedin = isset( $organisation->linkedin ) ? $organisation->linkedin : '';
            $fb = isset( $organisation->facebook ) ? $organisation->facebook : '';
            // $blurb = $s->blurb;    
            $blurb = $organisation->description;

            //$cat = isset($s['category'])?$s['category']:'';
            $cat_name = isset($category)?$category->name:'';
            
            // if not Category Sponsor
            if( $contractType->name != 'Category Sponsor' && empty( $cat_name ) ) $cat_name = $contractType->name;
            
            //$thumbnail = $s->logo; 
            $logo = $__vala2api->api_methods->getImage( $organisation->picture, 'large' );
            $thumbnail = '';
            //if( $isLogoValid )
                $thumbnail = $logo;
    
            
            $openLink='<div class="portfolio_image">';

            $closeLink='</div>';

            /** Social Links*/
            // $social='<div class="team_socials">' . "$link". "$twitter" . "$linkedin" . "$fb" . '</div>';
            //$social = '<ul class="team_socials">';
            $sc_icons = '<div style="padding: 25px;">';
            $social = '<ul id="vce_social_menu" class="soc-nav-menu">';
            
            if ( $link && false ) {
              $social .= '<li><a class="t_website hastip" href="' . $link . '" target="_blank"></a>';
            }
            
            if ( $fb ) {
              $sc_icons .= do_shortcode( '[mks_social icon="facebook" size="25" style="square" url="'.$fb.'" target="_blank"]' );
              //$social .= '<li><a class="t_facebook hastip" href="' . $fb . '" target="_blank"></a>';
              $social .= '<li><a href="' . $fb . '" target="_blank"><span class="vce-social-name">Facebook</span></a></li>';
            }
            
            if ( $twitter ) {
                $sc_icons .= do_shortcode( '[mks_social icon="twitter" size="25" style="square" url="'.$twitter.'" target="_blank"]' );
              //$social .= '<li><a class="t_twitter hastip" href="' . $twitter . '" target="_blank"></a>';
              $social .= '<li><a href="' . $twitter . '" target="_blank"><span class="vce-social-name">Twitter</span></a></li>';
            }
            
            if ( $linkedin ) {
                $sc_icons .= do_shortcode( '[mks_social icon="linkedin" size="25" style="square" url="'.$linkedin.'" target="_blank"]' );
              $social .= '<li><a class="t_linkedin hastip" href="' . $linkedin . '" target="_blank"></a>';
            }
            
            $sc_icons .= '</div>';
            $social .= '</ul>';
            /** End Social Links **/

            $span_desc='<div class="item-desc" style="display:none;"><a class="item_link" href="'.$permalink.'"></a></div><div class="item_label sponsor-content"><h4>'.$t.'  </h4><div class="social">'.$social.'</div><p class="sponsor-content-text"><h4>'.$cat_name.'</h4>'.$blurb.'</p></div>';    
          
            /** generate the final item HTML */ 
           /*$html.= '<div class="sponsor-element '.$class.''.$_values['class'].' '.$ext_class.'" >'.$openLink.'<img src="'.$thumbnail.'" alt="'.$t.'" />'.$closeLink.''.$span_desc.'</div>'; */   
           
           $output .= '<article class="vce-post vce-lay-c">';
    
    $logo_html = '<img src="'. $thumbnail .'" class="attachment-vce-lay-b size-vce-lay-b wp-post-image" alt="'.$sp.'">';
    //if( $link )
      //  $logo_html = '<a href="'.$link.'" target="_blank">' . $logo_html . '</div>';
    
    $output .= '<div class="meta-image" style="height: '.$_values['height'].'px">' . $logo_html . '</div>';
    
    //$output .= '<header class="entry-header">'. $span_desc .'</header>';
    
    $output .= '<header class="entry-header">
        <span class="meta-category"> '.$sc_icons.'</span>
        <div style="clear:both"></div>
        <h2 class="entry-title">'.$cat_name.'</h2></header>';
    
   
   $va_content = text_expander( $blurb );     
   $output .= '<div class="entry-content textContainer_Truncate">
            
            <p>'. $blurb .'</p>
        </div>';
        //<p class="textContainer_Truncate">'. $va_content['less'] .'</p>
        //<p><a href="#">Read More</a></p>
        
   //$output .= '<div class="va-read-more"><p>Read More</p></div>';
   $output .= '</article>'; 
           
    } 
    
    return $html .= '<div id="va-sponsor-layout" class="vce-loop-wrap">' . $output . '</div>';
} 
?>
