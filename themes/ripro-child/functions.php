<?php
/**
 * title 子主题函数
 * Description   www.zyfx8.cn 资源分享吧
 * Author   老雷
 */
//后台设置
require_once plugin_dir_path(__FILE__) . '/inc/codestar-framework/codestar-framework.php';
//文章简码优化排版
require_once get_stylesheet_directory() . '/inc/shortcodes/shortcodes.php';
require_once get_stylesheet_directory() . '/inc/shortcodes/shortcodespanel.php';
require_once get_stylesheet_directory() . '/inc/theme-functions.php';

//底部登陆栏-社交登录按钮
function _the_child_open_oauth_login_btn()
{
    if (_cao('is_oauth_qq') || _cao('is_oauth_weixin') || _cao('is_oauth_mpweixin') || _cao('is_oauth_weibo')) {
        $oauthArr = array('qq', 'weixin', 'mpweixin', 'weibo');
        $oauthArrValue = array(
            'qq' => 'QQ登录',
            'weixin' => '微信登录',
            'weibo' => '微博登录',
        );
        $rurl = home_url(add_query_arg(array()));
        foreach ($oauthArr as $value) {
            if (_cao('is_oauth_' . $value)) {
                if ($value != 'mpweixin') {
                    echo '<span class="wic_slogin_line"></span>
            <div class="wic_slogin_' . $value . '">
                <a href="' . esc_url(home_url('/oauth/' . $value . '?rurl=' . $rurl)) . '"
                                          class="qqbutton" rel="nofollow"><i class="fa fa-' . $value . '"></i>' . $oauthArrValue[$value] . '</a>
            </div>';
                }
            }
        }
    }
}

//文章内页面包屑导航
function zy_breadcrumbs()
{
    if ((is_single() && !_cao('is_archive_crumbs') && !is_attachment()) || is_attachment()) {
        return '当前位置：<a href="' . get_bloginfo('url') . '">' . get_bloginfo('name') . '</a> <small>></small> <a href="' . esc_url(get_permalink()) . '">' . get_the_title() . '</a>';
    } else {
        return false;
    }
}

//文章类型标识
function articleType()
{
    global $post;
    $post_ID = $post->ID;
    $cao_is_article_type = get_post_meta($post_ID, 'cao_is_article_type', true);
    $cao_article_type_info = get_post_meta($post_ID, 'cao_article_type_info', true);
    if ($cao_is_article_type) {
        $bac = 'background: linear-gradient(45deg, transparent 50%, ' . $cao_article_type_info['_color'] . ' 0%);';
        echo '<div class="free-theme-tag" style="' . $bac . '"><p>' . $cao_article_type_info['_tag'] . '</p></div>';
    }
}

// 允许上传 WebP 图片
function allow_webp_upload($mimes) {
    $mimes['webp'] = 'image/webp';
    return $mimes;
}
add_filter('mime_types', 'allow_webp_upload');
// 解决媒体库缩略图不显示问题
function webp_is_displayable($result, $path) {
    $info = @getimagesize($path);
    if ($info['mime'] === 'image/webp') {
        $result = true;
    }
    return $result;
}
add_filter('file_is_displayable_image', 'webp_is_displayable', 10, 2);

//提示文章更新
function articleUpdateTips()
{
    global $post;
    $post_ID = $post->ID;
    $cao_article_tips = get_post_meta($post_ID, 'cao_article_tips', true);
    if ($cao_article_tips) {
        echo '<div class="tips-theme-tag">' . $cao_article_tips . '</div>';
    }
}

//演示标识-演示链接
function demoMark()
{
    global $post;
    $post_ID = $post->ID;
    $cao_demourl = get_post_meta($post_ID, 'cao_demourl', true);
    $cao_is_demo_img = get_post_meta($post_ID, 'cao_is_demo_img', true);
    $goName = '';
    $goUrl = '';
    if ($cao_demourl == true) {
        $goName = ' 演示';
        $goUrl = $cao_demourl;
    } else if ($cao_is_demo_img == true) {
        $goName = ' 演示';
        $goUrl = '/demo?post_id=' . $post_ID;
    }
    if ($goName) {
        //echo '<a target="_blank" class="demo-theme-tag" href="' . $goUrl . '"><i class="fa fa-television"></i>' . $goName . '</a>';
    }
}

