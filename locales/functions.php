<?php
global $filtered_query;
/***********************************************************************************************/
/*  Tesla Framework */
/***********************************************************************************************/

require_once(get_template_directory() . '/tesla_framework/tesla.php');

/***********************************************************************************************/
/*  Register Plugins */
/***********************************************************************************************/

if ( is_admin() && current_user_can( 'install_themes' ) ) {
  require_once( get_template_directory() . '/plugins/tgm-plugin-activation/register-plugins.php' );
}

/***********************************************************************************************/
/* Add Menus */
/***********************************************************************************************/

function tt_register_menus($return = false){
	$tt_menus = array('primary' => esc_attr_x('Main Menu', 'dashboard','locales'), 'footer' => esc_attr_x('Footer Menu', 'dashboard', 'locales'));
	if($return)
		return array('primary' => 'Main Menu', 'secondary' => 'Side Menu', 'footer' => 'Footer Menu' );
	register_nav_menus($tt_menus);
}
add_action('init', 'tt_register_menus');

/**********************************************************************************************/
/*        SIDEBARS                                                                            */
/**********************************************************************************************/

function tt_locales_main_sidebar_register() {

  register_sidebar( array(
	'name'          => 'Blog Sidebar',
	'id'            => 'blog-sidebar',
	'before_widget' => '<div class="widget %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h4 class="widget-title">',
	'after_title'   => '</h4>',
  ) );
	register_sidebar( array(
	'name'          => 'Location Sidebar',
	'id'            => 'location-sidebar',
	'before_widget' => '<div class="widget %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h4 class="widget-title">',
	'after_title'   => '</h4>',
  ) );
}
add_action( 'widgets_init', 'tt_locales_main_sidebar_register' );

/**********************************************************************************************/
/*    favicon                                                                                 */
/**********************************************************************************************/
function tt_theme_favicon() {
	if( function_exists( 'wp_site_icon' ) && has_site_icon() ) {
		wp_site_icon();
	} else if(_go( 'favicon')){
		echo "\r\n" . sprintf( '<link rel="shortcut icon" href="%s">', _go( 'favicon') ) . "\r\n";
	}
}
add_action( 'wp_head', 'tt_theme_favicon');

/***********************************************************************************************/
/*   Enable Visual Composer */
/***********************************************************************************************/

function tt_load_vc() {
	if (class_exists('Vc_Manager')) {
		vc_set_shortcodes_templates_dir(TEMPLATEPATH . '/templates/shortcodes');
		require_once(TEMPLATEPATH . '/theme_config/shortcodes.php');
		require_once(TEMPLATEPATH . '/theme_config/tt-map.php');
		include_once(TEMPLATEPATH . '/theme_config/google_map.php' );
	}
}
add_action('init','tt_load_vc', 15);

/***********************************************************************************************/
/* ESC Attribute Function */
/***********************************************************************************************/

function tt_print( $param ){
	print esc_attr( $param );
}

/***********************************************************************************************/
/* Color Changers */
/***********************************************************************************************/

add_action( 'tt_fw_init' , 'tt_color_changers' );
function tt_color_changers(){
	//color changers
	require_once get_template_directory() . '/theme_config/color_changers.php';
}

/***********************************************************************************************/
/* Custom JS */
/***********************************************************************************************/

add_action('wp_footer', 'tt_custom_js', 99);
function tt_custom_js() {
  ?>
  <script type="text/javascript"><?php echo esc_js(_eo('custom_js')) ?></script>
  <?php
}

if(!function_exists('tt_locales_to_js')){
	function tt_locales_to_js() {
		$send_js = array(
			'dirUri' => get_template_directory_uri()
		);
		wp_localize_script( 'options.js', 'themeOptions', $send_js );
		wp_register_script( 'g-map', '//maps.googleapis.com/maps/api/js?key='._go('google_api_key').'&libraries=places'
			, array('jquery'), null, true );
		wp_enqueue_script( 'g-map');
	}
	add_action( 'wp_enqueue_scripts', 'tt_locales_to_js', 1 );
}

function tt_locales_admin_js( $hook ) {
	wp_enqueue_script( 'admin-g-map', '//maps.googleapis.com/maps/api/js?key='._go('google_api_key').'&libraries=places', array('jquery'), null, true );
}
add_action( 'admin_enqueue_scripts', 'tt_locales_admin_js', 10, 1);

