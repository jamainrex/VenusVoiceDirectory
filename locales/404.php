<?php get_header(); ?>
	<section class="section section-404-error">
		<div class="container">
			<div class="error-block">
				<h3 class="block-title"><?php esc_html_e('Error 404', 'locales'); ?></h3>
				<p class="block-message"><?php _go('404_title') ? _eo('404_title') : esc_html_e('the page was not found', 'locales'); ?></p>
				<img src="<?php if(_go('404_bg_image')) : _eo('404_bg_image'); else : echo get_template_directory_uri() . '/assets/404-image.png'; endif;?>" alt="404 image" />
				<a href="<?php echo esc_url( home_url('/') ) ?>" class="btn btn-default color-3"><?php _go('404_button_text') ? _eo('404_button_text') : esc_html_e('Back home','locales'); ?></a>
			</div>
		</div>
	</section>
<?php get_footer(); ?>