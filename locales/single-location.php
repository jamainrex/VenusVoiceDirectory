<?php get_header(); 
$post_id = get_the_ID();
$options = get_post_meta($post_id, 'slide_options', true);
$user_id = get_current_user_id();
$favorites = get_user_meta($user_id, 'favorite_locations', true ) ? explode(",", get_user_meta($user_id, 'favorite_locations', true )) : array();
?>


<!-- Single Location Block -->
<div <?php post_class('single-location-block'); ?>>
	<?php if(@$options['Location']['slide_images']) : ?>
		<!-- Location Cover -->
		<div class="single-location-cover">
			<div class="tt-slider cover-slider" data-fade="true" data-speed="900" data-infinite="true">
				<ul class="clean-list slides-list">
		
					<?php foreach($options['Location']['slide_images'] as $image_id ) :  ?>
						<li class="slide">
						<?php $slide_image = wp_get_attachment_image_src($image_id['slide_image'], 'original') ?>
							<img src="<?php tt_print($slide_image[0])  ?>" alt="single location image" />
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	<?php else: ?>
		<div class="cover_placeholder"></div>
	<?php endif; ?>
	<!-- Location Body -->
	<div class="single-location-body">
		<div class="container">
		
			<div class="row">	
				<?php while(have_posts()) : the_post(); tt_setPostViews(get_the_ID())?>
					<div class="col-md-7">
						<!-- Description -->
						<div class="location-description location-ajax" data-id="<?php tt_print($post_id) ?>">
							<!-- Add to Fav -->
							<span class="add-to-favorites <?php if(in_array($post_id, $favorites)) echo "added"; if(!is_user_logged_in()) echo "not_logged"; ?>">
								<i class="icon-like_outline"></i>
							</span>

							<div class="description-header">
								<h2 class="location-title"><?php the_title(); ?></h2>
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
							</div>
							<?php if($options['Location']['map']['location']) : ?>
								<p class="location-address"><?php tt_print($options['Location']['map']['location']) ?></p>
							<?php endif; ?>

							<div class="location-meta">
								<ul class="clean-list location-facilities">
									<?php foreach($options['Location']['facilitiez'] as $item['facility']) : 
										if(!empty($item['facility']['facility'])) : ?>
											<li>
												<i class="icon-<?php tt_print($item['facility']['facility']); ?>"></i>
											</li>
										<?php endif;
									endforeach; ?>	
								</ul>

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

							<?php the_content() ?>
							<?php if($options['Location']['website']) : ?>
								<p class="location-website">
									<a href="<?php tt_print($options['Location']['website']) ?>"><?php tt_print($options['Location']['website']) ?></a>
								</p>
							<?php endif; ?>
						</div>

						<?php comments_template( '/comments-location.php' ); ?>
					</div>
				<?php endwhile; ?>
				<div class="col-md-5">
					<aside class="main-sidebar">
						<?php get_sidebar( 'location' ); ?>
					</aside>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>