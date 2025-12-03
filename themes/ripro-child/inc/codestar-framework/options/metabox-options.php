<?php if (!defined('ABSPATH')) {
    die;
} // Cannot access directly.

/**
 * [ripro_child_post_options 子主题文章选项]
 * @Author   老雷
 * @DateTime 2020/12/04
 * @Url      www.zyfx8.cn 资源分享吧
 */
add_action('after_setup_theme', 'ripro_child_post_options');
function ripro_child_post_options()
{
    $prefix_post_opts = '_cao_ripro_child_post_options';
    CSF::createMetabox($prefix_post_opts, array(
        'title' => '<span class="badge badge-radius badge-primary"><i class="fa fa-codiepie"></i> 子主题</span>启动模块',
        'post_type' => 'post',
        'data_type' => 'unserialize',
        'priority' => 'high',
    ));
    CSF::createSection($prefix_post_opts, array(
        'fields' => array(
            array(
                'id' => 'cao_is_demo_img',
                'type' => 'switcher',
                'title' => '启用图片演示',
                'desc' => '用图片展示资源实际效果，权限高于父主题的演示地址',
                'default' => _cao('cao_is_demo_img', false),
            ),
            array(
                'id' => 'cao_demo_img_info',
                'type' => 'repeater',
                'title' => '演示信息',
                'fields' => array(
                    array(
                        'id' => 'title',
                        'type' => 'text',
                        'title' => '演示标题',
                        'default' => '演示标题',
                    ),
                    array(
                        'id' => 'image',
                        'type' => 'upload',
                        'title' => '演示图片',
                        'desc' => '上传演示模块图片',
                    ),
                ),
                'default' => _cao('cao_demo_img_info', array()),
                'dependency' => array('cao_is_demo_img', '==', 'true'),
            ),
            array(
                'id' => 'cao_is_article_type',
                'type' => 'switcher',
                'title' => '启用文章类型',
                'desc' => '专属文章独特标签，展示在首页或文章页',
                'default' => _cao('cao_is_article_type', false),
            ),
            array(
                'id' => 'cao_article_type_info',
                'type' => 'fieldset',
                'title' => '文章类型',
                'fields' => array(
                    array(
                        'id' => '_tag',
                        'type' => 'text',
                        'title' => '自定义标签',
                        'desc' => '格式：原创/转载/精华/推荐/已测/未测/特惠/独家',
                        'placeholder' => '输入文章标签',
                        'default' => '',
                    ),
                    array(
                        'id' => '_color',
                        'type' => 'radio',
                        'title' => '颜色选择',
                        'inline' => true,
                        'options' => array(
                            '#007bff' => '蓝色',
                            '#FF9800' => '橙色',
                            '#fb1408' => '红色',
                            '#4CAF50' => '绿色',
                            '#9E9E9E' => '灰色',
                        ),
                        'default' => '#007bff',
                    ),
                ),
                'dependency' => array('cao_is_article_type', '==', 'true'),
            ),
            array(
                'id' => 'cao_article_tips',
                'type' => 'text',
                'title' => '文章提示消息',
                'desc' => '已更新或已测试等提示，为空不显示',
                'default' => _cao('cao_article_tips'),
            ),

        ),
    ));
}