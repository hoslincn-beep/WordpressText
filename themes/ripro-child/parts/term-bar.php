<?php
/**
 * title 栏目顶部
 * Description   www.zyfx8.cn 资源分享吧
 * Author   老雷
 */
if (_cao('is_fancybox_img_one', '0')) {
    $image = _cao('deft_term_bar_img');
} else {
    $image = (get_the_post_thumbnail_url()) ? get_the_post_thumbnail_url() : _cao('deft_term_bar_img');
}
?>
<div class="term-bar lazyload visible" data-bg="<?php echo esc_url($image); ?>">
    <?php
    if (is_archive()) {
        the_archive_title('<h1 class="term-title">', '</h1>');
    } elseif (is_search()) {
        $titles = (get_search_query()) ? get_search_query() : '自定义筛选';
        echo '<h1 class="term-title">' . sprintf(esc_html__('搜索：%s', 'cao'), $titles) . '</h1>';
    } elseif (is_page()) {
        echo '<h1 class="term-title">' . trim(wp_title('', false)) . '</h1>';
    }
    ?>
</div>
<?php if (_cao('is_more_article_wave')) : ?>
    <!--增加头部波浪-->
    <!--    <div class="lang">-->
    <!--        <div class="lang__3"></div>-->
    <!--        <div class="lang__4"></div>-->
    <!--    </div>-->
    <div class="dabolang mobile-hide">
        <div id="dabolangl1" class="dabolangl"></div>
        <div id="dabolangl2" class="dabolangl"></div>
        <div id="dabolangl3" class="dabolangl"></div>
    </div>
<?php endif; ?>

<!--分类页显示 S-->
<?php
if (!_cao('is_filter_bar') && is_category()) :
    $currentterm = get_queried_object();
    if (!empty($currentterm)) {
        $currentterm_id = $currentterm->term_id;
        $parent_id = $currentterm->parent;
    } else {
        $currentterm_id = 0;
        $parent_id = 0;
    }
    ?>
    <div class="site-content riprochild-nav-search">
        <div class="container">
            <div class="filter--content">
                <!---搜索当前分类 START-->
                <div class="riprochild_type_bj">
                    <div class="header_search"
                         style="float:left;height: 38px;line-height: 28;text-align: left; margin-top: 10px;border-radius: 4px;width: 360px;position: inherit; margin-left:10px;">
                        <div class="search_form">
                            <div class="search_input" data-search="top-banner" style="background: #fff;">
                                <div class="search_filter" id="header_filter_cate">
                                </div>
                                <input class="search-input" id="search-keywords-cate" placeholder="搜索当前分类，按回车搜索"
                                       type="text"
                                       name="s" autocomplete="off">
                                <input type="hidden" name="search-cate" class="btn_search" data-search-btn="search-btn">
                            </div>
                            <div class="search_btn" id="search-btn-cate"><i class="fa fa-search"></i></div>
                        </div>
                    </div>
                    <script>
                        (function ($) {
                            $(function () {
                                $('#search-keywords-cate').bind('keypress', function (event) {
                                    if (event.keyCode == "13") {
                                        child_nav_search();
                                    }
                                })
                                $("#search-btn-cate").on("click", function () {
                                    child_nav_search();
                                })

                                function child_nav_search() {
                                    location.href = '/?s=' + $("#search-keywords-cate").val() + '&cat=' + "<?php echo $currentterm_id;?>";
                                }
                            })
                        })(jQuery)
                    </script>
                    <a href="/svip" rel="nofollow" target="_blank" class="openVip-Btn"><i class="fa fa-gift"></i>
                        升级终身VIP海量免费下载</a>
                </div>
                <!---搜索当前分类 END-->
            </div>
        </div>
    </div>
<?php endif; ?>
<!--分类页显示 E-->
