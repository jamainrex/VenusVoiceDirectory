<?php 
$slider_title = $slider_desktop_1 = $slider_tablet_1 = $slider_desktop_2 = $slider_tablet_2 = $slider_hide_title = $css = $slider_number = $slider_offset = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$class = !empty($css) ? vc_shortcode_custom_css_class( $css ) : '';

$slider_title = $slider_title ? $slider_title : 'Location Slider Title';
$slider_number = $slider_number ? $slider_number : -1;
$slider_offset_1 = $slider_offset_1 ? $slider_offset_1 : 0;
$slider_offset_2 = $slider_offset_2 ? $slider_offset_2 : 0;
$slider_desktop_1 = $slider_desktop_1 ? $slider_desktop_1 : 3;
$slider_tablet_1 = $slider_tablet_1 ? $slider_tablet_1 : 2;
$slider_desktop_2 = $slider_desktop_2 ? $slider_desktop_2 : 2;
$slider_tablet_2 = $slider_tablet_2 ? $slider_tablet_2 : 1;


if($slider_style == 1) : 
$args = array(
		'post_type' => 'location',
		'posts_per_page' => $slider_number,
		'orderby' => 'ASC',
		'offset' => $slider_offset_1
	);
$slider_query = new WP_Query( $args ); ?>
	<!-- Section - Carousel Section -->
	<section class="section <?php tt_print($class) ?>">
		<?php if(!$hide_slider_title) : ?>
			<h2 class="section-title">
				<div class="container"><?php tt_print($slider_title); ?></div>
			</h2>
		<?php endif; ?>
		<div class="container">
			<div class="tt-carousel destinations-carousel" data-items-desktop="<?php tt_print($slider_desktop_1) ?>" data-items-tablet="<?php tt_print($slider_tablet_1) ?>" data-items-phone="1" data-dots="true" data-arrows="true">
				<ul class="clean-list carousel-items">
					<?php if($slider_query->have_posts()) :
						while($slider_query->have_posts()) : $slider_query->the_post(); 
							$post_id = get_the_ID();
							$options = get_post_meta($post_id, 'slide_options', true);?>

							<li class="carousel-item">
								<div class="destination-box">
									<div class="box-inner">
										<div class="box-cover">
											<?php if(has_post_thumbnail()) : ?>	
												<div class="image">
													<?php the_post_thumbnail( 'tt_location_slider_style_1' ); ?>
												</div>
											<?php endif; ?>
											<ul class="clean-list destination-facilities">
												<?php foreach($options['Location']['facilitiez'] as $item['facility']) : 
													if(!empty($item['facility']['facility'])) : ?>
														<li>
															<i class="icon-<?php tt_print($item['facility']['facility']); ?>"></i>
														</li>
													<?php endif;
												endforeach; ?>	
											</ul>
										</div>

										<div class="box-body">
											<div class="box-meta">
												<h4 class="title">
													<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
												</h4>
												<?php if($options['Location']['map']['location']) : ?>
													<div class="location">
														<span class="text"><?php tt_print($options['Location']['map']['location']) ?></span>
													</div>
												<?php endif; ?>
												<p class="description"><?php if($options['Location']['description']) tt_print($options['Location']['description']); else esc_html_e('No Description', 'locales') ?></p>
											</div>

											<div class="box-footer">
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
												<a href="<?php the_permalink() ?>" class="destination-url"><?php esc_html_e('View', 'locales') ?></a>
											</div>
										</div>
									</div>
								</div>
							</li>
						<?php endwhile; 
					endif; ?>
				</ul>
			</div>
		</div>
	</section>
<?php elseif($slider_style == 2) : 
$args = array(
		'post_type' => 'location',
		'posts_per_page' => $slider_number,
		'orderby' => 'ASC',
		'offset' => $slider_offset_2
	);
$slider_query = new WP_Query( $args );
?>
	<!--  Section - Carousel Section -->
	<div class="section <?php tt_print($class) ?>">
		<?php if(!$hide_slider_title) : ?>
			<h2 class="section-title">
				<div class="container"><?php tt_print($slider_title); ?></div>
			</h2>
		<?php endif; ?>
		<div class="container">
			<div class="tt-carousel destinations-carousel" data-items-desktop="<?php tt_print($slider_desktop_2) ?>" data-items-small-desktop="2" data-items-tablet="<?php tt_print($slider_tablet_2) ?>" data-items-phone="1" data-dots="true" data-arrows="true">
				<ul class="clean-list carousel-items">
					<?php if($slider_query->have_posts()) :
						while($slider_query->have_posts()) : $slider_query->the_post(); 
							$post_id = get_the_ID();
							$options = get_post_meta($post_id, 'slide_options', true);?>
							<li class="carousel-item">
								<div class="destination-box">
									<div class="box-inner">
										<div class="box-cover">
											<?php if(has_post_thumbnail()) : ?>	
												<div class="image">
													<?php the_post_thumbnail( 'tt_location_slider_style_2' ); ?>
												</div>
											<?php endif; ?>
											<div class="box-meta">
												<h4 class="title">
													<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
												</h4>
												<p class="description"><?php if($options['Location']['description']) tt_print($options['Location']['description']); else esc_html_e('No Description', 'locales') ?></p>
											</div>
										</div>

										<div class="box-body">
											<div class="box-meta left">
												<?php if($options['Location']['map']['location']) : ?>
													<div class="location">
														<span class="text"><?php tt_print($options['Location']['map']['location']) ?></span>
													</div>
												<?php endif; ?>
											</div>
										</div>
									</div>
								</div>
							</li>
						<?php endwhile;
					endif; ?>
				</ul>
			</div>
		</div>
	</div>
<?php endif; ?>