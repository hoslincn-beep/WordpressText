<div class="shortcodes_control">
    <p>
        <?php _e( '如果你想要使用短代码请选择短代码选项：', 'wpfans'); ?>
    </p>
    <div>
        <label>
            <?php _e( '选择短代码', 'wpfans'); ?><span></span></label>
        <select name="items" class="shortcode_sel" size="1" onchange="document.forms.post.items_accumulated.value = this.options[selectedIndex].value;">

            <option class="parentscat">
                <?php _e( '1.提示框', 'wpfans'); ?>
            </option>
            <option value="[wm_error]<?php _e('这里输入内容','wpfans'); ?>[/wm_error]">
                <?php _e( '红色错误框', 'wpfans'); ?>
            </option>
            <option value="[wm_warn]<?php _e('这里输入内容','wpfans'); ?>[/wm_warn]">
                <?php _e( '黄色警告框', 'wpfans'); ?>
            </option>
            <option value="[wm_tips]<?php _e('这里输入内容','wpfans'); ?>[/wm_tips]">
                <?php _e( '蓝色计划框', 'wpfans'); ?>
            </option>
            <option value="[wm_notice]<?php _e('这里输入内容','wpfans'); ?>[/wm_notice]">
                <?php _e( '绿色提醒框', 'wpfans'); ?>
            </option>

            <option class="parentscat">
                <?php _e( '3.文本框', 'wpfans'); ?>
            </option>
            <option value="[wm_kuang title=&quot;标题&quot;]<?php _e('这里输入内容','wpfans'); ?>[/wm_kuang]">
                <?php _e( '虚线标题框', 'wpfans'); ?>
            </option>
            <option value="[wm_xuk]<?php _e('这里输入内容','wpfans'); ?>[/wm_xuk]">
                <?php _e( '虚线文本框', 'wpfans'); ?>
            </option>
            <option value="[wm_red]<?php _e('这里输入内容','wpfans'); ?>[/wm_red]">
                <?php _e( '红边文本框', 'wpfans'); ?>
            </option>
            <option value="[wm_yellow]<?php _e('这里输入内容','wpfans'); ?>[/wm_yellow]">
                <?php _e( '黄边文本框', 'wpfans'); ?>
            </option>
            <option value="[wm_blue]<?php _e('这里输入内容','wpfans'); ?>[/wm_blue]">
                <?php _e( '蓝边文本框', 'wpfans'); ?>
            </option>
            <option value="[wm_green]<?php _e('这里输入内容','wpfans'); ?>[/wm_green]">
                <?php _e( '绿边文本框', 'wpfans'); ?>
            </option>

            <option class="parentscat">
                <?php _e( '2.按钮', 'wpfans'); ?>
            </option>
            <option value="[wm_wpbutton link=&quot;#&quot; target=&quot;blank&quot; variation=&quot;red&quot;]<?php _e('这里输入内容','wpfans'); ?>[/wm_wpbutton]">
                <?php _e( '红色', 'wpfans'); ?>
            </option>
            <option value="[wm_wpbutton link=&quot;#&quot; target=&quot;blank&quot; variation=&quot;yellow&quot;]<?php _e('这里输入内容','wpfans'); ?>[/wm_wpbutton]">
                <?php _e( '黄色', 'wpfans'); ?>
            </option>
            <option value="[wm_wpbutton link=&quot;#&quot; target=&quot;blank&quot; variation=&quot;blue&quot;]<?php _e('这里输入内容','wpfans'); ?>[/wm_wpbutton]">
                <?php _e( '蓝色', 'wpfans'); ?>
            </option>
            <option value="[wm_wpbutton link=&quot;#&quot; target=&quot;blank&quot; variation=&quot;green&quot;]<?php _e('这里输入内容','wpfans'); ?>[/wm_wpbutton]">
                <?php _e( '绿色', 'wpfans'); ?>
            </option>

            <option class="parentscat">
                <?php _e( '4.内容隐藏', 'wpfans'); ?>
            </option>
            <option value="[wm_reply]<?php _e('评论后可见内容','wpfans'); ?>[/wm_reply]">
                <?php _e( '评论后可见内容', 'wpfans'); ?>
            </option>
            <option value="[wm_login]<?php _e('登录后可见内容','wpfans'); ?>[/wm_login]">
                <?php _e( '登录后可见内容', 'wpfans'); ?>
            </option>
            <option value="[wm_gzh keyword=&quot;关键字&quot; key=&quot;验证码&quot;]<?php _e('关注微信可见内容','wpfans'); ?>[/wm_gzh]">
                <?php _e( '关注微信可见内容', 'wpfans'); ?>
            </option>
          
            <option class="parentscat">
                <?php _e( '5.内容收缩', 'wpfans'); ?>
            </option>
            <option value="[wm_tabgroup][wm_tab title=&quot;<?php _e('标题','wpfans'); ?> 1&quot; id=&quot;1&quot;]<?php _e('内容','wpfans'); ?> 1[/wm_tab][wm_tab title=&quot;<?php _e('标题','wpfans'); ?> 2&quot; id=&quot;2&quot;]<?php _e('内容','wpfans'); ?> 2[/wm_tab] [wm_tab title=&quot;<?php _e('标题','wpfans'); ?> 3&quot; id=&quot;3&quot;]<?php _e('内容','wpfans'); ?> 3[/wm_tab][/wm_tabgroup]">
            <?php _e( 'TABS选项', 'wpfans'); ?>
            </option>
            <option value="[wm_toggle_box][wm_toggle_item title=&quot;<?php _e('标题','wpfans'); ?> 1&quot; active=&quot;true&quot;]<?php _e('内容','wpfans'); ?> 1[/wm_toggle_item][wm_toggle_item title=&quot;<?php _e('标题','wpfans'); ?> 2&quot;]<?php _e('内容','wpfans'); ?> 2[/wm_toggle_item][wm_toggle_item title=&quot;<?php _e('标题','wpfans'); ?> 3&quot;]<?php _e('内容','wpfans'); ?> 3[/wm_toggle_item][/wm_toggle_box]">
                <?php _e( '开关菜单', 'wpfans'); ?>
            </option>
            <option value="[wm_collapse title=&quot;阅读全文&quot;][/wm_collapse]">
                <?php _e( '阅读全文', 'wpfans'); ?>
            </option>
        </select>
        <label>
            <?php _e( '短代码预览', 'wpfans'); ?><br><span><?php _e('注：复制短代码到编辑器(可视模式)中，修改成自己的内容即可。','wpfans'); ?></span></label>
        <p>
            <textarea name="items_accumulated" rows="5"></textarea>
        </p>
    </div>
</div>