<?php

/*
Plugin Name: Splash Redirect
Plugin URI: https://github.com/benhuson/splash-redirect
Description: If you really must have a splash page for your website... This plugin uses JavaScript to redirect to a splash page.
Version: 1.0
Author: Ben Huson
License: GPLv2 or later
*/

class SplashRedirect {

	var $splash_page_id = 0;

	function SplashRedirect() {
	
		// Language
		load_plugin_textdomain( 'splash-redirect', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

		$this->splash_page_id = apply_filters( 'splash_redirect_page_id', get_option( 'splash_redirect_page_id', 0 ) );
		if ( ! is_admin() && $this->splash_page_id > 0 )
			add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ) );
		if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) )
			include_once( 'admin/admin.php' );
	}

	function wp_enqueue_scripts() {
		if ( $this->is_redirect_page() || $this->is_splash_page() ) {
			wp_enqueue_script( 'splash_redirect', plugins_url( '/js/splash-redirect.js' , __FILE__ ) );
			$splash_js_vars = array(
				'splash_page_url' => get_permalink( $this->splash_page_id ),
				'current_page'    => ''
			);
			if ( $this->is_splash_page() ) {
				$splash_js_vars['current_page'] = 'splash';
			} elseif ( $this->is_redirect_page() ) {
				$splash_js_vars['current_page'] = 'redirect';
			}
			wp_localize_script( 'splash_redirect', 'SplashRedirectVars', $splash_js_vars );
		}
	}

	function is_redirect_page() {
		return apply_filters( 'splash_redirect_is_redirect_page', is_front_page() );
	}

	function is_splash_page() {
		return is_page( $this->splash_page_id );
	}

	function get_plugin_basename() {
		return plugin_basename( __FILE__ );
	}

}

new SplashRedirect();
