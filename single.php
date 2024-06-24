<?php get_header(); ?>
<main class="main-page single-post">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<?php
				if (have_posts()) :
					while (have_posts()) :
						the_post(); ?>
						<?php $reading_time = calculate_reading_time(get_the_ID()); ?>
						<span class="lead fw-light  d-block"><?php echo get_the_date('F j, Y'); ?> <span class="rdtime"><?= $reading_time ?></span></span>
						<h1 class="fw-semibold h2"><?php the_title(); ?></h1>
						<?php if (has_post_thumbnail()) : ?>
							<div class="single-img">
								<?php the_post_thumbnail(); ?>
							</div>
						<?php endif; ?>
						<p><?php the_content(); ?></p>
						<div class="entry-pagination">
							<?php
							$prev_post = get_previous_post();
							if (!empty($prev_post)) :
							?>
								<div class="nav-previous">
									<a href="<?php echo get_permalink($prev_post->ID); ?>" rel="prev">
										<p class="colored"><?php echo esc_html__('PREVIOUS ARTICLE', 'tumo'); ?></p>
										<p><svg xmlns="http://www.w3.org/2000/svg" width="17" height="27" viewBox="0 0 17 27" fill="none">
												<path d="M0.578837 12.0661L11.7648 0.594658C12.538 -0.198219 13.7881 -0.198219 14.5531 0.594658L16.4119 2.50094C17.1851 3.29381 17.1851 4.57591 16.4119 5.36036L8.49126 13.5L16.4201 21.6312C17.1933 22.4241 17.1933 23.7062 16.4201 24.4906L14.5613 26.4053C13.7881 27.1982 12.538 27.1982 11.773 26.4053L0.587062 14.9339C-0.194311 14.1411 -0.194311 12.859 0.578837 12.0661Z" fill="#4CE0D7" />
											</svg><?php echo  esc_html($prev_post->post_title); ?></p>
									</a>
								</div>
							<?php
							endif;

							$next_post = get_next_post();
							if (!empty($next_post)) :
							?>
								<div class="nav-next">
									<a href="<?php echo get_permalink($next_post->ID); ?>" rel="next">
										<p class="colored"><?php echo esc_html__('NEXT ARTICLE', 'tumo'); ?></p>
										<p><?php echo esc_html($next_post->post_title); ?><svg xmlns="http://www.w3.org/2000/svg" width="17" height="28" viewBox="0 0 17 28" fill="none">
												<path d="M16.4212 15.4339L5.2352 26.9053C4.46205 27.6982 3.21185 27.6982 2.44693 26.9053L0.588085 24.9991C-0.185062 24.2062 -0.185062 22.9241 0.588086 22.1396L8.50874 14L0.579863 5.86879C-0.193285 5.07591 -0.193285 3.79381 0.579863 3.00937L2.43871 1.09466C3.21186 0.301781 4.46205 0.301782 5.22697 1.09466L16.4129 12.5661C17.1943 13.3589 17.1943 14.641 16.4212 15.4339Z" fill="#4CE0D7" />
											</svg></p>
									</a>
								</div>
							<?php
							endif;
							?>
						</div>
				<?php
					endwhile;
				endif; ?>

			</div>
			<div class="col-md-4">
				<?php
				// Query related articles
				$related_args = array(
					'post_type' => 'post',
					'posts_per_page' => 4, // Adjust the number of related posts to display
					'post__not_in' => array(get_the_ID()), // Exclude the current post
					'orderby' => 'rand', // Order by random to change the order on each page load
				);

				$related_query = new WP_Query($related_args);

				// Output related articles
				if ($related_query->have_posts()) :
				?>
					<div class="side-widget related-articles">
						<div class="related-posts">
							<h3 class="h3 fw-semibold mb-50">Related Articles</h3>

							<?php while ($related_query->have_posts()) : $related_query->the_post(); ?>
								<div class="list-related">
									<div class="img-list">
										<?php the_post_thumbnail(); ?>
									</div>
									<div class="title-list-block fw-medium">
										<h5><?php the_title(); ?></h5>
										<a href="<?php the_permalink(); ?>">more <svg xmlns="http://www.w3.org/2000/svg" width="14" height="15" viewBox="0 0 14 15" fill="none">
												<path d="M5.95246 1.43771L6.64613 0.726013C6.93985 0.424662 7.4148 0.424662 7.70539 0.726013L13.7797 6.955C14.0734 7.25635 14.0734 7.74365 13.7797 8.04179L7.70539 14.274C7.41167 14.5753 6.93673 14.5753 6.64613 14.274L5.95246 13.5623C5.65562 13.2577 5.66187 12.7608 5.96496 12.4627L9.73016 8.78235H0.749916C0.334338 8.78235 0 8.43932 0 8.01294V6.98706C0 6.56068 0.334338 6.21766 0.749916 6.21766H9.73016L5.96496 2.53733C5.65874 2.23918 5.65249 1.74227 5.95246 1.43771Z" fill="#4CE0D7" />
											</svg>
										</a>
									</div>
								</div>
							<?php endwhile; ?>

						</div>
					</div>
				<?php
					// Restore original post data
					wp_reset_postdata();
				endif;
				?>
				<?php
				// Get the categories of the current post
				$categories = get_the_category();

				// Check if there are categories assigned to the post
				if (!empty($categories)) {
				?>
					<div class="side-widget cats">
						<h3 class="h3 fw-semibold mb-50">Categories</h3>
						<?php
						// Get all categories with post counts
						$categories = get_categories(array(
							'hide_empty' => true, // Exclude empty categories
						));

						// Loop through each category
						foreach ($categories as $category) {
							$category_url = get_category_link($category->term_id);
							echo '<li class="fw-medium">';
							echo '<a href="' . esc_url($category_url) . '">';
							// Display category name and post count
							echo  esc_html($category->name) . '</a> <span class="bubble">' . $category->count . '</span>';
							echo '</li>';
						}
						?>
					</div>
				<?php
				}
				?>
			</div>
		</div>
	</div>
</main>
<?php get_footer(); ?>