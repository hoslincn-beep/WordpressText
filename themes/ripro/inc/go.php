<?php
if (!defined('ABSPATH')) {die;} // Cannot access directly.
/**
 * RiPro是一个优秀的主题，首页拖拽布局，高级筛选，自带会员生态系统，超全支付接口，你喜欢的样子我都有！
 * 正版唯一购买地址，全自动授权下载使用：https://ritheme.com/
 * 作者唯一QQ：200933220 （油条）
 * 承蒙您对本主题的喜爱，我们愿向小三一样，做大哥的女人，做大哥网站中最想日的一个。
 * 能理解使用盗版的人，但是不能接受传播盗版，本身主题没几个钱，主题自有支付体系和会员体系，盗版风险太高，鬼知道那些人乱动什么代码，无利不起早。
 * 开发者不易，感谢支持，更好的更用心的等你来调教
 */

/**
 * 下载地址加密flush shangche
 *
 */
header("Content-type:text/html;character=utf-8");
global $current_user;

$post_id = !empty($_GET['post_id']) ? (int)$_GET['post_id'] : 0;
$ref = !empty($_GET['ref']) ? (int)$_GET['ref'] : 0;
$type = isset($_GET['type']) ? intval($_GET['type']) : null; // 新增：下载类型（0=夸克,1=阿里, null/其他=默认百度）

if (!$post_id && !$ref) {
    cao_wp_die('URL参数错误','地址错误或者URL参数错误');
}

// helper: 增加文章下载计数（cao_paynum）
function ripro_increment_paynum($post_id) {
    $before_paynum = get_post_meta($post_id, 'cao_paynum', true);
    update_post_meta($post_id, 'cao_paynum', (int) $before_paynum + 1);
}

// 计算剩余到当天结束的时间（用于 cookie 过期）
function ripro_cookie_expire_till_midnight() {
    $now = time();
    // 到当天 23:59:59 的剩余秒数
    $tomorrow = strtotime('tomorrow', $now);
    return $tomorrow;
}

