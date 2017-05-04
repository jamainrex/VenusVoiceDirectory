<?php
$post_categories = get_terms( array( 'taxonomy' => 'location_tax', 'hide_empty' => false ) );
$post_cats = [];
if(!is_wp_error($post_categories)) :
	foreach($post_categories as $category) 
		$post_cats[$category->name] = $category->slug;
endif;

$vc_is_wp_version_3_6_more = version_compare( preg_replace( '/^([\d\.]+)(\-.*$)/', '$1', get_bloginfo( 'version' ) ), '3.6' ) >= 0;

add_filter( 'vc_iconpicker-type-icomoon', 'tt_icon');

$colors_arr = array (
	esc_html__( 'Blue', 'locales' ) => 'blue',
	esc_html__( 'Turquoise', 'locales' ) => 'turquoise',
	esc_html__( 'Pink', 'locales' ) => 'pink',
	esc_html__( 'Violet', 'locales' ) => 'violet',
	esc_html__( 'Peacoc', 'locales' ) => 'peacoc',
	esc_html__( 'Chino', 'locales' ) => 'chino',
	esc_html__( 'Mulled Wine', 'locales' ) => 'mulled_wine',
	esc_html__( 'Vista Blue', 'locales' ) => 'vista_blue',
	esc_html__( 'Black', 'locales' ) => 'black',
	esc_html__( 'Orange', 'locales' ) => 'orange',
	esc_html__( 'Sky', 'locales' ) => 'sky',
	esc_html__( 'Green', 'locales' ) => 'green',
	esc_html__( 'Juicy pink', 'locales' ) => 'juicy_pink',
	esc_html__( 'Sandy brown', 'locales' ) => 'sandy_brown',
	esc_html__( 'Purple', 'locales' ) => 'purple',
	esc_html__( 'White', 'locales' ) => 'white',
);


