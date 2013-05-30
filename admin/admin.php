<?php

class SplashRedirectAdmin {

	function SplashRedirectAdmin() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'admin_init', array( $this, 'admin_init' ) );
		add_filter( 'plugin_action_links_' . SplashRedirect::get_plugin_basename(), array( $this, 'plugin_settings_link' ) );
	}

	/**
	 * Plugin Settings Link
	 */
	function plugin_settings_link( $links ) {
		$settings_link = '<a href="' . admin_url( 'themes.php?page=splash_redirect' ) . '">' . __( 'Settings', 'splash-redirect' ) . '</a>';
		array_push( $links, $settings_link );
		return $links;
	}

	/**
	 * Admin Init
	 */
	function admin_init() {
		register_setting( 'redirect-settings-group', 'splash_redirect_page_id' );
		add_settings_section( 'section-redirect-settings', __( 'Redirect Settings', 'splash-redirect' ), array( $this, 'section_redirect_settings' ), 'splash-redirect' );
		add_settings_field( 'field-splash-redirect-page-id', __( 'Splash Page', 'splash-redirect' ), array( $this, 'field_splash_redirect_page_id' ), 'splash-redirect', 'section-redirect-settings' );
	}

	function section_redirect_settings() {
		echo '<p>' . __( 'Please select your splash page to enable splash page redirection.', 'splash-redirect' ) . '</p>';
	}

	function field_splash_redirect_page_id() {
		echo $this->dropdown_pages( array(
			'name'     => 'splash_redirect_page_id',
			'selected' => get_option( 'splash_redirect_page_id', 0 )
		) );
	}

	/**
	 * Admin Menu
	 */
	function admin_menu() {
		add_theme_page( __( 'Splash Redirect', 'splash-redirect' ), __( 'Splash Redirect', 'splash-redirect' ), 'manage_options', 'splash_redirect', array( $this, 'appearance_submenu_page' ) );
	}

	/**
	 * Add Options Page
	 * Adds menu item in the Appearance section.
	 */
	function appearance_submenu_page() {
		echo '<div class="wrap">
				<div id="icon-themes" class="icon32"><br /></div>
				<h2>' . __( 'Splash Redirect', 'splash-redirect' ) . '</h2>';
					if ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] == 'true' ) {
						echo '<div id="setting-error-settings_updated" class="updated settings-error"><p><strong>' . __( 'Settings saved.' ) . '</strong></p></div>';
					}
					echo '<form method="post" action="options.php">';
					settings_fields( 'redirect-settings-group' );
					do_settings_sections( 'splash-redirect' );
					submit_button();
					echo '
				</form>
			</div>';
	}

	/**
	 * Dropdown Pages
	 */	
	function dropdown_pages( $args ) {
		$args = wp_parse_args( $args, array(
			'id'                => '',
			'name'              => '',
			'selected'          => '',
			'echo'              => 0,
			'show_option_none'  => __( '-- Not Set --', 'sitesettings' ),
			'option_none_value' => 0
		) );
		if ( empty( $args['name'] ) )
			return '';
		return wp_dropdown_pages( $args );
	}

}

new SplashRedirectAdmin();
