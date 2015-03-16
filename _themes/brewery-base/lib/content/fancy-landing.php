<?php


if(!function_exists('ciAddColoredBackground')) {
    function ciAddColoredBackground($atts, $content="") {
        $p = false; // Defined for the sake of the IDE's error-checking
        $mt = -1;
        $mb = -1;
        $highlight = false;
        extract(
            shortcode_atts(
                array(
                    'mt' => -1,
                    'mb' => -1,
                    'highlight' => false,
                    'p'  => false
                ), ciNormalizeShortcodeAtts($atts) ), EXTR_OVERWRITE /* overwrite existing vars */ );


        $class = "colored-bg";
        if($mt >= 0) {
            $class .= " mt{$mt}";
        }
        if($mb >= 0) {
            $class .= " mb{$mb}";
        }
        if($highlight) {
            $class .= " highlight";
        }

        $markup = "<span class=\"{$class}\">" . do_shortcode($content) . "</span>";
        if($p) {
            $markup = "<p>" . $markup . "</p>";
        }
        return $markup;
    }
}
add_shortcode('bg', 'ciAddColoredBackground');



if(!function_exists('ciAddContainer')) {
    function ciAddContainer($atts, $content="") {
        return "<div class=\"white-container\">" . do_shortcode($content) . "</div>";
    }
}
add_shortcode('container', 'ciAddContainer');


