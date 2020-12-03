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

	/** Options Array */
	private $kit_woocommerce_options;

	public function __construct() {

		$this->kit_woocommerce_options = array(
			'woo-scripts'       => array(
				'title'       => 'Disable Scripts',
				'description' => __( 'Disables WooCommerce related scripts from non-WooCommerce pages.', 'performance-kit' ),
				'function'    => 'kit-woo-scripts',
				'type'        => 'checkbox',
			),
			'woo-cart'          => array(
				'title'       => 'Disable Cart Fragmentation',
				'description' => __( 'Disables Cart Fragmentation on non-WooCommerce pages.', 'performance-kit' ),
				'function'    => 'kit-woo-cart',
				'type'        => 'checkbox',
			),
			'woo-status'        => array(
				'title'       => 'Disable Status Meta Box',
				'description' => __( 'Disables Status Meta Box on WordPress Admin dashboard.', 'performance-kit' ),
				'function'    => 'kit-woo-status',
				'type'        => 'checkbox',
			),
			'woo-widgets'       => array(
				'title'       => 'Disable Widgets',
				'description' => __( 'Removes all WooCommerce widgets.', 'performance-kit' ),
				'function'    => 'kit-woo-widgets',
				'type'        => 'checkbox',
			),
			'password-strength' => array(
				'title'       => 'Disable Password Strength Meter',
				'description' => __( 'Disables Password Strength Meter on non-WooCommerce pages.', 'performance-kit' ),
				'function'    => 'kit-password-strength',
				'type'        => 'checkbox',
			),
		);

	}

	public function options_setup() {
		?>

		<form id="performance_kit_woocommerce_options" method="post" name="" action="#">

			<?php
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
