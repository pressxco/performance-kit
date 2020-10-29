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

/**
 * Local Google Analytics
 *
 * @since 1.0.0
 * -----------------------------------------------------------------------------
 * -----------------------------------------------------------------------------
 */

if ( get_option( 'kit-local-analytics' ) === '1' ) {

	if ( ! empty( get_option( 'kit-tracking-position' ) ) && get_option( 'kit-tracking-position' ) === 'wp_footer' ) {
		$tracking_code_position = 'wp_footer';
	} else {
		$tracking_code_position = 'wp_head';
	}

	add_action( $tracking_code_position, 'performance_kit_print_ga', 0 );

}

/**
 * Print Google Analytics Code
 */

function performance_kit_print_ga() {

	if ( ! empty( get_option( 'kit-tracking-id' ) ) ) {
		echo '<!-- Local Analytics generated with Performance Kit. -->';
		echo '<script>';
		 echo "(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
					(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
					m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
					})(window,document,'script','" . plugins_url() . "/performance-kit/lib/scripts/ga-classic.js','ga');";
		 echo "ga('create', '" . get_option( 'kit-tracking-id' ) . "', 'auto');";

		 // disable display features
		if ( ! empty( get_option( 'kit-optimize-analytics' ) ) && get_option( 'kit-optimize-analytics' ) === '1' ) {
			echo "ga('set', 'allowAdFeatures', false);";
		}

			// anonymize ip
		if ( ! empty( get_option( 'kit-anon-ip' ) ) && get_option( 'kit-anon-ip' ) === '1' ) {
			echo "ga('set', 'anonymizeIp', true);";
		}

			echo "ga('send', 'pageview');";
		echo '</script>';
	}

}
