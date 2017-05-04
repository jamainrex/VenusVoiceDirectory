<?php
return array('offers' => array(
		'name' => 'Offers',
		'term' => 'offer',
		'term_plural' => 'offers',
		'order' => 'DESC',
		'has_single' => false,
		'hierarchical' => false,
		'label'               => 'Offers',
		'url' => _go('offers_url') ? _go('offers_url') : 'offers',
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'post_options' => array(
			'supports' => array( 'title','thumbnail'),
			'taxonomies' => array(),
			'has_archive'=> true,
			'exclude_from_search' => false
		),
		'taxonomy_options' => array('show_ui' => true),
		'options' => array(
			'special_offer' => array(
				'type' => array(
					'offer_title' => array(
						'type' => 'line',
						'title' => 'Offer Title',
						'description' => 'example: Chineese Restaurant'
					),
					'discount' => array(
						'type' => 'line',
						'title' => 'Discount',
						'description' => 'example: Mega offer - 50% off',
					),
					'description' => array(
						'type' => 'text',
						'title' => 'Some Info',
						'description' => 'example: "Tasty chineese food at a low price".'
					),
					'link' => array(
						'type' => 'line',
						'title' => 'Link to the Local',
						'description' => 'example: https://locales.com/chineese-restaurant'
					),

				),
				'title' => 'Offer Info',
				'multiple' => false,
				'group' => true
			),
		),
		'icon' => 'icons/16x16.png',
		'output' => array(

			'main' => array(
				'shortcode' => 'tt_offers',
				'view' => 'views/offers-shortcode',
				'shortcode_defaults' => array(
					'center_item_background' => '',
					'desktop_items' => '',
					'tablet_items' => '',
					'mobile_items' => '',
					'infinite_slick' => '',
					'section_id' => '',
					'el_class' => '',
					'css' => ''
				)
			),
			'single' => array(
				'view'                  => 'views/offers-view',
				'shortcode_defaults'    => array(
				)
			)
		)
	),
	'location' => array(
		'name' => 'Location',
		'term' => 'location',
		'term_plural' => 'Locations',
		'order' => 'DESC',
		'has_single' => true,
		'hierarchical' => false,
		'label'               => 'Locations',
		'url' => _go('locations_url') ? _go('locations_url') : 'locations',
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'post_options' => array(
			'supports' => array( 'title', 'thumbnail', 'comments', 'author','editor'),
			'taxonomies' => array('post_tag'),
			'has_archive'=> false,
			'exclude_from_search' => false
		),
		'taxonomy_options' => array('show_ui' => true),
		'options' => array(
			'Location' => array(
				'type' => array(
					'location_category' => array(
						'type' => 'select',
						'description' => 'Indicate the costs rate.',
						'title' => 'Cost',
						'label' => array(	'1'=>'Very Low', '2'=>'Low Cost', '3'=>'Normal Cost','4'=>'Expensive','5'=>'Very Expensive'),
					),
					'description' => array(
						'type' => 'text',
						'title' => 'Description',
						'description' => 'example: Very nice interior ...'
					),
					'website' => array(
						'type' => 'line',
						'title' => 'Website URL',
						'description' => 'example: tomsdinner.com'
					),
					'facilitiez' => array(
						'type' => array(
							'facility' => array(
								'type' => 'line',
                        							'title' => 'Icon code',
								'description' => 'Example: icon-Streamline-48 - Available icons: <a href="http://demo.teslathemes.com/locales/icon-codes">here...</a>',
							),
						),
						'title' => 'Facilities',
						'multiple' => true,
						'group' => true
					),
					'loc_hidden' => array(
						'type' => 'line',
                					'title' => 'City:',
                					'description' => 'This city will be shown in filters so please take care of what you are writing.'
					),
					'map' => array(
						'type' => array(
							'location' => array(
								'type' => 'line',
                        							'title' => 'Location:',
                        							'description' => 'Write the location. example: Hampton St, Elmhurst, NY 11373'
							),
							'lat' => array(
								'type' => 'line',
                        							'title' => 'Latitude:',
                        							'description' => 'Use this site to get the exact coortinates: http://www.gps-coordinates.net/ - example for New York lat: 40.7127837'
							),
							'long' => array(
								'type' => 'line',
                        							'title' => 'Longitude:',
                        							'description' => 'Use this site to get the exact coortinates: http://www.gps-coordinates.net/ - example for New York long:  -74.00594130000002'
							)
						),
						'title' => 'Map Location',
						'multiple' => false,
						'group' => true
					),

					'working_hours' => array(
						'type' => array(
							'opening' => array(
								'type' => 'line',
                        							'title' => 'Opening at:'
							),
							'closing' => array(
								'type' => 'line',
                        							'title' => 'Closing at:',
							)
						),
						'title' => 'Working Hours',
						'multiple' => false,
						'group' => true
					),
					'contacts' => array(
						'type' => array(
							'phone' => array(
								'type' => 'line',
                        							'title' => 'Phone:'
							),
							'email' => array(
								'type' => 'line',
                        							'title' => 'Email:'
							),
							'twitter_name' => array(
								'type' => 'line',
                        							'title' => 'Twitter name:',
							),
							'facebook_url' => array(
								'type' => 'line',
                        							'title' => 'Facebook URL:',
							),
							'pinterest' => array(
								'type' => 'line',
                        							'title' => 'Pinterest:',
							),
							'instagram' => array(
								'type' => 'line',
                        							'title' => 'Instagram:',
							),
							'googleplus' => array(
								'type' => 'line',
                        							'title' => 'Google+:',
							),
							'youtube' => array(
								'type' => 'line',
                        							'title' => 'Youtube:',
							)
						),
						'title' => 'Contact Info',
						'multiple' => false,
						'group' => true
					),
					'slide_images' => array(
						'type' => array(
							'slide_image' => array(
								'type' => 'image',
                        							'title' => 'Slide Image',
                        							'default' => 'holder.js/1840x927/auto',
							),
						),
						'title' => 'Slider Images',
						'multiple' => true,
						'group' => true

					),

				),
				'multiple' => false,
				'group' => true
			)
		),
		'icon' => 'icons/16x16.png',
		'output' => array(

			'main' => array(
				'shortcode' => 'tt_locations',
				'view' => 'views/location-shortcode',
				'shortcode_defaults' => array(
					'testimonial_background' => '',
					'section_id' => '',
					'el_class' => '',
					'css' => ''
				)
			),
			'single' => array(
				'view'                  => 'views/location-view',
				'shortcode_defaults'    => array(
				)
			)
		)
	)
);

