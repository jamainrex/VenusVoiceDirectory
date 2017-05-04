<?php 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$class = !empty($css) ? vc_shortcode_custom_css_class( $css ) : '';
$concatinator =  strpos(_go('explore_page_url'), '?') !== false ? '&' : '?';
$background = $bg_img ? wp_get_attachment_image_src($bg_img, 'original') : '';
?>

<!-- Page Introbox -->
<div class="intro-box <?php tt_print($class) ?>">
	<div class="intro-box-content">
		<img src="<?php if(@$background[0]) tt_print(@$background[0]); else echo "\" style=\"background: #785777"; ?>" alt="intro box background" class="intro-box-background" />

		<div class="intro-box-inner-content">
			<form class="discover-places-form">
				<div class="container">
					<?php if($intro_title) : ?>
						<h1 class="form-title"><?php tt_print($intro_title) ?></h1>
					<?php endif; ?>
					<div class="form-inner">
						<?php if(!$hide_by_title) : ?>
							<div class="input-line">
								<input type="text" class="form-input check-value search-title-input" placeholder="<?php esc_attr_e('What are you looking for?','locales') ?>" />
							</div>
						<?php endif; ?>
						<div class="row">
							<?php if(!$hide_by_location) : ?>
								<div class="col-md-<?php echo !$hide_by_type ? 6 : 12; ?>">
									<div class="input-line">
										<span class="input-line-title"><?php esc_html_e('Location', 'locales') ?></span>
										<div class="select-box cities">
											<input type="text" class="select-box-input form-input check-value" readonly placeholder="<?php esc_attr_e('Choose location','locales') ?>" />
											<ul class="clean-list select-box-options">
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
														<li class="option"><?php tt_print($city) ?></li>
													<?php endforeach;
												endif; ?>
											</ul>
										</div>

										<select class="html-select-box cities check-value">
											<option selected disabled><?php esc_html_e('Choose location', 'locales') ?></option>
											<?php if($cities->have_posts()) :
												foreach(array_unique($unique_cities) as $city) : ?>
													<option><?php tt_print($city) ?></option>
												<?php endforeach;
											endif; ?>
										</select>
									</div>
								</div>
							<?php endif; ?>
							<?php if(!$hide_by_type) : ?>
								<div class="col-md-<?php echo !$hide_by_location ? 6 : 12; ?>">
									<div class="input-line">
										<span class="input-line-title"><?php esc_html_e('Type', 'locales') ?></span>
										<div class="select-box categories">
											<input type="text" class="select-box-input form-input check-value" readonly placeholder="<?php esc_attr_e('Choose the type','locales') ?>" />
											<ul class="clean-list select-box-options">
												<?php $location_cats = get_terms(array(
													'taxonomy' => 'location_tax',
													'hide_empty' => false,
												));  foreach($location_cats as $single_cat) : ?>
													<li class="option"><?php tt_print($single_cat->name); ?></li>
												<?php endforeach; ?>
											</ul>
										</div>

										<select class="html-select-box categories check-value">
											<option selected disabled><?php esc_html_e('Choose the type', 'locales') ?></option>
											<?php $location_cats = get_terms(array(
												'taxonomy' => 'location_tax',
												'hide_empty' => false,
											));  foreach($location_cats as $single_cat) : ?>
												<option><?php tt_print($single_cat->name); ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
							<?php endif; ?>
						</div>

						<div class="align-center">
							<a href="<?php tt_print(_go('explore_page_url').$concatinator) ?>" class="form-submit btn btn-default"><?php esc_html_e('Search', 'locales') ?></a>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>