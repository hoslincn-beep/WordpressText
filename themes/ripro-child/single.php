<?php
/*
* Description:   www.zyfx8.cn 资源分享吧
* Author   老雷
*/
$sidebar = cao_sidebar();
$column_classes = cao_column_classes($sidebar);
get_header();
?>
    <div class="container">
    <div class="breadcrumbs">
        <?php echo zy_breadcrumbs(); ?>
    </div>
<?php if (true) { ?>
    <!--下载模块 S-->
    <?php get_template_part('parts/riprodl'); ?>
    <!--下载模块 E-->
<?php } else { ?>
    <div class="row">
        <div class="<?php echo esc_attr($column_classes[0]); ?>">
            <div class="content-area">
                <?php if ((_get_post_shop_status() || _get_post_shop_hide()) && _cao('grid_is_price', true)) :
                    $post_price = _get_post_price();
                    $post_price = ($post_price) ? '<i class="cvip75"></i>' : '<i class="cvip85"></i>';
                    ?>
                    <?php echo '' . $post_price; ?>
                <?php endif; ?>
                <main class="site-main">
                    <?php while (have_posts()) : the_post();
                        get_template_part('parts/template-parts/content', 'single');
                    endwhile; ?>
                </main>
            </div>
        </div>
        <?php if ($sidebar != 'none') : ?>
            <div class="<?php echo esc_attr($column_classes[1]); ?>">
                <?php get_sidebar(); ?>
            </div>
        <?php endif; ?>
    </div>
    </div>

    <?php if (_cao('disable_related_posts', '1') && _cao('related_posts_style', 'grid') == 'fullgrid') {
        get_template_part('parts/related-posts');
    } ?>
<?php } ?>

<?php get_footer(); ?>