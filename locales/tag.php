<?php
    get_header();
    $page_id = get_option( 'page_for_posts' );
    $sidebar = get_post_meta($page_id, THEME_NAME . '_sidebar_position', true);
    $sidebar_status = is_active_sidebar('blog-sidebar' );

    if(empty($sidebar)) : $sidebar = 'right'; endif;
?>
<section class="section section-blog">
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
				<h2 class="pages-titles"><?php esc_html_e('Tag: ', 'locales'); single_tag_title(); ?></h5>
				<div class="blog-posts-list">
					<?php if(have_posts()) : while(have_posts()) : the_post(); 
						get_template_part('/templates/content'); 
					endwhile; 
					else : ?>
						<article class="blog-post">
							<h2><?php esc_html_e('Sorry, there are no posts to show.', 'locales'); ?></h2>
						</article>
					<?php endif;?>
				</div>
				<!-- Pagination -->
				<?php get_template_part( 'templates/pagination' ); ?>
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
<?php get_footer(); ?>