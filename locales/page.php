<?php
get_header();
$page_id = tt_get_page_id();
$sidebar = get_post_meta($page_id, THEME_NAME . '_sidebar_position', true);
$share = get_post_meta($page_id, THEME_NAME . '_share_on_off', true);
$sidebar_status = is_active_sidebar('blog-sidebar' );
if(empty($sidebar)) $sidebar = 'right';

if(have_posts()) : while(have_posts()) : the_post(); 
	if(!has_shortcode(get_post_field( 'post_content', $page_id),'vc_row') || ($sidebar!= 'full_width' && has_shortcode(get_post_field( 'post_content', $page_id),'vc_row'))): ?>
		<section id="post-<?php the_ID(); ?>" <?php post_class('section section-blog'); ?>>
			<div class="container">
				 <?php if('full_width' !== $sidebar && $sidebar_status): ?>
					<div class="row">
				<?php endif; 
					if($sidebar === 'left' && $sidebar_status) : ?>
						<div class="col-md-5">
							<aside class="main-sidebar left">
								<?php get_sidebar(); ?>
							</aside>
						</div>
					<?php endif; ?>
					<div class="col-md-<?php if( $sidebar !== 'full_width' && $sidebar_status ) print '7'; else print '12'; ?>">
						<div class="blog-posts-list">
								<article class="blog-post single-blog-post">
									<h2 class="post-title"><?php the_title(); ?></h2>
									<?php if(has_post_thumbnail()) : ?>
										<div class="post-cover">
											<?php the_post_thumbnail('tt_post_thumbnail'); ?>
										</div>
									<?php endif; ?>
									<div class="post-body">
	<?php endif ;
										the_content(); 
	if(!has_shortcode(get_post_field( 'post_content', $page_id),'vc_row') || ($sidebar!= 'full_width' && has_shortcode(get_post_field( 'post_content', $page_id),'vc_row'))): 
										
										if($share === 'enable_post_share') :
											tt_share(); 
										endif; ?>
									</div>
								</article>

								<?php comments_template(); ?>
						</div>
					</div>
					<?php if($sidebar === 'right' && $sidebar_status) : ?>
						<div class="col-md-5">
							<aside class="main-sidebar">
								<?php get_sidebar(); ?>
							</aside>
						</div>
					<?php endif; ?>
				<?php if('full_width' !== $sidebar && $sidebar_status): ?>
					</div>
				<?php endif; ?>
			</div>
		</section>
	<?php endif;
endwhile; endif; 
get_footer(); ?>