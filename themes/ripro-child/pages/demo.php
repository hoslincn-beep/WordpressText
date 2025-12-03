<?php
/*
 * emplate Name: 演示页面
 * Description:   www.zyfx8.cn 资源分享吧
 * Author   老雷
 */
$sidebar_childripro_kefu_info = _cao('sidebar_childripro_kefu_info');
$qq_kefu = isset($sidebar_childripro_kefu_info['qq_kefu']);

$home_mode_vip = _cao('home_vip_mod');
$post_id = !empty($_GET['post_id']) ? (int)$_GET['post_id'] : 0;
$cao_is_demo_img = get_post_meta($post_id, 'cao_is_demo_img', true);
$cao_demo_img_info = get_post_meta($post_id, 'cao_demo_img_info', true);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="<?php echo _cao('site_favicon') ?>" rel="icon">
    <title><?php echo get_the_title($post_id); ?></title>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/demo/jquery-2.2.4.min.js"
            type="text/javascript"></script>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/demo/demo.min.js" type="text/javascript"></script>
    <link type="text/css" rel="stylesheet"
          href="<?php echo get_stylesheet_directory_uri(); ?>/assets/demo/demo.min.css"/>
</head>
<body>
<div class="head">
    <div class="tab_t">
        <div class="td_t">
            「 本网页内容、图片、视频为模板演示数据，如有涉及侵犯版权，请联系我们在线客服，提供书面反馈，我们核实后会立即删除。 」
        </div>
    </div>
    <div class="tab">
        <div class="td_l">
            <h1><a <?php echo _target_blank(); ?>
                        href="<?php echo esc_url(get_permalink($post_id)); ?>"><?php echo get_the_title($post_id); ?></a>
                - 图片演示</h1>

        </div>
        <div class="td_r"><a title="资源详情" <?php echo _target_blank(); ?>
                             href="<?php echo esc_url(get_permalink($post_id)); ?>">资源详情</a><a title="在线客服"
                                                                                               target="_blank"
                                                                                               href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $qq_kefu; ?>&site=qq&menu=yes">在线客服</a>
        </div>
    </div>
    <div class="bg"></div>
    <div class="list">
        <?php if ($cao_demo_img_info) {
            $num = 0;
            foreach ($cao_demo_img_info as $value) {
                $type = 0;//默认图片100%显示
                $num++;
                if ($num == 1) {
                    $class = 'on';
                } else {
                    $class = '';
                }
                echo '<a class="' . $class . '" href="javascript:void(0);" data-type="' . $type . '" dimg="' . $value['image'] . '">' . $value['title'] . '</a>';
            }
        };
        ?>
    </div>
    <div class="cl"></div>
</div>
<div class="xgt">
    <?php
    echo '<img class="' . $class . '" src="' . $cao_demo_img_info[0]['image'] . '" title="' . $cao_demo_img_info[0]['title'] . '" alt="' . $cao_demo_img_info[0]['title'] . '" />';
    ?>
</div>
</body>
</html>