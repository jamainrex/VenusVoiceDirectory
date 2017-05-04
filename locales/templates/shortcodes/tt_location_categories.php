<?php 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
vc_icon_element_fonts_enqueue( $type );
$icon = ${"icon_" . $type}; 
$class = !empty($css) ? vc_shortcode_custom_css_class( $css ) : '';
$category = get_term_by('name', $location_category, 'location_tax'); 
$count = $category->count; 
$background = $bg_img ? wp_get_attachment_image_src($bg_img, 'original') : '';
$concatinator =  strpos(_go('explore_page_url'), '?') !== false ? '&' : '?';
$places = $count == 1 ? esc_html__('place', 'locales') : esc_html__('places', 'locales');  
?>

<?php if($service_type == 'type_3') : ?>
	<div class="service-block">
		<a href="<?php echo $custom_link ? $custom_link : tt_print(_go('explore_page_url').$concatinator."category=".$location_category) ?>" class="service-block-inner">
			<div class="service-block-info" <?php print $color_bg_info ? 'style="background: '.$color_bg_info.'"' : '';?>>
				<div class="block-info-inner">
					<span class="title" <?php print $color_text ? 'style="color: '.$color_text.'"' : '';?>><?php tt_print($location_category); ?></span>
					<i class="icon <?php tt_print($icon); ?>" <?php print $color_icon ? 'style="color: '.$color_icon.'"' : '';?>></i>

					<span class="nr-of-places"><?php tt_print($count." ".$places) ?></span>
				</div>
			</div>
			<img src="<?php tt_print($background[0]); ?>" alt="service block image" class="service-block-background"/>
		</a>
	</div>
<?php elseif($service_type == 'type_2') : ?>
	<div class="service-block wide">
		<a href="<?php echo $custom_link ? $custom_link : tt_print(_go('explore_page_url').$concatinator."category=".$location_category) ?>" class="service-block-inner">
			<div class="service-block-info" <?php print $color_bg_info ? 'style="background: '.$color_bg_info.'"' : '';?>>
				<div class="block-info-inner">
					<span class="title" <?php print $color_text ? 'style="color: '.$color_text.'"' : '';?>><?php tt_print($location_category); ?></span>
					<i class="icon <?php tt_print($icon); ?>" <?php print $color_icon ? 'style="color: '.$color_icon.'"' : '';?>></i>

					<span class="nr-of-places"><?php tt_print($count." ".$places) ?></span>
				</div>
			</div>
			<img src="<?php tt_print($background[0]); ?>" alt="service block image" class="service-block-background" />
		</a>
	</div>
<?php elseif($service_type == 'type_1') : ?>
	<div class="service-block small">
		<a href="<?php echo $custom_link ? $custom_link : tt_print(_go('explore_page_url').$concatinator."category=".$location_category) ?>" class="service-block-inner">
			<div class="service-block-info" <?php print $color_bg_info ? 'style="background: '.$color_bg_info.'"' : '';?>>
				<div class="block-info-inner">
					<span class="title" <?php print $color_text ? 'style="color: '.$color_text.'"' : '';?>><?php tt_print($location_category); ?></span>
					<i class="icon <?php tt_print($icon); ?>" <?php print $color_icon ? 'style="color: '.$color_icon.'"' : '';?>></i>

					<span class="nr-of-places"><?php tt_print($count." ".$places) ?></span>
				</div>
			</div>
			<img src="<?php tt_print($background[0]); ?>" alt="service block image" class="service-block-background" />
		</a>
	</div>
<?php endif; ?>