<?php use Banana\Pagination; ?>

<!-- Blog Posts -->
<div class="blog-posts-container clearfix">
    <h3 class="text-secondary blog-posts-container__heading"><?php echo 'Hasil Pencarian "<strong>'.$_GET["s"].'</strong>"' ?></h3>
    <div class="row">
        <?php if(have_posts()) : while (have_posts()) : the_post(); 
            get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); 
        endwhile; 
        else :
            echo '<div class="col-sm-12"><div class="blog-post-well"><p>Post tidak ditemukan<p></div></div>';
        endif?>
    </div>
    <div class="blog-pagination">
        <?php Pagination\pagination(); ?>
    </div>
</div>