function tt_icon($icons) {
	$icomoon = array(
		array( 'icon-ac_unit' => 'ac_unit'),
		array( 'icon-alarm' => 'alarm'),
		array( 'icon-account_balance' => 'account_balance'),
		array( 'icon-airplay' => 'airplay'),
		array( 'icon-flag' => 'flag'),
		array( 'icon-attach_money' => 'attach_money'),
		array( 'icon-audiotrack' => 'audiotrack'),
		array( 'icon-brightness_2' => 'brightness_2'),
		array( 'icon-brightness_3' => 'brightness_3'),
		array( 'icon-brightness_4' => 'brightness_4'),
		array( 'icon-brush' => 'brush'),
		array( 'icon-business_center' => 'business_center'),
		array( 'icon-cake' => 'cake'),
		array( 'icon-phone2' => 'phone2'),
		array( 'icon-call_end' => 'call_end'),
		array( 'icon-camera' => 'camera'),
		array( 'icon-photo_camera' => 'photo_camera'),
		array( 'icon-camera_enhance' => 'camera_enhance'),
		array( 'icon-camera_roll' => 'camera_roll'),
		array( 'icon-child_friendly' => 'child_friendly'),
		array( 'icon-wb_cloudy' => 'wb_cloudy'),
		array( 'icon-cloud_done' => 'cloud_done'),
		array( 'icon-cloud_queue' => 'cloud_queue'),
		array( 'icon-laptop' => 'laptop'),
		array( 'icon-directions_bus' => 'directions_bus'),
		array( 'icon-directions_car' => 'directions_car'),
		array( 'icon-directions_railway' => 'directions_railway'),
		array( 'icon-directions_transit' => 'directions_transit'),
		array( 'icon-time_to_leave' => 'time_to_leave'),
		array( 'icon-explore' => 'explore'),
		array( 'icon-extension' => 'extension'),
		array( 'icon-favorite' => 'favorite'),
		array( 'icon-favorite_border' => 'favorite_border'),
		array( 'icon-filter_drama' => 'filter_drama'),
		array( 'icon-terrain' => 'terrain'),
		array( 'icon-fingerprint' => 'fingerprint'),
		array( 'icon-fitness_center' => 'fitness_center'),
		array( 'icon-flash_on' => 'flash_on'),
		array( 'icon-flight_land' => 'flight_land'),
		array( 'icon-flight_takeoff' => 'flight_takeoff'),
		array( 'icon-free_breakfast' => 'free_breakfast'),
		array( 'icon-goat' => 'goat'),
		array( 'icon-group_work' => 'group_work'),
		array( 'icon-headset' => 'headset'),
		array( 'icon-high_quality' => 'high_quality'),
		array( 'icon-home' => 'home'),
		array( 'icon-local_hotel' => 'local_hotel'),
		array( 'icon-photo' => 'photo'),
		array( 'icon-image_aspect_ratio' => 'image_aspect_ratio'),
		array( 'icon-keyboard_voice' => 'keyboard_voice'),
		array( 'icon-language' => 'language'),
		array( 'icon-laptop_chromebook' => 'laptop_chromebook'),
		array( 'icon-laptop_mac' => 'laptop_mac'),
		array( 'icon-laptop_windows' => 'laptop_windows'),
		array( 'icon-library_music' => 'library_music'),
		array( 'icon-lightbulb_outline' => 'lightbulb_outline'),
		array( 'icon-linked_camera' => 'linked_camera'),
		array( 'icon-live_tv' => 'live_tv'),
		array( 'icon-local_airport' => 'local_airport'),
		array( 'icon-local_cafe' => 'local_cafe'),
		array( 'icon-local_car_wash' => 'local_car_wash'),
		array( 'icon-restaurant_menu' => 'restaurant_menu'),
		array( 'icon-local_drink' => 'local_drink'),
		array( 'icon-local_pizza' => 'local_pizza'),
		array( 'icon-print' => 'print'),
		array( 'icon-monetization_on' => 'monetization_on'),
		array( 'icon-network_check' => 'network_check'),
		array( 'icon-settings_input_antenna' => 'settings_input_antenna'),
		array( 'icon-signal_wifi_4_bar' => 'signal_wifi_4_bar'),
		array( 'icon-signal_wifi_4_bar_lock' => 'signal_wifi_4_bar_lock'),
		array( 'icon-signal_wifi_off' => 'signal_wifi_off'),
		array( 'icon-eye' => 'eye'),
		array( 'icon-mail2' => 'mail2'),
		array( 'icon-bell' => 'bell'),
		array( 'icon-lock' => 'lock'),
		array( 'icon-ribbon' => 'ribbon'),
		array( 'icon-image' => 'image'),
		array( 'icon-clock' => 'clock'),
		array( 'icon-camera2' => 'camera2'),
		array( 'icon-disc' => 'disc'),
		array( 'icon-printer' => 'printer'),
		array( 'icon-monitor' => 'monitor'),
		array( 'icon-server' => 'server'),
		array( 'icon-heart2' => 'heart2'),
		array( 'icon-book' => 'book'),
		array( 'icon-paper-stack' => 'paper-stack'),
		array( 'icon-microphone' => 'microphone'),
		array( 'icon-folder' => 'folder'),
		array( 'icon-umbrella' => 'umbrella'),
		array( 'icon-moon' => 'moon'),
		array( 'icon-thermometer' => 'thermometer'),
		array( 'icon-drop' => 'drop'),
		array( 'icon-sun' => 'sun'),
		array( 'icon-cloud' => 'cloud'),
		array( 'icon-cloud-upload' => 'cloud-upload'),
		array( 'icon-cloud-download' => 'cloud-download'),
		array( 'icon-location2' => 'location2'),
		array( 'icon-location-2' => 'location-2'),
		array( 'icon-map' => 'map'),
		array( 'icon-head' => 'head'),
		array( 'icon-briefcase' => 'briefcase'),
		array( 'icon-speech-bubble' => 'speech-bubble'),
		array( 'icon-anchor' => 'anchor'),
		array( 'icon-tag' => 'tag'),
		array( 'icon-content-right' => 'content-right'),
		array( 'icon-content-left' => 'content-left'),
		array( 'icon-grid' => 'grid'),
		array( 'icon-loader' => 'loader'),
		array( 'icon-bag' => 'bag'),
		array( 'icon-flag2' => 'flag2'),
		array( 'icon-trash' => 'trash'),
		array( 'icon-file' => 'file'),
		array( 'icon-open' => 'open'),
		array( 'icon-keyboard_return' => 'keyboard_return'),
		array( 'icon-menu' => 'menu'),
		array( 'icon-menu2' => 'menu2'),
		array( 'icon-cloud2' => 'cloud2'),
		array( 'icon-layers' => 'layers'),
		array( 'icon-open-book' => 'open-book'),
		array( 'icon-aircraft-landing' => 'aircraft-landing'),
		array( 'icon-aircraft-take-off' => 'aircraft-take-off'),
		array( 'icon-aircraft' => 'aircraft'),
		array( 'icon-bowl' => 'bowl'),
		array( 'icon-briefcase2' => 'briefcase2'),
		array( 'icon-browser' => 'browser'),
		array( 'icon-bucket' => 'bucket'),
		array( 'icon-cake2' => 'cake2'),
		array( 'icon-calendar' => 'calendar'),
		array( 'icon-camera3' => 'camera3'),
		array( 'icon-chat' => 'chat'),
		array( 'icon-clapperboard' => 'clapperboard'),
		array( 'icon-clipboard' => 'clipboard'),
		array( 'icon-code' => 'code'),
		array( 'icon-compass' => 'compass'),
		array( 'icon-credit-card' => 'credit-card'),
		array( 'icon-cup' => 'cup'),
		array( 'icon-database' => 'database'),
		array( 'icon-drink' => 'drink'),
		array( 'icon-drive' => 'drive'),
		array( 'icon-drop2' => 'drop2'),
		array( 'icon-eye2' => 'eye2'),
		array( 'icon-feather' => 'feather'),
		array( 'icon-flag3' => 'flag3'),
		array( 'icon-folder-images' => 'folder-images'),
		array( 'icon-folder-music' => 'folder-music'),
		array( 'icon-folder2' => 'folder2'),
		array( 'icon-game-controller' => 'game-controller'),
		array( 'icon-globe' => 'globe'),
		array( 'icon-graduation-cap' => 'graduation-cap'),
		array( 'icon-heart-outlined' => 'heart-outlined'),
		array( 'icon-heart3' => 'heart3'),
		array( 'icon-home2' => 'home2'),
		array( 'icon-image-inverted' => 'image-inverted'),
		array( 'icon-image2' => 'image2'),
		array( 'icon-images' => 'images'),
		array( 'icon-laptop2' => 'laptop2'),
		array( 'icon-leaf' => 'leaf'),
		array( 'icon-old-phone' => 'old-phone'),
		array( 'icon-palette' => 'palette'),
		array( 'icon-paper-plane' => 'paper-plane'),
		array( 'icon-shield' => 'shield'),
		array( 'icon-shop' => 'shop'),
		array( 'icon-shopping-bag' => 'shopping-bag'),
		array( 'icon-shopping-basket' => 'shopping-basket'),
		array( 'icon-shopping-cart' => 'shopping-cart'),
		array( 'icon-suitcase3' => 'suitcase3'),
		array( 'icon-thunder-cloud' => 'thunder-cloud'),
		array( 'icon-tools' => 'tools'),
		array( 'icon-trophy' => 'trophy'),
		array( 'icon-tv' => 'tv'),
		array( 'icon-v-card' => 'v-card'),
		array( 'icon-icloud' => 'icloud'),
		array( 'icon-check' => 'check'),
		array( 'icon-menu3' => 'menu3'),
		array( 'icon-flickr' => 'flickr'),
		array( 'icon-brand' => 'brand'),
		array( 'icon-social' => 'social'),
		array( 'icon-flickr2' => 'flickr2'),
		array( 'icon-brand3' => 'brand3'),
		array( 'icon-social3' => 'social3'),
		array( 'icon-flickr3' => 'flickr3'),
		array( 'icon-brand4' => 'brand4'),
		array( 'icon-social4' => 'social4'),
		array( 'icon-flickr4' => 'flickr4'),
		array( 'icon-brand5' => 'brand5'),
		array( 'icon-social5' => 'social5'),
		array( 'icon-vk' => 'vk'),
		array( 'icon-brand2' => 'brand2'),
		array( 'icon-social2' => 'social2'),
		array( 'icon-checkmark' => 'checkmark'),
		array( 'icon-tick' => 'tick'),
		array( 'icon-check2' => 'check2'),
		array( 'icon-amazon' => 'amazon'),
		array( 'icon-google' => 'google'),
		array( 'icon-google-plus' => 'google-plus'),
		array( 'icon-facebook' => 'facebook'),
		array( 'icon-instagram' => 'instagram'),
		array( 'icon-whatsapp' => 'whatsapp'),
		array( 'icon-twitter' => 'twitter'),
		array( 'icon-vine' => 'vine'),
		array( 'icon-rss' => 'rss'),
		array( 'icon-youtube' => 'youtube'),
		array( 'icon-twitch' => 'twitch'),
		array( 'icon-vimeo' => 'vimeo'),
		array( 'icon-dribbble' => 'dribbble'),
		array( 'icon-behance' => 'behance'),
		array( 'icon-500px' => '500px'),
		array( 'icon-dropbox' => 'dropbox'),
		array( 'icon-blogger' => 'blogger'),
		array( 'icon-tumblr' => 'tumblr'),
		array( 'icon-yahoo' => 'yahoo'),
		array( 'icon-appleinc' => 'appleinc'),
		array( 'icon-linkedin' => 'linkedin'),
		array( 'icon-pinterest' => 'pinterest'),
		array( 'icon-foursquare' => 'foursquare'),
		array( 'icon-yelp' => 'yelp'),
		array( 'icon-html-five' => 'html-five'),
		array( 'icon-global' => 'global'),
		array( 'icon-envelope' => 'envelope'),
		array( 'icon-mail' => 'mail'),
		array( 'icon-email' => 'email'),
		array( 'icon-letter' => 'letter'),
		array( 'icon-message' => 'message'),
		array( 'icon-mail-envelope-closed' => 'mail-envelope-closed'),
		array( 'icon-envelope-o' => 'envelope-o'),
		array( 'icon-dollar' => 'dollar'),
		array( 'icon-usd' => 'usd'),
		array( 'icon-user' => 'user'),
		array( 'icon-arrow-bottom' => 'arrow-bottom'),
		array( 'icon-search-2' => 'search-2'),
		array( 'icon-search-3' => 'search-3'),
		array( 'icon-Arrow_Forward' => 'Arrow_Forward'),
		array( 'icon-ring' => 'ring'),
		array( 'icon-t-shirt' => 't-shirt'),
		array( 'icon-paris' => 'paris'),
		array( 'icon-mountains' => 'mountains'),
		array( 'icon-suitcase' => 'suitcase'),
		array( 'icon-suitcase2' => 'suitcase2'),
		array( 'icon-mountains2' => 'mountains2'),
		array( 'icon-Arrow_Forward2' => 'Arrow_Forward2'),
		array( 'icon-Streamline-89' => 'Streamline-89'),
		array( 'icon-Streamline-94' => 'Streamline-94'),
		array( 'icon-Streamline-18' => 'Streamline-18'),
		array( 'icon-Streamline-48' => 'Streamline-48'),
		array( 'icon-Streamline-65' => 'Streamline-65'),
		array( 'icon-Streamline-58' => 'Streamline-58'),
		array( 'icon-facebook-social-media' => 'facebook-social-media'),
		array( 'icon-facebook-social-media2' => 'facebook-social-media2'),
		array( 'icon-twitter-social-media' => 'twitter-social-media'),
		array( 'icon-pinterest-social-media' => 'pinterest-social-media'),
		array( 'icon-youtube-social-media' => 'youtube-social-media'),
		array( 'icon-trip_advisor-social-media' => 'trip_advisor-social-media'),
		array( 'icon-architecture-interior-06' => 'architecture-interior-06'),
		array( 'icon-user2' => 'user2'),
		array( 'icon-user22' => 'user22'),
		array( 'icon-lock2' => 'lock2'),
		array( 'icon-cross' => 'cross'),
		array( 'icon-cross2' => 'cross2'),
		array( 'icon-left' => 'left'),
		array( 'icon-search4' => 'search4'),
		array( 'icon-user3' => 'user3'),
		array( 'icon-lock3' => 'lock3'),
		array( 'icon-settings' => 'settings'),
		array( 'icon-circle-close' => 'circle-close'),
		array( 'icon-essential_set_close' => 'essential_set_close'),
		array( 'icon-heart' => 'heart'),
		array( 'icon-like_outline' => 'like_outline'),
		array( 'icon-location' => 'location'),
		array( 'icon-Streamline-09' => 'Streamline-09'),
		array( 'icon-envelope2' => 'envelope2'),
		array( 'icon-phone' => 'phone'),
		array( 'icon-37.Stopwatch' => '37.Stopwatch'),
		array( 'icon-facebook_online_social_media' => 'facebook_online_social_media'),
		array( 'icon-ExpandMore' => 'ExpandMore'),
		array( 'icon-Streamline-182' => 'Streamline-182'),
		array( 'icon-Streamline-52' => 'Streamline-52'),
		array( 'icon-Streamline-63' => 'Streamline-63'),
		array( 'icon-Streamline-75' => 'Streamline-75'),
		array( 'icon-Streamline-22' => 'Streamline-22'),
		array( 'icon-delete' => 'delete'),
		array( 'icon-Streamline-45' => 'Streamline-45'),
		array( 'icon-Streamline-44' => 'Streamline-44'),
		array( 'icon-link' => 'link'),
		array( 'icon-social-facebook' => 'social-facebook'),
		array( 'icon-03-twitter' => '03-twitter'),
		array( 'icon-33-pinterest' => '33-pinterest'),
		array( 'icon-Location_Outline-02' => 'Location_Outline-02')
	);
	return array_merge($icons, $icomoon);
}

