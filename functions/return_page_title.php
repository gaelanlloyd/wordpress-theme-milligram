<?php

namespace mg;

if ( !defined( 'ABSPATH' ) ) exit;

// --- Return H1 / Page SEO title ----------------------------------------------

function return_page_title() {

	if ( is_category() ) {
		$title = single_cat_title( NULL, FALSE );
	} elseif ( is_tag() ) {
		$title = "Posts tagged: " . single_tag_title();
	} elseif ( is_author() ) {
		$title = "Posts by: " . get_the_author_meta('display_name');
	} elseif ( is_day() ) {
		$title = "Daily archives: " . get_the_time('l, F j, Y');
	} elseif ( is_month() ) {
	    $title = "Monthly archives: " . get_the_time('F Y');
	} elseif ( is_year() ) {
	    $title = "Yearly archives: " . get_the_time('Y');
	} else {
		$title = get_the_title();
	}

	return $title;

}