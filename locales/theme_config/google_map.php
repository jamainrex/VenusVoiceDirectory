<?php
vc_add_shortcode_param( 'google_map', 'tt_google_map', get_template_directory_uri() . '/templates/shortcodes/params/params.js' );

function tt_google_map( $settings, $value ) {
	return sprintf( '<div id="tt-vc-map">
		</div><input type="text" id="tt-search-map"><a href="#" id="tt-remove-markers">%s</a><input name="%s" class="wpb_vc_param_value tt_map_settings" type="text" value="%s">'
		, esc_html__( 'Remove markers', 'locales' ), $settings['param_name'], $value );
}