<?php get_header(); ?>
<main class="main-page">
	<div class="container">
		<?php if (have_posts()) : ?>
			<?php the_archive_title('<h1 class="fw-bold text-center h3 mb-50">', '</h1>'); ?>
			<div class="row">
				<?php
				while (have_posts()) : the_post();
					if (has_post_thumbnail()) {
						// Get the featured image URL
						$featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
					}
				?>
					<div class="col-md-4">
						<?php get_template_part("cards/post-card"); ?>
					</div>
				<?php
				endwhile;

				wp_reset_postdata();
				?>
			</div>
			<?php custom_pagination($wp_query); ?>
		<?php else : ?>
			<?php get_template_part('template-parts/content', 'none'); ?>
		<?php endif; ?>
	</div>
</main><!-- #main -->
<?php get_footer(); ?>