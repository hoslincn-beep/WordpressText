<?php
/*
 * Template Name: vip介绍
 * Description:   www.zyfx8.cn 资源分享吧
 * Author   老雷
 */
$home_mode_vip = _cao('home_vip_mod');
?>
<?php get_header(); ?>

<div class="vip-banner">
    <div class="vipbj">
        <h2><?php echo $home_mode_vip['title']; ?></h2>
        <p>目前为止共有 <span class="badge-light"><?php $users = $wpdb->get_var("SELECT COUNT(ID) FROM $wpdb->users");
                echo $users; ?></span> 位优秀的VIP会员加入！</p>
        <?php if (is_user_logged_in()) : ?>
            <a href="<?php echo esc_url(home_url('/user?action=vip')); ?>" class="btn-sm primary">前往开通</a>
        <?php else: ?>
            <a class="login-btn btn-sm primary">登录开通</a>
        <?php endif; ?>
    </div>
</div>
<div class="module-line"><span class="arrow left-arrow"></span> <span class="text">VIP会员尊享专属特权</span> <span
            class="arrow right-arrow"></span></div>
<ul class="vip-slogan">
    <li class="vip-slogan-box"><i class="fa fa-pie-chart"></i>
        <div class="vip-slogan-text">
            <p>100000+资源，无限量下载</p>
            <p>真正的海量，无套路，诚意满满</p>
        </div>
    </li>
    <li class="vip-slogan-box"><i class="fa fa-jsfiddle " style="font-size: 60px"></i>
        <div class="vip-slogan-text">
            <p>100m/s速度，百度云极速下载</p>
            <p>本地无需备份，即需即下，无需等待</p>
        </div>
    </li>
    <li class="vip-slogan-box"><i class="fa fa-gratipay" style="font-size: 55px"></i>
        <div class="vip-slogan-text">
            <p>看上喜欢的，加入收藏</p>
            <p>文件夹式收藏，方便快捷，精确查到</p>
        </div>
    </li>
    <li class="vip-slogan-box"><i class="fa fa-vine"></i>
        <div class="vip-slogan-text">
            <p>5000+原创精品，专享下载</p>
            <p>严格审核原创版权作品，VIP任性下载！</p>
        </div>
    </li>
    <li class="vip-slogan-box"><i class="fa fa-weixin"></i>
        <div class="vip-slogan-text">
            <p>全体在线客服，技术支持</p>
            <p>尊贵特权，极速响应，为你提供保障！</p>
        </div>
    </li>
    <li class="vip-slogan-box"><i class="fa fa-vimeo-square"></i>
        <div class="vip-slogan-text">
            <p>VIP标示，彰显尊贵身份</p>
            <p>点亮尊贵身份标示，散发与众不同气质</p>
        </div>
    </li>
