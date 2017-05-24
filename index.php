<?php use Banana\Pagination; ?>

<!-- Slider container -->
<?php $slider_arg=array('post_type'=>'post','cat' => get_category_by_slug('topdonasi-bebas') -> term_id,'posts_per_page'=>'4');
      $slider_post=new WP_Query($slider_arg);
      
if($slider_post->have_posts()): ?>

<div class="slider-container">
  <div class="slider-wrapper">
  
  <?php while($slider_post->have_posts()): ?>
  <?php $slider_post->the_post(); 
        $slider_link = get_the_permalink();
        $slider_img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full')['0'];
        $slider_title = get_the_title(); ?>
        
      <!-- Slides -->
      <div class="slider-slide">
          <a href="<?php echo $slider_link ?>">
              <img src="<?php echo $slider_img ?>" class="slider-image" alt="<?php echo $slider_title ?>"/>
          </a>
      </div>
  
  <?php endwhile; endif; ?>
  
  </div>
</div>

<!-- Blog Posts -->
<div class="blog-posts-container clearfix">
    <div class="row">
        <?php while (have_posts()) : the_post(); ?>
            <?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
        <?php endwhile; ?>
    </div>
    <div class="blog-pagination">
        <?php Pagination\pagination(); ?>
    </div>
</div>
