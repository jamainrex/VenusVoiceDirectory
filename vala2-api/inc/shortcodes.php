<?php
add_shortcode(  'vala2_sponsor_carousel', 'vala2_sponsor_carousel_sc'  );
function vala2_sponsor_carousel_sc(  $atts, $content = null  ) {
global $__vala2api;
extract(  shortcode_atts(  array( 
            'event_id' => ''
     ), $atts ) );

    $output='';
    
    wp_enqueue_style( 'bxslider-css' );
    wp_enqueue_script( 'bxslider' );
    wp_enqueue_script( 'vala2-scripts' );
    
    //$content = content_url('vala2/images');
    //ob_start();echo '<pre>' . print_r( $content, true ) . '</pre>';$content = ob_get_contents();ob_clean();
    $sponsors = $__vala2api->api_methods->getSponsors( $event_id );
    $content = vala2_carousel_sc_template( $sponsors->contracts );
    
    $output .= $content;
    
    return $output;
}

add_shortcode(  'vala2_sponsor_logo', 'vala2_sponsor_logo_sc'  );
function vala2_sponsor_logo_sc(  $atts, $content = null  ) {
global $__vala2api;
extract(  shortcode_atts(  array( 
            'event_id' => '',
            'type' => 'portfolio',
            'columns' => 4
     ), $atts ) );

    $output='';
    
    wp_enqueue_script( 'vala2-css' );
    wp_enqueue_script( 'vala2-scripts' );
    
    $sponsors = $__vala2api->api_methods->getSponsors( $event_id );
    
    $content = vala2_sponsors_logo_sc_template( $sponsors->contracts, $columns, $type );
    
    //echo '<pre>' . print_r( $content, true ) . '</pre>';
    /*ob_start();
        echo '<pre>' . print_r( $sponsors, true ) . '</pre>';
        
        $content = ob_get_contents();
    ob_clean();*/

    $output .= $content;
    
    return $output;
}

// Numbered Lists Shortcode
function venusvoice_numbered_ol_sc( $atts, $content ){
    extract( shortcode_atts( array(
        'id' => '',
        'name' => ''
    ), $atts ) ); 
    
    $output = "";
    
    $output .= '<ol class="vvnumberlist" id="'. $id .'">';
        $output .= do_shortcode( $content );
    $output .= '</ol>';
    
    //removing extra <br>
    $Old     = array( '<br />', '<br>', '<p></p>' );
    $New     = array( '','','' );
    $output = str_replace( $Old, $New, $output );
    
    return $output;
}
add_shortcode('vvol', 'venusvoice_numbered_ol_sc');

function venusvoice_numbered_li_sc( $atts, $content ){
    extract( shortcode_atts( array(
        'title' => '',
        'color' => '',
        'ctr' => ''
    ), $atts ) ); 
    
    $output = "";
    
    $output .= '<li class="'.$color.'">';
    $output .= '<h5><span style="color:'.$color.'; font-size: 45px; padding-right: 10px;">' . $ctr . '</span>'.$title.'</h5>';
    //$output .= '<h5>' . $title . '</h5>';
        $output .= do_shortcode( $content );
    $output .= '</li>';
    
    //removing extra <br>
    $Old     = array( '<br />', '<br>', '<p></p>' );
    $New     = array( '','','' );
    $output = str_replace( $Old, $New, $output );
    
    return $output;
}
add_shortcode('vvli', 'venusvoice_numbered_li_sc');


?>