</ul>
<section class="vipinfo-page">
<span class="tongue tongue-up tongue-section-primary">
        <i class="mdi mdi-chevron-up"></i>
    </span>
    <div class="container">
        <article class="single-content">
            <div class="schtext-center">
                <h6 class="text-uppercase">Pricing</h6>
                <h3 class="schtext-white">关于VIP会员介绍</h3>
                <div class="vip-desc" style="color: #CCC;">在这里，会员每月平均40+个用户开通会员， 下载资源 1000+份~</div>
            </div>
            <div class="section">
                <div class="home-vip-mod">
                    <div class="container">
                        <div class="row">
                            <div class="card ent-base ">
                                <div class="header" style="background:#0037da">
                                    <div class="version">
                                        游客/注册用户
                                    </div>
                                    <div class="price-year">
                                        <span class="dollar">￥</span><span class="price">0</span>
                                    </div>
                                    <div class="price-quarter">
                                        <span class="tehui"><i class="fa fa-diamond"></i> 限时优惠</span>
                                    </div>
                                    <p>
                                        <?php if (is_user_logged_in()) : ?>
                                            <a href="<?php echo esc_url(home_url('/user?action=vip')); ?>"
                                               class="btn-sm primary" style="background:<?php echo $item['_color']; ?>">
                                                <button class="btn user-login">升级会员</button>
                                            </a>
                                        <?php else: ?>
                                            <a class="login-btn btn-sm primary">
                                                <button class="btn user-login"><i class="fa fa-user"></i> 立即注册</button>
                                            </a>
                                        <?php endif; ?>
                                    </p>
                                    <div class="pricing-deco">
                                        <svg class="pricing-deco-img" enable-background="new 0 0 300 100" id="Layer_1"
                                             preserveAspectRatio="none" version="1.1" viewBox="0 0 300 100" x="0px"
                                             xml:space="preserve" xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xmlns="http://www.w3.org/2000/svg" y="0px">
                        <path class="deco-layer deco-layer--1" d="M30.913,43.944c0,0,42.911-34.464,87.51-14.191c77.31,35.14,113.304-1.952,146.638-4.729
	c48.654-4.056,69.94,16.218,69.94,16.218v54.396H30.913V43.944z" fill="#FFFFFF" opacity="0.6"></path>
                                            <path class="deco-layer deco-layer--2" d="M-35.667,44.628c0,0,42.91-34.463,87.51-14.191c77.31,35.141,113.304-1.952,146.639-4.729
	c48.653-4.055,69.939,16.218,69.939,16.218v54.396H-35.667V44.628z" fill="#FFFFFF" opacity="0.6"></path>
                                            <path class="deco-layer deco-layer--3" d="M43.415,98.342c0,0,48.283-68.927,109.133-68.927c65.886,0,97.983,67.914,97.983,67.914v3.716
	H42.401L43.415,98.342z" fill="#FFFFFF" opacity="0.7"></path>
                                            <path class="deco-layer deco-layer--4" d="M-34.667,62.998c0,0,56-45.667,120.316-27.839C167.484,57.842,197,41.332,232.286,30.428
	c53.07-16.399,104.047,36.903,104.047,36.903l1.333,36.667l-372-2.954L-34.667,62.998z" fill="#FFFFFF"></path>
                    </svg>
                                    </div>
                                </div>
                                <div class="content">
                                    <div class="desc" ><strong style="color:red">下载权限</strong>：仅限站内免费资源</div>
                                    <div class="desc"><strong style="color:red">VIP资源</strong>：无法下载</div>
                                    <div class="desc"><strong style="color:red">会员时长</strong>：长期有效</div>
                                    <div class="desc"><strong style="color:red">会员交流</strong>：无</div>
                                    <div class="desc"><strong style="color:red">售后服务</strong>：无</div>
                                </div>
                            </div>
                            <?php
                            if (isset($home_mode_vip['vip_group'])) {
                                foreach ($home_mode_vip['vip_group'] as $item) : ?>
                                    <div class="card ent-base ">
                                        <div class="header" style="background:<?php echo $item['_color']; ?>">
                                            <div class="version">
                                                <?php echo $item['_time']; ?>
                                            </div>
                                            <div class="price-year">
                                                <span class="dollar">￥</span><span
                                                        class="price"><?php echo $item['_price']; ?></span>
                                            </div>
                                            <div class="price-quarter">
                                                <?php if ($item['_tehui']) : ?>
                                                <span class="tehui"><i
                                                            class="fa fa-diamond"></i> <?php echo $item['_tehui']; ?></span>
                                            </div>
                                            <?php endif; ?>
                                            <p>
                                                <?php if (is_user_logged_in()) : ?>
                                                    <a href="<?php echo esc_url(home_url('/user?action=vip')); ?>"
                                                       class="btn-sm primary"
                                                       style="background:<?php echo $item['_color']; ?>">
                                                        <button class="btn user-login">前往开通</button>
                                                    </a>
                                                <?php else: ?>
                                                    <a class="login-btn btn-sm primary">
                                                        <button class="btn user-login"><i class="fa fa-user"></i> 登录购买
                                                        </button>
                                                    </a>
                                                <?php endif; ?>
                                            </p>
                                            <div class="pricing-deco">
                                                <svg class="pricing-deco-img" enable-background="new 0 0 300 100"
                                                     id="Layer_1" preserveAspectRatio="none" version="1.1"
                                                     viewBox="0 0 300 100" x="0px" xml:space="preserve"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink"
                                                     xmlns="http://www.w3.org/2000/svg" y="0px">
                        <path class="deco-layer deco-layer--1" d="M30.913,43.944c0,0,42.911-34.464,87.51-14.191c77.31,35.14,113.304-1.952,146.638-4.729
	c48.654-4.056,69.94,16.218,69.94,16.218v54.396H30.913V43.944z" fill="#FFFFFF" opacity="0.6"></path>
                                                    <path class="deco-layer deco-layer--2" d="M-35.667,44.628c0,0,42.91-34.463,87.51-14.191c77.31,35.141,113.304-1.952,146.639-4.729
	c48.653-4.055,69.939,16.218,69.939,16.218v54.396H-35.667V44.628z" fill="#FFFFFF" opacity="0.6"></path>
                                                    <path class="deco-layer deco-layer--3" d="M43.415,98.342c0,0,48.283-68.927,109.133-68.927c65.886,0,97.983,67.914,97.983,67.914v3.716
	H42.401L43.415,98.342z" fill="#FFFFFF" opacity="0.7"></path>
                                                    <path class="deco-layer deco-layer--4" d="M-34.667,62.998c0,0,56-45.667,120.316-27.839C167.484,57.842,197,41.332,232.286,30.428
	c53.07-16.399,104.047,36.903,104.047,36.903l1.333,36.667l-372-2.954L-34.667,62.998z" fill="#FFFFFF"></path>
                    </svg>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <?php echo $item['_desc']; ?>
                                            <p>
                                            </p>
                                        </div>
                                    </div>
                                <?php endforeach;
                            } ?>
                        </div>

                    </div>
                </div>
            </div>
        </article>
    </div>
