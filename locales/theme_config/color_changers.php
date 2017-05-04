<?php
/***********************************************************************************************/
/* Custom CSS */
/***********************************************************************************************/

add_action('wp_enqueue_scripts', 'tt_tesla_custom_css', 99);
function tt_tesla_custom_css() {
	wp_enqueue_script('comment-reply');
	$custom_css = _go('custom_css') ? _go('custom_css') : '';
	wp_add_inline_style('tt-main-style', $custom_css);
}

add_action('wp_enqueue_scripts', 'tt_style_changers',99);
function tt_style_changers(){
	$background_color = _go('bg_color') ;
	$background_image = _go('bg_image') ;
	if($background_image || $background_color)
		wp_add_inline_style('tt-main-style', "body{background-color: $background_color; background-image: url('$background_image')}");

	$colopickers_css = '';
	if (_go('site_color')):
        $lighter_color = adjustBrightness(_go('site_color'), 80);
        $lighter_color_2 = adjustBrightness(_go('site_color'), 150);
		$colopickers_css .= '  .header-search-form i:hover, footer ul li a:hover, a:hover, .single-share-block .social-platforms li a i, .widget.tesla-twitter-widget .tt_twitter .twitter li a, .single-blog-post .comments-list .comment .comment-reply-link:hover, .widget.widget_search .search-form .form-submit i, .subscribe-form .submit, .team-member.big .bottom-box p:before, .text-gradient, .testimonial .name, .text-gradient, form .input-line .placeholder span, form .input-line.has-value .label, form .input-line.has-value .label:before, .progress-item .progress-bar, .pagination .page-numbers li a, .single-share-block .share-btn:before, .widget.widget_categories ul li	{
			color: '._go('site_color').' !important;
		}
				
		header .main-nav > ul > li a:before, .widget .widget-title:after, .tag-list a:hover, .respond-form .form-submit input, form .input-line .line-border, form .input-line .line-border, .subscribe-box .icon, .btn, .btn.gradient:before, .team-member.big .bottom-box p:before, .slick-dots li button:before, .testimonials-carousel:before, .section-title.grad h2:before, .feature-item .f-icon, .text-gradient, .news-item, .pricing-table.gradient:before, .contact-section.form > span, .contact-section.form:before, .service-item .s-icon, .progress-item .progress-bar, .circle-btn.more, .pagination .page-numbers li .current, .pagination .page-numbers li a:hover{
			background : '._go('site_color').' !important;
		}

		.pagination .page-numbers li a:hover{
			color: #fff !important;
		}
		.subscribe-form .submit, .single-share-block .share-btn:before, .single-share-block .social-platforms li a i{
			-webkit-text-fill-color: initial !important;
		}


		.feature-item .f-icon{
			border: 10px solid '.$lighter_color_2.' !important;
		}

		';
	endif;

	if (_go('site_color_2')) :
		$colopickers_css .= '

		footer, header.sticky.fixed, hero-section single, header.fixed .main-nav ul li ul {
			background: ' . _go('site_color_2') . ';
		}

		';
	endif;

	wp_add_inline_style('tt-main-style', $colopickers_css);

	//Custom Fonts Changers
	wp_add_inline_style('tt-main-style', tt_text_css('main_content_text','h1, h2','px'));
	wp_add_inline_style('tt-main-style', tt_text_css('sidebar_text','h3, h4','px'));
	wp_add_inline_style('tt-main-style', tt_text_css('menu_text','h5, h6, footer, single-blog-post','px'));
}