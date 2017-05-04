<?php
// Creating the widget 
class popular extends WP_Widget {

function __construct() {
parent::__construct('popular',
					esc_attr__('[Locales] Popular Posts', 'locales'), 
					array( 'description' => esc_attr__( 'This widget gives you the ability to show the most popular posts by views', 'locales' ) ) 
					);
}

public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
if(!empty($instance['number'])):
		$postscount = $instance['number'];
	else:
		$postscount = 3;
	endif;
print $args['before_widget'];
if ( !empty( $title ) ) print $args['before_title'] . $title . $args['after_title']; 
?>
<ul class="popular-posts">                      
	<?php
	$popularpost = new WP_Query( array( 'posts_per_page' => $postscount, 'meta_key' => 'post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC'  ) );
	if ($popularpost->have_posts()) : while ($popularpost->have_posts()) : $popularpost->the_post(); ?>
		<li class="popular-post">
			<div class="post-image">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail('tt_popular_posts'); ?>
				</a>
			</div>

			<h3 class="post-title">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h3>
			<span class="post-date"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp')); _ex(' ago', 'widget', 'locales'); ?></span>
		</li>
	<?php endwhile; endif; ?>
	<?php wp_reset_postdata(); ?>
</ul>


<?php
print $args['after_widget'];
}
 
public function form( $instance ){ 
if ( isset( $instance[ 'title' ] ) ) :
	$title = $instance[ 'title' ];
else :
	$title = esc_attr__( 'New title', 'locales' );
endif;
$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 3;
?>  
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_attr_e( 'Title:', 'locales' ); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<p>
	<label for="<?php print $this->get_field_id( 'number' ); ?>"><?php esc_attr_e( 'Number of Posts:', 'locales' ); ?></label>
	<input class="widefat" value="<?php echo esc_attr( $number ); ?>" type="number" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" min="1" max="10">
</p>
<?php 
}
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
$instance['number'] = (int) $new_instance['number'];
return $instance;
}
}
function tt_widget_popular_load_widget() {
  register_widget( 'popular' );
}
add_action( 'widgets_init', 'tt_widget_popular_load_widget' );