/***********************************************************************************************/
/* DISPLAYING POST POPULARITY BY VIEWS ( VIEWS COUNTER )                                       */
/***********************************************************************************************/

function tt_getPostViews($postID){
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
		return "0 View";
	}
	return $count.' Views';
}
function tt_setPostViews($postID) {
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
		$count = 0;
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
	}else{
		$count++;
		update_post_meta($postID, $count_key, $count);
	}
}

/***********************************************************************************************/
/* Form Location                                                                               */
/***********************************************************************************************/
add_action( 'tt_fw_init' , 'tt_fw_functions' );

function tt_fw_functions(){
  TT_Contact_Form_Builder::add_form_locations(array(
	  'shortcode' => 'Shortcode Form',
  ));

/***********************************************************************************************/
/* Google fonts + Fonts changer */
/***********************************************************************************************/

TT_ENQUEUE::$gfont_changer = array(
		_go('logo_text_font'),
		_go('main_content_text_font'),
		_go('sidebar_text_font'),
		_go('menu_text_font')
	);
TT_ENQUEUE::$base_gfonts = array('Montserrat');
TT_ENQUEUE::add_js(array('jquery-form'));
}

/***********************************************************************************************/
/* Excerpt filter */
/***********************************************************************************************/
function tt_excerpt_more( $more ) {
	esc_html__(' ...', 'locales');
}
add_filter( 'excerpt_more', 'tt_excerpt_more' );

/***********************************************************************************************/
/* Share Function */
/***********************************************************************************************/

if(!function_exists('tt_share')){
  function tt_share(){
	$share_this = _go('share_this');
	if(isset($share_this) && is_array($share_this)): ?>

			<!-- Share Article -->
				<ul class="clean-list social-list share-block">
				  <?php foreach($share_this as $val):
					if($val === 'googleplus') $val = 'google-plus';
					switch ($val) {
					  case 'facebook': ?>
							  <?php printf('<li class="platform %s">', $val) ?>
							<a onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;t=<?php urlencode(get_the_title()); ?>&amp;u=<?php echo urlencode(get_the_permalink()) ?>','sharer','toolbar=0,status=0,width=548,height=325');" href="javascript: void(0)"><i class="icon-<?php echo esc_attr($val );?>"></i></a>
						
						<?php break; ?>
					  <?php case 'twitter': ?>
						  <?php printf('<li class="platform %s">', $val) ?>
							<a class="twitter" onClick="window.open('http://twitter.com/intent/tweet?url=<?php echo urlencode(get_the_permalink()) ?>&amp;text=<?php urlencode(get_the_title()); ?>','sharer','toolbar=0,status=0,width=548,height=325');" href="javascript: void(0)"><i class="icon-<?php echo esc_attr($val );?>"></i></a>
						  
						<?php break; ?>
					  <?php case 'google-plus': ?>
						  <?php printf('<li class="platform %s">', $val) ?>
							<a class="google-plus" onClick="window.open('https://plus.google.com/share?url=<?php echo urlencode(get_the_permalink()) ?>','sharer','toolbar=0,status=0,width=548,height=325');" href="javascript: void(0)"><i class="icon-<?php echo esc_attr($val );?>"></i></a>
						 
						<?php break; ?>
					  <?php case 'pinterest': ?>
						  <?php printf('<li class="platform %s">', $val) ?>
							<a class="pinterest" onClick="window.open('https://www.pinterest.com/pin/create/button/?url=<?php echo urlencode(get_the_permalink()) ?>','sharer','toolbar=0,status=0,width=748,height=325');" href="javascript: void(0)"><i class="icon-<?php echo esc_attr($val );?>"></i></a>
						  
						<?php break; ?>
					  <?php case 'linkedin': ?>
						  <?php printf('<li class="platform %s">', $val) ?>
							<a class="linkedin" onClick="window.open('http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo urlencode(get_the_permalink()) ?>','sharer','toolbar=0,status=0,width=548,height=325');" href="javascript: void(0)"><i class="icon-<?php echo esc_attr($val );?>"></i></a>
						  
						  <?php break; ?>
					  <?php case 'vkontakte': ?>
						  <?php printf('<li class="platform %s">', $val) ?>
							<a class="vkontakte" onClick="window.open('http://www.vkontakte.ru/share.php?url=<?php echo urlencode(get_the_permalink()) ?>','sharer','toolbar=0,status=0,width=548,height=325');" href="javascript: void(0)"><i class="icon-vk"></i></a>
						  
						<?php break; ?>
					  <?php default:
						esc_attr_e('No Share','locales');
						break;
					} ?>
				  <?php endforeach; ?>
			  </ul>
		<!-- Share Article End -->
	<?php endif;
  }
}

