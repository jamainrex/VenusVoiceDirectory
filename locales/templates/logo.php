<h1 class="hidden"><?php bloginfo('name'); ?></h1>
<h2 class="hidden"><?php bloginfo('description'); ?></h2>
 <!-- Site Identity -->
<a href="<?php echo esc_url( home_url('/') ) ?>" class="site-identity" style="<?php _estyle_changer('logo_text') ?>">
	<?php if(_go('logo_text')): ?>
		<?php _eo('logo_text') ?>
	<?php elseif(_go('home_logo_image')): ?>
		<img src="<?php _eo('home_logo_image') ?>" alt="<?php echo THEME_PRETTY_NAME ?> logo">
	<?php endif; ?>
</a>