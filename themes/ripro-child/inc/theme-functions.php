<?php
//子主题初始化
if (!function_exists('ripro_child_setup')):
    function ripro_child_setup()
    {
        //新增后台菜单选项
        register_nav_menus(array(
            'menu-3' => '顶部黑条导航',
        ));
        //新增自定义页面
        $init_pages = array(
            'pages/demo.php' => array('图片演示', 'demo'),
            'pages/svip.php' => array('VIP会员介绍', 'svip'),
            'pages/applylinks.php' => array('自助申请友链', 'applylinks'),
            'pages/links.php' => array('友情链接', 'links'),
        );
        foreach ($init_pages as $template => $item) {
            $one_page = array(
                'post_title' => $item[0],
                'post_name' => $item[1],
                'post_status' => 'publish',
                'post_type' => 'page',
                'post_author' => 1,
            );
            ///////////S CACHE ////////////////
            if (CaoCache::is()) {
                $_the_cache_key = 'ripro_child_functions_init_pages_' . $template;
                $_the_cache_data = CaoCache::get($_the_cache_key);
                if (false === $_the_cache_data) {
                    $_the_cache_data = get_page_by_title($item[0]); //缓存数据
                    CaoCache::set($_the_cache_key, $_the_cache_data);
                }
                $one_page_check = $_the_cache_data;
            } else {
                $one_page_check = get_page_by_title($item[0]);
            }
            ///////////S CACHE ////////////////

            if (!isset($one_page_check->ID)) {
                $one_page_id = wp_insert_post($one_page);
                update_post_meta($one_page_id, '_wp_page_template', $template);
            }
        }
    }

    add_action('after_setup_theme', 'ripro_child_setup');
endif;

//加载子主题css样式
add_action('wp_enqueue_scripts', 'ripro_chlid_css', 60);
function ripro_chlid_css()
{
    $__v = _the_theme_version();
    if (!is_admin()) {
        //挂在父主题优先最前
        wp_enqueue_style("uibanner_css", get_stylesheet_directory_uri() . "/assets/css/uibanner.css", array("app"), $__v, "all");
        wp_enqueue_style("swiper_css", get_stylesheet_directory_uri() . "/assets/css/swiper.min.css", array("app"), $__v, "all");
        wp_enqueue_style("uibanner_css");
        wp_register_style('ripro_chlid_style', get_stylesheet_directory_uri() . '/diy.css', array('app'), $__v, 'all');
        wp_enqueue_style('ripro_chlid_style');
    }
}

//加载子主题js
add_action("wp_enqueue_scripts", "ripro_child_js", 60);
function ripro_child_js()
{
    $__v = _the_theme_version();
    if (!is_admin()) {
        wp_register_script("swiper_js", get_stylesheet_directory_uri() . "/assets/js/swiper.min.js", array("jquery"), $__v, true);
        wp_enqueue_script("notice_js", get_stylesheet_directory_uri() . "/assets/js/notice.js", array("jquery"), $__v, true);
        wp_enqueue_script("pace_js", get_stylesheet_directory_uri() . "/assets/js/pace.min.js", array("jquery"), $__v, true);
        wp_enqueue_script("ripro_child_js", get_stylesheet_directory_uri() . "/assets/js/ripro.child.js", array("jquery"), $__v, true);
        wp_enqueue_script("swiper_js");
    }
}

//移除父主题的函数钩子
function remove_old_function()
{
    //广告函数钩子
    remove_action('ripro_echo_ads', 'ripro_echo_ads');
}

add_action('init', 'remove_old_function');
//重写父主题广告函数钩子
add_action('ripro_echo_ads', 'ripro_echo_ads_new', 20, 1);
function ripro_echo_ads_new($slug)
{
    if (defined('DOING_AJAX') && DOING_AJAX) {
        return false;
    }
    $sidebar_childripro_kefu_info = _cao('sidebar_childripro_kefu_info');
    $is_ads = _cao($slug);
    $ads_pc = _cao($slug . '_pc');
    $ads_mobile = _cao($slug . '_mobile');
    $html = '';
    $kefu = '<div class="img-info">
                <i class="fa fa-question-circle"></i>
                <div class="info">也想出现在这里？
                    <a rel="nofollow" target="_blank" title="QQ咨询" href="http://wpa.qq.com/msgrd?v=3&amp;uin=' . $sidebar_childripro_kefu_info['qq_kefu'] . '&amp;site=qq&amp;menu=yes">联系我们</a>吧
                </div>
            </div>';
    if (wp_is_mobile() && $is_ads && isset($ads_mobile)) {
        $html = '<div class="ripro_gg_wrap mobile">';
        $html .= $ads_mobile;
        $html .= '</div>';
    } else if ($is_ads && isset($ads_pc)) {
        $ads_pc = str_replace('ritheme.com', 'zyfx8.cn', $ads_pc);
        $ads_pc = str_replace('/ripro/assets/images/hero/ads.jpg', '/ripro-child/assets/images/child-ads.gif', $ads_pc);
        $html = '<div class="ripro_gg_wrap pc top-dver-item">';
        $html .= $ads_pc;
        $html .= $kefu;
        $html .= '</div>';
    }
    echo $html;
}

