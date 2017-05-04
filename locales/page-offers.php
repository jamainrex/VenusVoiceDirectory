<?php
/*
	Template Name: Offers Template
*/
get_header(); 
global $offers_per_page;
$offers_per_page = _go('offers_per_page') ? _go('offers_per_page') : 2;
$posts_load_per_click = _go('offers_to_load') ? _go('offers_to_load') : 3;

$tt_query = new WP_Query( array( 'post_type' => 'offers', 'posts_per_page' => $offers_per_page ) );
$i = 0;
?>
<section id="post-<?php the_ID(); ?>" class="section section-offers">
	<h2 class="section-title">
		<div class="container"><?php the_title() ?></div>
	</h2>
	<div class="container ajax-target">
		<?php if( $tt_query->have_posts()) : while( $tt_query->have_posts() ) : $tt_query->the_post(); 
			
			$options = get_post_meta(get_the_ID(), 'slide_options', true); 
			if($i % 2 == 0) : ?>
				<div class="special-offer-block">
					<div class="row row-fit">
						<div class="col-md-8 block-cover">
							<div class="image">
								<a href="<?php tt_print($options['special_offer']['link']); ?>">
									<?php the_post_thumbnail( 'tt_offers' ); ?>
								</a>
							</div>
						</div>

						<div class="col-md-5 block-body">
							<h5 class="block-title"><?php tt_print($options['special_offer']['offer_title']); ?></h5>
							<h3 class="block-discount"><?php tt_print($options['special_offer']['discount']); ?></h3>
							<p class="block-description"><?php tt_print($options['special_offer']['description']); ?></p>
						</div>
					</div>
				</div>
			<?php else: ?>
				<div class="special-offer-block">
					<div class="row row-fit">
						<div class="col-md-5 block-body">
							<h5 class="block-title"><?php tt_print($options['special_offer']['offer_title']); ?></h5>
							<h3 class="block-discount"><?php tt_print($options['special_offer']['discount']); ?></h3>
							<p class="block-description"><?php tt_print($options['special_offer']['description']); ?></p>
						</div>

						<div class="col-md-8 block-cover">
							<div class="image">
								<a href="<?php tt_print($options['special_offer']['link']); ?>">
									<?php the_post_thumbnail( 'tt_offers' ); ?>
								</a>
							</div>
						</div>
					</div>
				</div>
			<?php endif;  $i++;
		endwhile; endif; wp_reset_postdata(); ?>
	</div>
	<div class="align-center">
			<a href="#" class="btn btn-show-more <?php if($tt_query->found_posts <= $offers_per_page) print 'hidden';?>" 
			data-offset="<?php echo esc_attr($offers_per_page);?>" 
			data-count="<?php echo esc_attr($tt_query->found_posts);?>"
			data-perload="<?php echo esc_attr($posts_load_per_click);?>">
				<i class="fa fa-chevron-down"></i><?php esc_html_e('See more', 'locales'); ?>
			</a>
		</div>
</section>
<?php get_footer(); ?>