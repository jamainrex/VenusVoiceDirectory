<!-- Search Form -->
<form class="main-search-form" method="get" id="searchform" action="<?php echo esc_url( home_url('/') ) ?>">
	<div class="container">
		<div class="input-line">
			<input type="text" name="s" id="s" class="form-input check-value" placeholder="<?php esc_attr_e('Search', 'locales') ?>" />
			<span class="clear-input"></span>
		</div>
	</div>
</form>