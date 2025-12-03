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
$type = isset($_GET['type']) ? intval($_GET['type']) : null;

if (!$post_id && !$ref) {
    cao_wp_die('URL参数错误','地址错误或者URL参数错误');
}

// 获取客户端IP地址（支持CDN等代理情况）
function ripro_get_client_ip() {
    $ip = '';
    if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
        // CloudFlare
        $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
    } elseif (isset($_SERVER['HTTP_X_REAL_IP'])) {
        $ip = $_SERVER['HTTP_X_REAL_IP'];
    } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip_list = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $ip = trim($ip_list[0]);
    } elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

// 获取IP地址的哈希值（用于存储）
function ripro_get_ip_hash($ip) {
    return md5($ip . '_' . date('Ymd'));
}

// 获取用户类型和对应的每日下载限制
function ripro_get_user_download_limit($user_id = 0) {
    $is_guest = empty($user_id) || !is_user_logged_in();
    
    if ($is_guest) {
        return 10; // 游客限制为10次
    }
    
    // 获取用户VIP状态
    $CaoUser = new CaoUser($user_id);
    
    // 判断是否是永久VIP
    $is_boosvip = get_user_meta($user_id, 'cao_is_boosvip', true);
    
    if (!empty($is_boosvip) && $is_boosvip == '1') {
        return 30; // 永久VIP限制为30次
    }
    
    // 判断是否是普通VIP
    $vip_status = $CaoUser->vip_status();
    
    if ($vip_status) {
        return 20; // VIP用户限制为20次
    }
    
    return 10; // 普通登录用户限制为10次
}

// IP地址的全局下载限制（防止同一IP切换多个账户）
function ripro_get_ip_global_limit() {
    // 同一IP地址每日最大总下载次数（所有用户合计）
    // 可以根据需要调整这个值，比如设置为普通用户限制的2-3倍
    return 30; // 同一IP每日最多下载30次
}

// 检查IP地址的行为异常（检测短时间内切换多个账户）
function ripro_check_ip_abnormal_behavior($ip, $user_id) {
    $today = date('Ymd');
    $ip_hash = ripro_get_ip_hash($ip);
    
    // 获取该IP今日使用过的所有用户ID
    $ip_users_key = 'ripro_ip_users_' . $ip_hash;
    $ip_users = get_transient($ip_users_key);
    
    if ($ip_users === false) {
        $ip_users = array();
    }
    
    // 如果是新用户，添加到列表中
    if (!in_array($user_id, $ip_users)) {
        $ip_users[] = $user_id;
        set_transient($ip_users_key, $ip_users, DAY_IN_SECONDS);
    }
    
    // 如果同一IP在一天内使用了超过3个不同的账户，视为异常行为
    if (count($ip_users) > 3) {
        return array(
            'is_abnormal' => true,
            'user_count' => count($ip_users),
            'message' => '检测到异常行为：同一IP地址在24小时内使用了' . count($ip_users) . '个不同账户'
        );
    }
    
    return array('is_abnormal' => false, 'user_count' => count($ip_users));
}

// 检查并更新IP地址的全局下载次数
function ripro_check_ip_global_download($ip) {
    $today = date('Ymd');
    $ip_hash = ripro_get_ip_hash($ip);
    $ip_global_key = 'ripro_ip_global_' . $ip_hash;
    $global_limit = ripro_get_ip_global_limit();
    
    $down_data = get_transient($ip_global_key);
    
    if ($down_data === false) {
        $down_count = 1;
        set_transient($ip_global_key, array(
            'count' => $down_count,
            'ip' => $ip,
            'date' => $today
        ), DAY_IN_SECONDS);
        return array('is_allowed' => true, 'used' => $down_count, 'remaining' => $global_limit - $down_count);
    } else {
        $down_count = isset($down_data['count']) ? intval($down_data['count']) : 0;
        
        if ($down_count >= $global_limit) {
            return array('is_allowed' => false, 'used' => $down_count, 'remaining' => 0);
        } else {
            $down_count++;
            $down_data['count'] = $down_count;
            set_transient($ip_global_key, $down_data, DAY_IN_SECONDS);
            return array('is_allowed' => true, 'used' => $down_count, 'remaining' => $global_limit - $down_count);
        }
    }
}

