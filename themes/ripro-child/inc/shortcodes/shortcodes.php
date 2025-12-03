<?php
// 2.0版本
add_filter( 'widget_text', 'shortcode_unautop');
add_filter( 'widget_text', 'do_shortcode');

// 一、提示框
////////////////////////////////////////////////////////////

//1.红色错误框
function error($atts, $content=null, $code="") {
  $return = '<div class="werror">';
  $return .= do_shortcode($content);
  $return .= '</div>';
  return $return;
}
add_shortcode('wm_error' , 'error' );
//简码：[wm_error]这里输入内容[/wm_error]

//2.绿色提醒框
function notice($atts, $content=null, $code="") {
  $return = '<div class="wnotice">';
  $return .= do_shortcode($content);
  $return .= '</div>';
  return $return;
}
add_shortcode('wm_notice' , 'notice' );
//简码：[wm_notice]这里输入内容[/wm_notice]

//3.黄色警告框
function warn($atts, $content=null, $code="") {
  $return = '<div class="wwarn">';
  $return .= do_shortcode($content);
  $return .= '</div>';
  return $return;
}
add_shortcode('wm_warn' , 'warn' );
//简码：[wm_warn]这里输入内容[/wm_warn]

//4.蓝色计划框
function tips($atts, $content=null, $code="") {
  $return = '<div class="wtips">';
  $return .= do_shortcode($content);
  $return .= '</div>';
  return $return;
}
add_shortcode('wm_tips' , 'tips' );
//简码：[wm_tips]远方的雪山[/wm_tips]


// 二、文本框
////////////////////////////////////////////////////////////

//1.虚线标题框
function wpkuang($atts, $content = null, $code="") {
    extract(shortcode_atts(array( "title" => "" ) , $atts));
    return '<div class="wfieldset"> <tt>' . $title . '</tt><a>' . $content . '</a></div>';
}
add_shortcode('wm_kuang', 'wpkuang');

//2.虚线文本框
function xuk($atts, $content=null, $code="") {
  $return = '<div class="wxuk">';
  $return .= do_shortcode($content);
  $return .= '</div>';
  return $return;
}
add_shortcode('wm_xuk' , 'xuk' );
//简码：[wm_xuk]这里输入内容[/wm_xuk]

//3.红边提示框
function red($atts, $content=null, $code="") {
  $return = '<div class="wred">';
  $return .= do_shortcode($content);
  $return .= '</div>';
  return $return;
}
add_shortcode('wm_red' , 'red' );
//简码：[wm_red]这里输入内容[/wm_red]

//4.黄边提示框
function yellow($atts, $content=null, $code="") {
  $return = '<div class="wyellow">';
  $return .= do_shortcode($content);
  $return .= '</div>';
  return $return;
}
add_shortcode('wm_yellow' , 'yellow' );
//简码：[wm_yellow]这里输入内容[/wm_yellow]

//5.蓝边提示框
function blue($atts, $content=null, $code="") {
  $return = '<div class="wblue">';
  $return .= do_shortcode($content);
  $return .= '</div>';
  return $return;
}
add_shortcode('wm_blue' , 'blue' );
//简码：[wm_blue]这里输入内容[/wm_blue]

//6.绿边提示框
function green($atts, $content=null, $code="") {
  $return = '<div class="wgreen">';
  $return .= do_shortcode($content);
  $return .= '</div>';
  return $return;
}
add_shortcode('wm_green' , 'green' );
//简码：[wm_green]这里输入内容[/wm_green]


// 三、按钮
////////////////////////////////////////////////////////////

function wpbutton( $atts, $content = null ) {
    extract(
        shortcode_atts(
            array(
                'link'      => '#',
                'target'    => '',
                'variation' => '',
                'size'      => '',
                'align'     => '',
            ),
            $atts
        )
    );

  $style = ($variation) ? ' '.$variation : '';
  $align = ($align) ? ' align'.$align : '';
  $size = ($size == 'large') ? ' large_button' : '';
  $target = ($target == 'blank') ? 'target="_blank"' : '';

  $out = '<a '.$target.' class="wpbutton '.$style.$size.$align.'" href="'.$link.'">'.do_shortcode($content).'</a>';

    return $out;
}
add_shortcode('wm_wpbutton', 'wpbutton');
//简码：[wm_wpbutton link="链接地址" size="large" align="right"]链接名称[/wm_wpbutton]


