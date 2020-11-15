<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link    https://pressx.co
 * @since   1.0.0
 * @package Performance_Kit
 *
 * @wordpress-plugin
 * Plugin Name:       Performance Kit
 * Plugin URI:        https://pressx.co/plugins/performance-kit
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            PressX
 * Author URI:        https://pressx.co
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       performance-kit
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 */
define( 'PERFORMANCE_KIT_VERSION', '1.0.0' );


/**
 * Plugin root folder location.
 */
define( 'PERFORMANCE_KIT_FILE', __FILE__ );


/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */

require plugin_dir_path( __FILE__ ) . 'includes/class-performance-kit.php';

if ( ! class_exists( 'WPConfigTransformer' ) ) {

	require plugin_dir_path( __FILE__ ) . 'admin/inc/wp-config-transformer/WPConfigTransformer.php';

}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-performance-kit-activator.php
 */
function activate_performance_kit() {
	include_once plugin_dir_path( __FILE__ ) . 'includes/class-performance-kit-activator.php';
	Performance_Kit_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-performance-kit-deactivator.php
 */
function deactivate_performance_kit() {
	include_once plugin_dir_path( __FILE__ ) . 'includes/class-performance-kit-deactivator.php';
	Performance_Kit_Deactivator::deactivate();
}

/**
 * The code that runs during plugin uninstallation.
 * This action is documented in includes/class-performance-kit-uninstall.php
 */
function uninstall_performance_kit() {
	include_once plugin_dir_path( __FILE__ ) . 'includes/class-performance-kit-uninstall.php';
	Performance_Kit_Uninstall::uninstall();
}

register_activation_hook( __FILE__, 'activate_performance_kit' );
register_deactivation_hook( __FILE__, 'deactivate_performance_kit' );


/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since 1.0.0
 */
function run_performance_kit() {
	$plugin = new Performance_Kit();
	$plugin->run();

}
run_performance_kit();

function save_performance_kit_version() {

	if ( get_option( 'performance_kit_version' ) ) {
		update_option( 'performance_kit_version', PERFORMANCE_KIT_VERSION );
	} else {
		add_option( 'performance_kit_version', PERFORMANCE_KIT_VERSION );
	}

}
save_performance_kit_version();

function performance_kit_activation_redirect( $plugin ) {
	if ( $plugin == plugin_basename( __FILE__ ) ) {
		exit( wp_redirect( admin_url( '/options-general.php?page=performance-kit' ) ) );
	}
}
add_action( 'activated_plugin', 'performance_kit_activation_redirect' );



if ( ! function_exists( 'pk_fs' ) ) {
	// Create a helper function for easy SDK access.
	function pk_fs() {
		global $pk_fs;

		if ( ! isset( $pk_fs ) ) {
			// Include Freemius SDK.
			require_once dirname( __FILE__ ) . '/freemius/start.php';

			$pk_fs = fs_dynamic_init(
				array(
					'id'             => '7166',
					'slug'           => 'performance-kit',
					'type'           => 'plugin',
					'public_key'     => 'pk_93b7162bab48a9918ea334cbd60d5',
					'is_premium'     => false,
					'has_addons'     => false,
					'has_paid_plans' => false,
					'navigation'     => 'tabs',
					'menu'           => array(
						'slug'       => 'performance-kit',
						'first-path' => '/options-general.php?page=performance-kit',
						'account'    => false,
						'contact'    => false,
						'support'    => false,
						'parent'     => array(
							'slug' => 'options-general.php',
						),
					),
				)
			);
		}

		return $pk_fs;
	}

	// Init Freemius.
	pk_fs();
	// Signal that SDK was initiated.
	do_action( 'pk_fs_loaded' );

	function my_is_submenu_visible( $is_visible, $submenu_id ) {
		return $is_visible;
	}

	pk_fs()->add_filter( 'is_submenu_visible', 'my_is_submenu_visible', 10, 2 );

}
