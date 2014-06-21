<div class="header">
  <h1>Blog</h1>
  <p>Keep up to date with us.</p>
</div>

<div class="container blog-area">
  <div class="main-blog-content">
    <?php if (!have_posts()) : ?>
      <div class="alert alert-warning">
        <?php _e('Sorry, no results were found.', 'roots'); ?>
      </div>
      <?php get_search_form(); ?>
    <?php endif; ?>

    <?php while (have_posts()) : the_post(); ?>
    <div class="post-single">
    <time class="published post-time" datetime="<?php echo get_the_time('c'); ?>"><?php echo get_the_date('M<\b\>j<\/b>'); ?></time>

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
      </div>
    <?php endwhile; ?>

  </div>
  <div class="main-blog-sidebar">
    <?php dynamic_sidebar('sidebar-primary'); ?>
  </div>
</div>


