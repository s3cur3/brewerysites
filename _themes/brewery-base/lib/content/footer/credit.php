<?php

function ciGetThemeCredit() {
    function getLinkWithText($url, $text) {
        return "<a href=\"$url\" target=\"_blank\">$text</a>";
    }
    
    // Print a different link based on the current page ID
    global $wp_query;
    $id = $wp_query->post->ID;

    $root = "http://brewsites.net";
    $me = $root . "/tyler-young/";
    $designServices = $root . "/web-design-for-breweries/";
    $themes = $root . "/wordpress-themes-for-breweries/";
    $project = $root;

    $choices = array(
        /* Project-specific */
        getLinkWithText($themes, "WordPress Themes for Breweries"),
        getLinkWithText($themes, "WordPress Themes for Craft Breweries"),
        getLinkWithText($project, "Site created by BrewSites"),
        getLinkWithText($project, "Web Site by BrewSites"),
        getLinkWithText($project, "Brewery Sites designed by BrewSites"),

        /* Brewery specific */
        getLinkWithText($root, "Web Marketing for Breweries") . " by BrewSites",
        getLinkWithText($root, "Web Design for Craft Breweries"),
        "Web design by " . getLinkWithText($root, "BrewSites"),
        getLinkWithText($themes, "Brewery WordPress Theme") . " by BrewSites",
        getLinkWithText($themes, "WordPress themes for craft breweries") . " by " . getLinkWithText($root, "BrewSites"),


        /* Kansas City-specific *
        getLinkWithText($designServices, "Kansas City Web Design"), */

        /* Generic */
        "WordPress theme created by " . getLinkWithText($me, "Tyler Young") . " of BrewSites",
        "Brewery WordPress theme by " . getLinkWithText($root, "BrewSites"),
        getLinkWithText($root, "BrewSites"),
        "Web site created by " . getLinkWithText($me, "Tyler Young") . " of BrewSites",
        "Site by " .getLinkWithText($root, "BrewSites"),
        "Site created by " . getLinkWithText($root, "BrewSites"),
        "Designed by " . getLinkWithText($root, "BrewSites"),
        getLinkWithText($designServices, "Brewery Web Design") . " by BrewSites",
        getLinkWithText($designServices, "Web Design for Craft Breweries"),
    );

    return $choices[ $id % count($choices) ];
}

function ciPrintThemeCredit() {
    echo ciGetThemeCredit();
}