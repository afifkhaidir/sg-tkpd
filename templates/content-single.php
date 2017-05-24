<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
      <div class="post-thumbnail">
          <?php the_post_thumbnail([620, 290], ['class' => 'post-thumbnail__img', 'title' => 'Feature image']); ?>
      </div>
      <h1 class="post-title"><?php the_title();?></h1>
    </header>
    <div class="post-content">
      <div class="post-separator"></div>
      <div class="post-detail clearfix">
          <div class="post-detail-timestamp">
            <?php echo human_time_diff( get_the_time('U'), current_time( 'timestamp' ) ) . ' ago'; ?> | <?php the_category( ', ' ); ?>
          </div>
      </div>
      <?php the_content();?>
    </div>
    <footer>
      <!-- Prev/Next Post -->
      <div class="post-navigation clearfix">
          <?php previous_post_link('<div class="previous-post pull-left">&laquo; %link</div>','Previous Post', TRUE); ?>
          <?php next_post_link('<div class="previous-post pull-right">%link &raquo;</div>','Next Post', TRUE); ?>
      </div>
    </footer>
  </article>
<?php endwhile; ?>