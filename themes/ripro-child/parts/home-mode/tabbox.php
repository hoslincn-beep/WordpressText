<?php
/**
 * 选项切换模块
 */
$sidebar = 'none';
$column_classes = cao_column_classes($sidebar);
//样式I
$is_tab_style_one = _cao('is_tab_style_one');
//样式II
$is_tab_style_two = _cao('is_tab_style_two');
$tab_style_two_host_info = _cao('tab_style_two_host_info');
$tab_style_two_update_info = _cao('tab_style_two_update_ixnfo');
//样式III

$sidebar = 'none';
$column_classes = cao_column_classes($sidebar);
$mo_postlist_no_cat = _cao('home_last_post');
if (!empty($mo_postlist_no_cat['home_postlist_no_cat'])) {
    $args['cat'] = '-' . implode($mo_postlist_no_cat['home_postlist_no_cat'], ',-');
}
$args['paged'] = (get_query_var('paged')) ? get_query_var('paged') : 0;
//排除置顶文章
//$args['ignore_sticky_posts'] = 1;
$tabBoxDataOne = tabBoxdata('tab_box_one', $args);
?>
<div class="container">
    <?php do_action('ripro_echo_ads_child', 'child_tab_adv_top'); ?>
</div>
<div class="section">
    <div class="row">
        <div class="<?php echo esc_attr($column_classes[0]); ?>">
            <div class="content-area">
                <main class="site-main widget_tabcontent  ct">
                    <!--样式I S-->
                    <?php if ($is_tab_style_one) : ?>
                        <?php if (is_home()) : ?>
                            <div class="category-header" style="margin-bottom: 38px;">
                                <div class="catalog_types types">
                                    <h3 class="text-center">
                                        <span class="selected">最新资源</span>
                                        <span class="">热门资源</span>
                                        <span class="">最新免费</span>
                                    </h3>
                                </div>
                            </div>
                            <div class="container">
                        <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <!--样式I E-->
                    <!--样式II S-->
                    <?php if ($is_tab_style_two) : ?>
                        <link rel="stylesheet" id="wp-block-library-css"
                              href="//at.alicdn.com/t/font_1631810_4drehjsmfd.css" type="text/css"
                              media="all">
                        <?php if (is_home()) : ?>
                            <div class="container">
                                <div class="cl pos">
                                    <ul class="h-screen">
                                        <li class="on"><a href="javascript:;" title="最新资源">最新资源</a></li>
                                        <li class=""><a href="javascript:;" rel="" data-status="" title="热门资源">热门资源</a>
                                        </li>
                                        <li class=""><a href="javascript:;" title="免费资源">免费资源</a></li>
                                    </ul>
                                    <!--  -->
                                    <ul class="h-soup cl">
                                        <li>
                                            <i class="iconfont icon_star" title="更新"></i>
                                            <a class="txt" <?php echo $tab_style_two_update_info['_blank'] ? ' target="_blank"' : ''; ?>
                                               href="<?php echo $title = ($tab_style_two_update_info['_href']); ?>"
                                            ><?php echo $title = ($tab_style_two_update_info['_title']); ?></a>
                                        </li>
                                        <li class="open">
                                            <i class="iconfont icon_warn" title="推荐"></i>
                                            <a class="txt"
                                               href="<?php echo $title = ($tab_style_two_host_info['_href']); ?>" <?php echo $tab_style_two_host_info['_blank'] ? ' target="_blank"' : ''; ?>
                                            ><?php echo $title = ($tab_style_two_host_info['_title']); ?></a>
                                        </li>
                                        <li>
                                            <i class="iconfont icon_heart" title="一条"></i>
                                            <a class="txt" href="javascript:;" target="_blank">
                                                <p id="hitokoto"></p>
                                                <script src="https://v1.hitokoto.cn/?encode=js&select=%23hitokoto"
                                                        defer></script>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="container">
                        <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <!--样式II E-->

                    <?php if ($tabBoxDataOne->have_posts()) : ?>
                        <ul class="hide-code show">
                            <div class="container">
                                <div class="row posts-wrapper">
                                    <?php while ($tabBoxDataOne->have_posts()) : $tabBoxDataOne->the_post();
                                        get_template_part('parts/template-parts/content', _cao('latest_layout', 'list'));
                                    endwhile; ?>
                                </div>
                                <?php get_template_part('parts/pagination'); ?>
                            </div>
                        </ul>
                        <?php wp_reset_query(); ?>
                        <ul class="hide-code">
                            <div class="container">
                                <div class="row posts-wrapper">
                                    <?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                                    $args = array(
                                        // 以下代码中的 modified 就是 orderby 的值，按修改时间排序。
                                        // 常用 orderby 值：title-按标题；date-按发布日期；modified-按修改时间；ID-按文章 ID；rand-随机排序；comment_count-按评论数。

                                        // 控制每页显示 20 篇文章，如果将 20 改成-1 将显示所有文章。不加此代码表示按照后台设置。
                                        'meta_key' => 'views',/* 此处为你的自定义栏目名称 */
                                        //'showposts' => '10',
                                        'orderby' => 'meta_value_num', /* 配置排序方式为自定义栏目值 */
                                        'paged' => $paged
                                    );
                                    $tabBoxDataTwo = tabBoxdata('tab_box_two', $args);
                                    //query_posts($args);
                                    ?>
                                    <?php while ($tabBoxDataTwo->have_posts()) : $tabBoxDataTwo->the_post();
                                        get_template_part('parts/template-parts/content', _cao('latest_layout', 'list'));
                                    endwhile; ?>
                                </div>
                                <?php get_template_part('parts/pagination'); ?>
                            </div>
                        </ul>

                        <?php wp_reset_query(); ?>
                        <ul class="hide-code">
                            <div class="container">
                                <div class="row posts-wrapper">
                                    <?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                                    $args = array(
                                        'meta_key' => 'cao_price',/* 此处为你的自定义栏目名称 */
                                        //'showposts' => '10',
                                        'meta_value' => '0',
                                        'orderby' => 'meta_value_num', /* 配置排序方式为自定义栏目值 */
                                        'paged' => $paged
                                    );
                                    //query_posts($args);
                                    $tabBoxDataThree = tabBoxdata('tab_box_three', $args);
                                    ?>
                                    <?php while ($tabBoxDataThree->have_posts()) : $tabBoxDataThree->the_post();
                                        get_template_part('parts/template-parts/content', _cao('latest_layout', 'list'));
                                    endwhile; ?>
                                </div>
                            </div>
                        </ul>
                        <?php wp_reset_query(); ?>
                    <?php else : ?>
                        <?php get_template_part('parts/template-parts/content', 'none'); ?>
                    <?php endif; ?>
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
</div>
<div class="container" style="margin-top: 20px">
    <?php do_action('ripro_echo_ads_child', 'child_tab_adv_lower'); ?>
</div>
<?php
wp_reset_postdata();
echo ob_get_clean(); ?>



