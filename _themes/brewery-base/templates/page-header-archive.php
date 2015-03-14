<!-- PAGE-HEADER-ARCHIVE.PHP -->
<?php
$showTitle = ciGetNormalizedMeta( 'show_page_title', true );
if( $showTitle ) { ?>
    <div class="page-header">
        <?php if(is_post_type_archive(CI_BEER_TYPE) || is_post_type_archive(CI_STAFF_TYPE)) { ?>
            <h1>Our <?php echo roots_title(); ?></h1>
        <?php } else { ?>
            <h1><?php echo roots_title(); ?></h1>
        <?php } ?>
    </div> <?php
} else { ?>
    <div class="buffer"></div> <?php
} ?>