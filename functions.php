<?php

namespace mg;

if ( !defined( 'ABSPATH' ) ) exit;

// -----------------------------------------------------------------------------
// PRIMARY FUNCTIONS
// Only put things in this file that absolutely must load first.
// -----------------------------------------------------------------------------

// --- SAFE, SIMPLE, GLOBAL VARIABLE INITIALIZER -------------------------------

/* Declares a global site variable only if one doesn't already exist.
 * Helps ensure a parent theme doesn't overwrite values set by a child theme.
 * Also tidies up init code so they can be easy-reading one-liners.
 */

function init_site_global( $var, $default ) {
	if ( !isset( $GLOBALS['MG_SITE'][$var] ) ) {
		$GLOBALS['MG_SITE'][$var] = $default;
	}
}

// --- SAFE, SIMPLE, GLOBAL VARIABLE RETRIEVER ---------------------------------

function get_site_global( $var ) {
	if ( !empty( $GLOBALS['MG_SITE'][$var] ) ) {
		return $GLOBALS['MG_SITE'][$var];
	} else {
		return FALSE;
	}
}

// --- LOAD FUNCTION FILES -----------------------------------------------------

foreach ( glob(TEMPLATEPATH . '/functions/*.php') as $file ) {
     require_once $file;
}

