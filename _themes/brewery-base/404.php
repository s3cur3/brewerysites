<?php get_template_part('templates/page', 'header'); ?>

<div class="alert alert-warning">
  <?php _e('Sorry, but the page you were trying to view does not exist.', CI_TEXT_DOMAIN); ?>
</div>

<p><?php _e('It looks like this was the result of either:', CI_TEXT_DOMAIN); ?></p>
<ul>
  <li><?php _e('a mistyped address', CI_TEXT_DOMAIN); ?></li>
  <li><?php _e('an out-of-date link', CI_TEXT_DOMAIN); ?></li>
</ul>

<?php get_search_form(); ?>
