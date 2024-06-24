<?php get_header(); ?>
<main class="main-page">
	<section class="last-blog">
		<div class="container">

			<?php
			$args = array(
				'post_type' => 'post',
				'posts_per_page' => 1,
				'orderby' => 'date',
				'order' => 'DESC',
			);

			// The Query
			$query = new WP_Query($args);

			// The Loop
			if ($query->have_posts()) {
				while ($query->have_posts()) {
					$query->the_post();
					if (has_post_thumbnail()) {
						// Get the featured image URL
						$featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
					}
			?>
					<div class="last-post d-flex justify-content-center flex-column " style="background-image: url(<?= $featured_img_url ?>);">
						<div class="overlay"></div>
						<div class="col-md-7">
							<span class="lead mb-3 d-block"><?php echo get_the_date('F j, Y'); ?></span>
							<h2 class="h1 fw-bold"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
						</div>
					</div>
			<?php
				}
			}

			// Restore original post data
			wp_reset_postdata();
			?>
		</div>
	</section>
	<section class="latest-news">
		<div class="container">
			<h2 class="text-center h3 fw-bold">Latest News</h2>
			<div class="row">
				<?php
				$args = array(
					'post_type' => 'post',
					'offset' => 1,
					'posts_per_page' => 3,
					'orderby' => 'date',
					'order' => 'DESC',
				);

				// The Query
				$query = new WP_Query($args);

				// The Loop
				if ($query->have_posts()) {
					while ($query->have_posts()) {
						$query->the_post();
						if (has_post_thumbnail()) {
							// Get the featured image URL
							$featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
						}
				?>
						<div class="col-md-4">
							<?php get_template_part("cards/post-card"); ?>
						</div>
				<?php
					}
				}

				// Restore original post data
				wp_reset_postdata();
				?>
			</div>
		</div>
	</section>
	<div class="container">
		<?php
		if (have_posts()) :
			while (have_posts()) :
				the_post(); ?>
				<?php the_content(); ?>
		<?php
			endwhile;
		endif; ?>
	</div>
</main>
<?php get_footer(); ?>