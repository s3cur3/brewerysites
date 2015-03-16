<?php

function ciGetColorTheme() {
    $theme = of_get_option('color_theme', 'blue_charcoal');
    if( isset($_GET['color']) ) {
        $theme = $_GET['color'];
    }


    $link = '#428bca';
    $name = '#27201D';
    $bg = '#eeeeee';
    $secondaryBG = '#27201D';
    $h2 = "#27201D";
    $h1 = "#27201D";
    $btn = '#428bca';
    $h2OnSecondary = "#ffffff";
    switch( $theme ) {
        case "red_charcoal":
            $link = '#A60304';
            $btn = $link;
            $h2OnSecondary = "#ffffff";
            break;
        case "green_charcoal":
            $link = '#20C033';
            $btn = $link;
            $h2OnSecondary = "#ffffff";
            break;
        case "orange_charcoal":
            $link = '#F66200';
            $btn = $link;
            $h2OnSecondary = "#ffffff";
            break;
        case "blue_green":
            $link = '#3FAFE9';
            $btn = '#50A038';
            $bg = '#ffffff';
            $h2 = $link;
            $h2OnSecondary = $h2;
            break;
        case "brown":
            $link = "#6871A5";//'#4E6094';
            $btn = '#C48851';
            $name = '#6B3010';
            $secondaryBG = '#3B3129';
            $bg = "#ffffff";
            $h2 = $btn;
            $h1 = $secondaryBG;
            $h2OnSecondary = $h2;
            break;
        case "royalblue":
            $link = '#418EBF';
            $name = '#17558C';
            $bg = '#e9f0f5';
            $secondaryBG = '#133663';
            $h2 = $link;
            $h1 = $secondaryBG;
            $btn = $link;
            $h2OnSecondary = $h2;
            break;
        case "purple":
            $link = '#B068C2';
            $name = '#390A74';
            $bg = '#EDE6ED';
            $secondaryBG = $name;
            $h2 = $link;
            $h1 = $name;
            $btn = $link;
            $h2OnSecondary = $h2;
            break;
        case "darkgreen":
            $link = '#0A8C00';
            $name = $link;
            $bg = '#CADBC5';
            $secondaryBG = "#002800";
            $h2 = $link;
            $h1 = $name;
            $btn = $link;
            $h2OnSecondary = $h2;
            break;
        case "multi":
            $link = '#45B29D';
            $name = '#E27A3F';
            $bg = '#ffffff';
            $secondaryBG = '#334D5C';
            $h2 = "#E27A3F";
            $h1 = "#45B29D";
            $btn = '#45B29D';
            $h2OnSecondary = $h2;
            break;

    }
    return array(
        'splash_color' => $link,
        'header_highlight_color' => $link,
        'header_hover_color' => "#ffffff",
        'header_text_color' => "#777777",
        'firm_name_color' => $name,
        'background_color' => $bg,
        'secondary_background_color' => $secondaryBG,
        'heading_color' => $h2,
        'page_title_color' => $h1,
        'button_color' => $btn,
        'heading_on_secondary_background' => $h2OnSecondary,
    );
}


