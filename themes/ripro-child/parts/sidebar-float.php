<?php
//右边悬浮栏
$user_favourable_img_info = _cao('user_favourable_img_info');
$sidebar_childripro_kefu_info = _cao('sidebar_childripro_kefu_info');
$update_sidebar_rili_url = _cao('update_sidebar_rili_url');
$sidebar_childripro_float_tgzq = _cao('sidebar_childripro_float_tgzq');
?>
<!--跟随样式开始-->
<link rel="stylesheet" href="//at.alicdn.com/t/font_1691494_rmmzr5cl9bk.css" type='text/css' media='all'>
<div class="rightList bar-v2">
    <ul class="sidebar">
        <?php if ($user_favourable_img_info) : ?>
            <li class="vip">
                <a href="/svip" target="_blank" data-block="666" data-position="1">
                    <i class="iconfont iconhuiyuan"></i>
                    <span>会员特惠</span>
                    <div class="left-box">
                        <img src="<?php echo esc_url(@$user_favourable_img_info['_img']); ?>" alt="">
                    </div>
                </a>
            </li>
        <?php endif; ?>

        <?php if (_cao('is_sidebar_childripro_sign')) : ?>
            <li class="sign-in user-sign-in ">
                <a class="click-qiandao" href="javascript:void(0);" etap="to_top" title="打卡签到">
                    <i class="iconfont iconqiandao"></i>
                    <span>签到</span>
                </a>
            </li>
        <?php endif; ?>

        <?php if (_cao('is_sidebar_childripro_kefu')) : ?>
            <?php if (_cao('sidebar_childripro_kefu_info')) : ?>
                <li class="customer-service">
                    <a class="custom-w" data-block="666" data-position="4" data-ext-mark="custom-03">
                        <i class="iconfont iconkefu"></i>
                        <span>客服</span>
                    </a>
                    <div class="service-box">
                        <div class="service-con">
                            <?php if ($sidebar_childripro_kefu_info['qq_kfqun']) : ?>
                                <a href="//shang.qq.com/wpa/qunwpa?idkey=<?php echo $title = ($sidebar_childripro_kefu_info['qq_kfqun']); ?>"
                                   target="_blank" rel="nofollow">
                                    官方QQ群
                                    <i class="iconfont icon-cebianlan"></i>
                                </a>
                            <?php endif; ?>

                            <?php if ($sidebar_childripro_kefu_info['float_faq_url']) : ?>
                                <a data-ext-mark="custom-01"
                                   href="<?php echo $title = ($sidebar_childripro_kefu_info['float_faq_url']); ?>"
                                   target="_blank">
                                    常见问题 FAQ
                                    <i class="iconfont icon-cebianlan"></i>
                                </a>
                            <?php endif; ?>

                            <?php if ($sidebar_childripro_kefu_info['qq_kefu']) : ?>
                                <div class="custom-box">
                                    <p>在线客服</p>
                                    <a data-ext-mark="custom-02"
                                       href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $title = ($sidebar_childripro_kefu_info['qq_kefu']); ?>&site=qq&menu=yes"
                                       rel="nofollow"
                                       class="btn-contact custom-w">
                                        点我联系
                                    </a>
                                </div>
                            <?php endif; ?>
                            <?php if ($sidebar_childripro_kefu_info['qq_kefu_desc']) : ?>
                                <div class="custom-tel">
                                    <p>
                                        <?php echo $title = ($sidebar_childripro_kefu_info['qq_kefu_desc']); ?>
                                    </p>
                                </div>
                            <?php endif; ?>
                            <?php if ($sidebar_childripro_kefu_info['qq_kefu_works_time']) : ?>
                                <div class="custom-tel">
                                    <p>
                                        工作时间: <?php echo $title = ($sidebar_childripro_kefu_info['qq_kefu_works_time']); ?>
                                    </p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </li>
            <?php endif; ?>
        <?php endif; ?>
        <?php if (_cao('site_list_style', 'default') == 'default' && _cao('is_sidebar_childripro_float_blog', '1')) : $_bid = (is_cao_site_list_blog()) ? 1 : 0; ?>
            <li class="twinkle-point">
                <a class="rollbar-item tap-blog-style" etap="tap-blog-style" data-id="<?php echo $_bid; ?>"
                   title="博客模式">
                    <i class="iconfont iconblog"></i>
                    <span>博客<br>模式</span>
                </a>
            </li>
        <?php endif; ?>
        <?php if ($update_sidebar_rili_url) : ?>
            <li class="twinkle-point">
                <a href="<?php echo $title = ($update_sidebar_rili_url['update_sidebar_rili_url_info']); ?>"
                   class="update-log" id="update-log-click" data-block="666" data-position="6" target="_blank">
                    <i class="iconfont icongengxin"></i>
                    <span>更新<br>日历</span>
                </a>
            </li>
        <?php endif; ?>

        <?php if (_cao('is_sidebar_childripro_float_dark')) : ?>
            <li class="twinkle-point">
                <a class="rollbar-item tap-dark" href="javascript:void(0);" etap="tap-dark" title="夜间模式">
                    <i class="iconfont iconbrightness-half"></i>
                    <span>暗黑<br>模式</span>
                </a>
            </li>
        <?php endif; ?>

        <?php if (_cao('is_sidebar_childripro_float_full')) : ?>
            <li class="client">
                <a class="float-border float-text" href="javascript:void(0);" etap="to_full" title="点击全屏">
                    <i class="iconfont iconquanping"></i>
                    <span>全屏</span>
                </a>
            </li>
        <?php endif; ?>

        <?php if ($sidebar_childripro_float_tgzq) : ?>
            <li class="recruit">
                <a href="<?php echo $title = ($sidebar_childripro_float_tgzq['sidebar_childripro_float_tgzq_url']); ?>"
                   rel="nofollow" data-block="666"
                   data-position="8" target="_blank">
                    <i class="iconfont iconzhifeiji"></i>
                    <span>推广<br>赚钱</span>
                </a>
            </li>
        <?php endif; ?>
    </ul>
    <div class="rollbar">
        <div class="Top" style="display: block;" etap="to_top" title="返回顶部">
            <i class="iconfont icontop"></i>
            <span class="common-gradient"></span>
        </div>
    </div>
