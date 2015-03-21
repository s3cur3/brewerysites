#!/bin/sh

echo "\n\n\nDeleting all hidden files..."
find assets -name '.*' -type f -delete
find docs -name '.*' -type f -delete
find inc -name '.*' -type f -delete
find lang -name '.*' -type f -delete
find lib -name '.*' -type f -delete
find templates -name '.*' -type f -delete

echo "\n\n\nRunning grunt task..."
grunt

ZIP="ci-brewery-base.zip"
echo "\n\n\nNuking existing ZIP"
rm ${ZIP}

echo "\n\n\nCreating build directory"
DIRECTORY="ci-brewery-base"
mkdir $DIRECTORY

echo "\n\n\nCopying files to build directory"
cp -r assets docs inc lang lib templates style.css README.md screenshot.png 404.php archive-ci-beer.php archive-ci-staff.php base-template-landing.php base.php footer-shop.php functions.php Gruntfile.js header-shop.php index.php options.php page.php single-ci-beer.php single-ci-staff.php single.php template-beers.php template-blog.php template-landing.php template-staff.php screenshot.png $DIRECTORY

echo "\n\n\nZipping build directory"
zip -r ${ZIP} ${DIRECTORY}

echo "\n\n\nNuking build directory"
rm -r ${DIRECTORY}