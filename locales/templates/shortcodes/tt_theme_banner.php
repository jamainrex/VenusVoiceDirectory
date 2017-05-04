<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$class = !empty($css) ? vc_shortcode_custom_css_class( $css ) : '';

$background = $bg_img ? wp_get_attachment_image_src($bg_img, 'original') : '';
$button_text = $button_text ? $button_text : 'Pay Now';
?>
<!-- Theme Banner -->
<div class="theme-banner">
	<?php if(!$bg_img) : ?>
		<h3><?php esc_html_e('No Background image selected. Please select one.', 'locales') ?></h3>
	<?php else : ?>
		<div class="banner-image">
			<img src="<?php tt_print($background[0]) ?>" alt="banner image" />
		</div>	
	<?php endif ?>
	<div class="banner-content">
		<div class="container">
			<h3 class="banner-text"><?php tt_print($banner_text) ?></h3>
			<?php if(!$hide_button) : ?>
				<a href="<?php tt_print($button_link) ?>" class="btn btn-default"><?php tt_print($button_text) ?></a>
			<?php endif; ?>
		</div>
	</div>
</div>