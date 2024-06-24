<?php get_header(); ?>
<main class="main-page">
	<div class="container">
		<?php if (have_posts()) : ?>
			<?php the_title('<h1 class="fw-bold text-center h3 mb-50">', '</h1>'); ?>
			<?php the_content(); ?>
		<?php else : ?>
			<?php get_template_part('template-parts/content', 'none'); ?>
		<?php endif; ?>
	</div>
</main><!-- #main -->
<?php get_footer(); ?>