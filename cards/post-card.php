<div class="post-card">
    <a class="post-link" href="<?php echo get_permalink(); ?>">
        <?php if (has_post_thumbnail()) : ?>
            <div class="post-img">
                <?php the_post_thumbnail(); ?>
            </div>
        <?php endif; ?>
        <?php $reading_time = calculate_reading_time(get_the_ID()); ?>
        <span class="lead fw-light  d-block"><?php echo get_the_date('F j, Y'); ?> <span class="rdtime"><?= $reading_time ?></span></span>
        <h4 class="h4 fw-semibold"><?php the_title(); ?></h4>
    </a>
</div>