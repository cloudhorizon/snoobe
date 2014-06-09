<?php if (!is_front_page()) : ?>
<footer class="content-info" role="contentinfo">
  <div class="top container">
    <div class="col-sm-3">
      <?php dynamic_sidebar('footer-1'); ?>
    </div>
    <div class="col-sm-3">
      <?php dynamic_sidebar('footer-2'); ?>
    </div>
    <div class="col-sm-3">
      <?php dynamic_sidebar('footer-3'); ?>
    </div>
    <div class="col-sm-3">
      <?php dynamic_sidebar('footer-4'); ?>
    </div>
  </div>
  <div class="bottom">
    <div class="container">
      <div class="left">
        <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
      </div>
      <div class="right footer-menu">
        <?php dynamic_sidebar('sidebar-footer'); ?>
      </div>
    </div>
  </div>
</footer>
<?php endif; ?>


<?php wp_footer(); ?>