// Register colorpickers
add_action('customize_register', 'ciCustomizeRegister');
function ciCustomizeRegister($wp_customize)
{
    $defaultColors = ciGetColorTheme();


    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // PAGE SETUP
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $wp_customize->add_section('page_setup', array('title' => __('Page Setup', CI_TEXT_DOMAIN), 'priority' => 0,));

    $wp_customize->add_setting('style', array('default' => CI_STYLE_CLEAN, 'capability' => 'edit_theme_options', 'type' => 'option'));
    $wp_customize->add_control('style', array('label' => __('Theme Style', CI_TEXT_DOMAIN), 'section' => 'page_setup', 'type' => 'radio',
        'choices'    => array(
            CI_STYLE_CLEAN => __("Clean", CI_TEXT_DOMAIN),
            CI_STYLE_GRUNGY => __("Grunge", CI_TEXT_DOMAIN)
        ),
    ));

    $wp_customize->add_setting('full_width_container', array('type' => 'option', 'capability' => 'edit_theme_options'));
    $wp_customize->add_control('full_width_container', array('label' => 'Make Pages Full-Width?', 'section' => 'page_setup', 'type' => 'checkbox', 'std' => 0));

    $wp_customize->add_setting('show_sidebar_on_beer_archive', array('type' => 'option', 'capability' => 'edit_theme_options'));
    $wp_customize->add_control('show_sidebar_on_beer_archive', array('label' => 'Show sidebar on "All Beers" page?', 'section' => 'page_setup', 'type' => 'checkbox', 'std' => 0));

    $wp_customize->add_setting('full_screen_image_bg', array('type' => 'option', 'capability' => 'edit_theme_options'));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'full_screen_image_bg', array('label' => __('Full-Screen Background Image', CI_TEXT_DOMAIN), 'section' => 'page_setup')));





    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // HEADER
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $headerOption = array(
        array(
            'slug' => 'navbar_fixed',
            'default' => false,
            'label' => __('Fix navigation bar to top of screen?', CI_TEXT_DOMAIN),
            'type' => 'checkbox'
        ),
        array(
            'slug' => 'firm_name_color',
            'default' => $defaultColors['firm_name_color'],
            'label' => __('Company Name Color', CI_TEXT_DOMAIN),
            'type' => 'color'
        ),
        array(
            'slug' => 'header_text_color',
            'default' => $defaultColors['header_text_color'],
            'label' => __('Nav Menu Text Color', CI_TEXT_DOMAIN),
            'type' => 'color'
        ),
        array(
            'slug' => 'header_highlight_color',
            'default' => $defaultColors['header_highlight_color'],
            'label' => __('Nav Menu Highlight ("You Are Here") Color', CI_TEXT_DOMAIN),
            'type' => 'color'
        ),
        array(
            'slug' => 'header_hover_color',
            'default' => $defaultColors['header_hover_color'],
            'label' => __('Nav Menu Hover Color', CI_TEXT_DOMAIN),
            'type' => 'color'
        ),
        array(
            'slug' => 'header_link_bg_is_solid',
            'default' => true,
            'label' => __('Menu Button Background Is Solid Color?', CI_TEXT_DOMAIN),
            'type' => 'checkbox'
        ),
        array(
            'slug' => 'header_link_bg_color',
            'default' => $defaultColors['header_link_bg_color'],
            'label' => __('Nav Menu Background Color (if menu button background is solid)', CI_TEXT_DOMAIN),
            'type' => 'color'
        ),
        array(
            'slug' => 'header_link_size',
            'default' => '100',
            'label' => __('Nav Menu Text Size (percent)', CI_TEXT_DOMAIN),
            'type' => 'text'
        ),
        array(
            'slug' => 'company_logo',
            'label' => __('Company Logo', CI_TEXT_DOMAIN),
            'type' => 'image'
        ),
        array(
            'slug' => 'svg_logo',
            'label' => __('Company Logo (SVG Version, used only on supported browsers)', CI_TEXT_DOMAIN),
            'type' => 'image'
        ),
        array(
            'slug' => 'logo_width',
            'default' => '',
            'label' => __('Width to display logo (px)', CI_TEXT_DOMAIN),
            'type' => 'text'
        ),
        array(
            'slug' => 'logo_height',
            'default' => '',
            'label' => __('Height to display logo (px)', CI_TEXT_DOMAIN),
            'type' => 'text'
        ),
        array(
            'slug' => 'logo_top_padding',
            'default' => '24',
            'label' => __('Top padding for logo (px)', CI_TEXT_DOMAIN),
            'type' => 'text'
        ),
        array(
            'slug' => 'social_in_nav',
            'default' => false,
            'label' => __('Show social media icons to the right of the nav bar?', CI_TEXT_DOMAIN),
            'type' => 'checkbox'
        ),
    );

    $wp_customize->add_section('header', array('title' => __('Header', CI_TEXT_DOMAIN), 'description' => __('Set the color scheme for the navigation bar', CI_TEXT_DOMAIN), 'priority' => 0,));
    foreach($headerOption as $option) {
        if($option['type'] == 'color') {
            $wp_customize->add_setting($option['slug'], array('default' => $option['default'], 'type' => 'option', 'capability' => 'edit_theme_options'));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $option['slug'], array('label' => $option['label'], 'section' => 'header', 'settings' => $option['slug'])));
        } elseif($option['type'] == 'checkbox') {
            $wp_customize->add_setting($option['slug'], array('type' => 'option', 'capability' => 'edit_theme_options'));
            $wp_customize->add_control($option['slug'], array('label' => $option['label'], 'section' => 'header', 'type' => 'checkbox', 'std' => 1));
        } elseif($option['type'] == 'text') {
            $wp_customize->add_setting($option['slug'], array('default' => $option['default'], 'type' => 'option', 'capability' => 'edit_theme_options'));
            $wp_customize->add_control($option['slug'], array('label' => $option['label'], 'section' => 'header'));
        }  elseif($option['type'] == 'image') {
            $wp_customize->add_setting($option['slug'], array('type' => 'option', 'capability' => 'edit_theme_options'));
            $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, $option['slug'], array('label' => $option['label'], 'section' => 'header')));
        } else {
            die($option['type']);
        }
    }


    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // BODY COLORS
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $colors = array();
    $colors[] =
        array(
            'slug' => 'splash_color',
            'default' => $defaultColors['splash_color'],
            'label' => __('Link Color', CI_TEXT_DOMAIN)
        );
    $colors[] =
        array(
            'slug' => 'button_color',
            'default' => $defaultColors['button_color'],
            'label' => __('Button Color', CI_TEXT_DOMAIN)
        );
    $colors[] =
        array(
            'slug' => 'page_title_color',
            'default' => $defaultColors['page_title_color'],
            'label' => __('Page Title Color', CI_TEXT_DOMAIN)
        );
    $colors[] =
        array(
            'slug' => 'heading_color',
            'default' => $defaultColors['heading_color'],
            'label' => __('Level 2 Heading Color', CI_TEXT_DOMAIN)
        );
    $colors[] =
        array(
            'slug' => 'background_color',
            'default' => $defaultColors['background_color'],
            'label' => __('Background Color', CI_TEXT_DOMAIN)
        );
    $colors[] =
        array(
            'slug' => 'secondary_background_color',
            'default' => $defaultColors['secondary_background_color'],
            'label' => __('Secondary Background Color', CI_TEXT_DOMAIN)
        );

    $wp_customize->add_section('colors', array('title' => __('Body Colors', CI_TEXT_DOMAIN), 'description' => __('Set the color scheme for the page contents', CI_TEXT_DOMAIN), 'priority' => 0,));
    foreach ($colors as $color) {
        // SETTINGS
        $wp_customize->add_setting($color['slug'], array('default' => $color['default'], 'type' => 'option', 'capability' => 'edit_theme_options'));

        // CONTROLS
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $color['slug'], array('label' => $color['label'], 'section' => 'colors', 'settings' => $color['slug'])));
    }



    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // FANCY LANDING COLORS
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $colors = array(
        array(
            'slug' => 'fancy_landing_text_color',
            'default' => "#333333",
            'label' => __('Text Color', CI_TEXT_DOMAIN)
        ),
        array(
            'slug' => 'fancy_landing_splash_color',
            'default' => $defaultColors['splash_color'],
            'label' => __('Highlight Color', CI_TEXT_DOMAIN)
        ),
        array(
            'slug' => 'fancy_landing_page_title_color',
            'default' => $defaultColors['page_title_color'],
            'label' => __('Page Title Color', CI_TEXT_DOMAIN)
        ),
        array(
            'slug' => 'fancy_landing_heading_color',
            'default' => $defaultColors['heading_color'],
            'label' => __('Other Headings Color', CI_TEXT_DOMAIN)
        )
    );

    $section = 'fancy_landing';
    $wp_customize->add_section($section, array('title' => __('Fancy Landing Pages', CI_TEXT_DOMAIN), 'description' => __('Configure the "fancy" landing pages (available from a checkbox when editing an individual page)', CI_TEXT_DOMAIN), 'priority' => 0,));
    foreach ($colors as $color) {
        // SETTINGS
        $wp_customize->add_setting($color['slug'], array('default' => $color['default'], 'type' => 'option', 'capability' => 'edit_theme_options'));

        // CONTROLS
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $color['slug'], array('label' => $color['label'], 'section' => $section, 'settings' => $color['slug'])));
    }





    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // FOOTER
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $footerOptions = array(
        array(
            'slug' => 'footer_columns',
            'default' => '4',
            'label' => __('Footer Columns (1-4)', CI_TEXT_DOMAIN),
            'type' => 'text'
        ),
    );

    $wp_customize->add_section('footer', array('title' => __('Footer', CI_TEXT_DOMAIN), 'priority' => 100,));
    foreach($footerOptions as $option) {
        if($option['type'] == 'color') {
            $wp_customize->add_setting($option['slug'], array('default' => $option['default'], 'type' => 'option', 'capability' => 'edit_theme_options'));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $option['slug'], array('label' => $option['label'], 'section' => 'footer', 'settings' => $option['slug'])));
        } elseif($option['type'] == 'checkbox') {
            $wp_customize->add_setting($option['slug'], array('type' => 'option', 'capability' => 'edit_theme_options'));
            $wp_customize->add_control($option['slug'], array('label' => $option['label'], 'section' => 'footer', 'type' => 'checkbox', 'std' => 1));
        } elseif($option['type'] == 'text') {
            $wp_customize->add_setting($option['slug'], array('default' => $option['default'], 'type' => 'option', 'capability' => 'edit_theme_options'));
            $wp_customize->add_control($option['slug'], array('label' => $option['label'], 'section' => 'footer'));
        }  elseif($option['type'] == 'image') {
            $wp_customize->add_setting($option['slug'], array('type' => 'option', 'capability' => 'edit_theme_options'));
            $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, $option['slug'], array('label' => $option['label'], 'section' => 'footer')));
        } else {
            die($option['type']);
        }
    }






    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // AGE VERIFICATION
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $wp_customize->add_section('age_verification', array('title' => __('Age Verification', CI_TEXT_DOMAIN), 'priority' => 100,));

    $wp_customize->add_setting('age_verification', array('type' => 'option', 'capability' => 'edit_theme_options'));
    $wp_customize->add_control('age_verification', array('label' => 'Require users to be 21?', 'section' => 'age_verification', 'type' => 'checkbox', 'std' => 1));

    $wp_customize->add_setting('age_verification_image_bg', array('type' => 'option', 'capability' => 'edit_theme_options'));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'age_verification_image_bg', array('label' => __('Full-Screen Background Image (Age Verification Overlay)', CI_TEXT_DOMAIN), 'section' => 'age_verification')));



}


