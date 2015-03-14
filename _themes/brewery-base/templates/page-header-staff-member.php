<!-- PAGE-HEADER-STAFF-MEMBER.PHP -->
<?php
$showTitle = ciGetNormalizedMeta('show_page_title', true);
if( $showTitle ) { ?>
    <div class="page-header" itemscope itemtype="http://schema.org/Person">
        <h1 itemprop="name"><?php
            echo roots_title();

            if (has_post_thumbnail()) {
                the_post_thumbnail(CI_STAFF_IMG_SM, array( 'class'	=> "attachment-post-thumbnail alignright ml20 featured-img", 'itemprop' => 'image'));
            }
            ?>
        </h1>
    </div> <?php
} else { ?>
    <div class="buffer"></div> <?php
}

?>