//自定义广告函数钩子
add_action('ripro_echo_ads_child', 'ripro_echo_ads_child', 20, 1);
function ripro_echo_ads_child($slug)
{
    if (defined('DOING_AJAX') && DOING_AJAX) {
        return false;
    }
    $sidebar_childripro_kefu_info = _cao('sidebar_childripro_kefu_info');
    $ads_data = _cao($slug);
    if (!_cao('is_' . $slug) || !isset($ads_data['_adv'])) {
        return;
    }

    $html = '';
    $kefu = '<div class="img-info">
                <i class="fa fa-question-circle"></i>
                <div class="info">也想出现在这里？
                    <a rel="nofollow" target="_blank" title="QQ咨询" href="http://wpa.qq.com/msgrd?v=3&amp;uin=' . $sidebar_childripro_kefu_info['qq_kefu'] . '&amp;site=qq&amp;menu=yes">联系我们</a>吧
                </div>
            </div>';

    if (substr_count($ads_data['_adv'], '||') > 0) {
        $data = explode('||', $ads_data['_adv']);
        if (!isset($data)) {
            return;
        }
        foreach ($data as $key => $v) {
            if (empty($v)) {
                continue;
            }
            if (wp_is_mobile()) {
                $html .= '<div class="col-xs-12 col-sm-12 col-md-6 child-adv-list"><div class="ripro_gg_wrap mobile">';
                $html .= $v;
                $html .= '</div></div>';
            } else {
                $html .= '<div class="col-xs-12 col-sm-12 col-md-6 child-adv-list"><div class="ripro_gg_wrap pc top-dver-item">';
                $html .= $v;
                $html .= $kefu;
                $html .= '</div></div>';
            }
        }
        echo $html;
    } else {
        if (wp_is_mobile()) {
            $html = '<div class="ripro_gg_wrap mobile">';
            $html .= $ads_data['_adv'];
            $html .= '</div>';
        } else {
            $html = '<div class="ripro_gg_wrap pc top-dver-item">';
            $html .= $ads_data['_adv'];
            $html .= $kefu;
            $html .= '</div>';
        }
        echo $html;
    }
}

//启用友情链接
add_filter('pre_option_link_manager_enabled', '__return_true');

//加载下载内页
add_action('wp_head', 'ripro_child_dl', 50);
function ripro_child_dl()
{
    if (is_single()) {
        echo "<link rel='stylesheet' id='wbs-style-dlipp-css'  href='" . get_stylesheet_directory_uri() . "/assets/css/riprodl.css' type='text/css' media='all' />";
        echo "<link rel='stylesheet' id='aliicon'  href='//at.alicdn.com/t/font_839916_ncuu4bimmbp.css?ver=5.4-alpha-46770' type='text/css' media='all' />";
    }
}

//公告通知模块
add_action("init", "my_custom_init");
function my_custom_init()
{
    $labels = array("name" => "公告", "singular_name" => "公告", "add_new" => "发表公告", "add_new_item" => "发表公告", "edit_item" => "编辑公告", "new_item" => "新公告", "view_item" => "查看公告", "search_items" => "搜索公告", "not_found" => "暂无公告", "not_found_in_trash" => "没有已遗弃的公告", "parent_item_colon" => "", "menu_name" => "公告");
    $args = array("labels" => $labels, "public" => true, "publicly_queryable" => true, "show_ui" => true, "show_in_menu" => true, "exclude_from_search" => true, "query_var" => true, "rewrite" => true, "capability_type" => "post", "has_archive" => true, "hierarchical" => false, "menu_position" => null, "supports" => array("editor", "author", "title", "custom-fields"));
    register_post_type("kuaixun", $args);
}

