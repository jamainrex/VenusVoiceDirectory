<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $full_width
 * @var $full_height
 * @var $equal_height
 * @var $columns_placement
 * @var $content_placement
 * @var $parallax
 * @var $parallax_image
 * @var $css
 * @var $el_id
 * @var $video_bg
 * @var $video_bg_url
 * @var $video_bg_parallax
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row
 */
$el_class = $full_height = $parallax_speed_bg = $parallax_speed_video = $full_width = $equal_height = $flex_row = $columns_placement = $content_placement = $parallax = $parallax_image = $css = $el_id = $video_bg = $video_bg_url = $video_bg_parallax = '';
$output = $after_output = $col_gap = $colum_placement = $content_place = $equal_col = $flex = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script( 'wpb_composer_front_js' );

$wrapper_attributes = array();

$el_class = $this->getExtraClass( $el_class );

if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}

if ( ! empty( $full_height ) ) {
	$full_height = 'full-height';
	if ( ! empty( $columns_placement ) ) {
		$flex_row = true;
		$colum_placement = 'vc_row-o-columns-' . $columns_placement;
		if ( 'stretch' === $columns_placement ) {
			$colum_placement = 'vc_row-o-equal-height';
		}
	}
}

$has_video_bg = ( ! empty( $video_bg ) && ! empty( $video_bg_url ) && vc_extract_youtube_id( $video_bg_url ) );

$video_bg = '';
if ( $has_video_bg ) {
	$parallax = $video_bg_parallax;
	$parallax_image = $video_bg_url;
	$video_bg = 'vc_video-bg-container';
	wp_enqueue_script( 'vc_youtube_iframe_api_js' );
}

if ( ! empty( $parallax ) ) {
	wp_enqueue_script( 'vc_jquery_skrollr_js' );
	$wrapper_attributes[] = 'data-vc-parallax="1.5"'; // parallax speed
	$css_classes[] = 'vc_general vc_parallax vc_parallax-' . $parallax;
	if ( strpos( $parallax, 'fade' ) !== false ) {
		$css_classes[] = 'js-vc_parallax-o-fade';
		$wrapper_attributes[] = 'data-vc-parallax-o-fade="on"';
	} elseif ( strpos( $parallax, 'fixed' ) !== false ) {
		$css_classes[] = 'js-vc_parallax-o-fixed';
	}
}

$parallax_class = !empty( $parallax ) ? 'paralax-section' : '';

if ( ! empty ( $parallax_image ) ) {
	if ( $has_video_bg ) {
		$parallax_image_src = $parallax_image;
	} else {
		$parallax_image_id = preg_replace( '/[^\d]/', '', $parallax_image );
		$parallax_image_src = wp_get_attachment_image_src( $parallax_image_id, 'full' );
		if ( ! empty( $parallax_image_src[0] ) ) {
			$parallax_image_src = $parallax_image_src[0];
		}
	}
	$wrapper_attributes[] = 'data-vc-parallax-image="' . esc_attr( $parallax_image_src ) . '"';
}
if ( ! $parallax && $has_video_bg ) {
	$wrapper_attributes[] = 'data-vc-video-bg="' . esc_attr( $video_bg_url ) . '"';
}

$section_data = implode(' ', $wrapper_attributes);

if ( ! empty( $equal_height ) ) {
	$flex_row = true;
	$equal_col = 'vc_row-o-equal-height';
}

if ( ! empty( $content_placement ) ) {
	$flex_row = true;
	$content_place = ' vc_row-o-content-' . $content_placement;
}

if ( ! empty( $flex_row ) ) {
	$flex = 'vc_row-flex';
}

if (!empty($atts['gap'])) {
	$col_gap = 'vc_column-gap-'.$atts['gap'];
}

$tt_css = array(
	vc_shortcode_custom_css_class( $css ),
	$parallax_class,
	$el_class,
);

$vc_css = array (
	$video_bg,
	$full_height,
	$colum_placement,
	$equal_col,
	$flex,
	$content_place,
	$col_gap
);

$tt_css = implode(' ', $tt_css);
$vc_css = implode(' ', $vc_css);

switch ($full_width) {
	case 'stretch_row':
		printf('<section class="section %s" %s><div class="container"><div class="vc_row %s">%s</div></div></section>', $tt_css, $section_data, $vc_css, wpb_js_remove_wpautop( $content ));
		break;

	case 'stretch_row_content':
		printf('<section class="section %s" %s><div class="container-fluid"><div class="vc_row %s">%s</div></div></section>', $tt_css, $section_data, $vc_css, wpb_js_remove_wpautop( $content ));
		break;

	case 'stretch_row_content_no_spaces':
		printf('<section class="section ovh %s" %s><div class="container-fluid no-padding"><div class="vc_row %s vc-row-fit">%s</div></div></section>', $tt_css, $section_data, $vc_css, wpb_js_remove_wpautop( $content ));
		break;
	
	default:
		printf('<div class="section %s" %s>%s</div>', $tt_css, $section_data, wpb_js_remove_wpautop( $content ));
		break;
}