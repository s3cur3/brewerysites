<?php

$showSlider = ciGetNormalizedMeta( 'top_img_slider', false );
$additionalBodyClasses = array();
if( $showSlider ) {
    $additionalBodyClasses[] = "has-top-slider";
}
if( get_option( 'navbar_fixed', false ) ) {
    $additionalBodyClasses[] = "has-fixed-navbar";
}
$additionalBodyClasses[] = get_option('style', CI_STYLE_CLEAN);

get_template_part( 'templates/head' );

?>
<body <?php body_class( $additionalBodyClasses ); ?>>

<!--[if lt IE 8]>
<div class="alert alert-warning">
    <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your
    browser</a> to improve your experience.', CI_TEXT_DOMAIN); ?>
</div>
<![endif]-->

<?php

do_action( 'get_header' );
// Use Bootstrap's navbar if enabled in config.php
if( current_theme_supports( 'bootstrap-top-navbar' ) ) {
    get_template_part( 'templates/header-top-navbar' );
} else {
    get_template_part( 'templates/header' );
}

if( $showSlider ) {
    $sliderCat = ciGetNormalizedMeta( 'top_img_slider_cat_string', '' );
    echo ciGetSliderHTML( $sliderCat, 10, true, CI_SIZE_LG );
}

$pushPageDownAmt = ciGetNormalizedMeta('push_page_down', 0);
$pushFooterDownAmt = ciGetNormalizedMeta('push_footer_down', 0);
if($pushFooterDownAmt + $pushFooterDownAmt > 0) { ?>
    <style>
        .wrap.container {
            margin-top: <?php echo $pushPageDownAmt ?>px;
            margin-bottom: <?php echo $pushFooterDownAmt ?>px;
        }
    </style><?php
}

?>

<div class="wrap <?php echo ciGetContainerClass(); ?>" role="document">
    <div class="content row">
        <main class="main <?php echo roots_main_class(); ?>" role="main">
            <div class="pad main">
                <?php include roots_template_path(); ?>
            </div>
        </main>
        <!-- /.main -->
        <?php if( roots_display_sidebar() ) : ?>
            <aside class="sidebar <?php echo roots_sidebar_class(); ?>" role="complementary">
                <?php include roots_sidebar_path(); ?>
            </aside><!-- /.sidebar -->
        <?php endif; ?>
    </div>
    <!-- /.content -->
</div>
<!-- /.wrap -->

<?php get_template_part( 'templates/footer' ); ?>

</body>
</html>
