<?php
// Creating the widget 
class location_contact_info extends WP_Widget {

function __construct() {
parent::__construct(
			'location_contact_info', 
			esc_attr__('[Locales] Location Contact Info', 'locales'),
			array( 'description' => esc_attr__( 'This widget gives you the ability to show the location info', 'locales' ), ) 
			);
}

public function widget( $args, $instance ) {

$post_id = get_the_ID();
$options = get_post_meta($post_id, 'slide_options', true);

@$title = apply_filters( 'widget_title', $instance['title'] );
@$phone = $options['Location']['contacts']['phone'] ? $options['Location']['contacts']['phone'] : '';
@$email = $options['Location']['contacts']['email'] ? $options['Location']['contacts']['email'] : '';
@$workhours_open = $options['Location']['working_hours']['opening'] ? $options['Location']['working_hours']['opening'] : '';
@$workhours_close = $options['Location']['working_hours']['closing'] ? $options['Location']['working_hours']['closing'] : '';

@$twitter = $options['Location']['contacts']['twitter_name'] ? $options['Location']['contacts']['twitter_name'] : '';
@$facebook = $options['Location']['contacts']['facebook_url'] ? $options['Location']['contacts']['facebook_url'] : '';
@$instagram = $options['Location']['contacts']['instagram'] ? $options['Location']['contacts']['instagram'] : '';
@$googleplus = $options['Location']['contacts']['googleplus'] ? $options['Location']['contacts']['googleplus'] : '';
@$pinterest = $options['Location']['contacts']['pinterest'] ? $options['Location']['contacts']['pinterest'] : '';
@$youtube = $options['Location']['contacts']['youtube'] ? $options['Location']['contacts']['youtube'] : '';

// before and after widget arguments are defined by themes
print $args['before_widget'];
if ( !empty( $title ) ) print $args['before_title'] . $title . $args['after_title']; 
?>
	<ul class="clean-list contact-info-list">
	<?php if($phone): ?>
		<li class="phone"><span class="title"><?php esc_html_e('Phone:', 'locales') ?></span><span class="text"><?php tt_print($phone) ?></span></li>
	<?php endif; 
	if($email): ?>
		<li class="mail"><span class="title"><?php esc_html_e('Mail:', 'locales') ?></span><a href="mailto:"><?php tt_print($email) ?></a></li>
	<?php endif;
	if($workhours_close && $workhours_open): ?>
		<li class="hours"><span class="title"><?php esc_html_e('Working hours:', 'locales') ?></span><span class="text"><?php tt_print($workhours_open.' - '.$workhours_close) ?></span></li>
	<?php endif; ?>
	</ul>
	<ul class="clean-list social-list">
		<?php if($twitter) : ?>
			<li>
				<a href="<?php echo esc_url($twitter); ?>" target="_blank">
					<i class="icon-twitter ?>"></i>
				</a>
			</li>
		<?php endif; ?>
		<?php if($facebook) : ?>
			<li>
				<a href="<?php echo esc_url($facebook); ?>" target="_blank">
					<i class="icon-facebook ?>"></i>
				</a>
			</li>
		<?php endif; ?>
		<?php if($instagram) : ?>
			<li>
				<a href="<?php echo esc_url($instagram); ?>" target="_blank">
					<i class="icon-instagram ?>"></i>
				</a>
			</li>
		<?php endif; ?>
		<?php if($googleplus) : ?>
			<li>
				<a href="<?php echo esc_url($googleplus); ?>" target="_blank">
					<i class="icon-googleplus ?>"></i>
				</a>
			</li>
		<?php endif; ?>
		<?php if($pinterest) : ?>
			<li>
				<a href="<?php echo esc_url($pinterest); ?>" target="_blank">
					<i class="icon-pinterest ?>"></i>
				</a>
			</li>
		<?php endif; ?>
		<?php if($youtube) : ?>
			<li>
				<a href="<?php echo esc_url($youtube); ?>" target="_blank">
					<i class="icon-youtube ?>"></i>
				</a>
			</li>
		<?php endif; ?>
	</ul>

<?php
print $args['after_widget'];
}




	// Widget Backend 
public function form( $instance ){ 
	if ( isset( $instance[ 'title' ] ) ) :
		$title = $instance[ 'title' ];
	else :
		$title = esc_attr__( 'New title', 'locales' );
	endif;
?>  
<p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_attr_e( 'Title:', 'locales' ); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<?php 
}


public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
return $instance;
}
} 

function tt_widget_location_contact_info_load_widget() {
  register_widget( 'location_contact_info' );
}
add_action( 'widgets_init', 'tt_widget_location_contact_info_load_widget' );