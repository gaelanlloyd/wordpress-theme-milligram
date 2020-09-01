<?php

if ( !defined( 'ABSPATH' ) ) exit;

// --- REGISTER A NAV MENU -----------------------------------------------------

add_action( 'after_setup_theme', 'register_mg_menu' );

function register_mg_menu() {
	register_nav_menu( 'primary', __( 'Primary Menu', 'mg-main-menu' ) );
}
