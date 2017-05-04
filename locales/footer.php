			<!-- Page Overlay -->
			<span class="page-overlay"></span>
		</div>
		<!-- Footer -->
		<footer class="main-footer">
			<div class="container">
				<!-- Footer Nav -->
				<nav class="menu-links">
					<?php wp_nav_menu( 
						array(
							'theme_location' => 'footer',
							'container' => false,
							'menu_class' => false
						)
					 ); ?>
				</nav>

				<!-- Subscribe Form -->
				<?php if(!_go('hide_subscribe')) : ?>
					<form class="newsletter-subscribe-form" id="newsletter" method="post" data-tt-subscription>
						<h4 class="form-title"><?php if(_go('subscribe_text')) : _eo('subscribe_text'); else : esc_attr_e('Newsletter subscribe','locales'); endif; ?></h4>

						<div class="input-line">
							<input type="email" name="email" class="form-input check-value" data-tt-subscription-required data-tt-subscription-type="email" placeholder="<?php esc_attr_e('Enter your email address','locales');?>">
							<button type="submit" class="form-submit">
								<i class="icon-Streamline-58"></i>
							</button>
						</div>
						<div class="result_container"></div>
					</form> 
				<?php endif; ?>

				<!-- Footer Socials -->
				<div class="social-block">
					<ul class="clean-list social-list">
						<?php 
							$social_platforms = array(
								'facebook',
								'twitter',
								'dribbble',
								'youtube',
								'rss',
								'google',
								'linkedin',
								'pinterest',
								'instagram'
							);

							foreach($social_platforms as $platform): 
								if (_go('social_platforms_' . $platform)): ?>
									<li>
										<a href="<?php echo esc_url(_go('social_platforms_' . $platform)); ?>" target="_blank">
											<i class="icon-<?php print esc_attr($platform); ?>"></i>
										</a>
									</li>
								<?php endif;
							endforeach; 
						?>
					</ul>
				</div>

				<!-- Copyrights -->
				<?php if(!_go('hide_copyright')) : ?>
					<?php if(_go('copyright_text')) : ?>
						<p class="copyright-message"><?php _eo('copyright_text') ?></p>
					<?php else: ?>
						<p class="copyright-message"><?php esc_attr_e('Copyright ','locales'); echo date('Y').' ';?><a href="<?php echo esc_url('https://www.teslathemes.com/'); ?>" target="_blank"><?php esc_attr_e('TeslaThemes','locales'); ?></a>, <?php esc_attr_e('Supported by ', 'locales');?><a href="<?php echo esc_url('https://wpmatic.io/'); ?>" target="_blank"><?php esc_attr_e('WPmatic','locales');?></a></p>
					<?php endif; ?>
				<?php endif; ?>
			</div>
		</footer>
		<?php wp_footer(); ?>
	</body>
</html>