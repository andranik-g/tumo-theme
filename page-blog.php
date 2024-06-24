<?php /* Template Name: Blog Template */
get_header(); ?>
<main class="main-page">
    <div class="container">
        <?php if (have_posts()) : ?>
            <?php the_title('<h1 class="fw-bold text-center h3 mb-50">', '</h1>'); ?>
            <div class="row">
                <?php


                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 5,
                    'orderby' => 'date',
                    'order' => 'DESC',
                    'paged' => get_query_var('paged') ? get_query_var('paged') : 1
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
                    custom_pagination($query);

                    wp_reset_postdata();
                }
                ?>
            </div>
        <?php else : ?>
            <?php get_template_part('template-parts/content', 'none'); ?>
        <?php endif; ?>
    </div>
</main><!-- #main -->
<?php get_footer(); ?>