/***********************************************************************************************/
/* Comments */
/***********************************************************************************************/

function tt_custom_comments( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment;
  extract($args, EXTR_SKIP);
	global $comment_order;
	$comment_order++;
	$comment_class = 'comment-li';
	if($comment_order == 1)
		$comment_class = 'first';
  if ( 'div' == $args['style'] ) {
	$tag = 'div';
	$add_below = 'comment';
  } else {
	$tag = 'li';
	$add_below = 'div-comment';
  }
  ?>

  <<?php print $tag ?> id="comment-<?php comment_ID() ?>" <?php comment_class(empty( $args['has_children'] ) ? " $comment_class " : " $comment_class parent ") ?>>
		

		<div class="comment-header">
			<?php if ($args['avatar_size'] != 0): ?>
				<div class="image">
					<?php echo get_avatar( $comment, $args['avatar_size'], false,'avatar image' ); ?>
				</div>
			<?php endif;

			comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'],'reply_text'=> esc_attr__('reply','locales')))); ?>
		</div>

		<div class="comment-body">
			<h5 class="comment-meta">
				<span class="author"><?php echo get_comment_author(); ?></span>
				<span class="date"><?php echo get_comment_time(get_option('date_format','j F, Y \a\t g:i a')) ?></span>

				<div class="rating">
					<?php $rating_value = modify_comment() ?>
					<span class="bars">
						<i <?php if( $rating_value >= 1 ) echo 'class="full"' ?>></i>
						<i <?php if( $rating_value >= 2 ) echo 'class="full"'; ?>></i>
						<i <?php if( $rating_value >= 3 ) echo 'class="full"'; ?>></i>
						<i <?php if( $rating_value >= 4 ) echo 'class="full"'; ?>></i>
						<i <?php if( $rating_value >= 5 ) echo 'class="full"'; ?>></i>
					</span>
					<span class="value"><?php echo '('. modify_comment().'.0)';?></span>
				</div>
			</h5>
			<div class="comment-text"><?php comment_text(); ?></div>
		</div>


		


		<?php if ( 'div' != $args['style'] ) : ?>
			<div id="div-comment-<?php comment_ID() ?>"></div>
		<?php endif;
}

function move_comment_field_to_bottom( $fields ) {
$comment_field = $fields['comment'];
unset( $fields['comment'] );
$fields['comment'] = $comment_field;
return $fields;
}
add_filter( 'comment_form_fields', 'move_comment_field_to_bottom' );


/******************************************************************************************************************************/
/*						    	Comments Rating fields								*/
/******************************************************************************************************************************/

// Add fields after default fields above the comment box, always visible
	add_action( 'comment_form_logged_in_after', 'additional_fields' );
	add_action( 'comment_form_after_fields', 'additional_fields' );

	function additional_fields () {
	if(is_singular( 'location' )){ ?>

		<div class="rating-block new-comment-rating">
			<div class="rating">
				<span class="bars">
					<i class="full"></i>
					<i class="full"></i>
					<i class="full"></i>
					<i class="full"></i>
					<i class="full"></i>
				</span>
				<span class="value"><?php tt_print('(5.0)'); ?></span>
				<input type="number" name="comment-rating" value="5" hidden />
			</div>
		</div>
<?php }
}

// Save the comment meta data along with comment

add_action( 'comment_post', 'save_comment_meta_data' );

function save_comment_meta_data( $comment_id ) {
	if ( ( isset( $_POST['comment-rating'] ) ) && ( $_POST['comment-rating'] != '') )
	$rating = wp_filter_nohtml_kses($_POST['comment-rating']);
	add_comment_meta( $comment_id, 'rating', $rating );
}
// Add the comment meta (saved earlier) to the comment text
// You can also output the comment meta values directly to the comments template  

function modify_comment(){
	$commentrating = get_comment_meta( get_comment_ID(), 'rating', true );
	return (int)$commentrating;
}

