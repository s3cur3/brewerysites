<?php
/*
Plugin Name: Beers Custom Post Type
Plugin URI: http://conversioninsights.net
Description: Adds a "Beers" post type to be used in the theme.
Version: 1.02
Author: Tyler Young
Author URI: http://conversioninsights.net
*/

require_once 'plugin-updates/plugin-update-checker.php';
require_once 'lib/constants.php';
require_once 'lib/utils.php';
require_once 'lib/createType.php';
require_once 'lib/displayType.php';
require_once 'lib/addWidgets.php';

$UpdateChecker =
    PucFactory::buildUpdateChecker(
              'http://cisandbox.mystagingwebsite.com/wp-content/plugins/beers-cpt_version_metadata.json',
              __FILE__,
              'ci-beers-cpt',
              720 // check once a month for updates -- 720 == 24*30
    );






