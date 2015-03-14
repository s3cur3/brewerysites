<!-- content-beer-archive -->
<?php

$contentLength = 250;
$beers = ciGetAllBeers(100, $contentLength);

?>

<div class="beers"> <?php
    foreach( $beers as $i => $beer ) {
        if( $i % 2 == 0 ) { ?>
            <div class="row"><?php
        }?>
        <div id="post-<?php echo $beer['id']; ?>" class="main individual-post mb35 col-md-6" itemscope itemtype="http://schema.org/Product"><?php
            if( $beer['imgURL'] != '' ) { ?>
                <div class="text-center">
                    <a href="<?php echo $beer['url']; ?>" title="<?php echo $beer['title']; ?>">
                        <img class="mb0" src="<?php echo $beer['imgURL']; ?>" alt="<?php echo $beer['title']; ?>" width="<?php echo $beer['imgWidth']; ?>" height="<?php echo $beer['imgHeight']; ?>" itemprop="image">
                    </a>
                </div><?php
            } ?>
            <h2><a href="<?php echo $beer['url']; ?>" title="<?php echo $beer['title']; ?>" itemprop="name"><?php echo $beer['title']; ?></a></h2> <?php
            echo $beer['content'];

            if( strlen(strip_tags($beer['fullContent'], '<p>')) > strlen($beer['content'])) { ?>
                <a href="<?php echo $beer['url']; ?>" class="btn">Read more about <?php echo $beer['title']; ?></a><?php
            }
            ?>
            <div class="clr"></div>
        </div><!-- /.main --> <?php
        if( $i % 2 == 1 ) { ?>
            </div><?php
        }
    } ?>
</div>
