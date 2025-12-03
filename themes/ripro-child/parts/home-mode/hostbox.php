<?php
//置顶轮播商品模块
$is_host_rotation = _cao('is_host_rotation');
$host_rotation_infos = _cao('host_rotation_infos');
?>
<style>
    .category-box .big {
        margin-right: 0px;
        width: 100%;
    }

    .bgcolor-fff {
        background: none;
        padding-bottom: 0px;
    }

    .child-boxes-host .owl-prev, .child-boxes-host .owl-next {
        background: #fb1408;
        opacity: .1;
        top: 50%;
        margin-top: -30px;
        border-radius: 0px;

    }
    .child-boxes-host .owl-prev{
        left: -40px;
    }
    .child-boxes-host .owl-next {
        right: -40px;
    }

    .child-boxes-host .owl-prev:hover, .child-boxes-host .owl-next:hover {
        opacity: 1;
    }
</style>
<div class="section bgcolor-fff">
    <div class="container child-container">
        <div class="module category-boxes child-boxes owl child-boxes-host">
            <?php
            $sidebar = 'none';
            $column_classes = cao_column_classes($sidebar);
            $mo_postlist_no_cat = _cao('home_last_post');
            if (!empty($mo_postlist_no_cat['home_postlist_no_cat'])) {
                $args['cat'] = '-' . implode($mo_postlist_no_cat['home_postlist_no_cat'], ',-');
            }
            $args['paged'] = (get_query_var('paged')) ? get_query_var('paged') : 0;
            //排除置顶文章
            //$args['ignore_sticky_posts'] = 1;
            $args['post__in'] = get_option('sticky_posts');
            $args['caller_get_posts'] = 0;
            query_posts($args);
            ?>
            <?php while (have_posts()) : the_post();
                get_template_part('parts/template-parts/li-content', _cao('latest_layout', 'list'));
            endwhile; ?>
        </div>
    </div>
</div>

