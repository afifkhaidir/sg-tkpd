<div class="col-sm-6">
    <article class="blog-post">
        <div class="blog-post-thumbnail">
            <a href="<?php the_permalink(); ?>">
              <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title() ?>" class="blog-post-thumbnail__img">
            </a>
        </div>
        <div class="blog-post-body">
            <h2 class="blog-post-body__title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
            <div class="blog-post-body__date">
                <?php echo get_the_date('j F Y') ?>
            </div>
            <div class="blog-post-body__text">
                <?php the_excerpt(); ?>
            </div>
        </div>
    </article>
</div>