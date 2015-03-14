<?php


/**
 * @param $maxNumBeers int Maximum number of beers to return
 * @param $maxCharLength int The maximum length of the content, in characters
 * @return array All the beer data you need. Keys are 'content', 'title', 'url', 'imgURL', 'imgWidth', and 'imgHeight'
 */
if( !function_exists('ciGetAllBeers') ) {
    function ciGetAllBeers( $maxNumBeers = 100, $maxCharLength = -1 ) {
        $query = new WP_Query('showposts=' . $maxNumBeers . '&post_type=' . CI_BEER_TYPE);

        $beerArray = array();
        while( $query->have_posts() ) {
            $query->next_post();

            $attachment = wp_get_attachment_image_src( get_post_thumbnail_id($query->post->ID), CI_BEER_IMG );

            $maybeExcerpt = has_excerpt($query->post->ID) ? $query->post->post_excerpt : $query->post->post_content;

            $beerArray[] = array(
                'id' => $query->post->ID,
                'content' => ciFilterToMaxCharLength($maybeExcerpt, $maxCharLength),
                'fullContent' => $query->post->post_content,
                'title' => apply_filters('the_title', $query->post->post_title),
                'imgURL' => ($attachment ? $attachment[0] : ''),
                'imgWidth' => ($attachment ? $attachment[1] : -1),
                'imgHeight' => ($attachment ? $attachment[2] : -1),
                'url' => get_permalink($query->post->ID)
            );
        }

        wp_reset_postdata();
        return $beerArray;
    }
}


/**
 * Returns the HTML to display an image+text slider
 * @param $beersPerRow int Number of beers to print per row (in columns)
 * @param $numBeers int The max number of beers to display.
 * @param $headingLevel int The "level" of heading to apply to the beer's name. E.g., 2 gives H2, 3 gives H3, etc.
 * @param $maxCharLength int The maximum length for each beer's content. If -1, there will be no limit.
 * @param $noDescription boolean True if we should return exclude the excerpt/description
 * @param $showImages boolean True if we should include images in the output HTML
 * @return string The HTML to be output
 */
if( !function_exists('ciGetBeersHTML') ) {
    function ciGetBeersHTML( $beersPerRow = 1, $numBeers = 100, $headingLevel = 3, $maxCharLength = -1, $noDescription = false, $showImages = true, $imageComesBeforeHeading = true) {
        function getBeerInnerHTML( $beer, $headingLevel, $floatImg="right", $noDescription, $showImages, $imageComesBeforeHeading) {
            $imgClass = "beer-img";
            if( $floatImg == "right" ) {
                $imgClass .= " alignright ml20";
            } else if( $floatImg == "left" ) {
                $imgClass .= " alignleft mr20";
            }


            $imgHTML = "";
            if( $showImages && strlen($beer['imgURL']) > 0 ) {
                $imgHTML  .= "    <a href=\"{$beer['url']}\"><img alt=\"{$beer['title']}\" src=\"{$beer['imgURL']}\" width=\"{$beer['imgWidth']}\" height=\"{$beer['imgHeight']}\" class=\"{$imgClass}\" itemprop=\"image\"></a>\n";
            }

            $name = "<a href=\"{$beer['url']}\" itemprop=\"name\">{$beer['title']}</a>";
            if($noDescription && !$showImages) {
                return $name;
            } else if($noDescription && $imageComesBeforeHeading) {
                return $imgHTML . $name;
            } else if($noDescription && !$imageComesBeforeHeading) {
                return $name . $imgHTML;
            } else {
                $out = ($imageComesBeforeHeading ? $imgHTML : "");
                $out .= "    <h{$headingLevel}>{$name}</h{$headingLevel}>\n";
                $out .= ($imageComesBeforeHeading ? "" : $imgHTML);
                $out .= "    {$beer['content']}\n";
                $out .= "";
                return $out;
            }
        }


        $beers = ciGetAllBeers( $numBeers, $maxCharLength );

        if( count($beers) == 0 ) {
            return "";
        }

        $containerClass = "beers";
        $itemClass = "beer";
        if( $beersPerRow > 1 ) {
            $containerClass .= " row";
            $colWidth = 12 / $beersPerRow;
            $itemClass .= " col-sm-{$colWidth}";
        }
        $itemClass .= $showImages ? " has-img" : " no-img";
        $itemClass .= $imageComesBeforeHeading ? " img-before" : " img-after";

        $out = "<div class=\"{$containerClass}\">";
            if(count($beers) == 1) {
                $out .= getBeerInnerHTML($beers[0], $headingLevel, "right", $noDescription, $showImages, $imageComesBeforeHeading);
            }
            if($beersPerRow > 1) {
                for($i = 0; $i < count($beers); $i++) {
                    $out .= "<div class=\"{$itemClass}\" itemscope itemtype=\"http://schema.org/Product\">\n";
                    $out .= getBeerInnerHTML($beers[$i], $headingLevel, "none", $noDescription, $showImages, $imageComesBeforeHeading);
                    $out .= "\n</div>\n";

                    if(($i + 1) % $beersPerRow == 0) {
                        $out .= "<div class=\"clearfix\"></div>\n";
                    }
                }
            } else {
                $out .= "<ul>\n";
                for($i = 0; $i < count($beers); $i++) {
                    $out .= "<li class=\"{$itemClass}\" itemscope itemtype=\"http://schema.org/Product\">\n";
                    $out .= getBeerInnerHTML($beers[$i], $headingLevel, "none", $noDescription, $showImages, $imageComesBeforeHeading);
                    $out .= "\n<div class=\"clearfix\"></div>\n";
                    $out .= "\n</li>\n";
                }
                $out .= "</ul>\n";
            }
        $out .= "</div>";
        return $out;
    }
}


/**
 * Wrapper for the getSliderHTML() function, to be used by the Wordpress Shortcode API
 * @param $atts array containing optional 'category' field.
 * @return string The HTML that will display a slider on page
 */
if( !function_exists('ciBeerHTMLShortcode') ) {
    function ciBeerHTMLShortcode($atts) {
        $columns = 1; // Defined for the sake of the IDE's error-checking
        $length = 250;
        $list = false;
        extract(
            shortcode_atts(
                array(
                    'columns' => 1,
                    'length'  => 250,
                    'list'    => $list
                ), ciNormalizeShortcodeAtts($atts) ), EXTR_OVERWRITE /* overwrite existing vars */ );

        return ciGetBeersHTML(intval($columns), 100, 3, intval($length), $list);
    }
}

if( !function_exists('ciRegisterBeerShortcode') ) {
    function ciRegisterBeerShortcode() {
        add_shortcode('beers', 'ciBeerHTMLShortcode');
    }
}

add_action( 'init', 'ciRegisterBeerShortcode');




 