// 四、内容隐藏
////////////////////////////////////////////////////////////

//评论可见
function wp_reply_to_read($atts, $content=null) {
    extract(
        shortcode_atts(
            array(
                "notice" => '<div class="whidebox">抱歉，隐藏内容须成功<a href="' . get_permalink() . '#respond" title="评论本文"> 评论本文 </a>后刷新可见！</div>'
            ),
            $atts
        )
    );
    $email = null;
    $user_ID = (int) wp_get_current_user()->ID;
    if ($user_ID > 0) {
        $email = get_userdata($user_ID)->user_email;
        //对博主直接显示内容
        $admin_email = get_bloginfo ( 'admin_email' ); //博主Email
        if ($email == $admin_email) {
            return do_shortcode($content);
        }
    } else if (isset($_COOKIE['comment_author_email_' . COOKIEHASH])) {
        $email = str_replace('%40', '@', $_COOKIE['comment_author_email_' . COOKIEHASH]);
    } else {
        return $notice;
    }
    if (empty($email)) {
        return $notice;
    }
    global $wpdb;
    $post_id = get_the_ID();
    $query = "SELECT `comment_ID` FROM {$wpdb->comments} WHERE `comment_post_ID`={$post_id} and `comment_approved`='1' and `comment_author_email`='{$email}' LIMIT 1";
    if ($wpdb->get_results($query)) {
        return do_shortcode($content);
    } else {
        return $notice;
    }
}
add_shortcode('wm_reply', 'wp_reply_to_read'); 
//简码：wm_reply]评论后可见内容[/wm_reply]

