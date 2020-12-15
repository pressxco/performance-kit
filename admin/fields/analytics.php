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

class Performance_Kit_Analytics_Options extends Performance_Kit_Admin {

	public function __construct() {

		$this->kit_analytics_options = array(
			'local-analytics'        => array(
				'title'       => 'Enable Local Analytics',
				'description' => __( 'Enable fetching and serving the ga.js code from the Google Analytics, locally.', 'performance-kit' ),
				'function'    => 'kit-local-analytics',
				'type'        => 'checkbox',
			),
			'tracking-code-type'     => array(
				'title'       => 'Tracking Code Type',
				'description' => __( 'Define your tracking code type.', 'performance-kit' ),
				'function'    => 'kit-tracking-type',
				'type'        => 'select',
				'options'     => array(
					'Classic Google Analytics' => 'classic_google_analytics',
				),
			),
			'tracking-id'            => array(
				'title'       => 'Tracking ID',
				'description' => __( 'Define your tracking ID provided by your analytics provider.', 'performance-kit' ),
				'function'    => 'kit-tracking-id',
				'type'        => 'inputtext',
				'placeholder' => '',
			),
			'tracking-code-position' => array(
				'title'       => 'Tracking Code Position',
				'description' => __( 'Select the position where your analytics codes will be added.', 'performance-kit' ),
				'function'    => 'kit-tracking-position',
				'type'        => 'select',
				'options'     => array(
					'Header' => 'wp_head',
					'Footer' => 'wp_footer',
				),
			),
			'optimize-tracking'      => array(
				'title'       => 'Optimize Analytics',
				'description' => __( 'Optimize the analytics code by removing external marketing scripts and requests.', 'performance-kit' ),
				'function'    => 'kit-optimize-analytics',
				'type'        => 'checkbox',
			),
			'anonymize-ip'           => array(
				'title'       => 'Anonymize IP',
				'description' => __( 'Anonymize the IP.', 'performance-kit' ),
				'function'    => 'kit-anon-ip',
				'type'        => 'checkbox',
			),
			'track-admins'           => array(
				'title'       => 'Track Logged In Admins',
				'description' => __( 'Enable tracking for logged in admins.', 'performance-kit' ),
				'function'    => 'kit-track-admins',
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
					'Analytics Options',
					'Setup, enable and modify the analytics for your website',
					'kit_analytics_options', 
					$this->kit_analytics_options,
					'kit_option'
        );
        
        $this->performance_kit_catch();

			?>

		</form>

		<?php
	}
}

// Initialize.
$init = new Performance_Kit_Analytics_Options();
$init->options_setup();