//文章阅读预计时间
function count_words_read_time()
{
    global $post;
    $text_num = mb_strlen(preg_replace("/\\s/", "", html_entity_decode(strip_tags($post->post_content))), "UTF-8");
    $read_time = ceil($text_num / 400);
    $output .= "本文共" . $text_num . "个字，预计阅读时间需要" . $read_time . "分钟";
    return $output;
}

//弹幕-下载订单数据
function get_paylogs()
{
    global $wpdb, $paylog_table_name;
    $list = $wpdb->get_results("SELECT * FROM $paylog_table_name WHERE status =1 and post_id!=1273 ORDER BY pay_time DESC limit 10");
    $barrages = array();
    foreach ($list as $value) {
        $info = substr_replace(get_user_by('id', $value->user_id)->user_login, '**', '2') . " 刚刚下载了 " . mb_substr(get_the_title($value->post_id), 0, 8);
        $img = str_replace('http:', 'https:', get_user_meta($value->user_id)['user_custom_avatar'][0]);
        $href = get_permalink($value->post_id);
        $new = array(
            'info' => $info,
            'img' => $img,
            'href' => $href,
            'speed' => 15,
            'color' => '#fff',
            'bottom' => 70,
            'close' => false
        );
        array_push($barrages, $new);
    };
    return json_encode($barrages);
}

//检测文章是否是永久会员
function _get_post_cao_is_boosvip()
{
    global $post;
    $post_ID = $post->ID;
    
    // 获取文章的价格和限制设置
    $cao_price = get_post_meta($post_ID, 'cao_price', true);
    $cao_close_novip_pay = get_post_meta($post_ID, 'cao_close_novip_pay', true);
    $cao_is_boosvip = get_post_meta($post_ID, 'cao_is_boosvip', true);
    
    // 判断是否为免费但仅限VIP下载的资源
    $is_free_vip_only = ($cao_price == 0 && ($cao_close_novip_pay || $cao_is_boosvip));
    
    if ($is_free_vip_only) {
        // 价格=0且勾选了限制选项，显示"VIP免费"
        return 'VIP免费';
    } elseif ($cao_price == 0) {
        // 价格=0但未勾选限制选项，显示"免费"
        return '免费';
    }
    
    // 以下是原有逻辑，用于价格大于0的情况
    if (get_post_meta($post_ID, 'cao_is_boosvip', true)) {
        return 'VIP免费';
    }
    if (get_post_meta($post_ID, 'cao_vip_rate', true) == 0) {
        return 'VIP免费';
    }
    $cao_vip_rate = get_post_meta($post_ID, 'cao_vip_rate', true) * 10;
    return 'VIP ' . $cao_vip_rate . '折';
}






//每日更新的文章数量
function get_today_post_count()
{
    $today = getdate();
    ///////////S CACHE ////////////////
    if (CaoCache::is()) {
        $_the_cache_key = 'ripro_child_today_posts_count_key';
        $count_cache = CaoCache::get($_the_cache_key);
        if (false === $count_cache) {
            $query = new WP_Query('year=' . $today["year"] . '&monthnum=' . $today["mon"] . '&day=' . $today["mday"]);
            $count_cache = $query->found_posts;
            CaoCache::set($_the_cache_key, $count_cache);
        }
        $count = $count_cache;
    } else {
        $query = new WP_Query('year=' . $today["year"] . '&monthnum=' . $today["mon"] . '&day=' . $today["mday"]);
        $count = $query->found_posts;
    }
    ///////////S CACHE ////////////////
    echo $count;
}

// 每周更新的文章数量
function get_week_post_count()
{
    $date_query = array(
        array(
            'after' => '1 week ago'
        )
    );
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'date_query' => $date_query,
        'no_found_rows' => true,
        'suppress_filters' => true,
        'fields' => 'ids',
        'posts_per_page' => -1
    );
    ///////////S CACHE ////////////////
    if (CaoCache::is()) {
        $_the_cache_key = 'ripro_child_week_posts_count_key';
        $count_cache = CaoCache::get($_the_cache_key);
        if (false === $count_cache) {
            $query = new WP_Query($args);
            $count_cache = $query->post_count;
            CaoCache::set($_the_cache_key, $count_cache);
        }
        $count = $count_cache;
    } else {
        $query = new WP_Query($args);
        $count = $query->post_count;
    }
    ///////////S CACHE ////////////////
    echo $count +30;
}