/**
 * @param $hex string A hexidecimal color (like "#ffffff")
 * @param $steps int The amount to lighten or darken the color. Should be between -255 and 255,
 *                   with negative colors darkening and positive colors lightening.
 * @return string The hex value of the darkened/lightened color, beginning with "#"
 */
function ciAdjustBrightness($hex, $steps) {
    $steps = max(-255, min(255, $steps));

    // Format the hex color string
    $hex = str_replace('#', '', $hex);
    if (strlen($hex) == 3) {
        $hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
    }

    // Get decimal values
    $r = hexdec(substr($hex,0,2));
    $g = hexdec(substr($hex,2,2));
    $b = hexdec(substr($hex,4,2));

    // Adjust number of steps and keep it inside 0 to 255
    $r = max(0,min(255,$r + ($r * ($steps / 255))));
    $g = max(0,min(255,$g + ($g * ($steps / 255))));
    $b = max(0,min(255,$b + ($b * ($steps / 255))));

    $r_hex = str_pad(dechex($r), 2, '0', STR_PAD_LEFT);
    $g_hex = str_pad(dechex($g), 2, '0', STR_PAD_LEFT);
    $b_hex = str_pad(dechex($b), 2, '0', STR_PAD_LEFT);

    return '#'.$r_hex.$g_hex.$b_hex;
}