// 下载处理（包含 type 区分）
if (isset($post_id) && empty($ref)):
    $uid = $current_user->ID;
    $RiProPayAuth = new RiProPayAuth($uid,$post_id);

    $cao_is_post_free = $RiProPayAuth->cao_is_post_free();
    if (!is_user_logged_in() && !_cao('is_ripro_nologin_pay','1')) {
        cao_wp_die('请登录下载','请登录后下载资源包');
    }
    if ($cao_is_post_free && !is_user_logged_in() && !_cao('is_ripro_free_no_login')) {
        cao_wp_die('请登录下载','免费资源请登录后进行下载');
    }
    
    // 判断是否有权限下载
    $CaoUser = new CaoUser($uid);
    $PostPay = new PostPay($uid, $post_id);

    // 根据 type 选择实际下载地址字段
    // type === 1 -> cao_downurl_bak (阿里云盘)
    // type === 0 -> cao_downurl_quark (夸克云盘)
    // default -> cao_downurl (百度网盘或默认)
    if ($type === 1) {
        $_downurl = get_post_meta($post_id, 'cao_downurl_bak', true);
    } elseif ($type === 0) {
        $_downurl = get_post_meta($post_id, 'cao_downurl_quark', true);
    } else {
        $_downurl = get_post_meta($post_id, 'cao_downurl', true);
    }

    $home_url=esc_url(home_url());
    // 本地文件做处理
    if(strpos($_downurl,$home_url) !== false){ 
    	$parse_url = parse_url($_downurl);
    	$_downurl  =$parse_url['path'];
	}

    // --- 新增：检查每日下载次数限制并维护 today_down_num / over_down_num ---
    // 区分登录用户和游客逻辑：
    $is_guest = !is_user_logged_in() || !$uid;
    if ($is_guest) {
        // 游客硬编码每日限制为 10（按你要求写在 go.php）
        $guest_limit = 10;
        // 使用 cookie 来统计游客当日下载次数（按日清零）
        $cookie_name = 'ripro_guest_down_' . date('Ymd');
        $guest_count = isset($_COOKIE[$cookie_name]) ? intval($_COOKIE[$cookie_name]) : 0;
        if ($guest_count >= $guest_limit) {
            cao_wp_die('下载次数超出限制','今日下载次数已用：'.$guest_count.'次,剩余下载次数：0');
            exit;
        }
        // 当准备发放下载时，先 +1 cookie（若允许）
        $guest_count++;
        setcookie($cookie_name, $guest_count, ripro_cookie_expire_till_midnight(), COOKIEPATH ? COOKIEPATH : '/');
        // 维护游客的 today_down_num / over_down_num 写入为文章 meta（如果你愿意可改为写入全局 option，但遵循你的字段需求）
        update_option('ripro_guest_today_down_num_' . date('Ymd'), $guest_count);
        update_option('ripro_guest_over_down_num_' . date('Ymd'), max(0, $guest_limit - $guest_count));
    } else {
        // 登录用户：复用现有 VIP / 下载次数逻辑
        $vip_status = $CaoUser->vip_status();
        $this_vip_downum = $CaoUser->cao_vip_downum($uid,$vip_status);
        // 期望 $this_vip_downum 至少包含：
        // 'is_down' (是否允许下载)， 'today_down_num' (今日已用)， 'over_down_num' (剩余)
        // 若该方法不存在对应字段，我们也做容错处理
        $today_used = isset($this_vip_downum['today_down_num']) ? intval($this_vip_downum['today_down_num']) : 0;
        $over = isset($this_vip_downum['over_down_num']) ? intval($this_vip_downum['over_down_num']) : 0;
        $is_allowed = isset($this_vip_downum['is_down']) ? (bool)$this_vip_downum['is_down'] : true;

        if (!$is_allowed) {
            cao_wp_die('下载次数超出限制','今日下载次数已用：'.$today_used.'次,剩余下载次数：'.$over);
            exit;
        }
        // 在真正开始下载之前，增加今日已用并写入用户 meta（以防外部直接统计失败）
        $new_today_used = $today_used + 1;
        $new_over = ($over - 1 >= 0) ? $over - 1 : 0;
        // 写入你要求的字段名
        update_user_meta($uid, 'today_down_num', $new_today_used);
        update_user_meta($uid, 'over_down_num', $new_over);
    }
    // --- 以上是下载次数校验与写入 ---

    // 核心权限判断（复用你原来的逻辑）
    if ($PostPay->isPayPost() || $cao_is_post_free) {
    	if(!is_user_logged_in() && _cao('is_ripro_nologin_pay','1')){
            // 未登录但允许免登陆下载（站点配置允许）
            // 增加文章下载计数与日志
            ripro_increment_paynum($post_id);
            $PostPay->add_down_log();
			$flush = _download_file($_downurl);
            exit();
		}
        // 判断会员类型 判断下载次数
        $vip_status = $CaoUser->vip_status();
        $this_vip_downum = $CaoUser->cao_vip_downum($uid,$vip_status);

        if ($this_vip_downum['is_down'] || $PostPay->isPayPost() ) {
            if (_cao('is_all_down_num','0') && !$this_vip_downum['is_down']) {
                cao_wp_die('下载次数超出限制','今日下载次数已用：'.$this_vip_downum['today_down_num'].'次,剩余下载次数：'.$this_vip_downum['over_down_num']);exit();
            }
            $is_add_down_log = false;
            //没有真实购买 但是使用免费权限下载 将计算下载次数
            if (!$PostPay->isPayPost() && $cao_is_post_free) {

                update_user_meta($uid, 'cao_vip_downum', $this_vip_downum['today_down_num'] + 1); //更新+1
                $is_add_down_log = $PostPay->add_down_log();
                 
                // 更新完成 更新资源销售数量 输出成功信息
                ripro_increment_paynum($post_id);
            } else {
                // 对于正常有购买或允许的下载，也确保文章下载数+1 和写日志
                ripro_increment_paynum($post_id);
                if (!_cao('is_all_down_num','0') || $is_add_down_log === false) {
                    $PostPay->add_down_log();
                }
            }

            // 再次保证 today_down_num/over_down_num（已在上面登录用户分支写过，但这里确保已购买用户也被计入）
            if (!$is_guest) {
                // 重新读取（容错）
                $this_vip_downum2 = $CaoUser->cao_vip_downum($uid,$vip_status);
                $today_used2 = isset($this_vip_downum2['today_down_num']) ? intval($this_vip_downum2['today_down_num']) : 0;
                $over2 = isset($this_vip_downum2['over_down_num']) ? intval($this_vip_downum2['over_down_num']) : 0;
                update_user_meta($uid, 'today_down_num', $today_used2);
                update_user_meta($uid, 'over_down_num', $over2);
            }

            # // 开始下载缓冲...
            $flush = _download_file($_downurl);
            exit();
        } else {
            // 不允许
            $today = isset($this_vip_downum['today_down_num']) ? $this_vip_downum['today_down_num'] : 0;
            $over = isset($this_vip_downum['over_down_num']) ? $this_vip_downum['over_down_num'] : 0;
            cao_wp_die('下载次数超出限制','今日下载次数已用：'.$today.'次,剩余下载次数：'.$over);
            exit;
        }
    	
    }else{
    	cao_wp_die('非法下载','您没有购买此资源或下载权限错误');
    }
endif;

// 开始推广地址处理（保留你原来的逻辑）
if (isset($ref) && empty($post_id)):
    $from_user_id = $ref;
    $_SESSION['cao_from_user_id'] = $from_user_id;
    header("Location:" . home_url());
    exit();
endif;
// 结束推广地址处理


cao_wp_die('地址错误或者URL参数错误','地址错误或者URL参数错误');