//用户总数
function get_all_users_count()
{
    global $wpdb;
    ///////////S CACHE ////////////////
    if (CaoCache::is()) {
        $_the_cache_key = 'ripro_child_all_users_count_key';
        $count_cache = CaoCache::get($_the_cache_key);
        if (false === $count_cache) {
            $count_cache = $wpdb->get_var("SELECT COUNT(ID) FROM $wpdb->users");
            CaoCache::set($_the_cache_key, $count_cache);
        }
        $count = $count_cache;
    } else {
        $count = $wpdb->get_var("SELECT COUNT(ID) FROM $wpdb->users");
    }
    ///////////S CACHE ////////////////
    echo $count;

}

//自动为文章添加已使用过的标签
function array2object($array)
{ // 数组转对象
    if (is_array($array)) {
        $obj = new StdClass();
        foreach ($array as $key => $val) {
            $obj->$key = $val;
        }
    } else {
        $obj = $array;
    }
    return $obj;
}

function object2array($object)
{ // 对象转数组
    if (is_object($object)) {
        foreach ($object as $key => $value) {
            $array[$key] = $value;
        }
    } else {
        $array = $object;
    }
    return $array;
}

/*获取Tab数据*/
function tabBoxdata($source, $args)
{
    ///////////S CACHE ////////////////
    if (CaoCache::is()) {
        $_the_cache_key = 'ripro_child_home_tab_box_data_' . $source . '_' . $args['paged'];
        $_the_cache_data = CaoCache::get($_the_cache_key);
        if (false === $_the_cache_data) {
            $_the_cache_data = new WP_Query($args); //缓存数据
            CaoCache::set($_the_cache_key, $_the_cache_data);
        }
        $psots_data = $_the_cache_data;
    } else {
        $psots_data = new WP_Query($args); //原始输出
    }
    ///////////S CACHE ////////////////
    return $psots_data;
}

//资源总数
function get_all_post_count()
{
    ///////////S CACHE ////////////////
    if (CaoCache::is()) {
        $_the_cache_key = 'ripro_child_all_posts_count_key';
        $count_cache = CaoCache::get($_the_cache_key);
        if (false === $count_cache) {
            $count_cache = wp_count_posts()->publish;
            CaoCache::set($_the_cache_key, $count_cache);
        }
        $count = $count_cache;
    } else {
        $count = 41050 + wp_count_posts()->publish;//这里前面的 41050 可以任意更改，想怎么改就怎么改！
    }
    ///////////S CACHE ////////////////
    echo $count;
}

/* ----------  最小补丁：让“下载次数限制”同时对游客生效  ---------- */
 
/**
 * 24h 内不变的游客身份串（IP+UA 摘要）
 */
if (!function_exists('rc_guest_uid')) {
    function rc_guest_uid() {
        $ip  = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
        $ua  = $_SERVER['HTTP_USER_AGENT'] ?? '';
        $key = 'rc_gid_' . substr(md5($ip . $ua), 0, 8);
        if (!isset($_COOKIE[$key])) {
            setcookie($key, '1', time() + DAY_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN);
        }
        return $key;
    }
}
 
/**
 * 覆盖父主题 is_download_count_limit()
 * 登录用户 → user_id；游客 → rc_guest_uid()
 */
if (!function_exists('is_download_count_limit')) :
function is_download_count_limit($post_id = 0) {
    $max  = absint(_cao('download_count_limit_num', 3));
    $max  = max(1, $max);
    $day  = date('Ymd');
    $key  = "download_count_{$day}";
 
    $uid  = is_user_logged_in() ? get_current_user_id() : rc_guest_uid();
    $used = (int) get_user_meta($uid, $key, true);
 
    return $used >= $max;
}
endif;
 
/**
 * 覆盖父主题 set_download_count_limit()
 */
if (!function_exists('set_download_count_limit')) :
function set_download_count_limit($post_id = 0) {
    $day = date('Ymd');
    $key = "download_count_{$day}";
 
    $uid  = is_user_logged_in() ? get_current_user_id() : rc_guest_uid();
    $used = (int) get_user_meta($uid, $key, true);
 
    update_user_meta($uid, $key, $used + 1);
}
endif;
/* ----------  补丁结束  ---------- */

