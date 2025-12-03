<?php
$is_childbanner_rightbottom_icon = _cao('is_childbanner_rightbottom_icon');
$childbanner_rightbottom_icon_info = _cao('childbanner_rightbottom_icon_info');
$is_threeone_childbanner = _cao('is_threeone_childbanner');
$threeone_childbanner = _cao('threeone_childbanner');
$childbanner_rightup_info = _cao('childbanner_rightup_info');
$childbanner_rightlower_info = _cao('childbanner_rightlower_info');
?>
<div class="section">
    <div class="container child-con">
        <div class="row no-gutters">
            <div class="col-lg-9">
                <div class="swiper-container">
                    <div class="swiper-wrapper" data-align="">
                        <?php foreach ($threeone_childbanner['threeone_childbanner_info'] as $key => $item) {
                            echo '<div class="swiper-slide">';
                            echo '<a '.( $item['_blank'] ? ' target="_blank"' : '' ).' href="'.esc_url( $item['_href'] ).'">';
                            echo '<img src="'.esc_url( $item['_img'] ).'">';
                            echo '<h3><span class="label label-h3">'.$item['_tag'].'</span>'.$item['_title'].'</h3>';
                            echo '</a>';
                            echo '</div>';
                        } ?>
                    </div>

				    <?php if ($is_childbanner_rightbottom_icon) : ?>
				    <!--banner 右下角图标-->
					<div class="layout r_b_tip_box">
					    <div class="r_b_tip" style="background: url(<?php echo $childbanner_rightbottom_icon_info['_img']; ?>) no-repeat -3px -155px;"></div>
					</div>
					<?php endif; ?>
					
                    <!-- 如果需要分页器 -->
                    <div class="swiper-pagination"></div>

                    <!-- 如果需要导航按钮 -->
                    <span class="swiper-button-prev"><i class="mdi mdi-chevron-left"></i></span>
                    <div class="swiper-button-next"><i class="mdi mdi-chevron-right"></i></div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="row h-images no-gutters">
                    <div class="item-tuwen col-6 col-lg-12">
                        <a <?php echo $item['_blank'] ? ' target="_blank"' : ''?> href="<?php echo $title = ($childbanner_rightup_info['_href']); ?>" target="_blank" class="h-mark">
                            <i class="thumb" style="background-image:url(<?php echo esc_url( @$childbanner_rightup_info['_img'] ); ?>);"></i>
                            <strong><?php echo $title = ($childbanner_rightup_info['_title']); ?></strong>
                        </a>
                    </div>
                    <div class="item-tuwen col-6 col-lg-12">
                        <a <?php echo $item['_blank'] ? ' target="_blank"' : ''?> href="<?php echo $title = ($childbanner_rightlower_info['_href']); ?>" target="_blank" class="h-mark">
                            <i class="thumb" style="background-image:url(<?php echo esc_url( @$childbanner_rightlower_info['_img'] ); ?>);"></i>
                            <strong><?php echo $title = ($childbanner_rightlower_info['_title']); ?></strong>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>