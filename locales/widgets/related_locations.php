<?php
// Creating the widget 
class similar_locations extends WP_Widget {

function __construct() {
parent::__construct('similar_locations',
					esc_attr__('[Locales] Similar Locations', 'locales'), 
					array( 'description' => esc_attr__( 'This widget gives you the ability to show some similar locations', 'locales' ) ) 
					);
}

public function widget( $args, $instance ) {

$post_id = get_the_ID();
$title = apply_filters( 'widget_title', $instance['title'] );
if(!empty($instance['number'])):
	$postscount = $instance['number'];
else:
	$postscount = 3;
endif;

if(!empty($instance['taxonomy'])):
	$taxonomy = $instance['taxonomy'];
else:
	$taxonomy = 'Categories';
endif;

print $args['before_widget'];
if ( !empty( $title ) ) print $args['before_title'] . $title . $args['after_title']; 

if($taxonomy === 'Tags') :
	$tags = wp_get_post_tags($post_id);
	if ($tags) {

	$first_tag = $tags[0]->term_id;
	$opt=array(
	'tag__in' => array($first_tag),
	'post_type' => 'location',
	'post__not_in' => array($post_id),
	'posts_per_page'=>$postscount

	); ?>
	<ul class="clean-list similar-locations-list">
	<?php 
	$my_query = new WP_Query($opt);
	if( $my_query->have_posts() ) :
		while ($my_query->have_posts()) : $my_query->the_post(); ?>

			<li class="similar-location <?php if( !has_post_thumbnail() ) echo "no-image"; ?>">
				<?php if(has_post_thumbnail()) : ?>
					<a href="<?php the_permalink(); ?>" class="image">
						<?php the_post_thumbnail('tt_similar_locations'); ?>
					</a>
				<?php endif; ?>
				<h5 class="title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h5>
				<p class="categories"><?php tt_print($tags[0]->slug) ?></p>
			</li>

		<?php
		endwhile;
	else : esc_html_e('No similar posts for a moment', 'locales');
	endif;
	wp_reset_postdata();
	} else {
		esc_html_e('No similar posts for a moment', 'locales');
	}
	?>
	</ul>
<?php
elseif($taxonomy === 'Categories') :
	 $location_tax = array();
	 $terms = wp_get_post_terms( $post_id, 'location_tax');
	            if($terms){
	            foreach($terms as $term) array_push($location_tax, $term->slug);
	            $my_query = new WP_Query( array(
	                'post_type' => 'location',
	                'post_status' => 'publish',
	               	'tax_query' => array(
						array(
							'taxonomy' => 'location_tax',
							'field'    => 'slug',
							'terms'    => $location_tax,
						),
					),
	                'post__not_in' => array($post_id)
	                ));
		?>

		<ul class="clean-list similar-locations-list">
		<?php 
		
		if( $my_query->have_posts() ) :
			while ($my_query->have_posts()) : $my_query->the_post(); ?>
				<li class="similar-location <?php if( !has_post_thumbnail() ) echo "no-image"; ?>">
					<?php if(has_post_thumbnail()) : ?>
						<a href="<?php the_permalink(); ?>" class="image">
							<?php the_post_thumbnail('tt_similar_locations'); ?>
						</a>
					<?php endif; ?>
					<h5 class="title">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h5>
					<p class="categories"><?php tt_print($terms[0]->slug); ?></p>
				</li>
			<?php
			endwhile;
		endif;
		wp_reset_query();
	} else {
		esc_html_e('No similar posts for a moment', 'locales');
	}
	?>
	</ul>
<?php endif;
print $args['after_widget'];
}
 
public function form( $instance ){ 
if ( isset( $instance[ 'title' ] ) ) :
	$title = $instance[ 'title' ];
else :
	$title = esc_attr__( 'New title', 'locales' );
endif;
$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 3;
$taxonomy = isset($instance['taxonomy']) ? $instance['taxonomy'] : 'tags';
?>  
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_attr_e( 'Title:', 'locales' ); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<p>
	<label for="<?php print $this->get_field_id( 'number' ); ?>"><?php esc_attr_e( 'Number of Posts:', 'locales' ); ?></label>
	<input class="widefat" value="<?php echo esc_attr( $number ); ?>" type="number" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" min="1" max="10">
</p>
<p>
	<label for="<?php print $this->get_field_id( 'taxonomy' ); ?>"><?php esc_attr_e( 'Similar by:', 'locales' ); ?></label>
	<select class='widefat' id="<?php echo $this->get_field_id('taxonomy '); ?>" name="<?php echo $this->get_field_name('taxonomy'); ?>" type="text">
		<option value='Categories'<?php echo ($taxonomy=='Categories') ? 'selected' : ''; ?>>
			Categories
		</option> 
		<option value='Tags'<?php echo ($taxonomy =='Tags') ? 'selected' : ''; ?>>
			Tags
		</option>
	</select>
</p>
<?php 
}
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
$instance['number'] = (int) $new_instance['number'];
$instance['taxonomy'] = $new_instance['taxonomy'];
return $instance;
}
}
function tt_widget_similar_locations_widget() {
  register_widget( 'similar_locations' );
}
add_action( 'widgets_init', 'tt_widget_similar_locations_widget' );