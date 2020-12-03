<?php

/**
 * Fired during plugin uninstallation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Performance_Kit
 * @subpackage Performance_Kit/includes
 * @author     PressX <info@pressx.co>
 */
class Performance_Kit_Uninstall {

	/**
	 * Options removal.
	 *
	 * This will remove all the options that have been created by Performance Kit.
	 *
	 * @since    1.0.0
	 */
	public static function uninstall() {

		$performance_kit_options = wp_load_alloptions();
		$performance_kit_array   = array();
	
		foreach ( $performance_kit_options as $name => $value ) {
			if ( stristr( $name, 'kit-' ) ) {
					$performance_kit_array[ $name ] = $value;
					delete_option( $name );
			}
		}

	}

}
