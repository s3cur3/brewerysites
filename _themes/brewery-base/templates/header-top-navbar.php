<?php
$name = get_bloginfo('name');
$brandHTML = $name;
$imgURL = get_option('company_logo', false);
$svgURL = get_option('svg_logo', false);
if( $imgURL ) {
    $width = get_option('logo_width');
    $height = get_option('logo_height');
    $brandHTML = "<img src=\"{$imgURL}\" width=\"{$width}\" height=\"{$height}\" alt=\"{$name}\">";
    if( $svgURL ) {
        $brandHTML = "<img src=\"{$svgURL}\" onerror=\"this.onerror=null; this.src='{$imgURL}'\" width=\"{$width}\" height=\"{$height}\" alt=\"{$name}\">";
    }
}

$navbarType = "static";
if(get_option('navbar_fixed', false)) {
    $navbarType = "fixed";
}

?>
<!-- HEADER-TOP-NAVBAR.PHP -->
<header class="banner navbar navbar-default navbar-<?php echo $navbarType; ?>-top" role="banner">
    <div class="header-container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo home_url(); ?>/"><?php echo $brandHTML; ?></a>
        </div>

        <nav class="collapse navbar-collapse" role="navigation"> <?php
            $socialInNav = get_option('social_in_nav');
            $socialHTML = "";
            if( $socialInNav ) {
                $socialHTML = getSocialLinks();
            }

            $additionalNavText = of_get_option('additional_menu_text', '');
            if( $additionalNavText || $socialHTML ) {
                echo "<div class=\"post-nav\">{$additionalNavText}{$socialHTML}</div>";
            }

            if( has_nav_menu('primary_navigation') ) {
                wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav'));
            } ?>
        </nav>
    </div>
</header>
