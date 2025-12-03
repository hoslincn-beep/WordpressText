<?php
//分类展示模块
//云服务器
$class_cloud_info = _cao('class_cloud_info');
//热门标签
$class_host_info = _cao('class_host_info');
//专题专栏
$class_cms_info = _cao('class_cms_info');
//最新活动
$class_news_info = _cao('class_news_info');
?>
<div class="section">
    <div class="home-first">
        <div class="container hide_sm child-con">
            <div class="col-1-4">
                <div class="hf-widget hf-widget-1 hf-widget-software">
                    <h3 class="hf-widget-title">
                        <i class="ri-1x hhicon ri-cloud-line"></i>
                        <a href="javascript:void(0);">云服务器</a>
                        <span>云服务器推荐</span>
                        <div class="pages">
                            <i class="prev">
                                <i class="ri-arrow-left-s-line"></i>
                            </i>
                            <i class="next">
                                <i class="ri-arrow-right-s-line"></i>
                            </i>
                        </div>
                    </h3>
                    <div class="hf-widget-content">
                        <div class="scroll-h">
                            <ul>
                                <?php foreach ($class_cloud_info['class_cloud_info_data'] as $key => $item) {
                                    echo '<li>';
                                    echo '<a href="' . esc_url($item['_href']) . '" ' . ($item['_blank'] ? ' target="_blank"' : '') . '>';
                                    echo '<i class="thumb " style="background-image:url(' . esc_url($item['_img']) . ')"></i>';
                                    echo '<span>' . $item['_title'] . '</span>';
                                    echo '</a>';
                                    echo '</li>';
                                } ?>
                            </ul>
                            <ul class="holdon">
                                <?php foreach ($class_cloud_info['class_cloud_info_data'] as $key => $item) {
                                    if ($key > 3) {
                                        echo '<li>';
                                        echo '<a href="' . esc_url($item['_href']) . '" ' . ($item['_blank'] ? ' target="_blank"' : '') . '>';
                                        echo '<i class="thumb " style="background-image:url(' . esc_url($item['_img']) . ')"></i>';
                                        echo '<span>' . $item['_title'] . '</span>';
                                        echo '</a>';
                                        echo '</li>';
                                    }
                                } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-1-4 sxweb">
                <div class="hf-widget hf-widget-2">
                    <h3 class="hf-widget-title">
                        <i class="ri-1x hhicon ri-contrast-drop-2-line"></i>
                        <a href="javascript:void(0);">热门专栏</a>
                        <span>热门精品资源推荐</span></h3>
                    <div class="hf-widget-content">
                        <div class="no-scroll hf-tags">
                            <?php foreach ($class_host_info['class_host_info_data'] as $key => $item) {
                                echo '<a href="' . esc_url($item['_href']) . '" ' . ($item['_blank'] ? ' target="_blank"' : '') . '>';
                                echo '<span>' . $item['_title'] . '</span>';
                                echo '</a>';
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-1-4 sxweb">
                <div class="hf-widget hf-widget-1 hf-widget-hot-cats">
                    <h3 class="hf-widget-title">
                        <i class="ri-palette-fill"></i>
                        <a href="javascript:void(0);">专题模板</a>
                        <span>精选CMS优质好资源</span></h3>
                    <div class="hf-widget-content">
                        <div class="scroll-h">
                            <ul>
                                <?php foreach ($class_cms_info['class_cms_info_data'] as $key => $item) { ?>
                                    <li>
                                        <a href="<?php echo esc_url($item['_href']); ?>" target="_blank">
                                            <i class="hhicon <?php echo $item['_icon']; ?>"></i>
                                            <span><?php echo $item['_title']; ?></span>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-1-4 sxweb">
                <div class="hf-widget hf-widget-4">
                    <h3 class="hf-widget-title">
                        <i class="ri-1x hhicon ri-contacts-book-2-fill"></i>
                        <a href="javascript:void(0);">最新活动</a>
                        <span>最新会员专享活动</span>
                        <div class="pages">
                            <i class="prev">
                                <i class="ri-arrow-left-s-line"></i>
                            </i>
                            <i class="next">
                                <i class="ri-arrow-right-s-line"></i>
                            </i>
                        </div>
                    </h3>
                    <div class="hf-widget-content">
                        <div class="scroll-h">
                            <ul>
                                <?php foreach ($class_news_info['class_news_info_data'] as $key => $item) {
                                    if($key>1){
                                        continue;
                                    }
                                    echo '<li><h3>';
                                    echo '<a href="' . esc_url($item['_href']) . '" ' . ($item['_blank'] ? ' target="_blank"' : '') . '>';
                                    echo '<i class="icon-time"></i>';
                                    echo '<span>' . $item['_title'] . '</span>';
                                    echo '<em>' . $item['_tag'] . '</em>';
                                    echo '</a>';
                                    echo '</h3> </li> ';
                                } ?>
                            </ul>
                            <ul class="holdon">
                                <?php foreach ($class_news_info['class_news_info_data'] as $key => $item) {
                                    if($key<2){
                                        continue;
                                    }
                                    echo '<li><h3>';
                                    echo '<a href="' . esc_url($item['_href']) . '" ' . ($item['_blank'] ? ' target="_blank"' : '') . '>';
                                    echo '<i class="icon-time"></i>';
                                    echo '<span>' . $item['_title'] . '</span>';
                                    echo '<em>' . $item['_tag'] . '</em>';
                                    echo '</a>';
                                    echo '</h3> </li> ';
                                } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>