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

		$this->kit_cdn_options = array(
			'rewrite'              => array(
				'title'       => 'Enable CDN Rewrite',
				'description' => __( 'Enables the CDN rewrite and starts applying the settings below.', 'performance-kit' ),
				'function'    => 'kit-cdn-rewrite',
				'type'        => 'checkbox',
			),
			'cdn-url'              => array(
				'title'       => 'CDN URL',
				'description' => __( 'Your CDN URL provided by your CDN provider. Without a "/" trail.', 'performance-kit' ),
				'function'    => 'kit-cdn-url',
				'type'        => 'inputtext',
				'placeholder' => 'https://',
			),
			'included-directories' => array(
				'title'       => 'Included Directories',
				'description' => __( 'Define which directories you want to add your pull zone.', 'performance-kit' ),
				'function'    => 'kit-cdn-included',
				'type'        => 'inputtext',
				'placeholder' => 'wp-content,wp-includes',
			),
			'excluded-directories' => array(
				'title'       => 'Excluded Directories',
				'description' => __( 'Define which directories you DO NOT want to add your pull zone.', 'performance-kit' ),
				'function'    => 'kit-cdn-excluded',
				'type'        => 'inputtext',
				'placeholder' => 'wp-admin',
			),
			'excluded-files' => array(
				'title'       => 'Excluded Format',
				'description' => __( 'Define which file formats you DO NOT want to add your pull zone.', 'performance-kit' ),
				'function'    => 'kit-cdn-excluded-files',
				'type'        => 'inputtext',
				'placeholder' => '.png,.svg',
			),
			'debug_mode' => array(
				'title'       => 'Enable Debug Mode',
				'description' => __( 'Enables Debug Mode which is preventing rewriting urls when you are admin.', 'performance-kit' ),
				'function'    => 'kit-debug-mode',
				'type'        => 'checkbox',
			),

		);

	}

	public function options_setup() {
		?>

		<form id="performance_kit_misc_options" method="post" name="" action="#">

			<?php
				wp_nonce_field( 'performance_kit_update', 'performance_kit_form' );

				$this->performance_kit_section(
					'WordPress CDN Options',
					'Setup, enable and configure a content delivery network for your website...',
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