//登录可见
function wp_login_to_read($atts, $content = null) {
	extract(shortcode_atts(array("notices" =>'
	<div class="whidebox">抱歉，隐藏内容须成功<a href="' .site_url(). '/login" etap="login_btn" title="登录"> 登录 </a>后刷新可见！</div>'), $atts));
	if (is_user_logged_in()) {
		return do_shortcode( $content );
	} else {
		return $notices;
	}
}
add_shortcode('wm_login', 'wp_login_to_read');
//简码：[wm_login]只有用户才能看到的内容[/wm_login]

//关注微信公众号可见
function secrets_content($atts, $content=null){
	$qrcode = get_stylesheet_directory_uri().'/inc/shortcodes/img/qrcode_gzh.jpg';
    extract(shortcode_atts(array('key'=>null,'keyword'=>null), $atts));
    if(isset($_POST['secret_key']) && $_POST['secret_key']==$key){
        return '<div class="secret-password-content">'.$content.'<i title="私密内容" class="fa fa-lock secret-icon"></i></div>';
    } else {
        return 
            '<div class="post_hide_box">
             <img class="gzh-erweima"  src="'.$qrcode.'"  title="微信公众号：WordPress爱好者"><div class="post-secret-info"><i class="fa fa-exclamation-circle"></i>此处内容已经被作者无情的隐藏，请输入验证码查看内容</div>
             <form action="'.get_permalink().'" method="post"> 
             <span>验证码：</span><input id="pwbox" type="password" size="20" name="secret_key">
             <a class="a2" href="javascript:;"><input type="submit" value="提交" name="Submit"></a>
             </form>
             <div class="post-secret-notice">请关注“WordPress爱好者”官方微信公众号，回复关键字“<span>'.$keyword.'</span>”，获取验证码。</br>注：用手机微信扫描右侧二维码或微信搜索“WordPress爱好者”即可关注哦！</div>
             </div>';
    }
}
add_shortcode('wm_gzh', 'secrets_content');
//简码：[wm_gzh]只有用户才能看到的内容[/wm_gzh]

// 五、内容收缩
////////////////////////////////////////////////////////////

//1. Tabs选项
function wp_tab_group( $atts, $content=null ){
$GLOBALS['wp_tab_count'] = 0;
do_shortcode( $content );
if( is_array( $GLOBALS['wp-tabs'] ) ){
foreach( $GLOBALS['wp-tabs'] as $tab ){
$tabs[] = '<li><a href="#'.$tab['id'].'">'.$tab['title'].'</a></li>';
$panes[] = '<div id="'.$tab['id'].'">'.$tab['content'].'</div>';
}
$return = "\n".'<div id="wp-tabwrap"><ul id="wp-tabs">'.implode( "\n", $tabs ).'</ul>'."\n".'<div id="wp_tab_content">'.implode( "\n", $panes ).'</div></div>'."\n";
}
return $return;
}
add_shortcode( 'wm_tabgroup', 'wp_tab_group' );

function wp_scd_tab( $atts, $content=null ){
extract(shortcode_atts(array(
'title' => 'wp-tab %d',
'id' => ''
), $atts));
$x = $GLOBALS['wp_tab_count'];
$GLOBALS['wp-tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['wp_tab_count'] ), 'content' =>  $content, 'id' =>  $id );
$GLOBALS['wp_tab_count']++;
}
add_shortcode( 'wm_tab', 'wp_scd_tab' );
//简码：[wm_tabgroup][wm_tab title="标题 1" id="1"]内容 1[/wm_tab][wm_tab title="标题 2" id="2"]内容 2[/wm_tab] [wm_tab title="标题 3" id="3"]内容 3[/wm_tab][/wm_tabgroup]

//2.开关菜单
  function wp_toggle_box_shortcode( $atts, $content = null ){  
    $toggle_box = "<ul class='wp-toggle-box'>";
    $toggle_box = $toggle_box . do_shortcode($content);
    $toggle_box = $toggle_box . "</ul>";
    return $toggle_box;
  }
  add_shortcode('wm_toggle_box', 'wp_toggle_box_shortcode');

  function wp_toggle_item_shortcode( $atts, $content = null ){
    extract( shortcode_atts(array("title" => '', "active" => 'false'), $atts) );    
    $active = ( $active == "true" )? " active": '';
    $toggle_item = "<li>";
    $toggle_item = $toggle_item . "<h3 class='wp-toggle-box-head'>";
    $toggle_item = $toggle_item . "<i class='icon-toggle ".$active."'></i><span class='".$active."'>"; 
    $toggle_item = $toggle_item . $title . "</span></h3>";
    $toggle_item = $toggle_item . "<div class='wp-toggle-box-content" . $active . "'>" . do_shortcode($content) . "</div>";
    $toggle_item = $toggle_item . "</li>";
    return $toggle_item; 
  } 
  add_shortcode('wm_toggle_item', 'wp_toggle_item_shortcode');
//简码：[wm_toggle_box][wm_toggle_item title="标题" active="true"]内容[/wm_toggle_item][wm_toggle_item title="标题"]内容[/wm_toggle_item][wm_toggle_item title="标题"]内容[/wm_toggle_item][wm_toggle_item title="标题"]内容[/wm_toggle_item][/wm_toggle_box]

//3. 阅读全文  
function wpcollapse($atts, $content = null){
	extract(shortcode_atts(array(""),$atts));
	return '<div style="position:relative">
			    <div class="hidecontent" style="display:none">'.$content.'</div>
		            <a class="hidetitle">
                    <button class="collapseButton">阅读全文</button>
                </a>
	</div>';
}
add_shortcode('wm_collapse', 'wpcollapse');

//4. 卡片内链
function wp_embed_posts( $atts, $content = null ){
extract( shortcode_atts( array(
'ids' => ''
),
$atts ) );
global $post;
$content = '';
$postids = explode(',', $ids);
$inset_posts = get_posts(array('post__in'=>$postids));
$category = get_the_category();
foreach ($inset_posts as $key => $post) {
setup_postdata( $post );
$content .= '<span class="wp-embed-card">
<a target="_blank" href="'.get_category_link($category[0]->term_id ).'"><span class="wp-embed-card-category">'. $category[0]->cat_name .'</span></a>
<span class="wp-embed-card-img">
<a target="_blank" href="' . get_permalink() . '"><img alt="'. get_the_title() . '" src="'._get_post_thumbnail_url().'"></a>
</span>
<span class="wp-embed-card-info">
<a target="_blank" href="' . get_permalink() . '">
<span class="wp-card-name">'. get_the_title() . '</span>
</a>
<span class="wp-card-abstract">'.wp_trim_words( get_the_excerpt(), 100, '...' ).'</span>
<span class="wp-card-controls">
<span class="wp-group-data"> <i>时间:</i>'. get_the_time('Y/n/j') .'</span>
<span class="wp-group-data"> <i>阅读:</i>'._get_post_views().'</span>
<a target="_blank" href="' . get_permalink() . '"><span class="wp-card-btn-deep">阅读全文</span></a>
</span>
</span>
</span>';
}
wp_reset_postdata();
return $content;
}
add_shortcode('wm_embed_post', 'wp_embed_posts');