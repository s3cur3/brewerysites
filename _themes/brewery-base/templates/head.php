<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php if(is_post_type_archive(CI_BEER_TYPE) || is_post_type_archive(CI_STAFF_TYPE)) { ?>
        <title><?php post_type_archive_title('All ', true); ?> | <?php bloginfo('name'); ?></title>
    <?php } else { ?>
        <title><?php wp_title('|', true, 'right'); ?></title>
    <?php } ?>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php do_action('ci_meta'); ?>

    <?php wp_head(); ?>

    <?php do_action('ci_styles'); ?>

    <link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo('name'); ?> Feed"
          href="<?php echo esc_url(get_feed_link()); ?>">
</head>
