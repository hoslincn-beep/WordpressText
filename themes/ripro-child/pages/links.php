<?php
/**
 * Template name: 友情链接(Link)
 * Description:   www.zyfx8.cn 资源分享吧
 * Author   老雷
 */
get_header();
?>
    <div class="container">
        <ul class="plinks">
            <?php
            wp_list_bookmarks(array(
                'show_description' => true,
                'show_name' => true,
                'orderby' => 'rating',
                'title_before' => '<h2><i class="fa fa-chain-broken"></i> ',
                'title_after' => '</h2>',
                'order' => 'DESC'
            ));
            ?>
        </ul>
    </div>
<?php get_footer(); ?>