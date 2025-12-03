<div class="cao_entry_header">
    <div class="sjblog-tgroup">
        <?php edit_post_link('[编辑]'); ?>
        <?php if (!is_page()) {
            cao_entry_header(array('tag' => 'h1'));
        } else {
            cao_entry_header(array('tag' => 'h1', 'link' => false));
        }
        get_template_part('parts/entry-subheading'); ?>
        <header class="entry-header">
	  <span class="sjblog-name">作者 :
	                  <a <?php echo _target_blank(); ?> href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"
                                                        style="color: #6b6b6b;"><?php the_author(); ?></a>
	                  <span class="sjblog-views"><i
                                  class="fa fa-pencil-square-o"></i> <?php echo count_words_read_time(); ?></span>
	                  <span class="sjblog-time"> 发布时间：<i
                                  class="fa fa-clock-o"></i> <?php echo the_time('Y-m-j'); ?></span>
	                  <span class="sjblog-views"><i class="fa fa-eye"></i> 共<?php echo _get_post_views(); ?>人阅读 </span>
	  </span>
    </div>
</div>