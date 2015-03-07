<?php


if(!class_exists('CiBeersType')) {
    class CiBeersType
    {
        const SINGULAR_LC = "beer";
        const SINGULAR_CAP = "Beer";
        const PLURAL_LC = "beers";
        const PLURAL_CAP = "Beers";

        const POST_TYPE = CI_BEER_TYPE;
        const POST_IMG = CI_BEER_IMG;
        const POST_IMG_SM = CI_BEER_IMG_SM;

        function createTaxonomy() {
            $args = array(
                'hierarchical'      => true,
                'label'             => __('Style'),
                'show_ui'           => true,
                'show_admin_column' => true,
                'query_var'         => true,
                'rewrite'           => array( 'slug' => 'style' ),
            );

            register_taxonomy( 'style', self::POST_TYPE, $args );
        }

        function createType() {
            self::createTaxonomy();

            $args = array(
                'labels' => array(
                    'name' => self::PLURAL_CAP,
                    'all_items' => 'All ' . self::PLURAL_CAP,
                    'singular_name' => self::SINGULAR_CAP,
                    'add_new' => 'New ' . self::SINGULAR_CAP,
                    'add_new_item' => 'Add New ' . self::SINGULAR_CAP,
                    'new_item' => 'New ' . self::SINGULAR_CAP,
                    'edit_item' => 'Edit ' . self::SINGULAR_CAP,
                    'view_item' => 'View ' . self::SINGULAR_CAP
                ),
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'menu_icon' => 'dashicons-editor-bold', // A Dashicon: http://melchoyce.github.io/dashicons/
                'show_in_menu' => true,
                'query_var' => true,
                'rewrite' => array('slug' => self::SINGULAR_LC),
                'capability_type' => 'post',
                'has_archive' => false,
                'hierarchical' => false,
                'menu_position' => 50,
                'supports' => array(
                    'title',
                    'editor',
                    'thumbnail',
                    'revisions',
                    'excerpt'
                ),
                'taxonomies'          => array( 'styles' ),
                //'taxonomies' => array('category')
            );

            register_post_type( self::POST_TYPE, $args );

            if ( function_exists( 'add_image_size' ) ) {
                add_image_size( self::POST_IMG, 400, 400 );
                add_image_size( self::POST_IMG_SM, 300, 300 );
            }
            flush_rewrite_rules();
        }

        function addImgSizeNote() {
            add_meta_box(
                'ci_image_size_note',
                __('<strong>Note</strong>: Featured Image Sizes'),
                array($this, 'printImgSizeNote'),
                self::POST_TYPE,
                'side',
                'low'
            );
        }

        function printImgSizeNote() {
            echo "<p>Recommended size for " . self::SINGULAR_LC . " photos:<br />400&times;400</p>";
        }

        function updatedMessages( $messages ) {
            global $post, $post_ID;

            $messages[self::POST_TYPE] = array(
                0 => '', // Unused. Messages start at index 1.
                1 => sprintf( __(self::SINGULAR_CAP . ' updated. <a href="%s">View ' . self::SINGULAR_LC . '</a>'), esc_url( get_permalink($post_ID) ) ),
                2 => __('Custom field updated.', CI_TEXT_DOMAIN),
                3 => __('Custom field deleted.', CI_TEXT_DOMAIN),
                4 => __(self::SINGULAR_CAP . ' updated.', CI_TEXT_DOMAIN),
                /* translators: %s: date and time of the revision */
                5 => isset($_GET['revision']) ? sprintf( __(self::SINGULAR_CAP . ' restored to revision from %s', CI_TEXT_DOMAIN), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
                6 => sprintf( __(self::SINGULAR_CAP . ' published. <a href="%s">View ' . self::SINGULAR_LC . '</a>'), esc_url( get_permalink($post_ID) ) ),
                7 => __(self::SINGULAR_CAP . ' saved.', CI_TEXT_DOMAIN),
                8 => sprintf( __(self::SINGULAR_CAP . ' submitted. <a target="_blank" href="%s">Preview ' . self::SINGULAR_LC . '</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
                9 => sprintf( __(self::SINGULAR_CAP . ' scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview ' . self::SINGULAR_LC . '</a>'),
                    // translators: Publish box date format, see http://php.net/date
                    date_i18n( 'M j, Y @ G:i', strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
                10 => sprintf( __(self::SINGULAR_CAP . ' draft updated. <a target="_blank" href="%s">Preview ' . self::SINGULAR_LC . '</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
            );

            return $messages;
        }
    }
}





$creator = new CiBeersType();

// Create the Beers custom post type
add_action('init', array($creator, 'createType'));

// Add a note about the sizes of images we need
add_action( 'add_meta_boxes', array($creator, 'ciAddImgSizeNote') );

// Set the various "post updated" messages
add_filter('post_updated_messages', array($creator, 'updatedMessages'));


 