<?php
 // Subscribe Box
 class tt_subscribe_box extends WP_Widget {
 
	function __construct() {
		parent::__construct(
				'widget_subscribe',
				'[Locales] Subscribe Box',
				array(
					'description' => esc_attr__('Subscribe Box Widget.', 'locales'),
					'classname' => 'widget_subscribe',
				)
		);
	}

 
	function widget($args, $instance){
		extract($args);
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

	print $before_widget;
	if(!empty($title)){
		print $before_title . $title . $after_title;
	}

	?>
	<form class="newsletter-subscribe-form" id="newsletter" method="post" data-tt-subscription>
		<h4 class="form-title"><?php esc_attr_e('Newsletter subscribe','locales');?></h4>

		<div class="input-line">
			<input type="email" name="email" class="form-input check-value" data-tt-subscription-required data-tt-subscription-type="email" placeholder="<?php esc_attr_e('Enter your email address','locales');?>">
			<button type="submit" class="form-submit">
				<i class="icon-Streamline-58"></i>
			</button>
		</div>
		<div class="result_container"></div>
	</form>       
	<?php print $after_widget;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}
 
	function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
	?>
		<p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_attr_e( 'Title:' , 'locales'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
	<?php
	}
}
 
add_action('widgets_init', create_function('', 'return register_widget("tt_subscribe_box");')); ?>