//导航下拉栏目数量
add_filter('wp_nav_menu_objects', 'mysite_nav_items_num', 10, 2);
function wt_get_category_count($cat_ID)
{
    $category = get_category($cat_ID);
    return $category->count;
}

function mysite_nav_items_num($items, $args)
{
    if (isset($args->theme_location) && $args->theme_location == 'menu-1') {
        foreach ($items as $key => $item) {
            if ($item->object == 'category') {
                $catID = isset($item->object_id) ? $item->object_id : false;
                if ($catID && $item->post_parent != 0) {
                    $a = wt_get_category_count($catID);
                    $items[$key]->title .= '<span class="menu_num">' . $a . '</span>';
                }
            }
        }
    }
    return $items;
}

//移除谷歌加载字体
add_filter('gettext_with_context', 'disable_open_sans', 888, 4);
function disable_open_sans($translations, $text, $context, $domain)
{
    if ('Open Sans font: on or off' == $context && 'on' == $text) {
        $translations = 'off';
    }
    return $translations;
}

//去掉归档页面的 "分类："和"标签："
add_filter("get_the_archive_title", "my_theme_archive_title");
function my_theme_archive_title($title)
{
    if (is_category()) {
        $title = single_cat_title("", false);
    } elseif (is_tag()) {
        $title = single_tag_title("", false);
    } elseif (is_author()) {
        $title = "<span class=\"vcard\">" . get_the_author() . "</span>";
    } elseif (is_post_type_archive()) {
        $title = post_type_archive_title("", false);
    } elseif (is_tax()) {
        $title = single_term_title("", false);
    }
    return $title;
}

add_action('save_post', 'auto_add_tags');
function auto_add_tags()
{
    //移除所有缓存
    wp_cache_flush();
    //新增文章不自动添加标签
//    $tags = get_tags(array('hide_empty' => false));
//    $post_id = get_the_ID();
//    $post_content = get_post($post_id)->post_content;
//
//    if ($tags) {
//        $i = 0;
//        $arrs = object2array($tags);
//        shuffle($arrs);
//        $tags = array2object($arrs);// 打乱顺序
//        foreach ($tags as $tag) {
//            if (strpos($post_content, $tag->name) !== false) {
//                if ($i == 5) { // 控制输出数量
//                    break;
//                }
//                wp_set_post_tags($post_id, $tag->name, true);
//                $i++;
//            }
//        }
//    }
}
/*
//自动为文章内的标签添加内链
$match_num_from = 1;        //一篇文章中同一个标签少于几次不自动链接
$match_num_to = 1;      //一篇文章中同一个标签最多自动链接几次
function tag_sort($a, $b)
{
    if ($a->name == $b->name) return 0;
    return (strlen($a->name) > strlen($b->name)) ? -1 : 1;
}

function tag_link($content)
{
    global $match_num_from, $match_num_to;
    $posttags = get_the_tags();
    if ($posttags) {
        usort($posttags, "tag_sort");
        foreach ($posttags as $tag) {
            $link = get_tag_link($tag->term_id);
            $keyword = $tag->name;
            $cleankeyword = stripslashes($keyword);
            $url = "<a href=\"$link\" title=\"" . str_replace('%s', addcslashes($cleankeyword, '$'), __('【查看更多[%s]标签的文章】')) . "\"";
            $url .= ' target="_blank"';
            $url .= ">" . addcslashes($cleankeyword, '$') . "</a>";
            $limit = rand($match_num_from, $match_num_to);
            $content = preg_replace('|(<a[^>]+>)(.*)(' . $ex_word . ')(.*)(</a[^>]*>)|U' . $case, '$1$2%&&&&&%$4$5', $content);
            $content = preg_replace('|(<img)(.*?)(' . $ex_word . ')(.*?)(>)|U' . $case, '$1$2%&&&&&%$4$5', $content);
            $cleankeyword = preg_quote($cleankeyword, '\'');
            $regEx = '\'(?!((<.*?)|(<a.*?)))(' . $cleankeyword . ')(?!(([^<>]*?)>)|([^>]*?</a>))\'s' . $case;
            $content = preg_replace($regEx, $url, $content, $limit);
            $content = str_replace('%&&&&&%', stripslashes($ex_word), $content);
        }
    }
    return $content;
}

add_filter('the_content', 'tag_link', 1);
*/
//子主题版本
function _the_theme_child_version()
{
    $current_theme = wp_get_theme();
    return $current_theme->get('Version') . ' %c https://zyfx8.cn';
}






