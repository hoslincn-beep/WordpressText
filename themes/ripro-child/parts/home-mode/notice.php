<div class="section">
    <div class="container">
        <div class="seanggwrap">
            <div class="seangg comfff wow fadeInUp">
                <div class="seanggspan"><i class="fa fa-volume-up"></i><span>网站公告</span></div>
                <b></b>
                <div class="seanggc"><!--[diy=seanggc]-->
                    <div class="announce-wrap" id="rolltxt">
                        <ul class="announce-list line" style="margin-top: -30px;">
                            <?php

                            $args = array(
                                'post_type' => 'kuaixun',
                                'post_status' => 'publish',
                                'showposts' => '5',
                            );
                            $the_query = new WP_Query($args);


                            ?>


                            <?php if ($the_query->have_posts()) : ?>

                                <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>

                                    <li><a href="<?php echo esc_url(get_permalink()); ?>"
                                           target="_blank"><?php the_title(); ?></a><span><?php the_time('Y.n.j'); ?></span>
                                    </li>


                                <?php endwhile; ?>


                                <?php wp_reset_postdata(); ?>

                            <?php else : ?>
                                <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <!--[/diy]--></div>
                <div class="clear"></div>
            </div>

            <!--统计 start-->
            <div class="alert alert-modern alert-dark" style="
    background: linear-gradient(90deg, #ffc107, #ff7365, #ff82ea, #ffc107);
    background-size: 1400% 300%;
    animation: mymove 10s ease infinite;
    -webkit-animation: mymove 10s ease infinite;display: none;
">
                <div class="alert-content">  <span class="description-17codesign">
        <p style="
    color: #ffffff;
">&nbsp;&nbsp;资源总数：<?php echo $publish_posts = wp_count_posts()->publish; ?> 个&nbsp;&nbsp;&nbsp;๑&nbsp;&nbsp;&nbsp;本周更新：<?php get_week_post_count(); ?> 篇&nbsp;&nbsp;&nbsp;๑&nbsp;&nbsp;&nbsp;今日更新：<?php get_today_post_count(); ?> 篇&nbsp;&nbsp;</p>
        </span></div>
            </div>
            <!--统计 end-->
            <div class="seanchart" style="margin-top: -6px;">
                <ul>
                    <!--[diy=seanchart]-->
                    <div id="portal_block_396_content" class="dxb_bc">
                        <li class="seanchart1"><i class="fa fa-history"></i>
                            <div class="seanchartdiv"><span>今日发布</span>
                                <div class="clear"></div>
                                <em><?php get_today_post_count(); ?></em></div>
                            <div class="clear"></div>
                        </li>
                        <li class="seanchart2"><i class="fa fa-clock-o"></i>
                            <div class="seanchartdiv"><span>本周发布</span>
                                <div class="clear"></div>
                                <em><?php get_week_post_count(); ?></em></div>
                            <div class="clear"></div>
                        </li>
                        <li class="seanchart3"><i class="fa fa-dot-circle-o"></i>
                            <div class="seanchartdiv"><span>资源总数</span>
                                <div class="clear"></div>
                                <em><?php get_all_post_count(); ?></em></div>
                            <div class="clear"></div>
                        </li>
                    </div>
                    <!--[/diy]-->
                    <div class="clear"></div>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