function tt_icons() {
	$icons = array(
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Icon library', 'locales' ),
				'value' => array(
					esc_html__( 'Font Awesome', 'locales' ) => 'fontawesome',
					esc_html__( 'Open Iconic', 'locales' ) => 'openiconic',
					esc_html__( 'Typicons', 'locales' ) => 'typicons',
					esc_html__( 'Entypo', 'locales' ) => 'entypo',
					esc_html__( 'Linecons', 'locales' ) => 'linecons',
					esc_html__( 'Tesla Icons', 'js_composer' ) => 'icomoon'

				),
				'admin_label' => false,
				'param_name' => 'type',
				'description' => esc_html__( 'Select icon library.', 'locales' ),
			),

			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Icon library', 'locales' ),
				'value' => array(
					esc_html__( 'Font Awesome', 'locales' ) => 'fontawesome',
					esc_html__( 'Open Iconic', 'locales' ) => 'openiconic',
					esc_html__( 'Typicons', 'locales' ) => 'typicons',
					esc_html__( 'Entypo', 'locales' ) => 'entypo',
					esc_html__( 'Linecons', 'locales' ) => 'linecons',
					esc_html__( 'Tesla Icons', 'js_composer' ) => 'icomoon'
				),
				'admin_label' => false,
				'param_name' => 'type',
				'description' => esc_html__( 'Select icon library.', 'locales' ),
				'dependency' => array(
					'element' => 'add_icon',
					'value' => 'true',
				),
			),
			array(
				'type' => 'iconpicker',
				'heading' => esc_html__( 'Icon', 'locales' ),
				'param_name' => 'icon_fontawesome',
				'value' => 'fa fa-adjust', // default value to backend editor admin_label
				'settings' => array(
					'emptyIcon' => false,
					// default true, display an "EMPTY" icon?
					'iconsPerPage' => 4000,
					// default 100, how many icons per/page to display, we use (big number) to display all icons in single page
				),
				'dependency' => array(
					'element' => 'type',
					'value' => 'fontawesome',
				),
				'description' => esc_html__( 'Select icon from library.', 'locales' ),
			),
			array(
				'type' => 'iconpicker',
				'heading' => esc_html__( 'Icon', 'locales' ),
				'param_name' => 'icon_openiconic',
				'value' => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
				'settings' => array(
					'emptyIcon' => false, // default true, display an "EMPTY" icon?
					'type' => 'openiconic',
					'iconsPerPage' => 4000, // default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'type',
					'value' => 'openiconic',
				),
				'description' => esc_html__( 'Select icon from library.', 'locales' ),
			),
			array(
				'type' => 'iconpicker',
				'heading' => esc_html__( 'Icon', 'locales' ),
				'param_name' => 'icon_typicons',
				'value' => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
				'settings' => array(
					'emptyIcon' => false, // default true, display an "EMPTY" icon?
					'type' => 'typicons',
					'iconsPerPage' => 4000, // default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'type',
					'value' => 'typicons',
				),
				'description' => esc_html__( 'Select icon from library.', 'locales' ),
			),
			array(
				'type' => 'iconpicker',
				'heading' => esc_html__( 'Icon', 'locales' ),
				'param_name' => 'icon_entypo',
				'value' => 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
				'settings' => array(
					'emptyIcon' => false, // default true, display an "EMPTY" icon?
					'type' => 'entypo',
					'iconsPerPage' => 4000, // default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'type',
					'value' => 'entypo',
				),
			),
			array(
				'type' => 'iconpicker',
				'heading' => esc_html__( 'Icon', 'locales' ),
				'param_name' => 'icon_linecons',
				'value' => 'vc_li vc_li-heart', // default value to backend editor admin_label
				'settings' => array(
					'emptyIcon' => false, // default true, display an "EMPTY" icon?
					'type' => 'linecons',
					'iconsPerPage' => 4000, // default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'type',
					'value' => 'linecons',
				),
				'description' => esc_html__( 'Select icon from library.', 'locales' ),
			),
			array(
				'type' => 'iconpicker',
				'heading' => esc_html__( 'Icon', 'locales' ),
				'param_name' => 'icon_icomoon',
				'value' => 'vc_li vc_li-heart', // default value to backend editor admin_label
				'settings' => array(
					'emptyIcon' => false, // default true, display an "EMPTY" icon?
					'type' => 'icomoon',
					'iconsPerPage' => 4000, // default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'type',
					'value' => 'icomoon',
				),
				'description' => esc_html__( 'Select icon from library.', 'locales' ),
			));
	return $icons;
}
$tt_icons = tt_icons();


