<?php get_header('explore');
/*
	Template Name: Explore
*/
$user_id = get_current_user_id();
$favorites = get_user_meta($user_id, 'favorite_locations', true ) ? explode(",", get_user_meta($user_id, 'favorite_locations', true )) : array();
$args = array('post_type' => 'location', 'posts_per_page' => -1); 
$locations = new WP_Query($args);
$mapMarkers = array();

if($locations->have_posts()) : 
	$i =1;
	while($locations->have_posts()) : $locations->the_post(); 
		$post_id = get_the_ID();
		$options = get_post_meta($post_id, 'slide_options', true);
		$lat = $options['Location']['map']['lat'] ? $options['Location']['map']['lat'] : '40.7127837'; 
		$long = $options['Location']['map']['long'] ? $options['Location']['map']['long'] : '-74.00594130000002'; 
		
		$mapMarkers[$i]['marker'] = has_post_thumbnail() ? get_the_post_thumbnail_url() : get_template_directory_uri(). '/assets/identity.png';
		$mapMarkers[$i]['marker_coord']['lat'] = $lat;
		$mapMarkers[$i]['marker_coord']['lon'] = $long;
		$mapMarkers[$i]['id'] = get_the_ID();
		$i++ ?>
	<?php endwhile; 
endif; ?>

<div class="map-locations-box">
	<div class="map-locations-box-inner">
		<div class="box-inner-col locations-map">
			<div class="spinner-box visible">
				<div class="spinner-wrapper">
					<span class="spinner"></span>
				</div>
			</div>

			<div data-map-markers='<?php echo json_encode( array_values($mapMarkers) ) ?>' id="map-canvas" class="map-container"></div>
		</div>

		<div class="box-inner-col locations-results">
			<div class="results-filters">
				<div class="filters-inner">
					<!-- Select Boxes -->
					<div class="filter-select-boxes">
						<select class="select-options city-ajax">
							<option><?php esc_html_e('ALL', 'locales') ?></option>
							<?php $unique_cities = [];
							$cities = new WP_Query(array( 'post_type' => 'location')); 
							if($cities->have_posts()) :
								while($cities->have_posts()) : $cities->the_post();
									$options = get_post_meta(get_the_ID(), 'slide_options', true);
									if(isset($options['Location']['loc_hidden'])) : 
										$unique_cities[] = $options['Location']['loc_hidden'];
									endif; 
								endwhile;
								foreach(array_unique($unique_cities) as $city) : ?>
									<option><?php tt_print($city) ?></option>
								<?php endforeach;
							endif; ?>
						</select>

						<!-- Select Boxes -->
						<select class="select-options category-ajax">
							<option><?php esc_html_e('ALL', 'locales') ?></option>
							<?php $location_cats = get_terms(array(
								'taxonomy' => 'location_tax',
								'hide_empty' => false,
							));  foreach($location_cats as $single_cat) : ?>
								<option><?php tt_print($single_cat->name); ?></option>
							<?php endforeach; ?>
						</select>
					</div>

					<!-- Price Range -->
					<div class="price-filter-block">
						<span class="block-title"><?php esc_html_e('Price filter:', 'locales') ?></span>				
						<div class="price-range-blocks">
							<label class="price-range-block">
								<input type="checkbox" hidden class="price-range-hinput" value="1"/>
								<span class="amount">
									<i class="icon-usd full"></i>
									<i class="icon-usd"></i>
									<i class="icon-usd"></i>
									<i class="icon-usd"></i>
									<i class="icon-usd"></i>
								</span>
							</label>

							<label class="price-range-block">
								<input type="checkbox" hidden class="price-range-hinput" value="2"/>
								<span class="amount">
									<i class="icon-usd full"></i>
									<i class="icon-usd full"></i>
									<i class="icon-usd"></i>
									<i class="icon-usd"></i>
									<i class="icon-usd"></i>
								</span>
							</label>

							<label class="price-range-block">
								<input type="checkbox" hidden class="price-range-hinput" value="3"/>
								<span class="amount">
									<i class="icon-usd full"></i>
									<i class="icon-usd full"></i>
									<i class="icon-usd full"></i>
									<i class="icon-usd"></i>
									<i class="icon-usd"></i>
								</span>
							</label>

							<label class="price-range-block">
								<input type="checkbox" hidden class="price-range-hinput" value="4"/>
								<span class="amount">
									<i class="icon-usd full"></i>
									<i class="icon-usd full"></i>
									<i class="icon-usd full"></i>
									<i class="icon-usd full"></i>
									<i class="icon-usd"></i>
								</span>
							</label>

							<label class="price-range-block">
								<input type="checkbox" hidden class="price-range-hinput" value="5"/>
								<span class="amount">
									<i class="icon-usd full"></i>
									<i class="icon-usd full"></i>
									<i class="icon-usd full"></i>
									<i class="icon-usd full"></i>
									<i class="icon-usd full"></i>
								</span>
							</label>
						</div>
					</div>

					<!-- Filters Categories -->
					<div class="filters-categories">
						<div class="categories-list-wrapper">
							<span class="list-title"><?php esc_html_e('Choose tags:', 'locales') ?></span>
							<ul class="clean-list categories-list">
							<?php $tags_array = get_tags(array('hide_empty' => true)); 
							foreach ($tags_array as $tag) : ?>
								<li><?php tt_print($tag->name) ?></li>
	
							<?php endforeach; ?>
							</ul>
						</div>

						<div class="choosed-categories"></div>
					</div>
				</div>
			</div>

			<ul class="clean-list results-list">
				<?php if($locations->have_posts()) : 
					while($locations->have_posts()) : $locations->the_post(); 
					$options = get_post_meta(get_the_ID(), 'slide_options', true); ?>
						<li class="location-item location-ajax" data-id="<?php tt_print(get_the_ID()) ?>">
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
									<?php foreach($options['Location']['facilitiez'] as $item['facility']) : 
										if(!empty($item['facility']['facility'])) : ?>
											<li>
												<i class="icon-<?php tt_print($item['facility']['facility']); ?>"></i>
											</li>
										<?php endif;
									endforeach; ?>
								</ul>
							</div>
						</li>
					<?php endwhile;
				endif;
				wp_reset_postdata(); ?>
			</ul>
		</div>
	</div>
</div>
<?php get_footer() ?>