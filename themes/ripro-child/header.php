<?php
/**
 * Description   www.zyfx8.cn 资源分享吧
 * Author   老雷
 */
?>
<?php if (is_archive() && ($paged > 1) && ($paged < $wp_query->max_num_pages)) { ?>
    <link rel="prefetch prerender" href="<?php echo get_next_posts_page_link(); ?>">
<?php } ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link href="<?php echo _cao('site_favicon') ?>" rel="icon">
    <title><?php echo _title() ?></title>
    <?php wp_head(); ?>
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri() ?>/assets/js/html5shiv.js"></script>
    <script src="<?php echo get_template_directory_uri() ?>/assets/js/respond.min.js"></script>
    <![endif]-->
    <?php if (_cao('is_header_loaing', '0')) { ?>
        <script> $(document).ready(function () {
                NProgress.start();
                $(window).load(function () {
                    NProgress.done();
                });
            });</script>
    <?php } ?>
     <link href="<?php echo get_stylesheet_directory_uri() ?>/assets/css/remixicon/remixicon.css" rel="stylesheet">
     
     <!--google adv-->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7458776832777570"
            crossorigin="anonymous"></script>
</head>

<body <?php body_class(); ?>>

<div class="site">
    <?php
    get_template_part('parts/navbar');
    if (is_archive() || is_search() || is_page_template()) {
        get_template_part('parts/term-bar');
    }
    ?>
    <div class="site-content">

    
