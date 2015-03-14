<!-- Content, no meta -->
<?php while (have_posts()) : the_post(); ?>
    <?php the_content(); ?>

    <?php
    $abv = ciGetNormalizedMeta('abv', false);
    $ibu = ciGetNormalizedMeta('ibu', false);
    $availability = ciGetNormalizedMetaMultiple('availability', false);
    $seasons = ciGetNormalizedMeta('seasonal_availability', false);
    $og = ciGetNormalizedMeta('og', false);
    $srm = ciGetNormalizedMeta('srm', false);

    $availabilityStrings = array(
        'twelve' => __('12 oz. bottles', CI_TEXT_DOMAIN),
        'twentytwo' => __('22 oz. bottles', CI_TEXT_DOMAIN),
        'sevenfifty' => __('750 mL bottles', CI_TEXT_DOMAIN),
        'draft' => __('Draft', CI_TEXT_DOMAIN),
        'nitro' => __('Nitro Draft', CI_TEXT_DOMAIN)
    );
    ?>
    <div class="stats">
        <h4>Stats</h4>
        <div class="short-stats"><?php
            if($abv) { ?>
                <p><span class="percent-alcohol"><?php echo $abv; ?>%</span> ABV</p><?php
            }
            if($ibu) { ?>
                <p><span class="ibu"><?php echo $ibu; ?></span> IBU</p><?php
            }
            if($og) { ?>
                <p><span class="og"><?php echo $og; ?>&deg;</span> Plato</p><?php
            }
            if($srm) { ?>
                <p><span class="srm"><?php echo $srm; ?>&deg;</span> SRM</p><?php
            } ?>
        </div> <?php
        if($availability && count($availability) == 1) {?>
            <p><span class="availability-label">Availability<?php echo $seasons ? ' (' . $seasons . ')' : ''; ?></span>: <?php echo $availabilityStrings[$availability[0]]; ?></p> <?php
        } else if($availability && count($availability) > 1) { ?>
            <p><span class="availability-label">Availability<?php echo $seasons ? ' (' . $seasons . ')' : ''; ?></span>:</p>
            <ul> <?php
                foreach($availability as $availabilityKey) { ?>
                   <li class="availability"><?php echo $availabilityStrings[$availabilityKey]; ?></li> <?php
                } ?>
            </ul> <?php
        } else if($seasons) { ?>
            <p class="availability-label">Available <?php echo $seasons ?>.</p> <?php
        } ?>
    </div>
    <?php wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>')); ?>
<?php endwhile; ?>
