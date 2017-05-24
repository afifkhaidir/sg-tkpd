<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
      <h1 class="post-title"><?php the_title();?></h1>
    </header>
    <div class="post-content">
      <div class="post-separator"></div>
      <div class="gallery-wrapper">
          <?php $pictures = get_post_meta($post->ID, 'repeatable_fields', true);
          
          foreach($pictures as &$picture) { ?>
              <div class="gallery-box">
                  <img class="gallery-box__img"
                       src="<?php echo $picture['url']; ?>" 
                       alt="<?php echo $picture['name']; ?>">
                  <div class="gallery-box__caption">
                      <?php echo $picture['name']; ?>
                  </div>
              </div>
          <?php } ?>
          <?php unset($value); ?>
      </div>
      
      <!-- Lightbox Container -->
      <div class="lightbox">
          <div class="lightbox-body">
              <img src="" 
                   alt=""
                   class="lightbox-body__img img-responsive">
              <button class="lightbox-body__close">
                  <img src="https://static.tokopedia.net/donasi/wp-content/themes/tkpd-donasi/assets/images/ico-close.png" class="lightbox-close" alt="close">
              </button>
          </div>
          <div class="lightbox-bottom">
              <p class="lightbox-bottom__caption"></p>
          </div>
      </div>
    </div>
  </article>
<?php endwhile; ?>