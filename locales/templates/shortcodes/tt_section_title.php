<?php 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$css_class = !empty($css) ? vc_shortcode_custom_css_class( $css ) : '';

$output = '<h2 class="section-title '.$css_class.' '.$el_class.'">' ;
$output .= '<div class="container">';
$output .= !empty($title) ? ''.$title.'' : '';
$output .= !empty($subtext) ? '<p>'.$subtext.'</p>' : '';
$output .= '</div>';
$output .= '</h2>';
print balanceTags($output);
?>