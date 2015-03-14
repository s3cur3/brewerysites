<?php

/**
 * Register meta boxes
 *
 * For a demo of available options, see https://github.com/rilwis/meta-box/blob/master/demo/demo.php
 *
 * @param $meta_boxes void
 * @return array The filled meta boxes
 */
function ciRegisterMetaBoxes( $meta_boxes ) {
    global $ciSidebars;
    reset($ciSidebars);
    /**
     * Prefix of meta keys (optional)
     * Use underscore (_) at the beginning to make keys hidden
     * Alt.: You also can make prefix empty to disable it
     */
    // Better has an underscore as last sign
    $prefix = CI_THEME_PREFIX . '_';

    // 1st meta box
    $meta_boxes[] = array(
        // Meta box id, UNIQUE per meta box. Optional since 4.1.5
        'id' => 'standard',

        // Meta box title - Will appear at the drag and drop handle bar. Required.
        'title' => __( 'Page-specific options', CI_TEXT_DOMAIN ),

        // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
        'pages' => array( 'post', 'page', CI_BEER_TYPE ),

        // Where the meta box appear: normal (default), advanced, side. Optional.
        'context' => 'normal',

        // Order of meta box: high (default), low. Optional.
        'priority' => 'high',

        // Auto save: true, false (default). Optional.
        'autosave' => true,

        // List of meta fields
        'fields' => array(
            // Show page title
            array(
                'name' => __( 'Show page title?', CI_TEXT_DOMAIN ),
                'id'   => "{$prefix}show_page_title",
                'type' => 'checkbox',
                // Value can be 0 or 1
                'std'  => 1,
            ),
            array(
                'name' => __( 'Show page sidebar?', CI_TEXT_DOMAIN ),
                'id'   => "{$prefix}show_page_sidebar",
                'type' => 'checkbox',
                // Value can be 0 or 1
                'std'  => 1,
            ),
            array(
                'name' => __( 'Show featured image?', CI_TEXT_DOMAIN ),
                'id'   => "{$prefix}show_featured_img",
                'type' => 'checkbox',
                // Value can be 0 or 1
                'std'  => 1,
            ),
            array(
                'name' => __( 'Push page down (to show off page background) this many pixels', CI_TEXT_DOMAIN ),
                'id'   => "{$prefix}push_page_down",
                'type' => 'text',
                'std'  => '0',
            ),
            array(
                'name' => __( 'Push footer down (to show off page background) this many pixels', CI_TEXT_DOMAIN ),
                'id'   => "{$prefix}push_footer_down",
                'type' => 'text',
                'std'  => '0',
            ),
            array(
                'name'     => __( 'Which sidebar should we use?', CI_TEXT_DOMAIN ),
                'id'       => "{$prefix}sidebar",
                'type'     => 'select',
                // Array of 'value' => 'Label' pairs for select box
                'options'  => $ciSidebars,
                // Select multiple values, optional. Default is false.
                'multiple'    => false,
                'std'         => key($ciSidebars),
                'placeholder' => __( 'Select an Item', CI_TEXT_DOMAIN ),
            ),
            // Top-of-page image slider
            array(
                'name' => __( 'Show giant image slider at top of page?', CI_TEXT_DOMAIN ),
                'id'   => "{$prefix}top_img_slider",
                'type' => 'checkbox',
                // Value can be 0 or 1
                'std' => 0,
            ),
            // Taxonomy
            array(
                // Field name - Will be used as label
                'name'  => __( 'Show slides from this category at the top of the page (leave blank to show all)', CI_TEXT_DOMAIN ),
                // Field ID, i.e. the meta key
                'id'    => "{$prefix}top_img_slider_cat_string",
                // Field description (optional)
                'desc'  => __( 'If you\'re showing an image slider at the top of the page. Note: give the category "slug."', CI_TEXT_DOMAIN ),
                'type'  => 'text',
                // Default value (optional)
                'std'   => __( '', CI_TEXT_DOMAIN ),
                // CLONES: Add to make the field cloneable (i.e. have multiple value)
                'clone' => false,
            ),
        ),
    );

    // Meta box for the attorneys custom post type
    $meta_boxes[] = array(
        // Meta box id, UNIQUE per meta box. Optional since 4.1.5
        'id' => 'staff-only',

        // Meta box title - Will appear at the drag and drop handle bar. Required.
        'title' => __( 'Individual staff member options', CI_TEXT_DOMAIN ),

        // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
        'pages' => array( CI_STAFF_TYPE ),

        // Where the meta box appear: normal (default), advanced, side. Optional.
        'context' => 'normal',

        // Order of meta box: high (default), low. Optional.
        'priority' => 'high',

        // Auto save: true, false (default). Optional.
        'autosave' => true,

        // List of meta fields
        'fields' => array(
            // Show page title
            array(
                'name' => __( 'Show page title?', CI_TEXT_DOMAIN ),
                'id'   => "{$prefix}show_page_title",
                'type' => 'checkbox',
                // Value can be 0 or 1
                'std'  => 1,
            ),
            array(
                'name' => __( 'Show page sidebar?', CI_TEXT_DOMAIN ),
                'id'   => "{$prefix}show_page_sidebar",
                'type' => 'checkbox',
                // Value can be 0 or 1
                'std'  => 1,
            ),
            array(
                'name'     => __( 'Which sidebar should we use?', CI_TEXT_DOMAIN ),
                'id'       => "{$prefix}sidebar",
                'type'     => 'select',
                // Array of 'value' => 'Label' pairs for select box
                'options'  => $ciSidebars,
                // Select multiple values, optional. Default is false.
                'multiple'    => false,
                'std'         => key($ciSidebars),
                'placeholder' => __( 'Select an Item', CI_TEXT_DOMAIN ),
            ),
            // Top-of-page image slider
            array(
                'name' => __( 'Show giant image slider at top of page?', CI_TEXT_DOMAIN ),
                'id'   => "{$prefix}top_img_slider",
                'type' => 'checkbox',
                // Value can be 0 or 1
                'std' => 0,
            ),
            // Slider
            array(
                'name'  => __( 'Show slides from this category at the top of the page (leave blank to show all)', CI_TEXT_DOMAIN ),
                'id'    => "{$prefix}top_img_slider_cat_string",
                'desc'  => __( 'If you\'re showing an image slider at the top of the page. Note: give the category "slug."', CI_TEXT_DOMAIN ),
                'type'  => 'text',
                // Default value (optional)
                'std'   => __( '', CI_TEXT_DOMAIN ),
                // CLONES: Add to make the field cloneable (i.e. have multiple value)
                'clone' => false,
            ),
            array(
                'type' => 'heading',
                'name' => __( 'Social media links for this attorney', CI_TEXT_DOMAIN ),
                'id'   => 'fake_id', // Not used but needed for plugin
            ),
            // FB
            array(
                'name'  => __( 'Facebook URL', CI_TEXT_DOMAIN ),
                // Field ID, i.e. the meta key
                'id'    => "{$prefix}facebook",
                'desc'  => "Leave blank to hide the Facebook link",
                'type'  => 'text',
                'std'   => __( '', CI_TEXT_DOMAIN ),
                'clone' => false,
            ),
            // Twitter
            array(
                'name'  => __( 'Twitter URL', CI_TEXT_DOMAIN ),
                // Field ID, i.e. the meta key
                'id'    => "{$prefix}twitter",
                'desc'  => "Leave blank to hide the Twitter link",
                'type'  => 'text',
                'std'   => __( '', CI_TEXT_DOMAIN ),
                'clone' => false,
            ),
            // LI
            array(
                'name'  => __( 'LinkedIn URL', CI_TEXT_DOMAIN ),
                // Field ID, i.e. the meta key
                'id'    => "{$prefix}linkedin",
                'desc'  => "Leave blank to hide the LinkedIn link",
                'type'  => 'text',
                'std'   => __( '', CI_TEXT_DOMAIN ),
                'clone' => false,
            ),
            // G+
            array(
                'name'  => __( 'Google+ URL', CI_TEXT_DOMAIN ),
                // Field ID, i.e. the meta key
                'id'    => "{$prefix}google-plus",
                'desc'  => "Leave blank to hide the Google+ link",
                'type'  => 'text',
                'std'   => __( '', CI_TEXT_DOMAIN ),
                'clone' => false,
            ),
        ),
    );

    // Meta box for the Beers custom post type
    $meta_boxes[] = array(
        // Meta box id, UNIQUE per meta box. Optional since 4.1.5
        'id' => 'beer-stats',

        // Meta box title - Will appear at the drag and drop handle bar. Required.
        'title' => __( 'Beer Stats', CI_TEXT_DOMAIN ),

        // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
        'pages' => array( CI_BEER_TYPE ),

        // Where the meta box appear: normal (default), advanced, side. Optional.
        'context' => 'normal',

        // Order of meta box: high (default), low. Optional.
        'priority' => 'high',

        // Auto save: true, false (default). Optional.
        'autosave' => true,

        // List of meta fields
        'fields' => array(
            array(
                'name'  => __( 'Percent Alcohol', CI_TEXT_DOMAIN ),
                'id'    => "{$prefix}abv",
                'desc'  => __("(no % sign)"),
                'type'  => 'text',
                'std'   => '',
                'clone' => false,
            ),
            array(
                'name'  => __( 'IBU', CI_TEXT_DOMAIN ),
                // Field ID, i.e. the meta key
                'id'    => "{$prefix}ibu",
                'type'  => 'text',
                'std'   => '',
                'clone' => false,
            ),
            array(
                'name'  => __( 'Original Gravity (degrees Plato)', CI_TEXT_DOMAIN ),
                // Field ID, i.e. the meta key
                'id'    => "{$prefix}og",
                'type'  => 'text',
                'std'   => '',
                'clone' => false,
            ),
            array(
                'name'  => __( 'Color (degrees SRM)', CI_TEXT_DOMAIN ),
                // Field ID, i.e. the meta key
                'id'    => "{$prefix}srm",
                'type'  => 'text',
                'std'   => '',
                'clone' => false,
            ),
            array(
                'name'  => __( 'Seasonal Availability', CI_TEXT_DOMAIN ),
                // Field ID, i.e. the meta key
                'id'    => "{$prefix}seasonal_availability",
                'type'  => 'text',
                'std'   => '',
                'clone' => false,
            ),
            array(
                'name' => __('Availability', CI_TEXT_DOMAIN),
                'id' => "{$prefix}availability",
                'type' => 'select_advanced',
                // Array of 'value' => 'Label' pairs for select box
                'options' => array(
                    'twelve' => __('12 oz. bottles', CI_TEXT_DOMAIN),
                    'twentytwo' => __('22 oz. bottles', CI_TEXT_DOMAIN),
                    'sevenfifty' => __('750 mL bottles', CI_TEXT_DOMAIN),
                    'draft' => __('Draft', CI_TEXT_DOMAIN),
                    'nitro' => __('Nitro Draft', CI_TEXT_DOMAIN)
                ),
                // Select multiple values, optional. Default is false.
                'multiple' => true,
            ),
        ),
    );

    return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'ciRegisterMetaBoxes');







