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

class Performance_Kit_Woocommerce_Options extends Performance_Kit_Admin {

	public function __construct() {

		global $kit_woocommerce_options;

		$this->kit_woocommerce_options = $kit_woocommerce_options;

	}

	public function options_setup() {
		?>

		<form id="performance_kit_woocommerce_options" method="post" name="" action="options.php">

			<?php
				settings_fields( 'kit_woocommerce_settings' );
				wp_nonce_field( 'performance_kit_update', 'performance_kit_form' );

				$this->performance_kit_section(
					'WooCommerce Options',
					'Modify the WooCommerce assets and functions for better performance',
					'kit_woocommerce_options',
					$this->kit_woocommerce_options,
					'kit_option'
				);

			?>

		</form>

		<?php
	}
}


// Initialize.
$init = new Performance_Kit_Woocommerce_Options();
$init->options_setup();

?>

<?php if ( $init->woocommerce_checker() === false ) { ?>

<script>
	jQuery(".woocommerce_wrapper").addClass('active');
</script>

<?php } ?>
