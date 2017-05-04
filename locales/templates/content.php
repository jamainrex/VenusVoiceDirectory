<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post'); ?>>
	<ul class="clean-list post-meta">
		<li><?php esc_attr_e('Author: ', 'locales'); the_author_link(); ?></li>
		<li><?php the_time(get_option('date_format')); ?></li>
	</ul>

	<h2 class="post-title">
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</h2>
	<?php  if(has_post_thumbnail()) : ?>
		<div class="post-cover">
			<div class="image">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( 'tt_post_thumbnail' ); ?>
				</a>
			</div>
		</div>
	<?php endif; ?>
	<div class="post-body">
		<p class="post-excerpt"><?php echo get_the_excerpt(); ?></p>
		<div class="align-right">
			<a href="<?php the_permalink(); ?>" class="btn btn-text"><?php esc_html_e('Read more', 'locales'); ?></a>
		</div>
	</div>
</article>