function tt_comment_rating_average($post_id){

	$coments = get_comments(array('post_id' => $post_id));
	$com_count = get_comments_number($post_id);
	$ratings = array();
	for ($i=0; $i<$com_count; $i++):
		$com_id = (int)$coments[$i]->comment_ID;
		$com_meta = (int)get_comment_meta( $com_id, 'rating', true );
		array_push($ratings, $com_meta);
		
	endfor;  
	if($com_count != 0) :
		return $average = (int)array_sum($ratings) / $com_count; 
	else :
		return 0;
	endif;
}

/***********************************************************************************************/
/* AJAX */
/***********************************************************************************************/

add_action('wp_ajax_tt_post_ajax_load', 'tt_post_ajax_load');
add_action('wp_ajax_nopriv_tt_post_ajax_load', 'tt_post_ajax_load');

function tt_post_ajax_load() {
	$offset = $_POST['offset'];
	$perload = $_POST['perload'];

	$args = array(
		'post_status'   =>  'publish',
		'post_type'     =>  'offers',
		'offset' => $offset,
		'showposts' => $perload,
	);

$tt_query = new WP_Query($args);
$i = $offers_per_page; //this variable comes from offers
while($tt_query->have_posts()) : $tt_query->the_post(); 

	$options = get_post_meta(get_the_ID(), 'slide_options', true); 
	if($i % 2 == 0) : ?>
		<div class="special-offer-block">
			<div class="row row-fit">
				<div class="col-md-8 block-cover">
					<div class="image">
						<a href="<?php tt_print($options['special_offer']['link']); ?>">
							<?php the_post_thumbnail( 'tt_offers' ); ?>
						</a>
					</div>
				</div>

				<div class="col-md-5 block-body">
					<h5 class="block-title"><?php tt_print($options['special_offer']['offer_title']); ?></h5>
					<h3 class="block-discount"><?php tt_print($options['special_offer']['discount']); ?></h3>
					<p class="block-description"><?php tt_print($options['special_offer']['description']); ?></p>
				</div>
			</div>
		</div>
	<?php else: ?>
		<div class="special-offer-block">
			<div class="row row-fit">
				<div class="col-md-5 block-body">
					<h5 class="block-title"><?php tt_print($options['special_offer']['offer_title']); ?></h5>
					<h3 class="block-discount"><?php tt_print($options['special_offer']['discount']); ?></h3>
					<p class="block-description"><?php tt_print($options['special_offer']['description']); ?></p>
				</div>

				<div class="col-md-8 block-cover">
					<div class="image">
						<a href="<?php tt_print($options['special_offer']['link']); ?>">
							<?php the_post_thumbnail( 'tt_offers' ); ?>
						</a>
					</div>
				</div>
			</div>
		</div>
	<?php endif;  $i++;          
endwhile; wp_reset_postdata(); die();
}



add_action('wp_ajax_register_profile_form', 'register_profile_form');
add_action('wp_ajax_nopriv_register_profile_form', 'register_profile_form');

function register_profile_form(){
	global $current_user;
	wp_get_current_user();
	// Verify nonce
	if( !isset( $_POST['locales_new_user_nonce'] ) || !wp_verify_nonce( $_POST['locales_new_user_nonce'], 'locales_new_user' ) )
		die( 'Ooops, something went wrong, please try again later.' );

	$verify = true;

	$firstname = $_POST['reg_first_name'];
	$lastname = $_POST['reg_last_name'];
	$username = $_POST['reg_username'];
	$password = $_POST['reg_password'];
	$passwordr = $_POST['reg_passwordr'];
	$email = $_POST['reg_email'];
	$role = $_POST['user_role'];

	if (!empty($password) && !empty($passwordr)) {
		if ( $password != $passwordr ) {
			$error['pass'] = _x('The passwords do not match.','user registration', 'locales');
			$error['pass2'] = _x('Please write a new password.', 'user registration', 'locales');
		}
	}
 
	if ( !empty( $email ) ){
		if (!is_email(esc_attr( $email ))) {
			$error['email'] = _x('This email is not valid.', 'user registration', 'locales');
		}
		elseif(email_exists(esc_attr( $email )) != $current_user->ID ) {
			$error['email'] = _x('This email is already used.','user registration', 'locales');
		}
	} 

	if( !empty($username)) {
		if (username_exists($username)) {
			$error['username'] = _x('Username is used.','user registration', 'locales');
		}
		if(!validate_username($username)) {
			$error['username'] = _x('Invalid username.','user registration', 'locales');
		}
	}

	$userdata = array(
		'user_login'=> $username,
		'user_pass' => $password,
		'user_email'=> $email,
		'first_name'=> $firstname,
		'last_name' => $lastname,
		'role' => $role,
	);
 
	if(empty($error)) {
		$user_id = wp_insert_user( $userdata );
		$error['success'] = _x('Successfully registered.','user registration', 'locales');
	}

	die(json_encode($error));
}

