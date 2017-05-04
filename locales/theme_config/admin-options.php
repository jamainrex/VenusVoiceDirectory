<?php

return array(
	'favico' => array(
		'dir' => '/theme_config/icons/16x16.png'
	),
	'option_saved_text' => 'Options successfully saved',
	'tabs' => array(
		array(
			'title'=>'General Options',
			'icon'=>1,
			'boxes' => array(
				'Logo Customization' => array(
					'icon'=>'customization',
					'size'=>'2_3',
					'columns'=>true,
					'description'=>'Here you upload a image as logo or you can write it as text and select the logo color, size, font.',
					'input_fields' => array(
						'Home Logo As Image'=>array(
							'size'=>'half',
							'id'=>'home_logo_image',
							'type'=>'image_upload',
							'note'=>'Here you can insert your link to a image logo or upload a new logo image for homepage'
						),
						'Logo As Text'=>array(
							'size'=>'half_last',
							'id'=>'logo_text',
							'type'=>'text',
							'note' => "Type the logo text here, then select a color, set a size and font",
							'color_changer'=>true,
							'font_changer'=>true,
							'font_size_changer'=>array(8,50, 'px'),
							'font_preview'=>array(true, true)
						)	
					)
				),
				'Favicon' => array(
					'icon'=>'customization',
					'size'=>'1_3_last',
					'input_fields' => array(
						array(
							'id'=>'favicon',
							'type'=>'image_upload',
							'note'=>'Here you can upload the favicon icon.<br><br><br><br><br><br>'
						)
					)
				),
				'Custom CSS' => array(
					'icon'=>'css',
					'size'=>'half',
					'description'=>'Here you can write your personal CSS for customizing the classes you want. Or use our <b>Custom Styler</b>, from the Site Colors tab, for an easier custom css color picking.',
					'input_fields' => array(
						array(
							'id'=>'custom_css',
							'type'=>'textarea'
						)
					)
				),
				'Custom JS' => array(
					'icon'=>'js',
					'size'=>'half_last',
					'description'=>'Here you can write your personal JS that will be appended to footer.<br><br>',
					'input_fields' => array(
						array(
							'id'=>'custom_js',
							'type'=>'textarea'
						)
					)
				)
			)
		),
		array(
			'title' => 'Site Colors',
			'icon'=>4,
			'boxes' => array(
				'Background Customization'=>array(
					'icon'=>'customization',
					'columns'=>true,
					'size' => '1',
					'input_fields' => array(
							'Background Color'=>array(
								'size'=>'half',
								'id'=>'bg_color',
								'type'=>'colorpicker'
							),
							'Background Image' => array(
								'size'=>'half_last',
								'id'=>'bg_image',
								'type'=>'image_upload'
							)
						)
					),
					'Site Colors' => array(
						'icon'=>'background',
						'columns'=>true,
						'size' => '1',
						'input_fields' => array(
							'Primary Site Color'=>array(
								'size'=>'1_2',
								'id'=>'site_color',
								'type'=>'colorpicker',
								'note'=>'Choose primary color for your website. This will affect only specific elements, such as post links, widgets title underline etc...<br>To return to default color , open colorpicker and click the Clear button.'
							),
							'Secondary Site Color'=>array(
								'size'=>'1_2',
								'id'=>'site_color_2',
								'type'=>'colorpicker',
								'note'=>'Choose secondary color for your website. This will affect only specific elements.<br>To return to default color , open colorpicker and click the Clear button.'
							)
						)
					)
				)
			),
		array(
				'title' => 'Typography',
				'icon'  => 1,
				'boxes' => array(
					'Font Changers'=>array(
						'icon' => 'customization',
						'description'=>'Change the fonts & colors for site\'s sections:',
						'size'=>'1',
						'columns'=>true,
						'input_fields' => array(
							'Main Content Font/Color'=>array(
								'size'=>'1_3',
								'id'=>'main_content_text',
								'type'=>'text',
								'note' => "Then select a color, set a size and choose a font",
								'color_changer'=>true,
								'font_changer'=>true,
								'font_size_changer'=>array(8,50, 'px'),
								'hide_input'=>true,
							),
							'Secondary Font/Color'=>array(
								'size'=>'1_3',
								'id'=>'sidebar_text',
								'type'=>'text',
								'note' => "Then select a color, set a size and choose a font",
								'color_changer'=>true,
								'font_changer'=>true,
								'font_size_changer'=>array(8,50, 'px'),
								'hide_input'=>true,
							),
							'Thirdary Font/Color'=>array(
								'size'=>'1_3_last',
								'id'=>'menu_text',
								'type'=>'text',
								'note' => "Then select a color, set a size and choose a font",
								'color_changer'=>true,
								'font_changer'=>true,
								'font_size_changer'=>array(8,50, 'px'),
								'hide_input'=>true,
							)
						)
					)
				)
			),
		array(
			'title' => 'SEO and Socials',
			'icon'=>3,
			'boxes'=>array(
				'ShareThis feature'=>array(
					'icon'=>'social',
					'description'=>"To use this service please select your favorite social networks and it will be displayed under posts.",
					'size'=>'half',
					'input_fields'=>array(
						array(
							'type'  => 'select',
							'id'    => 'share_this',
							'note' => 'Facebook',
							'class'  => 'social_search',
							'multiple' => true,
							'options'=>array('Google'=>'googleplus','Facebook'=>'facebook','Twitter'=>'twitter','Pinterest'=>'pinterest','Linkedin'=>"linkedin",'Vkontakte'=>'vkontakte')
						)
					)
				),
				'Social Platforms'=>array(
					'icon'=>'social',
					'description'=>"Insert the link to the social share page.",
					'size'=>'half',
					'columns'=>true,
					'input_fields'=>array(
						array(
							'id'=>'social_platforms',
							'type'=>'social_platforms',
							'platforms'=>array('facebook','twitter','google','pinterest','linkedin','dribbble','behance','youtube','flickr','rss')
						)
					)
				)
			)
		),
		array(
			'title' => 'Header',
			'icon'  => 8,
			'boxes' => array(
				'Header' => array(
					'icon'=>'customization',
					'size'=>'1',
					'input_fields' => array(
						'Navigation Style' => array(
							'size'	=> 'half',
							'id' => 'navigation_style',
							'type' => 'radio',
							'values' => array('Sticky', 'Simple')
						)
					)
				) 
			)
		),
		array(
			'title' => 'Footer',
			'icon'  => 8,
			'boxes' => array(
				'Copyrights' => array(
					'icon'=>'customization',
					'size'=>'1',
					'input_fields' => array(

						'Copiright Text' => array(
							'id'=>'copyright_text',
							'type'=>'text',
							'note'=>'Type in your custom copyright message. Remenber that if you leave it blank then the default message will be shown. <b>(It accepts HTML)</b>'
						),
						'Hide Copyright Row' => array(
							'id'=>'hide_copyright',
							'type'=>'checkbox',
							'note'=>'Choose whether to show or hide the copyright inscription.'
						)
					)
				) ,
				'Subscription' => array(
					'icon'=>'customization',
					'size'=>'1',
					'input_fields' => array(

						'Subscribtion Text' => array(
							'id'=>'subscribe_text',
							'type'=>'text',
							'note'=>'Type in your custom message. Remenber that if you leave it blank then the default message will be shown. '
						),
						'Hide Subscribtion Form' => array(
							'id'=>'hide_subscribe',
							'type'=>'checkbox',
							'note'=>'Choose whether to show or hide the subscription form.'
						)
					)
				)
			)
		),
		array(
			'title' => 'Additional Options',
			'icon'  => 6,
			'boxes' => array( 
				'404 Page' => array(
					'icon'=>'customization',
					'size'=>'half',
					'input_fields' => array(
						'404 ERROR IMAGE'=>array(
							'size'=>'1_3',
							'id'=>'404_bg_image',
							'type'=>'image_upload',
							'note'=>'Here you can insert your link to a image or upload a new image for the error page - 404.'
						),
						'Title Text' => array(
							'id'=>'404_title',
							'type'=>'text',
							'note'=>'Type in your custom 404 title. Remenber that if you leave it blank the default message will be shown. (ERROR 404)'
						),
						'Error Message' => array(
							'id'=>'404_message',
							'type'=>'text',
							'note'=>'Type in your custom 404 error message. If you leave it blank the default message will be shown.'
						),
						'Button Text' => array(
							'id'=>'404_button_text',
							'type'=>'text',
							'note'=>'Type in your custom 404 button text. If you leave it blank the default message will be shown.'
						)
					)
				), 
			)
		),
		array(
			'title' => 'Dashboard and Explore',
			'icon'  => 6,
			'boxes' => array(
				'Confirmation Box' => array(
					'icon' => 'customization',
					'description'=>"Edit the Dashboard confirmation box texts. It shows up when the user clicks on the Delete button.",
					'size'=>'half',
					'input_fields' =>array(
						'Popup Title' => array(
							'id'    => 'dialog_title',
							'type'  => 'text',
							'note' => 'If left blank the default text will be used.',
						),
						'Popup Content' => array(
							'id'    => 'dialog_content',
							'type'  => 'text',
							'note' => 'If left blank the default text will be used.',
						),
						'Confirmation button text' => array(
							'id'    => 'confirm_text',
							'type'  => 'text',
							'note' => 'If left blank the default text will be used.',
						),
						'Cancelation button text' => array(
							'id'    => 'cancel_text',
							'type'  => 'text',
							'note' => 'If left blank the default text will be used.',
						),
					)
				),
				'Dashboard Page' => array(
					'icon' => 'customization',
					'description'=>"Here you have to add the link to the Dashboard page.",
					'size'=>'half',
					'input_fields' =>array(
						'Page Link' => array(
							'id'    => 'dashboard_page_url',
							'type'  => 'text',
							'note' => 'Example www.yourdomain.com/dashboard. this dasboard page has to be created before you add its link here.',
						),
					)
				),
				'Explore Page' => array(
					'icon' => 'customization',
					'description'=>"Here you have to add the link to the Explore page.",
					'size'=>'half',
					'input_fields' =>array(
						'Page Link' => array(
							'id'    => 'explore_page_url',
							'type'  => 'text',
							'note' => 'Example www.yourdomain.com/explore. this explore page has to be created before you add its link here.',
						),
					)
				)
			)
		),
		array(
			'title' => 'Locations',
			'icon'  => 6,
			'boxes' => array(
				'Location Link'=>array(
					'icon' => 'customization',
					'description'=>"By writing some word in here you are changing the permalink of the 'location' post type",
					'size'=>'half',
					'input_fields' =>array(
						'Permalink' => array(
							'id'    => 'locations_url',
							'type'  => 'text',
							'note' => 'Exemple : http://teslathemes.com/<b><u>location</u></b>/lamb-rack-with-fried-potatoes-and-sauce/<p><b>REMEMBER !</b> After you change the permalink you have to go to <b>Dashboard->Settings->Permalinks</b> and change the radio button to another type of permalink and click Save, to get it refreshed.</p>',
						)
					)
				), 
			)
		),
		array(
			'title' => 'Offers',
			'icon'  => 6,
			'boxes' => array(
				'Offers Link'=>array(
					'icon' => 'customization',
					'description'=>"By writing some word in here you are changing the permalink of the 'offers' post type",
					'size'=>'half',
					'input_fields' =>array(
						'Permalink' => array(
							'id'    => 'offers_url',
							'type'  => 'text',
							'note' => 'Exemple : http://teslathemes.com/<b><u>offers</u></b>/lamb-rack-with-fried-potatoes-and-sauce/<p><b>REMEMBER !</b> After you change the permalink you have to go to <b>Dashboard->Settings->Permalinks</b> and change the radio button to another type of permalink and click Save, to get it refreshed.</p>',
						)
					)
				),
				'Offers Page' => array(
					'icon'=>'customization',
					'size'=>'half',
					'input_fields' => array(
						'Offers per page'=>array(
							'size'=>'1_3',
							'id'=>'offers_per_page',
							'type'=>'text',
							'note'=>'How many offers will be shown on the offers page. <b>ACCEPTS ONLY NUMBERS ! </b>'
						),
						'Offers to load' => array(
							'id'=>'offers_to_load',
							'type'=>'text',
							'note'=>'How many offers to load by clicking the "See More" button. <b>ACCEPTS ONLY NUMBERS ! </b>'
						)
					)
				), 
			)
		),
		 array(
			'title' => 'Contact Info',
			'icon' => 5,
			'boxes' => array(
				'Google Settings'=>array(
					'icon' => 'social',
					'description'=>'Enter here the Google Maps API Key.',
					'size' => '1_3',
					'input_fields' => array(
						array(
							'type'=>'text',
							'id'=>'google_api_key',
							'note' => 'You can create such key with google services.'
						)
					)
				)
			)
		),
		array(
			'title' => 'Subscribers',
			'icon' => 7,
			'boxes' => array(
				'Subscribers'=>array(
					'icon' => 'social',
					'description'=>'First 20 subscribers are listed here. To get the full list export files using buttons below:',
					'size'=>1,
					'input_fields' => array(
						array(
							'type'=>'subscription',
							'id'=>'subscribe-form'
						)
					)
				)
			)
		),
	),
	'styles' => array( array('wp-color-picker'),'style','select2' ),
	'scripts' => array( array( 'jquery', 'jquery-ui-core','jquery-ui-datepicker','wp-color-picker' ), 'select2.min','jquery.cookie','tt_options', 'admin_js' )
);