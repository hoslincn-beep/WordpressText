<?php
$footer_youshe_info = _cao('footer_youshe_info');
?>
<?php if (@$footer_youshe_info['_title']) : ?>
    <div class="footer-fav">
        <div class="container">
            <div class="fl site-info">
                <h2><a href="#"> <?php echo $title = ($footer_youshe_info['_title']); ?> </a></h2>
                <div class="site-p">
                    <a href="#">
                        <p><?php echo $title = ($footer_youshe_info['_desc']); ?></p>
                    </a>
                </div>
            </div>
            <div class="fr site-fav">
                <a href="#" class="btn btn-fav btn-orange"
                   style=" background: <?php echo $color = ($footer_youshe_info['_color']); ?>; "> <i
                            class="ri-heart-line"></i> 按Ctrl+D收藏本站 </a></div>
            <div class="site-girl">
                <a href="#">
                    <div class="girl fl">
                        <i class="thumb " style="background-image:url(<?php echo $title = ($footer_youshe_info['_img']); ?>);-moz-background-size: 100% 100%;background-size:100% 100%;"></i>
                    </div>
                    <div class="girl-info hide_md">
                        <h4> <?php echo $title = ($footer_youshe_info['_right_font_up']); ?> </h4>
                        <h4> <?php echo $title = ($footer_youshe_info['_right_font_lower']); ?> </h4>
                    </div>
                </a>
            </div>
        </div>
    </div>
<?php endif; ?>