</section>

<section class="schbg-white">
    <div class="container">
        <div class="schtext-center1">
            <h3>VIP会员常见问题说明</h3>
            <div class="fluid-paragraph">
                <p class="text-muted">开通会员常见问题说明，如有任何疑问可以联系本站客服咨询</p>
            </div>
        </div>
        <div class="sch-bd">
            <ul class="schfaq-list" id="R_faqList">
                <li class="item">
                    <div class="hd">
                        <strong>开通VIP的好处？</strong>
                    </div>
                    <div class="bd">VIP会员根据等级在相应的有效期内享有本站所有资源免费下载与共享的权利。
                    </div>
                </li>
                <li class="item">
                    <div class="hd">
                        <strong>开通VIP后，还有资源需要单独购买吗？</strong>
                    </div>
                    <div class="bd">VIP用户在会员时间内，全站所有素材都可以任意免费下载，不分VIP等级，绝无二次消费！
                    </div>
                </li>
                <li class="item">
                    <div class="hd">
                        <strong>VIP会员专享资源能否直接商用？</strong>
                    </div>
                    <div class="bd">本站所有资源版权均属于原作者所有，本站提供资源均只能用于参考学习之用，请勿直接商用。若由于商用引起版权纠纷，一切责任均由使用者承担，本站概不负责！
                    </div>
                </li>
                <li class="item">
                    <div class="hd">
                        <strong>是否可以与他人分享VIP会员账号？</strong>
                    </div>
                    <div class="bd">一个VIP账号仅限一个人使用，禁止与他人分享账号，一经发现做永久封号处理。会员账号是您的重要资产，请务必珍惜！
                    </div>
                </li>
                <li class="item">
                    <div class="hd">
                        <strong>是否可以申请退款？可以开发票吗？</strong>
                    </div>
                    <div class="bd">不可以！由于数字产品传输的特殊性，我们不接受退款。红森林是一个个人网站，无法开具发票。用户需对赞助本站作出判断和评估，这是您的自愿操作，红森林作为非赢利网站，绝无任何逼迫行为。
                    </div>
                </li>
                <li class="item">
                    <div class="hd">
                        <strong>遇到付款失败，付款后没有生效怎么办？</strong>
                    </div>
                    <div class="bd">理论上来说正常付款后不会出现此类问题，但是也会有部分用户因为网络等原因导致在付款的过程中会有一些异常，如果出现类似问题，大可不必惊慌，本站所有支付都会生成订单，不管成功还是失败，所以如果真正遇到网络问题导致付款失败您又不知道是否成功时，请查看自己的个人中心的订单管理，截图联系网站客服进行处理。
                    </div>
                </li>
            </ul>
        </div>
    </div>
</section>

<div style="clear:both"></div>
<style type="text/css">
    .site-content {
        padding: 0px;
        background: #FFF;
    }

    .term-bar {
        display: none;
    }
</style>
<script>
    $("#R_faqList .item").on("click", function () {
        $(this).toggleClass("active").siblings().removeClass("active")
    });
</script>
<?php get_footer(); ?>