// 检查并更新用户当日下载次数（优化版，包含IP关联）
function ripro_check_daily_download_limit($user_id = 0, $ip = '') {
    $is_guest = empty($user_id) || !is_user_logged_in();
    $today = date('Ymd');
    $limit = ripro_get_user_download_limit($user_id);
    
    if ($is_guest) {
        // 游客：基于IP地址追踪
        if (empty($ip)) {
            $ip = ripro_get_client_ip();
        }
        $ip_hash = md5($ip . '_' . $today);
        
        // 获取今日该IP的游客下载次数
        $down_data = get_transient('ripro_guest_download_' . $ip_hash);
        
        if ($down_data === false) {
            $down_count = 1;
            set_transient('ripro_guest_download_' . $ip_hash, array(
                'count' => $down_count,
                'ip' => $ip,
                'date' => $today,
                'last_time' => time()
            ), DAY_IN_SECONDS);
            return array('is_allowed' => true, 'used' => $down_count, 'remaining' => $limit - $down_count);
        } else {
            $down_count = isset($down_data['count']) ? intval($down_data['count']) : 0;
            
            if ($down_count >= $limit) {
                return array('is_allowed' => false, 'used' => $down_count, 'remaining' => 0);
            } else {
                $down_count++;
                $down_data['count'] = $down_count;
                $down_data['last_time'] = time();
                set_transient('ripro_guest_download_' . $ip_hash, $down_data, DAY_IN_SECONDS);
                return array('is_allowed' => true, 'used' => $down_count, 'remaining' => $limit - $down_count);
            }
        }
    } else {
        // 登录用户：基于用户ID追踪，但记录关联的IP
        $user_key = 'ripro_user_download_' . $user_id . '_' . $today;
        $down_data = get_transient($user_key);
        
        if ($down_data === false) {
            $down_count = 1;
            $data = array(
                'count' => $down_count,
                'user_id' => $user_id,
                'date' => $today,
                'ips' => array($ip), // 记录关联的IP地址
                'last_time' => time()
            );
            set_transient($user_key, $data, DAY_IN_SECONDS);
            return array('is_allowed' => true, 'used' => $down_count, 'remaining' => $limit - $down_count);
        } else {
            $down_count = isset($down_data['count']) ? intval($down_data['count']) : 0;
            
            // 记录IP地址（用于追踪账户切换）
            if (!empty($ip) && isset($down_data['ips']) && !in_array($ip, $down_data['ips'])) {
                $down_data['ips'][] = $ip;
            }
            
            if ($down_count >= $limit) {
                return array('is_allowed' => false, 'used' => $down_count, 'remaining' => 0);
            } else {
                $down_count++;
                $down_data['count'] = $down_count;
                $down_data['last_time'] = time();
                set_transient($user_key, $down_data, DAY_IN_SECONDS);
                return array('is_allowed' => true, 'used' => $down_count, 'remaining' => $limit - $down_count);
            }
        }
    }
}

// helper: 增加文章下载计数（cao_paynum）
function ripro_increment_paynum($post_id) {
    $before_paynum = get_post_meta($post_id, 'cao_paynum', true);
    update_post_meta($post_id, 'cao_paynum', (int) $before_paynum + 1);
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
    if ($type === 1) {
        $_downurl = get_post_meta($post_id, 'cao_downurl_bak', true);
    } elseif ($type === 0) {
        $_downurl = get_post_meta($post_id, 'cao_downurl_quark', true);
    } else {
        $_downurl = get_post_meta($post_id, 'cao_downurl', true);
    }

    $home_url=esc_url(home_url());
    if(strpos($_downurl,$home_url) !== false){ 
    	$parse_url = parse_url($_downurl);
    	$_downurl  =$parse_url['path'];
	}

    // --- 新增：三重验证机制 ---
    // 1. 获取客户端IP
    $client_ip = ripro_get_client_ip();
    
    // 2. 检查用户下载限制
    $user_limit_check = ripro_check_daily_download_limit($uid, $client_ip);
    
    // 3. 检查IP全局下载限制
    $ip_global_check = ripro_check_ip_global_download($client_ip);
    
    // 4. 检查IP异常行为（仅对登录用户）
    if ($uid && is_user_logged_in()) {
        $abnormal_check = ripro_check_ip_abnormal_behavior($client_ip, $uid);
        if ($abnormal_check['is_abnormal']) {
            cao_wp_die(
                '下载被限制',
                $abnormal_check['message'] . '。为保证公平使用，系统已限制下载。如有疑问请联系客服。'
            );
            exit;
        }
    }
    
    // 综合判断下载权限
    if (!$user_limit_check['is_allowed']) {
        // 获取用户类型和限制信息用于显示
        $user_limit = ripro_get_user_download_limit($uid);
        $user_type = '游客';
        
        if ($uid && is_user_logged_in()) {
            $CaoUser = new CaoUser($uid);
            $is_boosvip = get_user_meta($uid, 'cao_is_boosvip', true);
            
            if (!empty($is_boosvip) && $is_boosvip == '1') {
                $user_type = '永久VIP';
            } elseif ($CaoUser->vip_status()) {
                $user_type = 'VIP';
            } else {
                $user_type = '普通用户';
            }
        }
        
        cao_wp_die(
            '下载次数超出限制',
            '今日下载次数已用：' . $user_limit_check['used'] . '次,剩余下载次数：' . $user_limit_check['remaining'] . 
            '（' . $user_type . '每日限制' . $user_limit . '次）'
        );
        exit;
    }
    
    if (!$ip_global_check['is_allowed']) {
        cao_wp_die(
            '下载次数超出限制',
            '当前网络环境（IP地址）今日下载次数已达上限：' . $ip_global_check['used'] . '次。' .
            '请明日再试或更换网络环境。'
        );
        exit;
    }
    // --- 结束三重验证 ---

    // 核心权限判断（复用你原来的逻辑）
    if ($PostPay->isPayPost() || $cao_is_post_free) {
    	if(!is_user_logged_in() && _cao('is_ripro_nologin_pay','1')){
            // 未登录但允许免登陆下载（站点配置允许）
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
                cao_wp_die('下载次数超出限制','今日下载次数已用：'.$this_vip_downum['today_down_num'].'次,剩余下载次数：'.$this_vip_downum['over_down_num']);
                exit();
            }
            
            $is_add_down_log = false;
            // 没有真实购买 但是使用免费权限下载 将计算下载次数
            if (!$PostPay->isPayPost() && $cao_is_post_free) {
                update_user_meta($uid, 'cao_vip_downum', $this_vip_downum['today_down_num'] + 1);
                $is_add_down_log = $PostPay->add_down_log();
                ripro_increment_paynum($post_id);
            } else {
                // 对于正常有购买或允许的下载，也确保文章下载数+1 和写日志
                ripro_increment_paynum($post_id);
                if (!_cao('is_all_down_num','0') || $is_add_down_log === false) {
                    $PostPay->add_down_log();
                }
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
    	
    } else {
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

cao_wp_die('地址错误或者URL参数错误','地址错误或者URL参数错误');