/***********************************************************************************************/
/* USER SETTINGS */
/***********************************************************************************************/
add_action('after_setup_theme', 'tt_remove_admin_bar');

function tt_remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
		show_admin_bar(false);
	}
}

function tt_add_user_role() {

$result = add_role( 'agent', __('Agent','locales'),
 array(
'read' => true,
'edit_posts' => false,
'delete_posts' => false,
'publish_posts' => false,
'upload_files' => true,
));

}
add_action( 'admin_init', 'tt_add_user_role' );

/***********************************************************************************************/
/* ADDING NEW LOCATION */
/***********************************************************************************************/

add_action('wp_ajax_submit_new_location', 'submit_new_location');
add_action('wp_ajax_nopriv_submit_new_location', 'submit_new_location');

function submit_new_location(){
	global $current_user;
	$error = array(); 

	$title = $_POST['location-name'];
	$tags =  $_POST['tagList'] ;
	$content = isset($_POST['location-description']) ? $_POST['location-description'] : '';

	if( !empty($title) && !empty($_POST['location-category']) && !empty($_POST['Location']['map']['location']) && !empty($_POST['Location']['working_hours']['opening']) && !empty($_POST['Location']['working_hours']['closing']) && !empty($_POST['Location']['contacts']['phone']) && !empty($_POST['Location']['contacts']['email']) ) {
		$slug = sanitize_title($title);
		$post_id = wp_insert_post(
				array(
					'post_author'       =>  $current_user->ID,
					'post_name'     =>  $slug,
					'post_title'        =>  $title,
					'post_content' => $content, 
					'post_status'       =>  'pending',
					'post_type'     =>  'location'
				)
		);

		$post_type = 'location';

		$slider_options = Tesla_slider::$slider_config;

		$post_options = $slider_options[$post_type]['options'];

		$values_array = array();

		foreach($post_options as $field => $value){
		if(!empty($_POST[$field]))
			$values_array[$field] = Tesla_slider::normalize_keys($_POST[$field],$value);
		}

		add_post_meta($post_id, 'slide_options', $values_array, true) or update_post_meta($post_id, 'slide_options', $values_array);
		
		if(!empty($_POST['location-category'])) {
			$category = get_term_by('name',$_POST['location-category'], 'location_tax');
			wp_set_object_terms($post_id, $category->term_id, 'location_tax' );
		}

		if(!empty($tags)){
			wp_set_post_tags( $post_id, $tags, true );
		}


		//  if(!empty($_POST['options']))
		// wp_set_post_terms( $post_id, $_POST['options'], 'property_option');

		require_once(ABSPATH . "wp-admin" . '/includes/image.php');
		require_once(ABSPATH . "wp-admin" . '/includes/file.php');
		require_once(ABSPATH . "wp-admin" . '/includes/media.php');

		if ( $_FILES ) { 
			$files = $_FILES["images"]; 
			$i = 0;
			foreach ($files['name'] as $key => $value) {           
					if ( $files['name'][$key] ) { 
						$file = array( 
							'name' => $files['name'][$key],
							'type' => $files['type'][$key], 
							'tmp_name' => $files['tmp_name'][$key], 
							'error' => $files['error'][$key],
							'size' => $files['size'][$key]
						); 
						$_FILES = array ("images" => $file); 
						foreach ($_FILES as $file => $array) {           
							if ($_FILES[$file]['error'] !== UPLOAD_ERR_OK) __return_false();
							if(strpos($_POST['removed-images-input'], $_FILES[$file]['name']) === false) {
								$attach_id = media_handle_upload( $file, $post_id );
								if($_POST['featured-image'] == $_FILES[$file]['name']) set_post_thumbnail($post_id, $attach_id);
								$_POST['Location']['slide_images'][$i]['slide_image'] = $attach_id;
								$i++;
							}
						}
					} 
				} 
			}

		$post_type = 'location';
		$slider_options = Tesla_slider::$slider_config;
		$post_options = $slider_options[$post_type]['options'];
		$values_array = array();

		foreach($post_options as $field => $value){
		if(!empty($_POST[$field]))
			$values_array[$field] = Tesla_slider::normalize_keys($_POST[$field],$value);
		}

		add_post_meta($post_id, 'slide_options', $values_array, true) or update_post_meta($post_id, 'slide_options', $values_array);
		$error['success'] = _x('Successfully submitted','submit location', 'locales');
	}
	die(json_encode($error));
}


