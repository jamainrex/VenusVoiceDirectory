<?php 
$popular_title = $nr_popular_posts = $blog_type = $popularpost_css = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$class = !empty($popularpost_css) ? vc_shortcode_custom_css_class( $popularpost_css ) : '';
$popular_title = $popular_title ? $popular_title : 'Most Popular Locations';
$nr_popular_posts = $nr_popular_posts ? $nr_popular_posts : '3';
$columns_nr = $columns_nr ? $columns_nr : '4';
$seemore_button = $seemore_button ? $seemore_button : 'See more';  
$link_to_explore = $link_to_explore ? $link_to_explore : '#';

$popular_locations = new WP_Query( 
	array( 
		'post_type' => 'location', 
		'posts_per_page' => $nr_popular_posts, 
		'meta_key' => 'post_views_count', 
		'orderby' => 'meta_value_num', 
		'order' => 'DESC'  ) );
?>

<!-- Section - Popular Posts -->
<section class="section section-popular-posts <?php tt_print($class) ?>">
	<?php if(!$hide_the_title) : ?>
		<h2 class="section-title">
			<div class="container"><?php tt_print($popular_title) ?></div>
		</h2>
	<?php endif; ?>
	<div class="row row-fit">
		<?php if ($popular_locations->have_posts()) : 
			while ($popular_locations->have_posts()) : $popular_locations->the_post(); 
				$post_id = get_the_ID();
				$options = get_post_meta($post_id, 'slide_options', true);?>
				<div class="col-sm-<?php tt_print($columns_nr); ?>">
					<div class="popular-post-box">
						<a href="<?php the_permalink(); ?>" class="box-inner">
							<div class="box-meta">
								<h4 class="post-title"><?php the_title(); ?></h4>
								<p class="post-excerpt"><?php tt_print($options['Location']['description']) ?></p>
							</div>
							<?php if(has_post_thumbnail()) : 
								the_post_thumbnail('tt_popular_locations');
							endif; ?>
						</a>
					</div>
				</div>
		<?php endwhile;
		else : ?>
			<h3><?php esc_html_e('There are no locations to display at this moment.', 'locales'); ?></h3>

		<?php endif; ?>		
	</div>
	<?php if(!$hide_seemore_button) : ?>
		<div class="btn-wrapper">
			<div class="container">
				<a href="<?php tt_print($link_to_explore) ?>" class="btn btn-arrow"><?php tt_print($seemore_button) ?></a>
			</div>
		</div>
	<?php endif; ?>
</section>