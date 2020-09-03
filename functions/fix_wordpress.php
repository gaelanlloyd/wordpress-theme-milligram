<?php

namespace mg;

if ( !defined( 'ABSPATH' ) ) exit;

// -----------------------------------------------------------------------------
// REMOVE UNDESIRABLE WORDPRESS FEATURES
// -----------------------------------------------------------------------------

// --- Disable the periodic admin email verifications

add_filter( 'admin_email_check_interval', '__return_false' );

// --- Disable public WP-JSON access

add_filter( 'rest_authentication_errors', function( $result ) {
    if ( ! empty( $result ) ) {
        return $result;
    }
    if ( ! is_user_logged_in() ) {
        return new WP_Error( 'rest_not_logged_in', 'You are not currently logged in.', array( 'status' => 401 ) );
    }
    return $result;
});

// --- Remove REST API links

remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('template_redirect', 'rest_output_link_header', 11, 0);

// --- Remove oembed links

remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);

// --- Disable adjacent post prefetch

remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );

// --- Disable pingback and xmlrpc

add_filter('xmlrpc_enabled', '__return_false'); // disable XMLRPC
remove_action('wp_head', 'rsd_link'); // removes EditURI/RSD (Really Simple Discovery) link.
remove_action('wp_head', 'wlwmanifest_link'); // removes wlwmanifest (Windows Live Writer) link.
remove_action('wp_head', 'wp_generator'); // removes meta name generator.
remove_action('wp_head', 'wp_shortlink_wp_head'); // removes shortlink.
remove_action('wp_head', 'feed_links', 2 ); // removes feed links.
remove_action('wp_head', 'feed_links_extra', 3 );  // removes comments feed.

// --- Disable wp-embed.min.js

function deregister_wp_scripts() {
    wp_deregister_script( 'wp-embed' );
    wp_dequeue_script( 'wp-embed' );
}

add_action( 'wp_footer', 'mg\deregister_wp_scripts' );

// --- Disable wp-emoji-release.min.js

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

// --- Remove <link rel='shortlink'>
// which causes tons of useless pages to be followed during a wget operation

remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

// --- Remove <meta name="generator">

remove_action('wp_head', 'wp_generator');

// --- Remove Gutenberg block styles

function disable_gutenberg_block() {
    wp_dequeue_style( 'wp-block-library' );
}

add_action( 'wp_print_styles', 'mg\disable_gutenberg_block', 100 );

// --- Disable dashboard junk

function disable_dashboard_widgets() {

    global $wp_meta_boxes;
    unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins'] );
    unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments'] );
    unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links'] );
    unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now'] );
    unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_primary'] );
    unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary'] );
    unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press'] );
    unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts'] );

    remove_meta_box( 'dashboard_site_health', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );
    // remove_meta_box( 'dashboard_quick_press', 'dashboard', 'normal' );
    // remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' );

}

add_action('wp_dashboard_setup', 'mg\disable_dashboard_widgets' );

// --- Disable the welcome panel

remove_action( 'welcome_panel', 'wp_welcome_panel' );

// --- Include theme CSS files

function add_scripts_footer() {

    // Milligram 1.4.1

    wp_register_style(
        'milligram-css',
        'https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css',
        array(),
        NULL,
        'all'
    );

    wp_enqueue_style( 'milligram-css' );

    // Theme CSS

    $fileCSS = '/style.css';

    wp_register_style(
        'mg-css',
        get_template_directory_uri() . $fileCSS,
        array(),
        date( 'Ymd-Hi', filemtime( get_template_directory() . $fileCSS ) ),
        'all'
    );

    wp_enqueue_style( 'mg-css' );

}

add_action( 'get_footer', 'mg\add_scripts_footer', 200 );

// --- Inject custom CSS to admin area

function custom_admin_css() {

    ob_start();

    ?><style>

        /* --- Add custom field metabox style overrides --- */
        #normal-sortables .wpt-field { float: left; width: 50%; }
        #normal-sortables .wpt-field.wpt-date, #normal-sortables .wpt-field.wpt-select { float: left; width: 25%; }
        #normal-sortables .inside:after { content:""; display:table; clear:both; }
        #normal-sortables .description p { color: #C0C0C0; line-height: 1em; margin: 0; }
        #normal-sortables .wpt-field-item { padding-right: 2em; }
        #normal-sortables .wpt-wysiwyg { width: 100%; }

        #normal-sortables #wpcf-group-bottom-contact-widget .wpt-checkbox { width:100%; }

        .cmb2-wrap input.cmb2-text-medium { width: 100%; }

        /* --- CMB --- */

        /* fix padding and spacing */
        .postbox-container .cmb2-wrap>.cmb-field-list>.cmb-row { padding: 0.1em 0; }

        /* remove borders */
        .postbox-container .cmb-row:not(:last-of-type) { border-bottom: none; }

        /* put descriptions on their own line */
        .cmb2-metabox-description { display: block; font-size: 11px; }
        p.cmb2-metabox-description { padding-top: 0; }

        /* 50% width fields */
        .cmb-row.half {
          width: 50%;
          float: left;
        }

        /* fix parent collapse when floating cmb elements */
        .cmb2-metabox:after { content: " "; display: block; height: 0; clear: both; }

        /* --- MISC --- */

        /* .wp-list-table #title { width: 80%; } */
        .wp-list-table #taxonomy-asset-category { width: 15%; }
        .wp-list-table #wsh_id { width: 10%; }
        .wp-list-table #wsh_eventdate { width: 10%; }


        /* -- Hide taxonomy term addition buttons -- */
        /* This prevents most end users from adding new taxonomy terms */

        .categorydiv .taxonomy-add-new { display: none; }

        /* -- Hide dashboard 'boxes' -- */
        #dashboard-widgets { display: none; }

    </style>

    <?php

    echo ob_get_clean();
}

add_action('admin_head', 'mg\custom_admin_css');
