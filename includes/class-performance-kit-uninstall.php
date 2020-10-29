<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://pressx.co
 * @since      1.0.0
 *
 * @package    Performance_Kit
 * @subpackage Performance_Kit/includes
 */

/**
 * Fired during plugin deactivation.
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
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function uninstall() {

		$performance_kit_options = wp_load_alloptions();
		$performance_kit_array  = array();
		
		foreach ( $performance_kit_options as $name => $value ) {
				if ( stristr( $name, 'kit-' ) ) {
						$my_options[ $name ] = $value;
						delete_option( $name );
				}
		}
		
	}

}
