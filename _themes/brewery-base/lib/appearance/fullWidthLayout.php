<?php

function ciGetContainerClass(){
    $fullWidthContainerSpecified = get_option('full_width_container');

    // Override with GET parms
    if( isset($_GET['layout']) && $_GET['layout'] == "full" ) {
        $fullWidthContainerSpecified = true;
    } else {
        if( isset($_GET['layout']) && $_GET['layout'] == "normal" ) {
            $fullWidthContainerSpecified = false;
        }
    }
    $needsFullWidthContainer = $fullWidthContainerSpecified && !roots_display_sidebar();

    $containerClass = "container";
    if( $needsFullWidthContainer ) {
        $containerClass .= "-fluid";
    }
    if( $fullWidthContainerSpecified ) {
        $containerClass .= " pseudo-fluid";
    }

    if(get_option('navbar_fixed', false)) {
        $containerClass .= " fixed-navbar";
    }
    if(get_option("full_screen_image_bg")) {
        $containerClass .= " has-bg-img";
    }
    if(ciGetNormalizedMeta('make_fancy_landing', false)) {
        $containerClass .= " fancy-landing";
    }
    $containerClass .= " text-align-" . ciGetNormalizedMeta('alignment', 'left');
    return $containerClass;
}



 