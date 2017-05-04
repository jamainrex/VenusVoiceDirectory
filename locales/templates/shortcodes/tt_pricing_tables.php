<?php 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$css_class = !empty($css) ? vc_shortcode_custom_css_class( $css ) : '';
$features_items = (array) vc_param_group_parse_atts( $features_items );
$button_text = $button_text ? $button_text : 'Buy Now';
$title = $title ? $title : 'Box Title';
$price = $price ? $price : '0';
$item_url = $item_url ? $item_url : '#';
$currency = $currency ? $currency : '$';
?>


<div class="pricing-table">
	<div class="table-header">
		<h4 class="title"><?php tt_print($title) ?></h4>
		<span class="pricing"><sup><?php tt_print($currency) ?></sup><?php tt_print($price) ?></span>
	</div>

	<div class="table-body">
		<ul class="clean-list table-features">
			<?php foreach($features_items as $features_item): ?>
				<li><?php tt_print($features_item['item_feature']); ?></li>
			<?php endforeach; ?>
		</ul>
	</div>

	<div class="table-footer">
		<a href="<?php tt_print($item_url) ?>" class="btn btn-default color-2"><?php tt_print($button_text) ?></a>
	</div>
</div>