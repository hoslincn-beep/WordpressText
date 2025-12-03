</div><!-- end sitecoent -->
<?php
$is_footer_wave = _cao('is_footer_wave');
$footer_autonomy_links_info = _cao('footer_autonomy_links_info');
$mode_banner = _cao('mode_banner');

if (is_array($mode_banner) && isset($mode_banner['bgimg']) && _cao('is_footer_banner')) : ?>
    <div class="module parallax">
        <img class="jarallax-img lazyload" data-srcset="<?php echo $mode_banner['bgimg']; ?>" data-sizes="auto"
             src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" alt="">
        <div class="container">
            <h4 class="entry-title">
                <?php echo wp_kses($mode_banner['text'], array(
                    'br' => array(),
                )); ?>
            </h4>
            <?php if ($mode_banner['primary_text'] != '') : ?>
                <a<?php echo _target_blank(); ?> class="button"
                                                 href="<?php echo esc_url($mode_banner['primary_link']); ?>"><?php echo esc_html($mode_banner['primary_text']); ?></a>
            <?php endif; ?>
            <?php if ($mode_banner['secondary_text'] != '') : ?>
                <a<?php echo _target_blank(); ?> class="button transparent"
                                                 href="<?php echo esc_url($mode_banner['secondary_link']); ?>"><?php echo esc_html($mode_banner['secondary_text']); ?></a>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>

<?php
$footer_youshe_statistics_info = _cao('footer_youshe_statistics_info');
if (is_array($footer_youshe_statistics_info) && isset($footer_youshe_statistics_info['_img']) && _cao('is_footer_youshe_statistics')) : ?>
    <div class="footer-statistics">
        <div class="site-data-wp" id="J_siteDataBar" data-bg="<?php echo $footer_youshe_statistics_info['_img']; ?>"
             style="background-image: url(&quot;<?php echo $footer_youshe_statistics_info['_img']; ?>&quot;);">
            <ul class="data-items">
                <li>
                    <span class="srctive"><?php echo floor((time() - strtotime(_cao('web_start_date'))) / 86400); ?></span><strong>本站运营(天)</strong>
                </li>
                <li>
                    <span class="srctive"><?php get_all_users_count(); ?></span><strong>用户总数</strong>
                </li>
                <li>
                    <span class="srctive"><?php get_all_post_count(); ?></span><strong>资源总数(个)</strong>
                </li>
                <li>
                    <span class="srctive"><?php get_week_post_count(); ?></span><strong>近7天更新(个)</strong>
                </li>
                <li>
                    <span class="srctive srcshujia"><?php echo _cao('web_resource_size'); ?></span><strong>资源大小(GB)</strong>
                </li>
            </ul>
            <?php if ($footer_youshe_statistics_info['_btn'] != '') : ?>
                <a target="_blank" class="btn btn-outlined"
                   href="<?php echo $footer_youshe_statistics_info['_btn_url']; ?>"
                   rel="nofollow"><?php echo $footer_youshe_statistics_info['_btn']; ?></a>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>

<?php if (_cao('is_footer_youshe', 'true')) {
    get_template_part('parts/footer-youshe');
} ?>
<footer class="site-footer">
    <div class="container">

        <?php if (_cao('is_diy_footer', 'true')) {
            get_template_part('parts/diy-footer');
        } ?>

        <?php if (_cao('is_footer_links')) : ?>
            <!--Friendship Links Start-->
            <div class="codesign-dw">
                <div class="col-xs-12 yuanbt_frlink">
                    <ul>
                        <span>友情链接
                         <?php if (_cao('is_footer_autonomy_links')) : ?>
                             <a href="<?php echo $title = ($footer_autonomy_links_info['_href']); ?>" target="_blank">自助申请友链</a>
                         <?php endif; ?>
                        </span>
                        <li>
                            <a href="https://zaodao.net" target="_blank"><strong>早道大咖素材</strong></a>
                        </li>
                        <?php wp_list_bookmarks('title_li=&show_images=0&categorize=0'); ?>
                    </ul>
                </div>
            </div>
            <!--Friendship Links End-->
        <?php endif; ?>

        <?php if (_cao('cao_copyright_text', '') != '') : ?>
            <div class="site-info">
                <?php echo _cao('cao_copyright_text', ''); ?>
                <?php if (_cao('cao_ipc_info')) : ?>
                    <a href="https://beian.miit.gov.cn" target="_blank" class="text"><?php echo _cao('cao_ipc_info') ?>
                        <br></a>
                <?php endif; ?>
                <div class="footer-shouquan"><?php echo _cao('footer_state_text', ''); ?></div>
            </div>
        <?php endif; ?>
        <?php if (_cao('web_js')) : ?>
            <?php echo _cao('web_js'); ?>
        <?php endif; ?>
    </div>
