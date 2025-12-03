<?php
  $sidebar = cao_sidebar();
  $column_class = $sidebar == 'none' ? 'col-lg-6' : 'col-12';
?>

  <article id="post-<?php the_ID(); ?>" <?php post_class( 'post post-list' ); ?>>
      <?php articleType(); ?>

    <?php cao_entry_media( array( 'layout' => 'rect_300' ) ); ?>
    <div class="entry-wrapper">
      <?php cao_entry_header( array( 'category' => true ,'author'=>true ) ); ?>
      <div class="entry-excerpt u-text-format"><?php echo _get_excerpt(); ?></div>
      <?php get_template_part( 'parts/entry-footer' ); ?>
    </div>
  </article>
