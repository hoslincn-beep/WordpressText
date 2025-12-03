<?php
/**
 * [加载子主题首页Diy模块]
 * @Author   老雷
 * @WebUrl   www.zyfx8.cn 资源分享吧
 */
get_header();
?>
<div class="content-area">
	<main class="site-main">
	<?php $module_home = _cao('child_home_mode');
		if (!$module_home) {
		    echo '<h2 style=" text-align: center; margin: 0 auto; padding: 60px; ">请前往后台-主题设置-设置首页模块！</h2>';
		}
		if ($module_home) {
		    foreach ($module_home['enabled'] as $key => $value) {
		        @get_template_part('parts/home-mode/'.$key);
		    }
		}
		get_template_part('parts/home-mode/banner')
	?>
	</main>
</div>
<?php get_footer(); ?>
