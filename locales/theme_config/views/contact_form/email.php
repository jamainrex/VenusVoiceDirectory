<div class="input-line <?php if(!empty($required)) echo 'required'; ?>">
	<span class="label"><?php echo esc_attr($label); ?></span>
	<input data-parsley-errors-container="#error-container" data-parsley-error-message="An E-mail is required" data-parsley-type="email" class="check-value" type="email" name="<?php echo esc_attr($name)?>" <?php if(!empty($required)) echo 'data-parsley-required="true"'; ?>>
	<span class="placeholder"><?php echo esc_attr($placeholder); ?><span><?php esc_html_e('*', 'locales'); ?></span></span>
	<span class="line-border"></span>
</div>