/***********************************************************************************************/
/* ADDING LOCATION TO FAVORITES AJAX */
/***********************************************************************************************/

add_action('wp_ajax_tt_add_favorite_location', 'tt_add_favorite_location');
add_action('wp_ajax_nopriv_tt_add_favorite_location', 'tt_add_favorite_location');

function tt_add_favorite_location(){
	$post_id = $_POST['postid'];
	$user_id = get_current_user_id();
	$favorites = get_user_meta($user_id, 'favorite_locations', true ) ? explode(",", get_user_meta($user_id, 'favorite_locations', true )) : array();
	if($_POST['postid'] == 'null') {    
		update_user_meta( $current_user->ID , 'favorite_locations', ''); 
		$error['fail'] = esc_attr__('nothing changed', 'locales');
	} else {   
		if (!in_array($post_id, $favorites)) {      
			array_push($favorites, $post_id); 
			$error['added'] = esc_attr__('added','locales');  
		} else {      
		$favorites = array_diff($favorites, array($post_id)); 
			$error['removed'] = esc_attr__('removed', 'locales');
		}    
		update_user_meta( $user_id, 'favorite_locations', implode(",",$favorites));  
	}  
	die(json_encode($error));  
}

/***********************************************************************************************/
/* REMOVING LOCATION FROM DASHBOARD  - AJAX */
/***********************************************************************************************/

add_action('wp_ajax_tt_remove_listing_from_dashboard', 'tt_remove_listing_from_dashboard');
add_action('wp_ajax_nopriv_tt_remove_listing_from_dashboard', 'tt_remove_listing_from_dashboard');

function tt_remove_listing_from_dashboard(){
	$post_id = $_POST['postid'];

	if($_POST['postid'] == 'null') {    
		$error['fail'] = __('Failed', 'locales');
	} else {
		$error['success'] = __('Removed', 'locales');
		wp_trash_post( $post_id );
	}
	die(json_encode($error)); 
}


/***********************************************************************************************/
/* REMOVING FAVORITE LOCATION FROM DASHBOARD  - AJAX */
/***********************************************************************************************/

add_action('wp_ajax_tt_remove_favorite_listing_from_dashboard', 'tt_remove_favorite_listing_from_dashboard');
add_action('wp_ajax_nopriv_tt_remove_favorite_listing_from_dashboard', 'tt_remove_favorite_listing_from_dashboard');

function tt_remove_favorite_listing_from_dashboard(){
	$post_id = $_POST['postid'];
	$user_id = get_current_user_id();
	$favorites = get_user_meta($user_id, 'favorite_locations', true ) ? explode(",", get_user_meta($user_id, 'favorite_locations', true )) : array();

	if($_POST['postid'] == 'null') {    
		$error['fail'] = __('Failed', 'locales');
	} else {
		$favorites = array_diff($favorites, array($post_id)); 
		update_user_meta( $user_id, 'favorite_locations', implode(",",$favorites));
		$error['success'] = __('Removed', 'locales');
	}
	die(json_encode($error)); 
}

/***********************************************************************************************/
/* ADD NEW CONTACT METHOD - PHONE  */
/***********************************************************************************************/

function tt_modify_contact_methods($profile_fields) {

	$profile_fields['contactphone'] = 'Phone';
	return $profile_fields;
}
add_filter('user_contactmethods', 'tt_modify_contact_methods');




add_action('wp_ajax_tt_update_profile_form', 'tt_update_profile_form');
add_action('wp_ajax_nopriv_tt_update_profile_form', 'tt_update_profile_form');

