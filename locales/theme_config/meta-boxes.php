<?php
return array(
		'metaboxes'=>array(
			array(
				'id'             => 'post_settings_',          // meta box id, unique per meta box
				'title'          => esc_attr_x('Post Settings','meta boxes','locales'),         // meta box title,'meta boxes','locales')e
				'post_type'      => array('post'),
				'priority'		 => 'low',
				'context'		=> 'normal',
				'input_fields'   => array(            // list of meta fields (can be added by field arrays)
					'sidebar_position'  =>  array(
						'name'  =>  esc_attr_x('Sidebar Position','meta boxes','locales'),
						'type'  =>  'select',
						'values'    =>  array(
								'as_blog'   =>  esc_attr_x('Same as Blog Page','meta boxes','locales'),
								'full_width'=>  esc_attr_x('No Sidebar/Full Width','meta boxes','locales'),
								'right'     =>  esc_attr_x('Right','meta boxes','locales'),
								'left'      =>  esc_attr_x('Left','meta boxes','locales'),
							),
						'std'   =>  'right'  //default value selected
					),
					'share_on_off'  =>  array(
						'name'  =>  esc_attr_x('Post Share','meta boxes','locales'),
						'type'  =>  'select',
						'values'    =>  array(
								'enable_post_share'	=>  esc_attr_x('Show Share Section','meta boxes','locales'),
								'disable_post_share'	=>  esc_attr_x('Hide Share Section','meta boxes','locales')
							),
						'std'   =>  'enable_post_share',  //default value selected
						'desc'	=> esc_attr_x('Choose to show or hide the "Share" section.','meta boxes', 'locales')
					),
				)
			),
			
			array(
				'id'             => 'page_settings_',            // meta box id, unique per meta box
				'title'          => esc_attr_x('Page Settings','meta boxes','locales'),   // meta box title
				'post_type'      => array('page'),		// post types, accept custom post types as well, default is array('post'); optional
				'taxonomy'       => array(),    // taxonomy name, accept categories, post_tag and custom taxonomies
				'context'		 => 'normal',						// where the meta box appear: normal (default), advanced, side; optional
				'priority'		 => 'low',						// order of meta box: high (default), low; optional
				'input_fields'   => array(
					
					
					'sidebar_position'  =>  array(
						'name'  =>  esc_attr_x('Sidebar Position','meta boxes','locales'),
						'type'  =>  'select',
						'values'    =>  array(
								'full_width'    =>  esc_attr_x('No Sidebar/Full Width','meta boxes','locales'),
								'right'         =>  esc_attr_x('Right','meta boxes','locales'),
								'left'          =>  esc_attr_x('Left','meta boxes','locales'),
							),
						'std'   =>  'right'  //default value selected
					),
					'share_on_off'  =>  array(
						'name'  =>  esc_attr_x('Page Share','meta boxes','locales'),
						'type'  =>  'select',
						'values'    =>  array(
								'enable_post_share'	=>  esc_attr_x('Show Share Section','meta boxes','locales'),
								'disable_post_share'	=>  esc_attr_x('Hide Share Section','meta boxes','locales')
							),
						'std'   =>  'enable_post_share',  //default value selected
						'desc'	=> esc_attr_x('Choose to show or hide the "Share" section.','meta boxes', 'locales')
					),
				)
			),
		)
	);