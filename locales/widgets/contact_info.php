<?php
// Creating the widget 
class contact_info extends WP_Widget {

function __construct() {
parent::__construct(
					'contact_info', 
					esc_attr__('[Locales] Socials and contacts', 'locales'),
					array( 'description' => esc_attr__( 'This widget gives you the ability to show the Follow Me Links', 'locales' ), ) 
					);
}

public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
$phone = $instance['phone'];
$email = $instance['email'];
$workhours = $instance['workhours'];
// before and after widget arguments are defined by themes
print $args['before_widget'];
if ( !empty( $title ) ) print $args['before_title'] . $title . $args['after_title']; 
?>
	<ul class="clean-list contact-info-list">
	<?php if($phone): ?>
		<li class="phone"><span class="title"><?php esc_html_e('Phone:', 'locales') ?></span><span class="text"><?php tt_print($phone) ?></span></li>
	<?php endif; 
	if($email): ?>
		<li class="mail"><span class="title"><?php esc_html_e('Mail:', 'locales') ?></span><a href="#"><?php tt_print($email) ?></a></li>
	<?php endif;
	if($workhours): ?>
		<li class="hours"><span class="title"><?php esc_html_e('Working hours:', 'locales') ?></span><span class="text"><?php tt_print($workhours) ?></span></li>
	<?php endif; ?>
	</ul>
	<ul class="clean-list social-list">
		<?php 
			$social_platforms = array(
				'facebook',
				'twitter',
				'dribbble',
				'youtube',
				'rss',
				'google',
				'linkedin',
				'pinterest',
				'instagram'
			);

			foreach($social_platforms as $platform): 
				if (_go('social_platforms_' . $platform)): ?>
					<li>
						<a href="<?php echo esc_url(_go('social_platforms_' . $platform)); ?>" target="_blank">
							<i class="icon-<?php print esc_attr($platform); ?>"></i>
						</a>
					</li>
				<?php endif;
			endforeach; 
		?>
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
	if ( isset( $instance[ 'phone' ] ) ) :
		$phone = $instance[ 'phone' ];
	else :
		$phone = esc_attr__( 'Your Phone Number', 'locales' );
	endif;
	if ( isset( $instance[ 'email' ] ) ) :
		$email = $instance[ 'email' ];
	else :
		$email = esc_attr__( 'Type an Email', 'locales' );
	endif;
	if ( isset( $instance[ 'workhours' ] ) ) :
		$workhours = $instance[ 'workhours' ];
	else :
		$workhours = esc_attr__( '08:00 - 17:00', 'locales' );
	endif;
?>  
<p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_attr_e( 'Title:', 'locales' ); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'phone' ); ?>"><?php esc_attr_e( 'Phone:', 'locales' ); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'phone' ); ?>" name="<?php echo $this->get_field_name( 'phone' ); ?>" type="text" value="<?php echo esc_attr( $phone ); ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php esc_attr_e( 'Email:', 'locales' ); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" type="text" value="<?php echo esc_attr( $email ); ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'workhours' ); ?>"><?php esc_attr_e( 'Working Hours:', 'locales' ); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'workhours' ); ?>" name="<?php echo $this->get_field_name( 'workhours' ); ?>" type="text" value="<?php echo esc_attr( $workhours ); ?>" />
</p>
<?php 
}







public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
$instance['phone'] = ( ! empty($new_instance['phone'] ) ) ? strip_tags($new_instance['phone']) : '';
$instance['email'] = ( ! empty($new_instance['email'] ) ) ? strip_tags($new_instance['email']) : '';
$instance['workhours'] = ( ! empty($new_instance['workhours'] ) ) ? strip_tags($new_instance['workhours']) : '';
return $instance;
}
} 

function tt_widget_contact_info_load_widget() {
  register_widget( 'contact_info' );
}
add_action( 'widgets_init', 'tt_widget_contact_info_load_widget' );