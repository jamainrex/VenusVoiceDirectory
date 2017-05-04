<?php
    get_header();
    $page_id = tt_get_page_id();
    $news_id = get_option( 'page_for_posts' );
    $sidebar_option = get_post_meta( $page_id, THEME_NAME . '_sidebar_position', true );
    $share = get_post_meta($page_id, THEME_NAME . '_share_on_off', true);
    $sidebar_status = is_active_sidebar('blog-sidebar' );

    switch ($sidebar_option) {
        case 'as_blog':
            $s_id = $news_id;   
            break;
        case 'full_width':
            $s_id = $page_id;
            break;
        case 'right':
            $s_id = $page_id;
            break;
        case 'left':
            $s_id = $page_id;
    }
    if(!empty($s_id)) $sidebar = get_post_meta( $s_id, THEME_NAME . '_sidebar_position', true );
    if(empty($sidebar)) $sidebar = 'right';
?>

<section <?php post_class('section section-blog'); ?>>
	<div class="container">
		<div class="row">
			<?php if($sidebar === 'left' && $sidebar_status) : ?>
				<div class="col-md-5">
					<aside class="main-sidebar left">
						<?php get_sidebar(); ?>
					</aside>
				</div>
			<?php endif; ?>

			<div class="col-md-<?php if( $sidebar !== 'full_width' && $sidebar_status ) print '7'; else print '12'; ?>">
				<div class="blog-posts-list">
					<?php if(have_posts()) : while(have_posts()) : the_post(); tt_setPostViews(get_the_ID()); ?>
						<article class="blog-post single-blog-post">
							<ul class="clean-list post-meta">
								<li><?php esc_attr_e('Author: ', 'locales'); the_author_link(); ?></li>
								<li><?php the_time(get_option('date_format')); ?></li>
							</ul>

							<h2 class="post-title"><?php the_title(); ?></h2>
							<?php if(has_post_thumbnail()) : ?>
								<div class="post-cover">
									<?php the_post_thumbnail('tt_post_thumbnail'); ?>
								</div>
							<?php endif; ?>
							<div class="post-body">
								<?php the_content(); 

	                            $defaults = array(
	                                'before'           => '<p class="post-content-pag">',
	                                'after'            => '</p>',
	                                'link_before'      => '',
	                                'link_after'       => '',
	                                'next_or_number'   => 'next',
	                                'separator'        => '&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;',
	                                'nextpagelink'     => esc_attr_x( 'Next page','single','locales'),
	                                'previouspagelink' =>esc_attr_x( 'Previous page ','single','locales' ),
	                                'pagelink'         => '%',
	                                'echo'             => 1
	                            );

	                            wp_link_pages( $defaults ); ?>

	                            <div class="post-meta-information">
	                            	<div class="meta-item cats">
		                            	<h5 class="meta-item-title"><?php esc_html_e('Categories', 'locales'); ?></h5>
		                            	<?php the_category(" "); ?>
		                            </div>
		                            <div class="meta-item tags">
		                            	<h5 class="meta-item-title"><?php esc_html_e('Tags', 'locales'); ?></h5>
		                            	<?php the_tags("", " ", "" ); ?>
		                            </div>
	                            </div>

								<?php if($share === 'enable_post_share') :
									tt_share(); 
								endif; ?>

							</div>
						</article>
						<?php comments_template();
					endwhile; endif;?>
				</div>
			</div>

			<?php if($sidebar === 'right' && $sidebar_status) : ?>
				<div class="col-md-5">
					<aside class="main-sidebar">
						<?php get_sidebar(); ?>
					</aside>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
<?php get_footer(); ?>