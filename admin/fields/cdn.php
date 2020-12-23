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

class Performance_Kit_CDN_Options extends Performance_Kit_Admin {

	public function __construct() {

		global $kit_cdn_options;

		$this->kit_cdn_options = $kit_cdn_options;

	}

	public function options_setup() {
		?>

		<form id="performance_kit_misc_options" method="post" name="" action="options.php">

			<?php
				settings_fields( 'kit-settings' );
				wp_nonce_field( 'performance_kit_update', 'performance_kit_form' );

				$this->performance_kit_section(
					'WordPress CDN Options',
					'Setup, enable and configure a content delivery network for your website',
					'kit_cdn_options',
					$this->kit_cdn_options,
					'kit_option'
				);

			?>

		</form>

		<?php
	}
}

// Initialize
$init = new Performance_Kit_CDN_Options();
$init->options_setup();

?>