add_action( 'ci_styles', 'ciPrintCustomColorStyling');
function ciPrintCustomColorStyling() {
    /**
     * Gets the customized color for a particular use.
     * @param string $colorIdentifier The name of the color, as registered with the WordPress theme customizer
     * @return string The color, in the form "#xxxxxxx"
     */
    function ciGetNormalizedColor($colorIdentifier) {
        $defaultColors = ciGetColorTheme();
        $clr = get_option($colorIdentifier);
        if( ($clr == "" || $clr == "#") && array_key_exists($colorIdentifier, $defaultColors) ) {
            $clr = $defaultColors[$colorIdentifier];
        }

        // Hack to keep this from being in the Customize options
        if( $colorIdentifier == 'heading_on_secondary_background' && !$clr ) {
            $clr = $defaultColors[$colorIdentifier];
        }

        if( $clr[0] !== "#" ) {
            $clr = "#" . $clr;
        }

        return $clr;
    }

    // Body colors
    $splash = ciGetNormalizedColor('splash_color');
    $firm_name = ciGetNormalizedColor('firm_name_color');
    $background = ciGetNormalizedColor('background_color');
    $secondaryBG = ciGetNormalizedColor('secondary_background_color');
    $h1 = ciGetNormalizedColor('page_title_color');
    $h2 = ciGetNormalizedColor('heading_color');
    $h2OnSecondary = ciGetNormalizedColor('heading_on_secondary_background');
    $btn = ciGetNormalizedColor('button_color');

    // Fancy landing pages
    $fancy_landing_splash = ciGetNormalizedColor('fancy_landing_splash_color');
    $fancy_landing_text = ciGetNormalizedColor('fancy_landing_text_color');
    $fancy_landing_h1 = ciGetNormalizedColor('fancy_landing_page_title_color');
    $fancy_landing_h2 = ciGetNormalizedColor('fancy_landing_heading_color');

    // Header stuff
    $header_text_color = ciGetNormalizedColor('header_text_color');
    $header_highlight_color = ciGetNormalizedColor('header_highlight_color');
    $header_link_bg_is_solid = get_option('header_link_bg_is_solid');
    $header_link_size = get_option('header_link_size');
    $header_link_bg_color = ciGetNormalizedColor('header_link_bg_color');
    $header_hover_color = ciGetNormalizedColor('header_hover_color');
    $logo_top_padding = get_option('logo_top_padding');

    // Image background
    $backgroundImg = get_option("full_screen_image_bg");
    $backgroundImgAgeVerification = of_get_option("age_verification_image_bg");
    $backgroundPattern = of_get_option("pattern_bg");
    $menuBackgroundPattern = of_get_option("menu_pattern_bg");

    $patternPath = get_template_directory_uri() . '/assets/img/patterns/';

?>
    <!-- From customization.php -->
    <style>
        body {
            background: <?php echo $background; ?>;
<?php
            if( $backgroundImg ) { ?>
                background: url(<?php echo $backgroundImg; ?>) no-repeat center center fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover; <?php
            } else if( $backgroundPattern && $backgroundPattern != 'none' ) { ?>
                background-image: url('<?php echo $patternPath, $backgroundPattern; ?>.png');
                background-repeat: repeat;
                background-position: center center;<?php
            } ?>
        }

        <?php if($backgroundImgAgeVerification) { ?>
        #age-verification-overlay-wrap {
            background: url(<?php echo $backgroundImgAgeVerification; ?>) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
        <?php }?>

        .navbar-default .navbar-nav>.active>a, .navbar-default .navbar-nav>.active>a:hover, .navbar-default .navbar-nav>.active>a:focus, .dropdown-menu>.active>a, .dropdown-menu>.active>a:hover, .dropdown-menu>.active>a:focus {
            background: <?php echo $splash; ?>;
            color: #fff;
        }
        .navbar {
            <?php if($menuBackgroundPattern && $menuBackgroundPattern != 'none') { ?>
                background: url('<?php echo $patternPath, $menuBackgroundPattern; ?>.png') repeat center center;
            <?php } ?>
        }

        .fancy-landing main > p, .fancy-landing main > div, .fancy-landing main > span {
            color: <?php echo $fancy_landing_text ?>;
        }

        h1 {
            color: <?php echo $h1 ?>;
        }
        h2 {
            color: <?php echo $h2 ?>;
        }
        .fancy-landing h1 {
            color: <?php echo $fancy_landing_h1 ?>;
        }
        .fancy-landing h2, .fancy-landing h3, .fancy-landing h4  {
            color: <?php echo $fancy_landing_h2 ?>;
        }
        .colored-bg {
            background: <?php echo $secondaryBG; ?>;
        }
        .colored-bg.highlight, .fancy-landing .beer h3 {
            background: <?php echo $fancy_landing_splash; ?>;
        }
        .fancy-landing .beer h3:hover {
            background: <?php echo ciAdjustBrightness($fancy_landing_splash, -40); ?>;
        }
        .carousel-caption h2 {
            color: #fff;
        }
        .inverted h2 {
            color: <?php echo $h2OnSecondary; ?>;
        }

        a, .individual-post .meta a:hover {
            color: <?php echo $splash; ?>;
        }
        a:hover, a:focus {
            color: <?php echo ciAdjustBrightness($splash, -30) ?>;
        }

        .fancy-landing a {
            color: <?php echo $fancy_landing_splash; ?>;
        }
        .fancy-landing a:hover, .fancy-landing a:focus {
            color: <?php echo ciAdjustBrightness($fancy_landing_splash, -30) ?>;
        }

        .navbar-default .navbar-brand {
            color: <?php echo $firm_name; ?>;
            padding-top: <?php echo $logo_top_padding ?>px;
        }
        .navbar-default .navbar-brand:hover {
            color: <?php echo $header_highlight_color; ?>
        }
        .navbar-default .navbar-nav>li>a {
            color: <?php echo $header_text_color; ?>;
            background: <?php echo $header_link_bg_is_solid ? $header_link_bg_color : 'transparent' ?>;
        }
        .navbar-default .navbar-nav>li>a:hover, .navbar-default .navbar-nav>li>a:focus {
            background: <?php echo $header_link_bg_is_solid ? $header_hover_color : 'transparent'; ?>;
            color: <?php echo $header_link_bg_is_solid ? ciAdjustBrightness($header_text_color, -130) : $header_hover_color; ?>;
        }
        .navbar-default .navbar-nav>.open>a, .navbar-default .navbar-nav>.open>a:hover, .navbar-default .navbar-nav>.open>a:focus {
            color: <?php echo ciAdjustBrightness($header_text_color, -130); ?>;
        }
        .navbar-default .navbar-nav>.active>a, .navbar-default .navbar-nav>.active>a:hover, .navbar-default .navbar-nav>.active>a:focus, .dropdown-menu>.active>a, .dropdown-menu>.active>a:hover, .dropdown-menu>.active>a:focus {
            background: <?php echo $header_link_bg_is_solid ? $header_highlight_color : 'transparent'; ?>;;
            color: <?php echo $header_link_bg_is_solid ? "#fff" : $header_highlight_color; ?>;
        }
        .navbar-default .navbar-nav>.active.open>a {
            background: #e7e7e7;
        }

        .navbar-nav > li > a {
            font-size: <?php echo $header_link_size; ?>%;
        }
        <?php if($header_link_size > 110) { ?>
            .navbar-nav>li>a {
                padding-top: 20px;
                padding-bottom: 20px;
            }
        <?php } ?>

        .nsu_widget, footer, .inverted, .carousel-caption.left, .carousel-caption.right {
            background: <?php echo $secondaryBG; ?>;
            color: #fff;
        }

        .btn-primary, input[type="submit"], button[type="submit"] {
            color: #fff;
            background-color: <?php echo $btn; ?>;
            border-color: <?php echo ciAdjustBrightness($btn, -20) ?>; /* slightly darker */
        }
        .btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active, .open .dropdown-toggle.btn-primary, input[type="submit"]:hover, button[type="submit"]:hover, input[type="submit"]:focus, button[type="submit"]:focus, form input[type="submit"]:hover, form input[type="submit"]:focus {
            background-color: <?php echo ciAdjustBrightness($btn, -18) ?>;
            border-color: <?php echo ciAdjustBrightness($btn, -35) ?>;
            color: #fff;
        }

        ul.social-list li a, .individual-post .meta a {
            color: <?php echo $secondaryBG; ?>;
        }

        @media (max-width: 768px) {
            .carousel-caption.left, .carousel-caption.right {
                background: transparent;
            }
        }
    </style>
<?php
}




function ciAddEditorStyles() {
    add_editor_style( 'assets/css/editor-colors.php' );
}
add_action( 'init', 'ciAddEditorStyles');


