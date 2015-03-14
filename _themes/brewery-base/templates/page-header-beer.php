<!-- PAGE-HEADER-BEER.PHP -->
<?php
$showTitle = ciGetNormalizedMeta('show_page_title', true);
if( $showTitle ) { ?>
    <div class="page-header" itemscope itemtype="http://schema.org/IndividualProduct">
        <?php printBreadcrumbs(); ?>
        <h1 itemprop="name"><?php echo roots_title(); ?> </h1>
    </div> <?php
} else { ?>
    <div class="buffer"></div> <?php
}

if(has_post_thumbnail()) {
    the_post_thumbnail(CI_BEER_IMG_SM, array('class' => "attachment-post-thumbnail alignright ml20 featured-img", 'itemprop' => 'image'));
}
?>