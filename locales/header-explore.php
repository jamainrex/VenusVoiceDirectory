<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>" />
		<meta name="description" content="<?php bloginfo('description'); ?>" />
		<meta name="author" content="<?php esc_attr_e('TeslaThemes','locales'); ?>"/>

		<!-- Mobile Specific Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
		<?php wp_head() ?>
	</head>
	<body id="page" <?php body_class();?>>
		<!-- Header -->
		<header class="main-header header-side-nav <?php if(_go('navigation_style') === 'Sticky') echo ' sticky'; ?>">
			<?php get_template_part('templates/searchform') ?>
			<!-- Header Inner -->
			<div class="header-inner">
				<div class="header-content">
					<?php get_template_part('templates/logo') ?>

					<!-- Select Box -->
					<div class="select-box trigger-overlay cat-select-ajax">
						<input type="text" readonly placeholder="<?php esc_attr_e('Choose type', 'locales'); ?>" class="select-box-input check-value" data-cat="<?php if(@$_GET['category']) tt_print($_GET['category']) ?>" />

						<ul class="clean-list select-box-options ">
							<li class="option"><?php esc_html_e('ALL', 'locales'); ?></li>
							<?php $location_cats = get_terms(array(
								'taxonomy' => 'location_tax',
								'hide_empty' => false,
							));  foreach($location_cats as $single_cat) : ?>
								<li class="option"><?php tt_print($single_cat->name); ?></li>
							<?php endforeach; ?>
						</ul>
					</div>
					<input type="hidden" name="search_location_title" class="search_location_title" value="<?php if(@$_GET['title']) tt_print($_GET['title']) ?>">
					<!-- Select Box -->
					<div class="select-box trigger-overlay city-select-ajax">
						<input type="text" readonly placeholder="<?php esc_attr_e('Location', 'locales'); ?>" class="select-box-input check-value" data-city="<?php if(@$_GET['city']) tt_print($_GET['city']) ?>" />

						<ul class="clean-list select-box-options">
							<li class="option"><?php esc_html_e('ALL', 'locales'); ?></li>
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

					<!-- Site Nav -->
					<nav class="main-nav">
						<?php wp_nav_menu( 
							array(
								'theme_location' => 'primary',
								'container' => false,
								'menu_class' => false
							)
						 ); ?>
					</nav>

					<?php if(!is_user_logged_in()) : ?>
							<!-- User Profile Block -->
							<div class="user-profile-block">
								<ul class="clean-list profile-actions">
									<li class="profile-action login"><i class="icon-lock3"></i><?php esc_html_e('Log in', 'locales') ?></li>
									<?php if(get_option('users_can_register')) : ?>
										<li class="profile-action register"><i class="icon-user3"></i><?php esc_html_e('Register', 'locales') ?></li>
									<?php endif; ?>
								</ul>

								<!-- Login Form -->
								<form class="header-profile-form login-form" id="loginform" name="loginform" action="<?php echo wp_login_url(); ?>" method="post">
									<span class="close-form-btn"></span>
									<h5 class="form-title"><?php esc_html_e('Login', 'locales') ?></h5>

									<div class="input-line">
										<input type="text" id="user_login" name="log" class="form-input check-value" placeholder="<?php esc_attr_e('Username', 'locales') ?>" />
										<i class="icon-user3"></i>
									</div>

									<div class="input-line">
										<input type="password" id="user_pass" name="pwd" class="form-input check-value" placeholder="<?php esc_attr_e('Password', 'locales') ?>" />
										<i class="icon-lock2"></i>
									</div>

									<input class="btn btn-default btn-submit color-3" type="submit" id="wp-submit" name="wp-submit" value="<?php esc_attr_e('Login', 'locales') ?>"/>
									<input type="hidden" name="redirect_to" value="<?php echo esc_url( home_url('/') ) ?>"/>
									<input type="hidden" name="testcookie" value="1"/>
									<p class="align-center">
										<a href="#" class="forgot-password"><?php esc_html_e('Forgot your your password?', 'locales') ?></a>
									</p>
								</form>
								<?php if(get_option('users_can_register')) : ?>
									<!-- Register Form -->
									<form id="register-form" class="header-profile-form register-form" method="post" action="register_profile_form">
										<span class="close-form-btn"></span>
										<h5 class="form-title"><?php esc_html_e('Register', 'locales') ?></h5>

										<div class="input-line">
											<input type="text" id="reg_first_name" name="reg_first_name" class="form-input check-value" placeholder="<?php esc_attr_e('First name', 'locales') ?>" />
											<i class="icon-user3"></i>
										</div>
										<div class="input-line">
											<input type="text" id="reg_last_name" name="reg_last_name" class="form-input check-value" placeholder="<?php esc_attr_e('Last name', 'locales') ?>" />
											<i class="icon-user3"></i>
										</div>

										<div class="input-line">
											<input type="email" id="reg_email" name="reg_email" class="form-input check-value" placeholder="<?php esc_attr_e('E-mail', 'locales') ?>" required />
											<i class="icon-global"></i>
										</div>

										<div class="input-line">
											<input type="text" id="reg_username" name="reg_username" class="form-input check-value" placeholder="<?php esc_attr_e('Username', 'locales') ?>" required />
											<i class="icon-user3"></i>
										</div>

										<div class="input-line">
											<input type="password" id="reg_password" name="reg_password" class="form-input check-value" placeholder="<?php esc_attr_e('Password', 'locales') ?>" required />
											<i class="icon-lock2"></i>
										</div>

										<div class="input-line">
											<input type="password" id="reg_passwordr" name="reg_passwordr" class="form-input check-value" placeholder="<?php esc_attr_e('Confirm Password', 'locales') ?>" required />
											<i class="icon-lock2"></i>
										</div>
										<?php wp_nonce_field('locales_new_user','locales_new_user_nonce', true, true ); ?>
										<input type="hidden" name="user_role" value="agent"/>
										<input type="submit" id="wp-submit" name="wp-submit" class="btn btn-default btn-submit color-3" value="<?php esc_html_e('Register', 'locales') ?>"/>
									</form>
								<?php endif; ?>

								<!-- Forgot Password Form -->
								<form class="header-profile-form forgot-password-form" id="lostpasswordform" name="lostpasswordform" action="<?php echo wp_lostpassword_url(); ?>" method="post">
									<span class="close-form-btn"></span>
									<h5 class="form-title"><?php esc_html_e('Forgot password?', 'locales') ?></h5>

									<div class="input-line">
										<input type="text" id="user_login" name="user_login" class="form-input check-value" placeholder="<?php esc_attr_e('Username or E-mail', 'locales') ?>" />
										<i class="icon-global"></i>
									</div>

									<input type="submit" id="wp-submit" name="wp-submit" class="btn btn-default btn-submit color-3" value="<?php esc_attr_e('Recover password', 'locales') ?>"/>
									<input type="hidden" name="redirect_to" value="">
								</form>
							</div>
						<?php else : 
							if(_go('dashboard_page_url')) : ?>
								<div class="user-profile-block">
									<ul class="clean-list profile-actions">
										<li class="profile-action">
											<a href="<?php _eo('dashboard_page_url') ?>"><i class="icon icon-Streamline-182"></i><?php esc_html_e('My Dashboard', 'locales'); ?></a>
										</li>
									</ul>
								</div>
							<?php endif;
						endif; ?>

					<!-- Search Form Toggle -->
					<span class="search-form-toggle">
						<i class="icon-search4"></i>
					</span>

					<!-- Sidenav Toggle -->
					<span class="side-menu-toggle">
						<i class="icon-menu2"></i>
					</span>

					<!-- Mobile Nav Toggle -->
					<span class="mobile-sideblock-toggle">
						<i class="icon-menu2"></i>
					</span>
				</div>
			</div>
		</header>

		<!-- Mobile Side Menu -->
		<div class="mobile-sidemenu-block">
			<!-- Close Sidemenu -->
			<span class="close-sidemenu">
				<i class="icon-cross2"></i>
			</span>

			<!-- Menu Inner -->
			<div class="sidemenu-inner">
				<!-- Search Form -->
				<form class="sidemenu-search-form" method="get" id="searchform" action="<?php echo esc_url( home_url('/') ) ?>">
					<div class="input-line">
						<input type="text" name="s" id="s" class="form-input check-value" placeholder="<?php esc_attr_e('Search', 'locales') ?>" />
						<button class="btn btn-submit">
							<i class="icon-search4"></i>
						</button>
					</div>
				</form>

				<!-- Main Nav -->
				<nav class="sidemenu-nav">
					<?php wp_nav_menu( 
						array(
							'theme_location' => 'primary',
							'container' => false,
							'menu_class' => false
						)
					 ); ?>
				</nav>
				<?php if(!is_user_logged_in()) : ?>
					<?php if(get_option('users_can_register')) : ?>
						<!-- Register Form -->
						<form class="sidemenu-form register-form" method="post" action="register_profile_form">
							<h5 class="form-title"><?php esc_html_e('Register', 'locales') ?></h5>

							<div class="input-line">
								<input type="text" id="reg_first_name" name="reg_first_name" class="form-input check-value" placeholder="<?php esc_attr_e('First name', 'locales') ?>" />
								<i class="icon-user3"></i>
							</div>
							<div class="input-line">
								<input type="text" id="reg_last_name" name="reg_last_name" class="form-input check-value" placeholder="<?php esc_attr_e('Last name', 'locales') ?>" />
								<i class="icon-user3"></i>
							</div>

							<div class="input-line">
								<input type="email" id="reg_email" name="reg_email" class="form-input check-value" placeholder="<?php esc_attr_e('E-mail', 'locales') ?>" />
								<i class="icon-global"></i>
							</div>

							<div class="input-line">
								<input type="text" id="reg_username" name="reg_username" class="form-input check-value" placeholder="<?php esc_attr_e('Username', 'locales') ?>" />
								<i class="icon-user3"></i>
							</div>

							<div class="input-line">
								<input type="password" id="reg_password" name="reg_password" class="form-input check-value" placeholder="<?php esc_attr_e('Password', 'locales') ?>" />
								<i class="icon-lock2"></i>
							</div>
							<div class="input-line">
								<input type="password" id="reg_passwordr" name="reg_passwordr" class="form-input check-value" placeholder="<?php esc_attr_e('Confirm Password', 'locales') ?>" />
								<i class="icon-lock2"></i>
							</div>
							<?php wp_nonce_field('locales_new_user','locales_new_user_nonce', true, true ); ?>
							<input type="hidden" name="user_role" value="agent"/>

							<input type="submit" id="wp-submit" name="wp-submit" class="btn btn-default btn-submit color-3" value="<?php esc_html_e('Register', 'locales') ?>"/>
							<p class="form-footer"><?php esc_html_e('Already have an account? ', 'locales') ?><a href="#" class="bring-login-form"><?php esc_html_e('Sign in', 'locales') ?></a></p>
						</form>
					<?php endif; ?>
					<!-- Login Form -->
					<form class="sidemenu-form login-form" id="loginform" name="loginform" action="<?php echo wp_login_url(); ?>" method="post">
						<h5 class="form-title"><?php esc_html_e('Login', 'locales') ?></h5>

						<div class="input-line">
							<input type="text" id="user_login" name="log" class="form-input check-value" placeholder="<?php esc_attr_e('Username', 'locales') ?>" />
							<i class="icon-user3"></i>
						</div>

						<div class="input-line">
							<input type="password" id="user_pass" name="pwd" class="form-input check-value" placeholder="<?php esc_attr_e('Password', 'locales') ?>" />
							<i class="icon-lock2"></i>
						</div>

						<input type="submit" name="wp-submit" id="wp-submit" class="btn btn-default btn-submit color-3" value="<?php esc_html_e('Login', 'locales') ?>"/>
						<input type="hidden" name="redirect_to" value="<?php echo esc_url( home_url('/') ) ?>"/>
						<input type="hidden" name="testcookie" value="1"/>
						<p>
							<a href="#" class="bring-forgot-password-form"><?php esc_html_e('Forgot your your password?', 'locales') ?></a> / <a href="#" class="bring-sign-up-form"><?php esc_html_e('Register', 'locales') ?></a>
						</p>
					</form>

					<!-- Forgot Password Form -->
					<form class="sidemenu-form forgot-password-form" id="lostpasswordform" name="lostpasswordform" action="<?php echo wp_lostpassword_url(); ?>" method="post">
						<h5 class="form-title"><?php esc_html_e('Forgot your your password?', 'locales') ?></h5>

						<div class="input-line">
							<input type="text" class="form-input check-value" name="user_login" id="user_login"  placeholder="<?php esc_attr_e('Username or E-mail', 'locales') ?>" />
							<i class="icon-global"></i>
						</div>

						<input type="submit" name="wp-submit" id="wp-submit" class="btn btn-default btn-submit color-3" value="<?php esc_attr_e('Recover password', 'locales') ?>" />
						<input type="hidden" name="redirect_to" value="">
						<p class="form-footer"><a href="#" class="bring-login-form"><?php esc_html_e('Sign in', 'locales') ?></a></p>
					</form>
				<?php else : 
					if(_go('dashboard_page_url')) : ?>
						<div class="user-profile-block">
							<ul class="clean-list profile-actions">
								<li class="profile-action">
									<a href="<?php _eo('dashboard_page_url') ?>"><i class="icon icon-Streamline-182"></i><?php esc_html_e('My Dashboard', 'locales'); ?></a>
								</li>
							</ul>
						</div>
					<?php endif;
				endif; ?>
			</div>
		</div>
		
		<!-- Main Content Box -->
		<div class="content-box">