function tt_update_profile_form(){

	global $current_user;
	$error = array(); 
	wp_get_current_user();
	/* Update user data. */
	if ( !empty( $_POST['email'] ) ){
		if (!is_email(esc_attr( $_POST['email'] )))
			$error['email'] = _x('The email you entered is not valid.', 'update-profile', 'locales');
		elseif(email_exists(esc_attr( $_POST['email'] )) != false )
			$error['email'] = _x('This email is already used by another user.  try a different one.', 'update-profile', 'locales');
		else{
			wp_update_user( array('ID' => $current_user->ID, 'user_email' => esc_attr( $_POST['email'] )));
		}
	} 

	if ( !empty( $_POST['first-name'] ) )
		update_user_meta( $current_user->ID, 'first_name', esc_attr( $_POST['first-name'] ) );
	if ( !empty( $_POST['last-name'] ) )
		update_user_meta($current_user->ID, 'last_name', esc_attr( $_POST['last-name'] ) );
	if ( !empty( $_POST['user-phone'] ) )
		update_user_meta( $current_user->ID, 'contactphone', esc_attr( $_POST['user-phone'] ) );
	if(empty($error))
		$error['success'] = _x('Successfully updated', 'update-profile', 'locales');

	/* Update user password. */
	if ( !empty($_POST['password'] ) && !empty( $_POST['password-repeat'] ) ) {
		if ( $_POST['password'] == $_POST['password-repeat'] ) {
			wp_update_user( array( 'ID' => $current_user->ID, 'user_pass' => esc_attr( $_POST['password'] ) ) );
		}
		else {
			$error['pass'] = _x('The passwords do not match.', 'update-profile', 'locales');
			$error['pass2'] = _x('Please add new password.', 'update-profile', 'locales');
		}
	}

	die(json_encode($error));
}

/***********************************************************************************************/
/* ADD NEW CONTACT METHOD - PHONE  */
/***********************************************************************************************/

function exclude_page_templates_from_search($query) {
	 global $wp_the_query;
	 if ( ($wp_the_query === $query) && (is_search()) && ( ! is_admin()) ) {
		  $meta_query = 
				array(
					 'relation' => 'OR',
					 array(
						  'key' => '_wp_page_template',
						  'value' => array( 'page-dashboard.php', 'page-explore.php', 'page-offers.php'),
						  'compare' => 'NOT LIKE'
					 ),
					 array(
						  'key' => '_wp_page_template',
						  'value' => ' ',
						  'compare' => 'NOT EXISTS'
					 )
				);
		  $query->set('meta_query', $meta_query);
	 }
}
add_filter('pre_get_posts','exclude_page_templates_from_search');

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

add_action('wp_ajax_tt_filter_explore_locations', 'tt_filter_explore_locations');
add_action('wp_ajax_nopriv_tt_filter_explore_locations', 'tt_filter_explore_locations');

