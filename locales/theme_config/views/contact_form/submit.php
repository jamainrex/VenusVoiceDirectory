<div class="input-line submit">
	<span class="label"><?php esc_attr($placeholder); ?></span>
	<input class="btn gradient big submit" type="submit" value="<?php print isset($label) && $label !== '' ? $label : esc_attr__('Send message','locales') ?>"
	data-sending="<?php esc_attr_e('Sending Message','locales') ?>"
	data-sent="<?php esc_attr_e('Message Successfully Sent','locales') ?>"
    data-error="<?php esc_attr_e('Unable to send message','locales') ?>">
</div>