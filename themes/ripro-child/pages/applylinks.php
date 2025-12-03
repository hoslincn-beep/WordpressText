<?php
/**
 * Template name: 自助申请友链
 * Description:   www.zyfx8.cn 资源分享吧
 * Author   老雷
 */
?>
<?php
if (isset($_POST['blink_form']) && $_POST['blink_form'] == 'send') {
    global $wpdb;

// 表单变量初始化
    $link_name = isset($_POST['blink_name']) ? trim(htmlspecialchars($_POST['blink_name'], ENT_QUOTES)) : '';
    $link_url = isset($_POST['blink_url']) ? trim(htmlspecialchars($_POST['blink_url'], ENT_QUOTES)) : '';
    $link_description = isset($_POST['blink_lianxi']) ? trim(htmlspecialchars($_POST['blink_lianxi'], ENT_QUOTES)) : ''; // 联系方式
    $link_target = "_blank";
    $link_visible = "N"; // 表示链接默认不可见

// 表单项数据验证
    if (empty($link_name) || mb_strlen($link_name) > 20) {
        wp_die('连接名称必须填写，且长度不得超过30字');
    }

    if (empty($link_url) || strlen($link_url) > 60 || !preg_match("/^(https?:\/\/)?(((www\.)?[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)?\.([a-zA-Z]+))|(([0-1]?[0-9]?[0-9]|2[0-5][0-5])\.([0-1]?[0-9]?[0-9]|2[0-5][0-5])\.([0-1]?[0-9]?[0-9]|2[0-5][0-5])\.([0-1]?[0-9]?[0-9]|2[0-5][0-5]))(\:\d{0,4})?)(\/[\w\- .\/?%&=]*)?$/i", $link_url)) { //验证url
        wp_die('链接地址必须填写');
    }

    $sql_link = $wpdb->insert(
        $wpdb->links,
        array(
            'link_name' => '【待审核】--- ' . $link_name,
            'link_url' => $link_url,
            'link_target' => $link_target,
            'link_description' => $link_description,
            'link_visible' => $link_visible
        )
    );
    $result = $wpdb->get_results($sql_link);
    wp_die('亲，友情链接提交成功，【等待站长审核中】！<p><a href="/">点此返回</a>', '提交成功');
}
get_header();
?>
    <div id="main">
        <div class="container">
            <div class="post-yqlj">
                <div class="col-lg-6 col-12">
                    <!--表单开始-->
                    <form method="post" class="mt20" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">

                        <div class="form-group">
                            <label for="blink_name"><font color="red">*</font> 链接名称:</label>
                            <input type="text" size="40" value="" class="form-control" id="blink_name"
                                   placeholder="请输入链接名称，且长度不得超过30字" name="blink_name"/>
                        </div>

                        <div class="form-group">
                            <label for="blink_url"><font color="red">*</font> 链接地址:</label>
                            <input type="text" size="40" value="" class="form-control" id="blink_url"
                                   placeholder="请输入链接地址，不要忘了https://" name="blink_url"/>
                        </div>

                        <div class="form-group">
                            <label for="blink_lianxi">联系QQ:</label>
                            <input type="text" size="40" value="" class="form-control" id="blink_lianxi"
                                   placeholder="请输入联系QQ" name="blink_lianxi"/>
                        </div>

                        <div>
                            <input type="hidden" value="send" name="blink_form"/>
                            <button type="submit" class="btn btn-primary">提交申请</button>
                            <button type="reset" class="btn btn-default">重填</button>
                            （提示：带有<font color="red">*</font>，表示必填项~）
                        </div>
                    </form>
                    <!--表单结束-->
                </div>

                <div class="col-lg-6 col-12">
                    <?php if (have_posts()) : while (have_posts()) :
                    the_post(); ?>
                    <article class="col-md-10 mt20 col-md-offset-2 view clearfix">
                        <p class="mt20">欢迎同类站点与本站交换友情链接，要求有权重有排名，收录良好的，内容健康，内容相关更佳。</p> <!--根据自身修改-->
                        <p class="mt20"><strong>友链自助申请须知</strong></p> <!--根据自身修改-->
                        <p>&#x2714; 申请前请先加上本站链接；</p> <!--根据自身修改-->
                        <p>&#x2714; 稳定更新，每月至少发布10篇文章，最好是建站一年以上；</p> <!--根据自身修改-->
                        <p>&#x2714; 禁止一切产品黄赌毒，营销、广告联盟类型的网站，优先通过同类原创、内容相近的网站；</p> <!--根据自身修改-->
                        <p class="mt20"><strong>本站链接信息</strong></p> <!--根据自身修改-->
                        <p>名称：<?php echo get_bloginfo('name'); ?>（<?php echo get_bloginfo('url'); ?>）</p> <!--根据自身修改-->
                        <p>网址：<a style="font-weight: bolder;color: #FFF;"
                                 href="<?php echo get_bloginfo('url'); ?>"><?php echo get_bloginfo('url'); ?></a></p>
                        <!--根据自身修改-->
                    </article>
                </div>

                <?php endwhile; else: ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php get_footer(); ?>