</footer>

<?php if (_cao('is_sidebar_childripro_float', 'true')) {
    get_template_part('parts/sidebar-float');
} ?>

<?php if (_cao('is_sidebar_ripro_float')) : ?>
    <div class="rollbar">
        <?php if (_cao('site_kefu_qq')) : ?>
            <div class="rollbar-item tap-qq" etap="tap-qq"><a target="_blank" title="QQ咨询"
                                                              href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo _cao('site_kefu_qq'); ?>&site=qq&menu=yes"><i
                            class="fa fa-qq"></i></a></div>
        <?php endif; ?>

        <div class="rollbar-item" etap="to_full" title="全屏页面"><i class="fa fa-arrows-alt"></i></div>

        <?php if (_cao('is_ripro_blog_style_btn', '1')) : $_bid = (is_cao_site_list_blog()) ? 1 : 0; ?>
            <div class="rollbar-item tap-blog-style" etap="tap-blog-style" data-id="<?php echo $_bid; ?>" title="博客模式">
                <i class="fa fa-list"></i></div>
        <?php endif; ?>

        <?php if (_cao('is_ripro_dark_btn')) : ?>
            <div class="rollbar-item tap-dark" etap="tap-dark" title="夜间模式"><i class="mdi mdi-brightness-4"></i></div>
        <?php endif; ?>
        <div class="rollbar-item" etap="to_top" title="返回顶部"><i class="fa fa-angle-up"></i></div>
    </div>
<?php endif; ?>

<div class="dimmer"></div>

<?php if (!is_user_logged_in() && is_site_shop_open()) : ?>
    <?php get_template_part('parts/popup-signup'); ?>
<?php endif; ?>

<?php get_template_part('parts/off-canvas'); ?>

<?php if (_cao('is_console_footer', 'true')) : ?>
    <script>
        console.log("\n %c <?php echo _the_theme_name() . ' V' . _the_theme_child_version();?> \n\n", "color: #fadfa3; background: #030307; padding:5px 0;", "background: #fadfa3; padding:5px 0;");
        console.log("SQL 请求数：<?php echo get_num_queries();?>");
        console.log("页面生成耗时： <?php echo timer_stop(0, 5);?>");
    </script>
<?php endif; ?>

<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $('.ct h3 span').click(function () {
            $(this).addClass("selected").siblings().removeClass();
            $('.ct > ul').eq($(this).index()).addClass('show');
            $('.ct > ul').eq($(this).index()).siblings().removeClass('show');
        });
        $("pre > code").addClass("language-php");
    });
    jQuery(".header-dropdown").hover(function () {
        jQuery(this).addClass('active');
    }, function () {
        jQuery(this).removeClass('active');
    });
    //child tab切换
    $('.h-screen li').click(function () {
        $(this).addClass("on").siblings().removeClass();
        $('.ct > ul').eq($(this).index()).addClass('show');
        $('.ct > ul').eq($(this).index()).siblings().removeClass('show');
    });
    $(".h-soup li i").click(function () {
        var soupBtn = $(this).parent();
        $(".h-soup li").removeClass("open");
        soupBtn.addClass("open");
    });
