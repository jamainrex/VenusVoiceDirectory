<?php
return array(
	'error_class'=>'error',			//class added to container on error

	'required_class' => 's_error',	//class added to the required input with no value at submission
	'required_msg' => esc_attr__('Please insert email','locales'),	//message displayed when at least one required filed is not filled
	'invalid_email_class' => 'invalid_email',	//class added to the email input with an invalid email value at submission
	'invalid_email_msg'=> esc_attr__("Invalid Email",'locales'),	//Invalid email message
	'input_timeout' => true,	//if true will remove input classes within the time in ms set for 'result_timeout' config below

	'success_class'=>'success',		//class addded to container on successful subscription
	'animation_done_class'=>'animation_done',
	'result_timeout' => 3000,	//time in ms to remove result container html and added classes (error_class or success_class)
	
	'result_container_selector'=>'form .result_container',//Jquery type selector for the result container
	//'result_wrapper'=> array(
	//	'tag'=>'<p>',				//wrapper tag
	//	'attr'=>array(				//any jquery object attributes
	//		'id'=>'result_wrapper',
	//		)
	//	),
	'date_format' => "F j, Y, g:i a",
	'date_headline' => esc_attr__('Date','locales'),
	'no_data_posted' => esc_attr__('No data received','locales'),
	'error_open_create_files_msg' => esc_attr__('Error writing to disk','locales'), //leave blank to get the php error msg
	'success_msg' => esc_attr__('Successfully Subscribed','locales'),
	'error_writing_msg' => esc_attr__("Couldn't write to file",'locales'),

	);