//  Add Parameters to row
vc_add_params('vc_row', array(
	array(
		'type' => 'checkbox',
		'heading' => esc_attr__( 'Show Title?', 'locales' ),
		'param_name' => 'sc_title',
		'description' => esc_attr__( 'If checked Title will be shown at top', 'locales' ),
		'value' => array( esc_attr__( 'Yes', 'locales' ) => 'yes' )
	),
	array(
		'type' => 'textfield',
		'heading' => esc_attr__( 'Section title', 'locales' ),
		'param_name' => 'section_title',
		'value' => '',
		'description' => esc_attr__( 'Set Section title', 'locales' ),
		'dependency' => array(
			'element' => 'sc_title',
			'not_empty' => true,
		),
	),
	array(
		'type' => 'dropdown',
		'heading' => esc_attr__( 'Choose section style', 'locales' ),
		'param_name' => 'sc_title_style',
		'description' => esc_attr__( 'Select style type.', 'locales' ),
		'value'         =>  array(
			esc_attr__('Light', 'locales')    =>  'standard',
			esc_attr__('Dark', 'locales')     =>  'inverted'
		),
		'std'   =>  'standard'
	),
));

/* TT Popular Locations 
----------------------------------------------------------- */
vc_map( array(
	'name' => esc_attr__( 'Popular Locations', 'locales' ),
	'base' => 'tt_popular_locations',
	'icon' => 'icon-wpb',
	'category' => esc_attr__( 'TeslaThemes', 'locales' ),
	'description' => esc_attr__( 'Shows a number of Popular Locations', 'locales' ),
	"params" => array(
		array(
			'type' => 'textfield',
			'heading' => esc_attr__( 'Section Title', 'locales' ),
			'param_name' => 'popular_title',
			'description' => esc_attr__( 'Default: Most Popular Location', 'locales' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_attr__( 'Hide the Title', 'locales' ),
			'param_name' => 'hide_the_title',
			'description' => esc_attr__( 'Default: No', 'locales' ),
			'value' => array( esc_attr__( 'Yes', 'locales' ) => 'yes' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_attr__( 'Number of Posts', 'locales' ),
			'param_name' => 'nr_popular_posts',
			'description' => esc_attr__( 'Choose how much posts will be shown.', 'locales' ),
			'value'         =>  array(
				esc_attr__('3 Posts', 'locales')    =>  '3',
				esc_attr__('4 Posts', 'locales')    =>  '4',
				esc_attr__('6 Posts', 'locales')    =>  '6',
				esc_attr__('8 Posts', 'locales')    =>  '8',
				esc_attr__('9 Posts', 'locales')    =>  '9',
				esc_attr__('12 Posts', 'locales')    =>  '12',
			),
			'std'   =>  '3'
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_attr__( 'Number of Columns', 'locales' ),
			'param_name' => 'columns_nr',
			'description' => esc_attr__( 'Default: 3 columns', 'locales' ),
			'value'         =>  array(
				esc_attr__('3 Columns', 'locales')    =>  '4',
				esc_attr__('4 Columns', 'locales')    =>  '3',
			),
			'std'   =>  '4'
		),
		array(
			'type' => 'textfield',
			'heading' => esc_attr__( '"See more" button text', 'locales' ),
			'param_name' => 'seemore_button',
			'description' => esc_attr__( 'Default: See more', 'locales' ),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_attr__( '"See more" button LINK', 'locales' ),
			'param_name' => 'link_to_explore',
			'description' => esc_attr__( 'Default: #', 'locales' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_attr__( 'Hide the Button ?', 'locales' ),
			'param_name' => 'hide_seemore_button',
			'description' => esc_attr__( 'Default: No', 'locales' ),
			'value' => array( esc_attr__( 'Yes', 'locales' ) => 'yes' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_attr__( 'Extra class name', 'locales' ),
			'param_name' => 'el_class',
			'description' => esc_attr__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'locales' )
		),
		array(
			'type' => 'css_editor',
			'heading' => esc_attr__( 'CSS box', 'locales' ),
			'param_name' => 'css',
			'group' => esc_attr__( 'Design Options', 'locales' )
		)
	)
) );

/* TT Location slider
----------------------------------------------------------- */
vc_map( array(
	'name' => esc_attr__( 'Location Slider', 'locales' ),
	'base' => 'tt_location_slider',
	'icon' => 'icon-wpb',
	'category' => esc_attr__( 'TeslaThemes', 'locales' ),
	'description' => esc_attr__( 'Shows a Slider with location posts', 'locales' ),
	"params" => array(
		array(
			'type' => 'textfield',
			'heading' => esc_attr__( 'Section Title', 'locales' ),
			'param_name' => 'slider_title',
			'description' => esc_attr__( 'Default: Location Slider Title', 'locales' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_attr__( 'Hide the Title', 'locales' ),
			'param_name' => 'hide_slider_title',
			'description' => esc_attr__( 'Default: No', 'locales' ),
			'value' => array( esc_attr__( 'Yes', 'locales' ) => 'yes' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_attr__( 'Number of Slides', 'locales' ),
			'param_name' => 'slider_number',
			'description' => esc_attr__( 'Type a number of slides to be shown. Default: All locations', 'locales' ),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_attr__( 'Offset number of Slides', 'locales' ),
			'param_name' => 'slider_offset_1',
			'description' => esc_attr__( 'Type an offset number. Works only if number of posts is set. Default: 0', 'locales' ),
			'dependency' => array(
				'element' => 'slider_style',
				'value' => '1',
			)
		),
		array(
			'type' => 'textfield',
			'heading' => esc_attr__( 'Offset number of Slides', 'locales' ),
			'param_name' => 'slider_offset_2',
			'description' => esc_attr__( 'Type an offset number. Works only if number of posts is set. Default: 0', 'locales' ),
			'dependency' => array(
				'element' => 'slider_style',
				'value' => '2',
			)
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_attr__( 'Slider Style', 'locales' ),
			'param_name' => 'slider_style',
			'description' => esc_attr__( 'Default: Style 1', 'locales' ),
			'value'         =>  array(
				esc_attr__('Style 1', 'locales')    =>  '1',
				esc_attr__('Style 2', 'locales')    =>  '2',
			),
			'std'   =>  '1'
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_attr__( 'Number of slides on Desktop', 'locales' ),
			'param_name' => 'slider_desktop_1',
			'description' => esc_attr__( 'Default: 3 slides', 'locales' ),
			'value'         =>  array(
				esc_attr__('1 Slides', 'locales')    =>  '1',
				esc_attr__('2 Slides', 'locales')    =>  '2',
				esc_attr__('3 Slides', 'locales')    =>  '3',
				esc_attr__('4 Slides', 'locales')    =>  '4'
			),
			'std'   =>  '3',
			'dependency' => array(
				'element' => 'slider_style',
				'value' => '1',
			)
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_attr__( 'Number of slides on tablets', 'locales' ),
			'param_name' => 'slider_tablets_1',
			'description' => esc_attr__( 'Default: 2 slides', 'locales' ),
			'value'         =>  array(
				esc_attr__('1 Slides', 'locales')    =>  '1',
				esc_attr__('2 Slides', 'locales')    =>  '2',
				esc_attr__('3 Slides', 'locales')    =>  '3'
			),
			'std'   =>  '2',
			'dependency' => array(
				'element' => 'slider_style',
				'value' => '1',
			)
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_attr__( 'Number of slides on Desktop', 'locales' ),
			'param_name' => 'slider_desktop_2',
			'description' => esc_attr__( 'Default: 3 slides', 'locales' ),
			'value'         =>  array(
				esc_attr__('1 Slides', 'locales')    =>  '1',
				esc_attr__('2 Slides', 'locales')    =>  '2',
				esc_attr__('3 Slides', 'locales')    =>  '3'
			),
			'std'   =>  '2',
			'dependency' => array(
				'element' => 'slider_style',
				'value' => '2',
			)
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_attr__( 'Number of slides on tablets', 'locales' ),
			'param_name' => 'slider_tablets_2',
			'description' => esc_attr__( 'Default: 2 slides', 'locales' ),
			'value'         =>  array(
				esc_attr__('1 Slides', 'locales')    =>  '1',
				esc_attr__('2 Slides', 'locales')    =>  '2'
			),
			'std'   =>  '1',
			'dependency' => array(
				'element' => 'slider_style',
				'value' => '2',
			)
		),
		array(
			'type' => 'textfield',
			'heading' => esc_attr__( 'Extra class name', 'locales' ),
			'param_name' => 'el_class',
			'description' => esc_attr__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'locales' )
		),
		array(
			'type' => 'css_editor',
			'heading' => esc_attr__( 'CSS box', 'locales' ),
			'param_name' => 'css',
			'group' => esc_attr__( 'Design Options', 'locales' )
		)
	)
) );

/* TT Theme Banner
----------------------------------------------------------- */
vc_map( array(
	'name' => esc_attr__( 'Theme Banner', 'locales' ),
	'base' => 'tt_theme_banner',
	'icon' => 'icon-wpb',
	'category' => esc_attr__( 'TeslaThemes', 'locales' ),
	'description' => esc_attr__( 'Shows a banner for promoting something', 'locales' ),
	"params" => array(
		array(
			'type' => 'attach_images',
			'heading' => esc_attr__( 'Background', 'locales' ),
			'param_name' => 'bg_img',
			'description' => esc_attr__( 'Choose the background image. Size > 1840x476px', 'locales' ),
			'admin_label' => true
		),
		array(
			'type' => 'textfield',
			'heading' => esc_attr__( 'Banner Text', 'locales' ),
			'param_name' => 'banner_text',
			'description' => esc_attr__( 'Default: Nothing shows up.', 'locales' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_attr__( 'Hide the Button ?', 'locales' ),
			'param_name' => 'hide_button',
			'description' => esc_attr__( 'Default: No', 'locales' ),
			'value' => array( esc_attr__( 'Yes', 'locales' ) => 'yes' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_attr__( 'Button text', 'locales' ),
			'param_name' => 'button_text',
			'description' => esc_attr__( 'Default: Pay Now', 'locales' ),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_attr__( 'Button Link', 'locales' ),
			'param_name' => 'button_link',
			'description' => esc_attr__( 'Default: #', 'locales' ),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_attr__( 'Extra class name', 'locales' ),
			'param_name' => 'el_class',
			'description' => esc_attr__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'locales' )
		),
		array(
			'type' => 'css_editor',
			'heading' => esc_attr__( 'CSS box', 'locales' ),
			'param_name' => 'css',
			'group' => esc_attr__( 'Design Options', 'locales' )
		)
	)
) );


/* TT Location Category */
vc_map( array(
	'name' => esc_html__( 'Location Category', 'locales' ),
	'base' => 'tt_location_categories',
	'icon' => 'icon-wpb',
	'category' => esc_html__( 'TeslaThemes', 'locales' ), 
	'description' => esc_html__( 'Locations and categories', 'locales' ),
	"params" => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Style', 'locales' ),
			'value' => array(
				esc_html__( 'Small', 'locales' ) => 'type_1',
				esc_html__( 'Small Wide', 'locales' ) => 'type_2',
				esc_html__( 'Normal', 'locales' ) => 'type_3',
			),
			'param_name' => 'service_type',
			'description' => esc_html__( 'Select category style type.', 'locales' ),
			'std' => 'type_3',
			'admin_label' => true,
		),
		array(
			'type' => 'attach_images',
			'heading' => esc_attr__( 'Background', 'locales' ),
			'param_name' => 'bg_img',
			'description' => esc_attr__( 'Choose the background image. Size bigger than 613x613px and square.', 'locales' ),
			'admin_label' => true
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_attr__( 'Category', 'locales' ),
			'value' => $post_cats,
			'param_name' => 'location_category',
			'description' => esc_attr__( 'Select a category.', 'locales' ),
			'admin_label' => true,
		),

		$tt_icons[0],
		$tt_icons[2],
		$tt_icons[3],
		$tt_icons[4],
		$tt_icons[5],
		$tt_icons[6],
		$tt_icons[7],

		array(
			'type' => 'textfield',
			'heading' => esc_attr__( 'Custom link', 'locales' ),
			'param_name' => 'custom_link',
			'description' => esc_attr__( 'Default: if you leave it blank then will use theme defaults.', 'locales' )
		),

		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Icon Color', 'locales' ),
			'param_name' => 'color_icon',
			'description' => esc_html__( 'Select icon color.', 'locales' ),
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Text Color', 'locales' ),
			'param_name' => 'color_text',
			'description' => esc_html__( 'Select icon color.', 'locales' ),
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Initial box Color', 'locales' ),
			'param_name' => 'color_bg_info',
			'description' => esc_html__( 'Select icon color.', 'locales' ),
		)

	)
) );

/* TT Intro Box */
vc_map( array(
	'name' => esc_html__( 'Intro Box', 'locales' ),
	'base' => 'tt_intro_box',
	'icon' => 'icon-wpb',
	'category' => esc_html__( 'TeslaThemes', 'locales' ), 
	'description' => esc_html__( 'An advanced search box with filters.', 'locales' ),
	"params" => array(
		array(
			'type' => 'attach_images',
			'heading' => esc_attr__( 'Background', 'locales' ),
			'param_name' => 'bg_img',
			'description' => esc_attr__( 'Choose the background image. At least 1920x1080px', 'locales' ),
			'admin_label' => true
		),
		array(
			'type' => 'textfield',
			'heading' => esc_attr__( 'Section Title', 'locales' ),
			'param_name' => 'intro_title',
			'description' => esc_attr__( 'Default: if you leave it blank then it is hidden.', 'locales' )
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_attr__( 'Hide the title filter ?', 'locales' ),
			'param_name' => 'hide_by_title',
			'description' => esc_attr__( 'Default: No', 'locales' ),
			'value' => array( esc_attr__( 'Yes', 'locales' ) => 'yes' )
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_attr__( 'Hide the location filter ?', 'locales' ),
			'param_name' => 'hide_by_location',
			'description' => esc_attr__( 'Default: No', 'locales' ),
			'value' => array( esc_attr__( 'Yes', 'locales' ) => 'yes' )
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_attr__( 'Hide the type filter ?', 'locales' ),
			'param_name' => 'hide_by_type',
			'description' => esc_attr__( 'Default: No', 'locales' ),
			'value' => array( esc_attr__( 'Yes', 'locales' ) => 'yes' )
		),
		array(
			'type' => 'css_editor',
			'heading' => esc_attr__( 'CSS box', 'locales' ),
			'param_name' => 'css',
			'group' => esc_attr__( 'Design Options', 'locales' )
		)
	)
) );

/* Pricing tables
-----------------------------------------------------------------*/

vc_map( array(
	'name' => esc_attr__( 'Pricing Tables', 'locales' ),
	'base' => 'tt_pricing_tables',
	'icon' => 'icon-wpb',
	'category' => esc_attr__( 'TeslaThemes', 'locales' ),
	'description' => esc_attr__( 'Displays a nice designed pricing table.', 'locales' ),
	"params" => array(
		array(
			'type' => 'textfield',
			'heading' => esc_attr__( 'Title', 'locales' ),
			'param_name' => 'title',
			'description' => esc_attr__( 'Give this box a title.', 'locales' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_attr__( 'Price', 'locales' ),
			'param_name' => 'price',
			'description' => esc_attr__( 'Give this box a price.', 'locales' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_attr__( 'Currency sign', 'locales' ),
			'param_name' => 'currency',
			'description' => esc_attr__( 'Write a currency sign.', 'locales' )
		),
		array(
			'type' => 'param_group',
			'heading' => esc_attr__( 'Features', 'locales' ),
			'param_name' => 'features_items',
			'description' => esc_attr__( 'Enter a list of features.', 'locales' ),
			'value' => urlencode( json_encode( array(
				array(
					'item_feature'        =>  ''
				)))),
			'params'    =>  array(
				array(
					'type'  =>  'textfield',
					'heading'   =>  esc_attr__('Feature','locales'),
					'param_name'    =>  'item_feature'
				),
			)
		),
		array(
			'type'  =>  'textfield',
			'heading'   =>  esc_attr__('Button Text','locales'),
			'param_name'    =>  'button_text',
			'description'   =>  esc_attr__('Text like: "Buy Now"','locales'),
		),
		array(
			'type'  =>  'textfield',
			'heading'   =>  esc_attr__('Button URL Link','locales'),
			'param_name'    =>  'item_url',
			'description'   =>  esc_attr__('Paste an url link.','locales'),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_attr__( 'Extra class name', 'locales' ),
			'param_name' => 'el_class',
			'description' => esc_attr__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'locales' )
		),
		array(
			'type' => 'css_editor',
			'heading' => esc_attr__( 'CSS box', 'locales' ),
			'param_name' => 'css',
			'group' => esc_attr__( 'Design Options', 'locales' )
		)        
		)
	));

/* Section Title
-------------------------------------------------------------*/
vc_map( array(
	'name' => esc_html__( 'Section Title', 'locales' ),
	'base' => 'tt_section_title',
	'icon' => 'icon-wpb',
	'category' => esc_html__( 'TeslaThemes', 'locales' ),
	'description' => esc_html__( 'Tesla Section Title', 'locales' ),
	'params' => array(
		array(
			'type' => 'textarea',
			'heading' => esc_html__( 'Section Title', 'locales' ),
			'param_name' => 'title',
			'admin_label' => true,
			'value' => esc_html__( 'This is custom heading title', 'locales' ),
		),

		array(
			'type' => 'textarea',
			'heading' => esc_html__( 'Section Description', 'locales' ),
			'param_name' => 'subtext',
			'admin_label' => true,
			'value' => esc_html__( 'This is a custom heading description', 'locales' ),
		),

		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'locales' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'Style particular content element differently - add a existing class name (black, white, hero-section) or another custom class from CSS.', 'locales' ),
		),

		array(
			'type' => 'css_editor',
			'heading' => esc_html__( 'Css', 'locales' ),
			'param_name' => 'css',
			'group' => esc_html__( 'Design options', 'locales' )
		)
	),
) );