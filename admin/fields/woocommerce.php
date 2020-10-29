<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link  https://pressx.co
 * @since 1.0.0
 *
 * @package    Performance_Kit
 * @subpackage Performance_Kit/admin/modules
 */

class Performance_Kit_Woocommerce_Options extends Performance_Kit_Admin {

	/** Options Array */
	private $kit_woocommerce_options;

	public function __construct() {

		$this->kit_woocommerce_options = array(
			'woo-scripts' => array(
				'title' => 'Disable Scripts',
				'description' => __( 'Disables WooCommerce related scripts from non-WooCommerce pages.', 'performance-kit' ),
				'function' => 'kit-woo-scripts',
				'type' => 'checkbox',
			),
			'woo-cart' => array(
				'title' => 'Disable Cart Fragmentation',
				'description' => __( 'Disables Cart Fragmentation on non-WooCommerce pages.', 'performance-kit' ),
				'function' => 'kit-woo-cart',
				'type' => 'checkbox',
			),
			'woo-status' => array(
				'title' => 'Disable Status Meta Box',
				'description' => __( 'Disables Status Meta Box on WordPress Admin dashboard.', 'performance-kit' ),
				'function' => 'kit-woo-status',
				'type' => 'checkbox',
			),
			'woo-widgets' => array(
				'title' => 'Disable Widgets',
				'description' => __( 'Removes all WooCommerce widgets.', 'performance-kit' ),
				'function' => 'kit-woo-widgets',
				'type' => 'checkbox',
			),
			'password-strength' => array(
				'title' => 'Disable Password Strength Meter',
				'description' => __( 'Disables Password Strength Meter on non-WooCommerce pages.', 'performance-kit' ),
				'function' => 'kit-password-strength',
				'type' => 'checkbox',
			),
		);

	}

	public function options_setup() {
		?>

		<form id="performance_kit_woocommerce_options" method="post" name="" action="#">

			<?php 
				wp_nonce_field( 'performance_kit_update', 'performance_kit_form' ); 
				
				$kit_woocommerce = $this->woocommerce_checker();

				// WooCommerce Options
				$this->section_heading('WooCommerce Options', 'Modify the WooCommerce assets and functions for better performance...'); ?>

				<div class="kit-option">

					<div class="option-title">
						<span><?php echo __('WooCommerce Status', 'performance-kit'); ?></span>
					</div>

					<div class="option-text">
						<?php if ( $kit_woocommerce == false ) : ?>
						<span class="text red"><?php echo __( '&#9675; Not Active', 'performance-kit' ); ?> </span>
						<?php else : ?>
						<span class="text green"><?php echo __( '&#9679; Active', 'performance-kit' ); ?> </span>
						<?php endif; ?>
					</div>

					<?php if ( $kit_woocommerce == false ) : ?>
					<div class="woocommerce-notification">
					<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
						stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle">
						<circle cx="12" cy="12" r="10"></circle>
						<line x1="12" y1="8" x2="12" y2="12"></line>
						<line x1="12" y1="16" x2="12.01" y2="16"></line>
					</svg>
						<?php
						echo __(
							'In order to manage WooCommerce options, you will need WooCommerce plugin
						installed and activated.',
							'performance-kit'
						);
						?>
					</div>
					<?php else : ?>
					<div class="woocommerce-notification green">
						<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
							stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle">
							<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
							<polyline points="22 4 12 14.01 9 11.01"></polyline>
						</svg>
						<?php echo __( 'WooCommerce is installed and activated.', 'performance-kit' ); ?>
					</div>
					<?php endif; ?>
				</div>

				<?php $this->performance_kit_list_layout( $this->kit_woocommerce_options, 'kit_option' );

				submit_button( __( 'Save Changes', 'performance-kit' ), 'primary kit-button', 'submit-disable-scripts', true );

			?>

		</form>

		<?php
	}
}


// Initialize
$init = new Performance_Kit_Woocommerce_Options();
$init->options_setup();

?>
