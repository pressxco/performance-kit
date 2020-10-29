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

if(!class_exists('WPConfigTransformer')) {

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
register_uninstall_hook( __FILE__, 'uninstall_performance_kit' );


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

function cyb_activation_redirect( $plugin ) {
    if( $plugin == plugin_basename( __FILE__ ) ) {
        exit( wp_redirect( admin_url( '/options-general.php?page=performance-kit' ) ) );
    }
}
add_action( 'activated_plugin', 'cyb_activation_redirect' );