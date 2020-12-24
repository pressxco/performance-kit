<?php
/**
 * Provide a admin area view for the particular section
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link  https://pressx.co
 * @since 1.0.0
 *
 * @package    Performance_Kit
 * @subpackage Performance_Kit/admin/fields
 */
class Performance_Kit_Wordpress_Options extends Performance_Kit_Admin {

	public function __construct() {

		global $kit_wordpress_options;
		global $kit_config_options;
		global $kit_advanced_options;

		$this->kit_wordpress_options = $kit_wordpress_options;
		$this->kit_config_options    = $kit_config_options;
		$this->kit_advanced_options  = $kit_advanced_options;

	}

	public function options_setup() {
		?>

		<form id="performance_kit_wordpress_options" method="post" name="" action="options.php">

			<?php
				settings_fields( 'kit_wordpress_settings' );
				wp_nonce_field( 'performance_kit_update', 'performance_kit_form' );

				$this->performance_kit_section(
					'WordPress Base Options',
					'Modify the WordPress Core functionalities',
					'kit_wordpress_options',
					$this->kit_wordpress_options,
					'kit_option'
				);

				$this->performance_kit_section(
					'WordPress Config Options',
					'Modify the WordPress Config file for better performance',
					'kit_config_options',
					$this->kit_config_options,
					'kit_option'
				);

				$this->performance_kit_section(
					'WordPress Advanced Options',
					'Modify the WordPress Functions for better performance',
					'kit_advanced_options',
					$this->kit_advanced_options,
					'kit_option'
				);

			?>

		</form>

		<?php
	}
}

// Initialize.
$init = new Performance_Kit_Wordpress_Options();
$init->options_setup();