function tt_filter_explore_locations(){

	$user_id = get_current_user_id();
	$favorites = get_user_meta($user_id, 'favorite_locations', true ) ? explode(",", get_user_meta($user_id, 'favorite_locations', true )) : array();

	if(!empty($_POST['params']['title'])) :
		global $wpdb;
		$post__in = 'post__in';
		$post_in_val = $_POST['params']['title'];
		$mypostids = $wpdb->get_col('SELECT ID FROM '. $wpdb->posts.' WHERE post_title LIKE \'%' . esc_sql( $wpdb->esc_like( $post_in_val ) ) . '%\'');
	else:
		$post__in = '';
		$mypostids = '';
	endif;

	if(!empty($_POST['params']['priceRange'])) :
		$relation = 'OR';
		$ranges = [];
		foreach($_POST['params']['priceRange'] as $rng) :
			$price_range = array(
				'key' => 'slide_options',
				'value' => serialize('location_category').serialize($rng),
				'compare' => 'LIKE'
			);
			array_push($ranges, $price_range);
		endforeach;
	else : 
		$price_range = '';
	$relation = 'AND';
	endif;

	if(!empty($_POST['params']['city'])) :
		$city = array(
			'key' => 'slide_options',
			'value' => serialize('loc_hidden').serialize($_POST['params']['city']),
			'compare' => 'LIKE'
		);
	else : 
		$city = '';
	endif;

	if(!empty($_POST['params']['category']))
		$cat = array(
			'taxonomy' => 'location_tax',
			'field'    => 'name',
			'terms' => $_POST['params']['category'],
		);
	else $cat = '';
	if(!empty($_POST['params']['tags']))
		$tags = array(
			'taxonomy' => 'post_tag',
			'field'    => 'name',
			'terms' => $_POST['params']['tags'],
		);
	else $tags = '';

	$filtered_query = new WP_Query( array(
		  'post_type' => 'location',
		  'post_status' => 'publish',
		  'showposts' => -1,
		  $post__in => $mypostids,
		  'orderby' => 'meta_value_num',
		  'tax_query' => array(
				 'relation' => 'AND',
				$cat,
				$tags,
		  ),
		  'meta_query' => array(
				'relation' => $relation,
				$ranges[0],
				$ranges[1],
				$ranges[2],
				$ranges[3],
				$ranges[4],
				$city
		  )  
	 ));
	while ( $filtered_query -> have_posts() ) : $filtered_query -> the_post();
		$options = get_post_meta(get_the_ID(), 'slide_options', true); 
		$lat = $options['Location']['map']['lat'] ? $options['Location']['map']['lat'] : '40.7127837'; 
		$long = $options['Location']['map']['long'] ? $options['Location']['map']['long'] : '-74.00594130000002'; 
		$thumbnail = has_post_thumbnail() ? get_the_post_thumbnail_url() : get_template_directory_uri(). '/assets/identity.png'; ?>

		<li class="location-item location-ajax" data-id="<?php tt_print(get_the_ID()) ?>" data-marker-thumb="<?php tt_print($thumbnail) ?>" data-marker-lat="<?php tt_print($lat) ?>" data-marker-lon="<?php tt_print($long) ?>">
			<div class="image">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail('tt_explore_locations'); ?>
				</a>

				<span class="add-to-favorites <?php if(in_array(get_the_ID(), $favorites)) echo "added"; if(!is_user_logged_in()) echo "not_logged"; ?>">
					<i class="icon-like_outline"></i>
				</span>
			</div>

			<div class="item-body">
				<h4 class="item-title">
					<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
				</h4>
				<?php if($options['Location']['map']['location']): ?>
					<p class="location"><?php tt_print($options['Location']['map']['location']) ?></p>
				<?php endif; ?>
				<div class="review-details">
					<div class="rating">
						<?php $location_rating = tt_comment_rating_average(get_the_ID()); ?>
						<span class="bars">
							<i <?php if($location_rating >= 1) echo 'class="full"' ?>></i>
							<i <?php if($location_rating >= 2) echo 'class="full"' ?>></i>
							<i <?php if($location_rating >= 3) echo 'class="full"' ?>></i>
							<i <?php if($location_rating >= 4) echo 'class="full"' ?>></i>
							<i <?php if($location_rating >= 5) echo 'class="full"' ?>></i>
						</span>
						<span class="value"><?php tt_print('('.number_format((float)$location_rating, 1, '.', '').')'); ?></span>
					</div>
					<div class="price-range">
						<span class="amount">
							<i class="icon-usd <?php if($options['Location']['location_category'] >= 1) echo ' full'; ?>"></i>
							<i class="icon-usd <?php if($options['Location']['location_category'] >= 2) echo ' full'; ?>"></i>
							<i class="icon-usd <?php if($options['Location']['location_category'] >= 3) echo ' full'; ?>"></i>
							<i class="icon-usd <?php if($options['Location']['location_category'] >= 4) echo ' full'; ?>"></i>
							<i class="icon-usd <?php if($options['Location']['location_category'] >= 5) echo ' full'; ?>"></i>
						</span>
					</div>
				</div>

				<ul class="clean-list item-facilities">
					<?php if($options['Location']['facilities']['indoor']) : ?>
						<li>
							<i class="icon-Streamline-18"></i>
						</li>
					<?php endif; ?>
					<?php if($options['Location']['facilities']['specials']) : ?>
						<li>
							<i class="icon-Streamline-94"></i>
						</li>
					<?php endif; ?>
					<?php if($options['Location']['facilities']['drinks']) : ?>	
						<li>
							<i class="icon-Streamline-89"></i>
						</li>
					<?php endif; ?>
					<?php if($options['Location']['facilities']['music']) : ?>
						<li>
							<i class="icon-Streamline-48"></i>
						</li>
					<?php endif; ?>
					<?php if($options['Location']['facilities']['entertainment']) : ?>
						<li>
							<i class="icon-Streamline-65"></i>
						</li>
					<?php endif; ?>
				</ul>
			</div>
		</li>
	<?php endwhile;
	 wp_reset_postdata(); die();
}