<!-- content-staff -->
<?php while (have_posts()) : the_post(); ?>
    <div class="entry-content">
        <?php the_content(); ?>
    </div>
<?php endwhile; ?>
<?php

$contentLength = 250;
$staff = ciGetAllStaff(100, $contentLength);

?>

<div class="staff"> <?php
    foreach( $staff as $i => $staffMember ) {
        if( $i % 2 == 0 ) { ?>
            <div class="row"><?php
        }?>
        <div id="post-<?php echo $staffMember['id']; ?>" class="main individual-post mb35 col-md-6" itemscope itemtype="http://schema.org/Person"><?php
            if( $staffMember['imgURL'] != '' ) { ?>
                <div class="text-center">
            <a href="<?php echo $staffMember['url']; ?>" title="<?php echo $staffMember['title']; ?>">
                <img class="mb0" src="<?php echo $staffMember['imgURL']; ?>" alt="<?php echo $staffMember['title']; ?>" width="<?php echo $staffMember['imgWidth']; ?>" height="<?php echo $staffMember['imgHeight']; ?>" itemprop="image">
                </a><?php
                if( !staffSocialURLsAreEmpty($staffMember['socialURLs']) )
                    printSocialLinks( $staffMember['socialURLs'], 'in-staff-list' ); ?>
                </div><?php
            } ?>
            <h2><a href="<?php echo $staffMember['url']; ?>" title="<?php echo $staffMember['title']; ?>" itemprop="name"><?php echo $staffMember['title']; ?></a></h2> <?php
            echo $staffMember['content'];

            if( strlen(strip_tags($staffMember['fullContent'], '<p>')) > strlen($staffMember['content'])) {?>
            <a href="<?php echo $staffMember['url']; ?>" class="btn">Read <?php echo $staffMember['title']; ?>'s full bio</a><?php
            }
            ?>
            <div class="clr"></div>
        </div><!-- /.main --> <?php
        if( $i % 2 == 1 ) { ?>
            </div><?php
        }
    } ?>
</div>
