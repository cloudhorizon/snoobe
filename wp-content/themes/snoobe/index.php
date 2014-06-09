<div class="header">
  <h1>Blog</h1>
  <p>Keep up to date with us.</p>
</div>

<div class="container blog-area">
  <div class="main-blog-content">
    <time class="published post-time" datetime="<?php echo get_the_time('c'); ?>"><?php echo get_the_date('M<\b\>j<\/b>'); ?></time>
    <?php if (!have_posts()) : ?>
      <div class="alert alert-warning">
        <?php _e('Sorry, no results were found.', 'roots'); ?>
      </div>
      <?php get_search_form(); ?>
    <?php endif; ?>

    <?php while (have_posts()) : the_post(); ?>
    
    <?php echo '<a href="', get_permalink(), '">';
      if (has_post_thumbnail()) {
        the_post_thumbnail();
      }
      else {
        /*echo 
          '<img src="',
          get_bloginfo('template_directory'), '/images/thumb-default.png',
          '" width="100" height="75" alt="thumbnail" />';*/
      }
      echo '</a>';?>

      <?php get_template_part('templates/content', get_post_format()); ?>
    <?php endwhile; ?>

    <?php if ($wp_query->max_num_pages > 1) : ?>
      <nav class="post-nav">
        <ul class="pager">
          <li class="previous"><?php next_posts_link(__('&larr; Older posts', 'roots')); ?></li>
          <li class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'roots')); ?></li>
        </ul>
      </nav>
    <?php endif; ?>
  </div>
  <div class="main-blog-sidebar">
    <?php dynamic_sidebar('sidebar-primary'); ?>
  </div>
</div>


