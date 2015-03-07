<?php

global $ciSidebars;
reset($ciSidebars);
$default = key($ciSidebars);

$sidebar = ciGetNormalizedMeta('sidebar', $default);
dynamic_sidebar($sidebar);

?>
