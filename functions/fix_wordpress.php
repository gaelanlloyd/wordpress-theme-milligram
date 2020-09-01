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

}

add_action( 'get_footer', 'mg\add_scripts_footer', 200 );
