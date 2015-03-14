<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

require_once "lib/appearance/FontOptionsBuilder.php";

function optionsframework_option_name() {
	$themename = "Conversion Insights Base";//wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * To see an example, check out: https://github.com/devinsays/options-framework-theme/blob/master/options.php
 */

if( !function_exists('optionsframework_options') ) {
    function optionsframework_options() {
        $patternPath = get_template_directory_uri() . '/assets/img/patterns/';
        $colorPath = get_template_directory_uri() . '/assets/img/colors/';

        $options = array();


        /**************************************************************
                               Basics
         ***************************************************************/
        $options[] = array(
            'name' => __('Basics', CI_TEXT_DOMAIN),
            'type' => 'heading');
        $options[] = array(
            'name' => __("Theme Style", CI_TEXT_DOMAIN),
            'desc' => __("Select one of a number of site-wide visual styles", CI_TEXT_DOMAIN),
            'id' => "style",
            'std' => "clean",
            'type' => "select",
            'class' => 'mini',
            'options' => array(
                CI_STYLE_CLEAN => __("Clean", CI_TEXT_DOMAIN),
                CI_STYLE_GRUNGY => __("Grunge", CI_TEXT_DOMAIN)
            )
        );
        $options[] = array(
            'name' => __('', CI_TEXT_DOMAIN),
            'desc' => __('<h3>Footer options</h3>', CI_TEXT_DOMAIN),
            'type' => 'info');
        $options[] = array(
            'name' => __('Footer columns', CI_TEXT_DOMAIN),
            'desc' => __('Each widget in the footer "sidebar" will be treated as its own column.', CI_TEXT_DOMAIN),
            'id' => 'footer_columns',
            'std' => '4',
            'class' => 'mini',
            'type' => 'text');
        $options[] = array(
            'name' => __('', CI_TEXT_DOMAIN),
            'desc' => __('<h3>Age Verification</h3>', CI_TEXT_DOMAIN),
            'type' => 'info');
        $options[] = array(
            'name' => __('Require users to be 21?', CI_TEXT_DOMAIN),
            'desc' => __('If checked, we\'ll require the user to confirm their date of birth before showing any content.', CI_TEXT_DOMAIN),
            'id' => 'age_verification',
            'std' => '1',
            'type' => 'checkbox');
        $options[] = array(
            'name' => __('Background image for age verification', CI_TEXT_DOMAIN),
            'desc' => __('To use a large image as the background on the age verification overlay (instead of a flat, solid color), upload an image here.<br /> Recommended size: 1600x1024 or larger.', CI_TEXT_DOMAIN),
            'id' => 'age_verification_image_bg',
            'type' => 'upload');
        $options[] = array(
            'name' => __('', CI_TEXT_DOMAIN),
            'desc' => __('<h3>Google Analytics options</h3>', CI_TEXT_DOMAIN),
            'type' => 'info');
        $options[] = array(
            'name' => __('Google Analytics ID', CI_TEXT_DOMAIN),
            'desc' => __('Format: <code>UA-XXXXX-Y</code> (Note: Universal Analytics only, not Classic Analytics)', CI_TEXT_DOMAIN),
            'id' => 'analytics_id',
            'std' => '',
            'class' => 'mini',
            'type' => 'text');
        $options[] = array(
            'name' => __('', CI_TEXT_DOMAIN),
            'desc' => __('Note that Analytics tracking will <em>not</em> be active when you are logged in. (Open a different Web browser to test it.)', CI_TEXT_DOMAIN),
            'type' => 'info');



        /**************************************************************
                        Header
         ***************************************************************/
        $options[] = array(
            'name' => __('Header', CI_TEXT_DOMAIN),
            'type' => 'heading');

        $options[] = array(
            'name' => __('Firm Logo', CI_TEXT_DOMAIN),
            'desc' => __('By default, we use the <a href="./options-general.php">site title</a> as the "logo." To use an image instead, set it here.<br /> Recommended size: 300x37.', CI_TEXT_DOMAIN),
            'id' => 'firm_logo',
            'type' => 'upload');


        $options[] = array(
            'name' => __('SVG version of logo', CI_TEXT_DOMAIN),
            'desc' => __('If you choose to use an SVG version of the logo, the bitmap (above) will be used as a fallback.', CI_TEXT_DOMAIN),
            'id' => 'svg_logo',
            'type' => 'upload');
        $options[] = array(
            'name' => __('Width to display SVG', CI_TEXT_DOMAIN),
            'desc' => __('(in pixels)&mdash;should be the same as the bitmap version\'s width', CI_TEXT_DOMAIN),
            'id' => 'svg_logo_width',
            'std' => '',
            'class' => 'mini',
            'type' => 'text');
        $options[] = array(
            'name' => __('Height to display SVG', CI_TEXT_DOMAIN),
            'desc' => __('(in pixels)&mdash;should be the same as the bitmap version\'s height', CI_TEXT_DOMAIN),
            'id' => 'svg_logo_height',
            'std' => '',
            'class' => 'mini',
            'type' => 'text');

        $options[] = array(
            'name' => __('Additional "menu" text', CI_TEXT_DOMAIN),
            'desc' => __('This will appear to the far right of the navigation menu. Example: Call us at (123) 456-7890', CI_TEXT_DOMAIN),
            'id' => 'additional_menu_text',
            'std' => '',
            'type' => 'textarea');

        $options[] = array(
            'name' => __('Fix navigation bar to the top of the screen?', CI_TEXT_DOMAIN),
            'desc' => __('If checked, the navigation will follow the user down the page.', CI_TEXT_DOMAIN),
            'id' => 'navbar_fixed',
            'std' => '0',
            'type' => 'checkbox');

        $options[] = array(
            'name' => __('Show social media icons to the right of the nav bar?', CI_TEXT_DOMAIN),
            'desc' => 'If checked, we\'ll display the social media links that you set up in the Social tab above',
            'id' => 'social_in_nav',
            'std' => '0',
            'type' => 'checkbox');


        /**************************************************************
                        Fonts
         ***************************************************************/
        $options[] = array(
            'name' => __('Fonts', CI_TEXT_DOMAIN),
            'type' => 'heading');

        $options[] = array(
            'desc' => __('<h2 style="font-weight:bold;border-bottom:1px solid #333">Advanced font selection</h2><br />' .
                         'Here, you can use just about any font you find in the <a href="http://www.google.com/fonts/" target="_blank">Google Fonts directory</a>.', CI_TEXT_DOMAIN),
            'type' => 'info');
        $options[] = array(
            'desc' => __('<strong>NOTE</strong>: It is recommended that you use a maximum of two to three fonts. More fonts will slow down page loads and generally look less professional.', CI_TEXT_DOMAIN),
            'type' => 'info');

        $fontOptions = new FontOptionsBuilder();

        $options[] = array(
            'desc' => __('<h3 style="margin-top:3em">Page title (a.k.a. H1) font</h2>', CI_TEXT_DOMAIN),
            'type' => 'info');
        $options[] = $fontOptions->getFontFamilySelect('title_font_family', "Bree+Serif");
        $options[] = $fontOptions->getFontFamilyVariants('title_font_variants');
        $options[] = $fontOptions->getWeightOption('title_font_weight', '400');
        $options[] = $fontOptions->getFallbackOption('title_font_fallback', 'Georgia, Garamond, sans-serif');

        $options[] = array(
            'desc' => __('<h3 style="margin-top:3em">Heading (a.k.a. H2, H3, and H4) font</h3>', CI_TEXT_DOMAIN),
            'type' => 'info');
        $options[] = $fontOptions->getFontFamilySelect('heading_font_family', "Bree+Serif");
        $options[] = $fontOptions->getFontFamilyVariants('heading_font_variants');
        $options[] = $fontOptions->getWeightOption('heading_font_weight', '400');
        $options[] = $fontOptions->getFallbackOption('body_font_fallback', 'Georgia, Garamond, sans-serif');


        $openSansDefaultVariants = array(
            '300italic' => '1',
            '400italic' => '1',
            '700italic' => '1',
            '400' => '1',
            '300' => '1',
            '700' => '1',
        );
        $options[] = array(
            'desc' => __('<h3 style="margin-top:3em">Body font</h3>', CI_TEXT_DOMAIN),
            'type' => 'info');
        $options[] = $fontOptions->getFontFamilySelect('body_font_family', "Open+Sans");
        $options[] = $fontOptions->getFontFamilyVariants('body_font_variants', $openSansDefaultVariants);
        $options[] = $fontOptions->getWeightOption('body_font_weight', '400');
        $options[] = $fontOptions->getFallbackOption('body_font_fallback', '"Helvetica Neue", Helvetica, Arial, sans-serif');

        $options[] = array(
            'desc' => __('<h3 style="margin-top:3em">Widget title font</h3>', CI_TEXT_DOMAIN),
            'type' => 'info');
        $options[] = $fontOptions->getFontFamilySelect('widget_title_font_family', "Open+Sans");
        $options[] = $fontOptions->getFontFamilyVariants('widget_title_font_variants', $openSansDefaultVariants);
        $options[] = $fontOptions->getWeightOption('widget_title_font_weight', '700');
        $options[] = $fontOptions->getFallbackOption('widget_title_font_fallback', '"Helvetica Neue", Helvetica, Arial, sans-serif');

        $options[] = array(
            'desc' => __('<h3 style="margin-top:3em">Menu font</h3>', CI_TEXT_DOMAIN),
            'type' => 'info');
        $options[] = $fontOptions->getFontFamilySelect('menu_font_family', "Open+Sans");
        $options[] = $fontOptions->getFontFamilyVariants('menu_font_variants', $openSansDefaultVariants);
        $options[] = $fontOptions->getWeightOption('menu_font_weight', '700');
        $options[] = $fontOptions->getFallbackOption('menu_font_fallback', '"Helvetica Neue", Helvetica, Arial, sans-serif');



        /**************************************************************
                    Appearance (advanced)
         ***************************************************************/
        $options[] = array(
            'name' => __('Appearance (advanced)', CI_TEXT_DOMAIN),
            'type' => 'heading');

        $options[] = array(
            'name' => __('', CI_TEXT_DOMAIN),
            'desc' => __('<strong>NOTE</strong>: Basic appearance settings, including the colors used by the theme,' .
                         ' can be set using the Wordpress "<a href="./customize.php">Customize</a>" tool.<br />' .
                         '<a class="btn btn-primary mt10" href="./customize.php" style="text-decoration:none">Take me to the basic appearance options</a>', CI_TEXT_DOMAIN),
            'type' => 'info');

        $options[] = array(
            'name' => __('Make pages full-width?', CI_TEXT_DOMAIN),
            'desc' => __('If checked, we will make pages the full width of the browser window, instead of being inside a "page" container.', CI_TEXT_DOMAIN),
            'id' => 'full_width_container',
            'std' => '0',
            'type' => 'checkbox');

        $options[] = array(
            'name' => __('Show sidebar on "All Beers" page?', CI_TEXT_DOMAIN),
            'desc' => __('If checked, we\'ll display the beers in two columns with your default sidebar.', CI_TEXT_DOMAIN),
            'id' => 'show_sidebar_on_beer_archive',
            'std' => '0',
            'type' => 'checkbox');

        $options[] = array(
            'name' => "Color theme",
            'desc' => "By default, we use a light blue-and-charcoal color theme. You can select a different theme here. <strong>NOTE</strong>: This will not override your settings in the <a href=\"./customize.php\">basic appearance options</a>.",
            'id' => "color_theme",
            'std' => "blue_charcoal",
            'type' => "images",
            'options' => array(
                'blue_charcoal' => $colorPath . 'blue_charcoal.png',
                'red_charcoal' => $colorPath . 'red_charcoal.png',
                'green_charcoal' => $colorPath . 'green_charcoal.png',
                'orange_charcoal' => $colorPath . 'orange_charcoal.png',
                'blue_green' => $colorPath . 'blue_green.png',
                'brown' => $colorPath . 'brown.png',
                'royalblue' => $colorPath . 'royalblue.png',
                'purple' => $colorPath . 'purple.png',
                'darkgreen' => $colorPath . 'darkgreen.png',
                'multi' => $colorPath . 'multi.png',
            )
        );


        $options[] = array(
            'name' => __('Full-screen background image', CI_TEXT_DOMAIN),
            'desc' => __('To use a large image as the background to the pages (instead of a flat, solid color), upload an image here.<br /> Recommended size: 1600x1024 or larger.', CI_TEXT_DOMAIN),
            'id' => 'full_screen_image_bg',
            'type' => 'upload');

        $options[] = array(
            'name' => "Background pattern",
            'desc' => "To use a subtle pattern (from subtlepatterns.com) as the background to the pages (instead of a flat, solid color or an image), select a pattern here.",
            'id' => "pattern_bg",
            'std' => "none",
            'type' => "images",
            'options' => array(
                'none' => $patternPath . 'none.png',
                'brushed_@2X' => $patternPath . 'brushed_@2X.png',
                'grey_wash_wall' => $patternPath . 'grey_wash_wall.jpg',
                'light_grey' => $patternPath . 'light_grey.png',
                'nice_snow' => $patternPath . 'nice_snow.png',
                'ricepaper_v3' => $patternPath . 'ricepaper_v3.png',
                'sandpaper' => $patternPath . 'sandpaper.png',
                'sos' => $patternPath . 'sos.png',
                'stardust_@2X' => $patternPath . 'stardust_@2X.png',
                'ticks_@2X' => $patternPath . 'ticks_@2X.png',
                'tweed_@2X' => $patternPath . 'tweed_@2X.png',
                'witewall_3_@2X' => $patternPath . 'witewall_3_@2X.png')
        );
        $options[] = array(
            'name' => __('Favicon for site', CI_TEXT_DOMAIN),
            'desc' => __('A <a href="http://en.wikipedia.org/wiki/Favicon" target="_blank">favicon</a> is the little icon displayed in the page\'s tab. You can create one from a 16&times;16 image using the <a href="http://www.favicon.cc/" target="_blank">Favicon Generator</a>.', CI_TEXT_DOMAIN),
            'id' => 'favicon',
            'type' => 'upload');
        $options[] = array(
            'name' => __('Apple Touch Icon', CI_TEXT_DOMAIN),
            'desc' => __('When someone adds your site to their home screen on an Apple device (iPhone, iPad, etc.), the <a href="https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html" target="_blank">Apple Touch Icon</a> is the image that will be used. (Typically, a 152&times;152 PNG is recommended.)', CI_TEXT_DOMAIN),
            'id' => 'touch_icon',
            'type' => 'upload');
        $options[] = array(
            'name' => __('Disable added effects on Apple Touch Icon?', CI_TEXT_DOMAIN),
            'desc' => __('Disable curved border, drop shadow, etc. for Apple touch icon', CI_TEXT_DOMAIN),
            'id' => 'touch_icon_precomposed',
            'std' => '0',
            'type' => 'checkbox');

        $options[] = array(
            'name' => __('Custom CSS', CI_TEXT_DOMAIN),
            'desc' => __('If you <em>really</em> don\'t want to create a child theme, you can add custom CSS to the header here.', CI_TEXT_DOMAIN),
            'id' => 'custom_css',
            'std' => '',
            'type' => 'textarea');

        $options[] = array(
            'name' => __('Enable demo mode?', CI_TEXT_DOMAIN),
            'desc' => __('If checked, we will display the theme selector on every page. You probably do not want to do this.', CI_TEXT_DOMAIN),
            'id' => 'mlf_demo_site',
            'std' => '0',
            'type' => 'checkbox');




        /**************************************************************
                    Social media
         ***************************************************************/
        $options[] = array(
            'name' => __('Social Media Links', CI_TEXT_DOMAIN),
            'type' => 'heading');

        $options[] = array(
            'name' => __('Facebook URL', CI_TEXT_DOMAIN),
            'desc' => __('URL for your company\'s Facebook page. <br>(To hide the Facebook icon, leave this blank.)', CI_TEXT_DOMAIN),
            'id' => 'fb',
            'std' => 'http://facebook.com/',
            'type' => 'text');

        $options[] = array(
            'name' => __('Twitter URL', CI_TEXT_DOMAIN),
            'desc' => __('URL for your company\'s Twitter page. <br />(To hide the Twitter icon, leave this blank.)', CI_TEXT_DOMAIN),
            'id' => 'twitter',
            'std' => 'https://twitter.com/',
            'type' => 'text');

        $options[] = array(
            'name' => __('LinkedIn URL', CI_TEXT_DOMAIN),
            'desc' => __('URL for your company\'s LinkedIn page. <br />(To hide the LinkedIn icon, leave this blank.)', CI_TEXT_DOMAIN),
            'id' => 'linkedin',
            'std' => 'http://www.linkedin.com/in/',
            'type' => 'text');

        $options[] = array(
            'name' => __('Google+ URL', CI_TEXT_DOMAIN),
            'desc' => __('URL for your company\'s Google+ page. <br />(To hide the Google+ icon, leave this blank.)', CI_TEXT_DOMAIN),
            'id' => 'gplus',
            'std' => 'https://plus.google.com/',
            'type' => 'text');

        $options[] = array(
            'name' => __('Google+ link is to: ', CI_TEXT_DOMAIN),
            'desc' => __('If you like, you can associate all pages of your site with an individual author or your organization. (<a href="http://www.searchenginejournal.com/claiming-google-authorship-and-publisher-markup-for-seo/61263/" target="_blank">More info</a>)', CI_TEXT_DOMAIN),
            'id' => 'gplus_authorship',
            'std' => 'organization',
            'type' => 'select',
            'options' => $test_array = array(
                    'author' => __('The site\'s primary "author"', CI_TEXT_DOMAIN),
                    'organization' => __('Your company', CI_TEXT_DOMAIN),
                    'none' => __('None', CI_TEXT_DOMAIN)
                ));

        $options[] = array(
            'name' => __('Display social media icons in full color?', CI_TEXT_DOMAIN),
            'desc' => __('', CI_TEXT_DOMAIN),
            'id' => 'social_icons_color',
            'std' => false,
            'type' => 'select',
            'class' => 'mini', //mini, tiny, small
            'options' => array(
                true => 'Yes, full color',
                false => 'No, monochrome'
            ));






        /**************************************************************
                    Footer
         ***************************************************************/
        $options[] = array(
            'name' => __('Footer', CI_TEXT_DOMAIN),
            'type' => 'heading' );

        /**
         * For $settings options see:
         * http://codex.wordpress.org/Function_Reference/wp_editor
         *
         * 'media_buttons' are not supported as there is no post to attach items to
         * 'textarea_name' is set by the 'id' you choose
         */
        $wp_editor_settings = array(
            'wpautop' => true, // Default
            'textarea_rows' => 5,
            'tinymce' => array( 'plugins' => 'wordpress' )
        );

        $options[] = array(
            'name' => __('Footer text (for the bottom of each page)', CI_TEXT_DOMAIN),
            'desc' => "If you'd like text at the very, very bottom of each page, you can type it here.",
            'id' => 'disclaimer',
            'type' => 'editor',
            'settings' => $wp_editor_settings );

        return $options;
    }
}
