<?php use Banana\Pagination; ?>

<!-- Blog Posts -->
<div class="blog-posts-container clearfix">
    <h3 class="text-secondary blog-posts-container__heading">Kategori <strong><?php echo single_cat_title() ?></strong></h3>
    <div class="row">
        <?php while (have_posts()) : the_post(); ?>
            <?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
        <?php endwhile; ?>
    </div>
    <div class="blog-pagination">
        <?php Pagination\pagination(); ?>
    </div>
</div>