</script>

<script>
    //内容信息导航吸顶
    $(function () {
        var navHeight = $("#navHeight").offset().top;
        var navFix = $("#navHeight");
        if (navHeight > 36) {
            navFix.addClass("navFix");
        }
        window.onscroll = function () {
            if ($(this).scrollTop() > navHeight || $(this).scrollTop() > 37) {
                navFix.addClass("navFix");
            } else {
                navFix.removeClass("navFix");
            }
        }
    })
    $(document).ready(function () {

    })
    var ndt = $("#help dt");
    var ndd = $("#help dd");
    ndd.eq(0).show();
    ndt.click(function () {
        ndd.hide();
        $(this).next().show();
    });
</script>

<?php wp_footer(); ?>
<?php if (_cao('is_footer_wave')) : ?>
    <div class="waveHorizontals mobile-hide">
        <div id="waveHorizontal1" class="waveHorizontal"></div>
        <div id="waveHorizontal2" class="waveHorizontal"></div>
        <div id="waveHorizontal3" class="waveHorizontal"></div>
    </div>
<?php endif; ?>

<!-- 弹幕引用 S-->
<?php if (_cao('is_more_down_barrage')) : ?>
    <?php get_template_part('parts/barrager'); ?>
<?php endif; ?>
<!-- 弹幕引用 E-->

<!-- 底部用户登陆栏 S -->
<?php if (_cao('is_more_loginbottom_column') && !is_user_logged_in()) : ?>
    <?php $more_loginbottom_column_info = _cao('more_loginbottom_column_info'); ?>
    <div class="wic_slogin cl" style="bottom: 0px; opacity: 1;">
        <div class="wp">
            <div class="wic_slogin_info"><a rel="nofollow"
                                            href="<?php echo $more_loginbottom_column_info['_tag_href']; ?>"><?php echo $more_loginbottom_column_info['_tag']; ?></a> <?php echo $more_loginbottom_column_info['_title']; ?>
            </div>
            <div class="wic_slogin_btn">
                <a rel="nofollow" href="javascript:;" class="loginbutton" title="普通登录"><i class="fa fa-user"></i>账号登录/注册</a>
            </div>
            <?php _the_child_open_oauth_login_btn(); ?>
        </div>
    </div>
<?php endif; ?>
<!-- 底部用户登陆栏 E -->
<?php
$is_activity_float_info = _cao('is_activity_float_info');
$activity_float_info = _cao('activity_float_info');
$user_id = is_user_logged_in() ? wp_get_current_user()->ID : 0;
?>
<!-- 右上角活动悬浮 关闭 S-->
<?php if ($is_activity_float_info && !is_boosvip_status($user_id)) : ?>
    <div id="right_ad" class="right-ad-active" style="display: none;">
        <div class="kubao" style="display: none;"><span class="sm"></span></div>
        <a class="link animated" href="<?php echo $activity_float_info['_href']; ?>" target="_blank"
           style=" background: url(<?php echo $activity_float_info['_img']; ?>) no-repeat top /100% auto;"><em
                    class="close">×</em></a></div>
    <link rel='stylesheet' id='rightad-css' href='<?php bloginfo('stylesheet_directory'); ?>/assets/css/right.css'
          type='text/css' media='all'/>
    <script type='text/javascript' src='<?php bloginfo('stylesheet_directory'); ?>/assets/js/right.js'></script>
<?php endif; ?>
<!-- 右上角活动悬浮 E-->

<script type='text/javascript' src='<?php bloginfo('stylesheet_directory'); ?>/assets/js/copy.btn.js'></script>

<?php if (_cao('cao_disabled_f12')) : ?>
    <!--禁用F12-->
    <script type='text/javascript' src='<?php bloginfo('stylesheet_directory'); ?>/assets/js/cannot.copy.js'></script>
<?php endif; ?>

</body>
</html>
