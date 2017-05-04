<?php get_header(); ?>
<section class="section section-blog">
	<div class="container">
		<div class="row">
			<div class="col-md-7">
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
			<div class="col-md-5">
				<aside class="main-sidebar">
					<?php get_sidebar(); ?>
				</aside>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>