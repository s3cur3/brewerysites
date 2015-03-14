<!-- content-beer-archive -->
<?php
$beersPerRow = 4;
if(get_option('show_sidebar_on_beer_archive')) {
    $beersPerRow = 2;
}

echo ciGetBeersHTML($beersPerRow, 1000, 2, 250, false, true, true);