</div>
<?php if (_cao('is_sidebar_childripro_float_wapqq')) : ?>
    <!--手机QQ跟随-->
    <div class="suspend">
        <dl>
            <a href="mqqwpa://im/chat?chat_type=wpa&uin=<?php echo $title = ($sidebar_childripro_kefu_info['qq_kefu']); ?>&version=1&src_type=web&web_src=zyfx8"></a>
        </dl>
    </div>
    <!--手机QQ跟随-->
<?php endif; ?>

<?php if (_cao('is_sidebar_childripro_float_wap1')) : ?>
    <!--手机跟随样式1-->
    <div id="foot-memu" class="aini_foot_nav">
        <ul>
            <li>
                <a href="/" class="foothover">
                    <i class="nohover iconfont iconhome_light"></i>
                    <p>首页</p>
                </a>
            </li>
            <li>
                <a class="click-qiandao" href="javascript:void(0);" etap="to_top" title="打卡签到">
                    <i class="nohover iconfont iconqiandao"></i>
                    <p>签到</p>
                </a>
            </li>
            <li class="aini_zjbtn">
                <a href="<?php echo $title = ($sidebar_childripro_float_tgzq['sidebar_childripro_float_tgzq_url']); ?>"
                   rel="nofollow" data-block="666" data-position="8" target="_blank">
                    <em class="bg_f b_ok"></em>
                    <span class="bg_f">
          <i class="iconfont foot_btn f_f iconjiahao"></i>
        </span>
                </a>
            </li>
            <li>
                <a class="rollbar-item tap-dark" href="javascript:void(0);" etap="tap-dark" title="夜间模式">
                    <i class="nohover iconfont iconbrightness-half"></i>
                    <p>切换</p>
                </a>
            </li>
            <li>
                <a href="mqqwpa://im/chat?chat_type=wpa&uin=<?php echo $title = ($sidebar_childripro_kefu_info['qq_kefu']); ?>&version=1&src_type=web&web_src=zyfx8.cn">
                    <i class="nohover iconfont iconkefu"></i>
                    <p>客服</p>
                </a>
            </li>
        </ul>
    </div>
    <!--手机跟随样式1-->
<?php endif; ?>
<!--跟随样式结束-->