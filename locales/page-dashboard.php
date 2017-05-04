<?php get_header();
/*
	Template Name: User Dashboard
*/

/* Get user info. */
global $current_user;
wp_get_current_user();
$dialog_title = _go('dialog_title') ? _go('dialog_title') : 'Confirm Deletion?';
$dialog_content = _go('dialog_content') ? _go('dialog_content') : 'Do you really want to remove this item?';
$confirm_text = _go('confirm_text') ? _go('confirm_text') : 'Confirm';
$cancel_text = _go('cancel_text') ? _go('cancel_text') : 'Cancel';

$favorites = get_user_meta( $current_user->ID, 'favorite_locations',  true );
$favorites_arr = explode(",", $favorites);

$my_locals = new WP_Query(array( 'post_type' => 'location', 'author' => $current_user->ID )); 
$my_favorite_locals = new WP_Query(array( 'post_type' => 'location', 'post__in' => $favorites_arr )); 

?>

<section id="post-<?php the_ID(); ?>" class="section section-dashboard">
	<h2 class="section-title">
		<div class="container"><?php the_title(); ?></div>
	</h2>
<?php if(is_user_logged_in()) : ?>
	<div class="dashboard-tabs">
		<div class="tabed-content">
			<div class="tabs-header">
				<div class="container">
					<ul class="clean-list tab-links">
						<li class="tab-link current" data-tab-link="dashboard-tab-1">
							<i class="icon icon-Streamline-182"></i>
							<span class="text"><?php esc_html_e('Dashboard', 'locales'); ?></span>
						</li>

						<li class="tab-link" data-tab-link="dashboard-tab-2">
							<i class="icon icon-Streamline-52"></i>
							<span class="text"><?php esc_html_e('My listing', 'locales'); ?></span>
						</li>

						<li class="tab-link" data-tab-link="dashboard-tab-3">
							<i class="icon icon-Streamline-63"></i>
							<span class="text"><?php esc_html_e('Favourites', 'locales'); ?></span>
						</li>

						<li class="tab-link" data-tab-link="dashboard-tab-4">
							<i class="icon icon-Streamline-75"></i>
							<span class="text"><?php esc_html_e('Edit profile', 'locales'); ?></span>
						</li>

						<li class="tab-link" data-tab-link="dashboard-tab-5">
							<i class="icon icon-Streamline-22"></i>
							<span class="text"><?php esc_html_e('Add your listing', 'locales'); ?></span>
						</li>
					</ul>
				</div>
			</div>

			<div class="tabs-body">
				<div class="container">
					<div class="tab-item current" id="dashboard-tab-1">
						<div class="user-info-box">
							<h1><?php esc_html_e('Hello', 'locales'); tt_print(' '.$current_user->display_name)?></h1>
							<p><?php esc_html_e('from your account dashboard you can view your listings &amp; your favourities edit your password &amp; account details', 'locales'); ?></p>

							<span class="logout-box"><?php esc_html_e('Not', 'locales'); tt_print(' '.$current_user->display_name.' ? ')?><a href="<?php echo wp_logout_url(esc_url( home_url('/') ) ); ?>"><?php esc_html_e('Sign out', 'locales') ?></a></span>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="dashboard-list-box">
									<div class="box-header"><?php esc_html_e('My listing', 'locales'); ?></div>

									<div class="box-body">
										<ol>
											<?php if($my_locals->have_posts()) : 
												while($my_locals->have_posts()) : $my_locals->the_post(); ?>
													<li>
														<p><?php the_title(); ?></p>
													</li>
												<?php endwhile;
											else: esc_html_e('You do not have any listings yet.', 'locales');
											endif; ?>
										</ol>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="dashboard-list-box">
									<div class="box-header"><?php esc_html_e('My favourites', 'locales'); ?></div>

									<div class="box-body">
										<ol>
											<?php if($my_favorite_locals->have_posts()) : 
												while($my_favorite_locals->have_posts()) : $my_favorite_locals->the_post(); ?>
													<li>
														<p><?php the_title(); ?></p>
													</li>
												<?php endwhile;
											else: esc_html_e('You do not have any favourite listings yet.', 'locales');
											endif; ?>
										</ol>
									</div>
								</div>
							</div>
						</div>

						<div class="align-center">
							<a href="#" class="btn btn-default color-2 add-listing-tab"><?php esc_html_e('Add your listing', 'locales'); ?></a>
						</div>
					</div>

					<div class="tab-item" id="dashboard-tab-2">
						<div class="profile-listing-table">
							<table class="listing-table">
								<thead>
									<tr>
										<th></th>
										<th><?php esc_html_e('Location title', 'locales'); ?></th>
										<th><?php esc_html_e('Date posted', 'locales'); ?></th>
										<th></th>
									</tr>
								</thead>

								<tbody>
									<?php if($my_locals->have_posts()) : 
										$i = 1;
										while($my_locals->have_posts()) : $my_locals->the_post(); ?>
											<tr class="listing_item_row">
												<td><?php tt_print($i); ?></td>
												<td>
													<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
												</td>
												<td><?php the_date(); ?></td>
												<td>
													<a href="<?php get_delete_post_link() ?>" class="delete-btn delete-listing-ajax" data-id="<?php the_ID() ?>" data-confirm_text="<?php tt_print($confirm_text) ?>" data-cancel_text="<?php tt_print($cancel_text) ?>" data-dialog_title="<?php tt_print($dialog_title) ?>" data-dialog_content="<?php tt_print($dialog_content) ?>">
														<span class="text"><?php esc_html_e('Delete', 'locales'); ?></span>
														<i class="icon icon-delete"></i>
													</a>
												</td>
											</tr>
										<?php $i++; endwhile; wp_reset_postdata();
									else: ?><tr>
											<td class="no_listings_to_show"><p><?php esc_html_e('You do not have any listings yet.', 'locales'); ?></p></td>
										</tr>
									<?php endif; ?>
								</tbody>
							</table>

							<div class="align-right">
								<a href="#" class="btn btn-default color-2 add-listing-tab"><?php esc_html_e('Add your listing', 'locales'); ?></a>
							</div>
						</div>
					</div>

					<div class="tab-item" id="dashboard-tab-3">
						<div class="profile-listing-table">
							<table class="listing-table favourites-list">
								<thead>
									<tr>
										<th></th>
										<th><?php esc_html_e('Location title', 'locales'); ?></th>
									</tr>
								</thead>

								<tbody>
									<?php if($my_favorite_locals->have_posts()) : 
										$i = 1;
										while($my_favorite_locals->have_posts()) : $my_favorite_locals->the_post(); ?>
											<tr class="favorite-listing_item_row">
												<td><?php tt_print($i); ?></td>
												<td>
													<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
												</td>
												<td></td>
												<td>
													<a href="#" class="delete-btn delete-favorite-listing-ajax" data-id="<?php the_ID() ?>">
														<span class="text"><?php esc_html_e('Delete', 'locales'); ?></span>
														<i class="icon icon-delete"></i>
													</a>
												</td>
											</tr>
										<?php $i++; endwhile; wp_reset_postdata();
									else:  ?><tr>
											<td class="no_listings_to_show"><p><?php esc_html_e('You do not have any favourite listings yet.', 'locales'); ?></p></td>
										</tr>
									<?php endif; ?>
								</tbody>
							</table>
						</div>
					</div>

					<div class="tab-item" id="dashboard-tab-4">
						<form class="dashboard-form edit-profile-form">
							<div class="main-details">
								<div class="row">
									<div class="col-sm-6">
										<div class="input-line">
											<input type="text" name="first-name" data-first="<?php tt_print($current_user->first_name); ?>" class="form-input check-value" placeholder="<?php esc_attr_e('First Name', 'locales') ?>" />
										</div>
									</div>
									<div class="col-sm-6">
										<div class="input-line">
											<input type="text" name="last-name" data-last="<?php tt_print($current_user->last_name); ?>" class="form-input check-value" placeholder="<?php esc_attr_e('Last Name', 'locales') ?>" />
										</div>
									</div>
									<div class="col-sm-6">
										<div class="input-line">
											<input type="text" name="email" data-mail="<?php tt_print($current_user->user_email); ?>" class="form-input check-value dashboard_email" placeholder="<?php esc_attr_e('E-mail', 'locales') ?>" />
										</div>
									</div>
									<div class="col-sm-6">
										<div class="input-line">
											<input type="text" name="user-phone"  data-phone="<?php tt_print($current_user->contactphone); ?>" class="form-input check-value" placeholder="<?php esc_attr_e('Phone', 'locales') ?>" />
										</div>
									</div>
								</div>
							</div>

							<div class="password-block">
								<h5 class="block-title"><?php esc_html_e('Password change', 'locales') ?></h5>

								<div class="password-inputs">
									<div class="row">
										<div class="col-md-6">
											<div class="input-line">
												<input type="password" name="password" class="form-input check-value dashboard_pass" placeholder="<?php esc_attr_e('New password', 'locales') ?>" />
											</div>
										</div>
										<div class="col-md-6">
											<div class="input-line">
												<input type="password" name="password-repeat" class="form-input check-value dashboard_pass_r" placeholder="<?php esc_attr_e('Confirm new password', 'locales') ?>" />
											</div>
										</div>
									</div> 
								</div>
							</div>
							<div class="align-center">
								<input type="submit" name="wp-submit" class="btn save-btn btn-default color-2 update-profile-form-ajax" value="<?php esc_attr_e('Save', 'locales') ?>"/>
							</div>
						</form>
					</div>

					<div class="tab-item" id="dashboard-tab-5">
						<form id="ajax-property-form" class="dashboard-form upload-property-form" enctype="multipart/form-data">
							<div class="user-details">
								<p class="details-text"><?php esc_html_e('You are currently signed in as', 'locales'); ?> <span class="username"><?php tt_print($current_user->user_email) ?></span></p>
								<a href="<?php echo wp_logout_url(esc_url( home_url('/') ) ); ?>" class="btn-sign-out"><?php esc_html_e('Sign out', 'locales') ?></a>
							</div>

							<!-- Main Info -->
							<div class="property-main-info">
								<div class="row">
									<div class="col-md-6">
										<div class="input-line">
											<input type="text" name="location-name" class="form-input check-value required-input" placeholder="<?php esc_attr_e('Listing name', 'locales') ?>" />
										</div>
									</div>

									<div class="col-md-6">
										<div class="select-box">
											<input type="text" name="location-category" class="select-box-input form-input check-value required-input" readonly placeholder="<?php esc_attr_e('Category', 'locales') ?>" />
											<ul class="clean-list select-box-options">
												<?php $location_cats = get_terms(array(
													'taxonomy' => 'location_tax',
													'hide_empty' => false,
												));  foreach($location_cats as $single_cat) : ?>
													<li class="option"><?php tt_print($single_cat->name); ?></li>
												<?php endforeach; ?>
											</ul>
										</div>
									</div>

									<div class="col-md-12">
										<div class="input-line">
											<textarea class="form-input check-value" name="Location[description]" placeholder="<?php esc_attr_e('Description', 'locales') ?>"></textarea>
										</div>
									</div>
								</div>

								<!-- Location Tags -->
								<div class="property-tags-block">
									<div class="tags-block-inner">
										<span class="block-title"><?php esc_html_e('Listing tags', 'locales') ?></span>

										<div class="add-tags-block">
											<div class="input-line">
												<input type="text" name="location-tags" class="form-input check-value" placeholder="<?php esc_attr_e('Add tag', 'locales') ?>" />
												<input type="hidden" name="tagList" class="tag-list-input">
											</div>
										</div>

										<p class="block-descrption"><?php esc_html_e('Visitors can filter their search by the amenities too, so make sure you include all the relevant ones.', 'locales') ?></p>
									</div>

									<div class="tags-list"></div>
								</div>

								<!-- Property Price Range -->
								<div class="property-price-range">
									<span class="title"><?php esc_html_e('Add a price range', 'locales') ?></span>

									<div class="amount">
										<i class="icon-usd"></i>
										<i class="icon-usd"></i>
										<i class="icon-usd"></i>
										<i class="icon-usd"></i>
										<i class="icon-usd"></i>
									</div>
									<input type="hidden" name="Location[location_category]" value="1" class="location_amount_range">
								</div>

								<!-- Location Facilities -->
								<div class="location-facilities-block">
									<h5 class="block-title"><?php esc_html_e('Location facilities', 'locales') ?><span class="add_facility"><?php esc_attr_e('+ Add facility', 'locales'); ?></span></h5>

									<ul class="clean-list facilities-list">
										
									</ul>
									<?php get_template_part('/templates/facility_icons'); ?>
								</div>

								<!-- Upload Images -->
								<div class="gallery-images-block">
									<h5 class="block-title">
										<span class="text"><?php esc_html_e('Gallery images', 'locales') ?></span>
										<span class="add-images-btn">
											<span class="placeholder"><?php esc_html_e('(+ Add photos)', 'locales') ?></span>
										</span>
									</h5>

									<div class="images-gallery">
										<label class="add-images-thumbnail">
											<i class="icon icon-Streamline-44"></i>
											<input type="file" name="images[]" id="images" multiple accept="image/*" />
										</label>
										<input type="hidden" name="featured-image" class="featured-image">
										<input type="hidden" class="removed-images" name="removed-images-input">

										<div class="row row-fit-10"></div>
									</div>
								</div>

								<!-- Location Block -->
								<div class="set-location-block">
									<div class="input-line">
										<h5 class="line-title"><?php esc_html_e('Location', 'locales') ?></h5>

										<input type="text" name="Location[map][location]" class="form-input check-value required-input" placeholder="<?php esc_attr_e('NY, Manhattan', 'locales') ?>" />
										<input type="hidden" name="Location[loc_hidden]" class="hidden_input_for_city"/>
									</div>

									<div class="map-container"></div>
									<input type="hidden" name="Location[map][lat]" class="location-map-lat" value="40.715126852017086">
									<input type="hidden" name="Location[map][long]" class="location-map-long" value="-74.00364875793457">
								</div>
							</div>

							<!-- Contact Info -->
							<div class="property-contact-info">
								<div class="row">
									<div class="col-md-3">
										<div class="input-line">
											<h5 class="line-title"><?php esc_html_e('Working hours', 'locales') ?></h5>

											<div class="working-hours">
												<input type="text" name="Location[working_hours][opening]" class="form-input check-value required-input" maxlength="5" placeholder="00:00"  />
												<span></span>
												<input type="text" name="Location[working_hours][closing]" class="form-input check-value required-input" maxlength="5" placeholder="00:00"  />
											</div>
										</div>
									</div>

									<div class="col-md-9">
										<div class="input-line">
											<h5 class="line-title"><?php esc_html_e('Phone', 'locales') ?></h5>
											<input type="text" name="Location[contacts][phone]" class="form-input check-value required-input" placeholder="(+373)" />
										</div>
										<div class="input-line">
											<h5 class="line-title"><?php esc_html_e('Email', 'locales') ?></h5>
											<input type="email" name="Location[contacts][email]" class="form-input check-value required-input" placeholder="<?php esc_attr_e('hi@teslathemes.com', 'locales') ?>" />
										</div>

										<div class="input-line">
											<h5 class="line-title"><?php esc_html_e('Twitter username', 'locales') ?></h5>
											<input type="text" name="Location[contacts][twitter_name]" class="form-input check-value" placeholder="<?php esc_attr_e('https://', 'locales') ?>" />
										</div>

										<div class="input-line">
											<h5 class="line-title"><?php esc_html_e('Facebook url', 'locales') ?></h5>
											<input type="text" name="Location[contacts][facebook_url]" class="form-input check-value" placeholder="<?php esc_attr_e('https://', 'locales') ?>" />
										</div>

										<div class="select-box add-social-platforms-select-box">
											<input type="text" class="select-box-input form-input check-value" readonly placeholder="<?php esc_attr_e('Other Platforms', 'locales') ?>" />
											<ul class="clean-list select-box-options">
												<li class="option" data-options='{"title": "Pinterest Url", "name": "Location[contacts][pinterest]" ,"placeholder": "<?php esc_attr_e('https://', 'locales') ?>"}'><?php esc_html_e('Pinterest', 'locales') ?></li>
												<li class="option" data-options='{"title": "Instagram Account","name": "Location[contacts][instagram]",  "placeholder": "<?php esc_attr_e('https://', 'locales') ?>"}'><?php esc_html_e('Instagram', 'locales') ?></li>
												<li class="option" data-options='{"title": "Google+ Url", "name": "Location[contacts][googleplus]", "placeholder": "<?php esc_attr_e('https://', 'locales') ?>"}'><?php esc_html_e('Google+', 'locales') ?></li>
												<li class="option" data-options='{"title": "Youtube Channel", "name": "Location[contacts][youtube]" ,"placeholder": "<?php esc_attr_e('https://', 'locales') ?>"}'><?php esc_html_e('Youtube', 'locales') ?></li>
											</ul>
										</div>

										<!-- Website -->
										<div class="input-line hide-input">
											<span class="btn-reveal-input">
												<i class="icon icon-link"></i>
												<span class="text"><?php esc_html_e('Add link on website', 'locales') ?></span>
											</span>

											<div class="form-input-wrapper">
												<input type="text" name="Location[website]" class="form-input check-value input-hidden" placeholder="<?php esc_attr_e('Website URL', 'locales') ?>" />
											</div>
										</div>
									</div>
								</div>
							</div>

							<!-- Save Data -->
							<div class="property-save-block align-right">
								<input type="submit" name="wp-submit" class="btn btn-save btn-default color-2 location-submit-btn" value="<?php esc_html_e('Save', 'locales'); ?>"/>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="overlay">
		<div class="progress">
			<div class="loader"></div>
		</div>
	</div>
<?php else : ?>
	<h1 class="align-center"><?php esc_html_e('Sorry,', 'locales'); ?></h1>
	<h1 class="align-center"><?php esc_html_e('You have to be logged in to view this page.', 'locales'); ?></h1>
<?php endif; ?>
</section>

<?php get_footer(); ?>