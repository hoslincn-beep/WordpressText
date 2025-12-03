<?php
$mode_search = _cao('mode_search');
$image = $mode_search['bgimg'];
$categories = get_categories( array('hide_empty' => 0) );//获取所有分类
$home_search_mod = _cao('home_search_mod');
?>
<div class="section search_section">
	<div class="container">
		<div class="row">
			<div class="home-filter--content">
				<form class="mb-0" method="get" autocomplete="off" action="<?php echo home_url(); ?>">
					<div class="form-box search-properties mb-0">
					    <div class="row">
					        <div class="col-xs-12 col-sm-6 col-md-9">
					            <div class="form-group mb-0">
					                <input type="text" class="home_search_input" name="s" placeholder="希望您有前戏的探索，不要粗暴的深入...">
					                </div>
					            </div>
					        <div class="col-xs-12 col-sm-6 col-md-3">
					            <input type="submit" value="搜索"  class="button transparent" style="width: 100%;">
					        </div>
					    </div>
					    <div class="home-search-results"></div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
