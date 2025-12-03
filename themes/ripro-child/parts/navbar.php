<?php
/**
 * title 顶部
 * Description   www.zyfx8.cn 资源分享吧
 * Author   老雷
 */
global $current_user;
$container = _cao('navbar_full', false);
$menu_class = 'main-menu hidden-xs hidden-sm hidden-md';
if (cao_compare_options(_cao('navbar_hidden', false), rwmb_meta('navbar_hidden')) == true) {
    $menu_class .= ' hidden-lg hidden-xl';
}
$logo_regular = _cao('site_logo');
$logo_regular_dark = _cao('site_dark_logo');

$CaoUser = new CaoUser($current_user->ID);
$site_money_ua = _cao('site_money_ua');
?>
<?php if (_cao('is_more_navbar_top')) : ?>
<div class="header-banner">
    <div class="container">
        <div class="header-banner-content wrapper">
            <div class="deanggwrap">
                <div class="deangg comfff wow fadeInUp">
                    <div class="deanggspan"></div>
                    <div class="top-text">Hi~欢迎您光临本站，秉承服务宗旨，履行"站长"责任，相识只是起点，服务永无止境！</div>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="header-banner-left">
                <div id="ym-menu" class="ym-menu">
                    <ul id="menu-header-top" class="menu">
                        <li><?php wp_nav_menu(array('theme_location' => 'menu-3')); ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<header class="site-header uitop <?php if (_cao('is_more_frosted_glass')) : ?>frosted<?php endif; ?>" id="navHeight">
    <?php else: ?>
    <header class="site-header <?php if (_cao('is_more_frosted_glass')) : ?>frosted<?php endif; ?>" id="navHeight">
        <?php endif; ?>
        <?php if ($container == false) : ?>
        <div class="container">
            <?php endif; ?>
            <div class="navbar">
                <div class="logo-wrapper<?php if (_cao('is_more_logo_streamer')) : ?>s<?php endif; ?>">
                    <?php if (!empty($logo_regular)) : ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>">
                            <img class="logo regular tap-logo" src="<?php echo esc_url($logo_regular); ?>"
                                 data-dark="<?php echo esc_url(_cao('site_dark_logo')); ?>"
                                 alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
                        </a>
                    <?php else : ?>
                        <a class="logo text"
                           href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html(get_bloginfo('name')); ?></a>
                    <?php endif; ?>
                </div>
                <div class="sep"></div>

                <nav class="<?php echo esc_attr($menu_class); ?>">
                    <?php wp_nav_menu(array(
                        'container' => false,
                        'fallback_cb' => 'Cao_Walker_Nav_Menu::fallback',
                        'menu_class' => 'nav-list u-plain-list',
                        'theme_location' => 'menu-1',
                        'walker' => new Cao_Walker_Nav_Menu(true),
                    )); ?>
                </nav>

                <div class="main-search">
                    <?php get_search_form(); ?>
                    <div class="search-close navbar-button"><i class="mdi mdi-close"></i></div>
                </div>

                <div class="actions">
                    <?php if (is_site_shop_open()) : ?>
                        <!-- user -->
                        <?php if (is_user_logged_in()) : ?>
                            <?php if (_cao('is_navbar_newhover', '1')) {
                                get_template_part('parts/navbar-hover');
                            } else { ?>
                                <a class="user-pbtn"
                                   href="<?php echo esc_url(home_url('/user')) ?>"><?php echo get_avatar($current_user->user_email); ?>
                                    <?php if (!_cao('is_navbar_ava_name', '0')) {
                                        echo '<span>' . $current_user->display_name . '</span>';
                                    } ?>
                                </a>
                            <?php } ?>

                        <?php else: ?>
                            <div class="login-btn navbar-button">登录/注册
                                <?php if (_cao('is_more_login_dropdown')) : ?>
                                    <span class="diamond">
				    <ul>
                    <?php $more_login_dropdown_info = _cao('more_login_dropdown_info');
                    if (isset($more_login_dropdown_info['more_login_dropdown_info_list'])) {
                        foreach ($more_login_dropdown_info['more_login_dropdown_info_list'] as $key => $link) {
                            echo '<li><i></i>' . $link['_title'] . '</li>';
                        }
                    }
                    ?>
				    </ul> 
				    <i class="kt">立即开通<?php if (_cao('more_goopen_vip_red')) : ?>
                            <em><?php echo _cao('more_goopen_vip_red'); ?></em><?php endif; ?></i>
				</span>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <!-- user end -->
                    <div class="search-open navbar-button"><i class="mdi mdi-magnify"></i></div>
                    <?php if (_cao('is_ripro_dark_btn')) : ?>
                        <div class="tap-dark navbar-button"><i class="mdi mdi-brightness-4"></i></div>
                    <?php endif; ?>
                    <div class="burger navbar-button" style="margin-right: 0;"><i class="fa fa-list"></i></div>
                </div>
            </div>
            <?php if ($container == false) : ?>
        </div>
    <?php endif; ?>
    </header>
    <div class="header-gap"></div>