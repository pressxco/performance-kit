<?php
/**
 *
 * Register saveable data.
 *
 * @since   2.0.0
 * @package Custom_Codes
 */

defined( 'ABSPATH' ) || die( 'No script kiddies please!' );

/**
 * Register data.
 */
function kit_register_data() {

	register_setting(
		'kit-settings',
		'kit-xmlrpc',
		array(
			'type'              => 'boolean',
			'description'       => __( 'Disables XML-RPC functionality', 'performance-kit' ),
			'single'            => true,
			'default'           => false,
			'sanitize_callback' => 'sanitize_key',
		)
	);

	register_setting(
		'kit-settings',
		'kit-emojis',
		array(
			'type'              => 'boolean',
			'description'       => __( 'Removes Emoji Javascript file. Be cautious as this option affects your current emojis.', 'performance-kit' ),
			'single'            => true,
			'default'           => false,
			'sanitize_callback' => 'sanitize_key',
		)
	);

	register_setting(
		'kit-settings',
		'kit-query',
		array(
			'type'              => 'boolean',
			'description'       => __( 'Removes Query Strings from assets like CSS and Javascript files.', 'performance-kit' ),
			'single'            => true,
			'default'           => false,
			'sanitize_callback' => 'sanitize_key',
		)
	);

	register_setting(
		'kit-settings',
		'kit-wlw',
		array(
			'type'              => 'boolean',
			'description'       => __( 'Removes wlwmanifest Link.', 'performance-kit' ),
			'single'            => true,
			'default'           => false,
			'sanitize_callback' => 'sanitize_key',
		)
	);

	register_setting(
		'kit-settings',
		'kit-rsd',
		array(
			'type'              => 'boolean',
			'description'       => __( 'Removes RSD Link.', 'performance-kit' ),
			'single'            => true,
			'default'           => false,
			'sanitize_callback' => 'sanitize_key',
		)
	);

	register_setting(
		'kit-settings',
		'kit-jquery-migrate',
		array(
			'type'              => 'boolean',
			'description'       => __( 'Removes jQuery Migrate Javascript file. Be cautious as this option may affect your theme functionality if you are using a very old theme', 'performance-kit' ),
			'single'            => true,
			'default'           => false,
			'sanitize_callback' => 'sanitize_key',
		)
	);

	register_setting(
		'kit-settings',
		'kit-shortlink',
		array(
			'type'              => 'boolean',
			'description'       => __( 'Removes Shortlink.', 'performance-kit' ),
			'single'            => true,
			'default'           => false,
			'sanitize_callback' => 'sanitize_key',
		)
	);

	register_setting(
		'kit-settings',
		'kit-rss',
		array(
			'type'              => 'boolean',
			'description'       => __( 'Removes RSS Feeds.', 'performance-kit' ),
			'single'            => true,
			'default'           => false,
			'sanitize_callback' => 'sanitize_key',
		)
	);

	register_setting(
		'kit-settings',
		'kit-rss-links',
		array(
			'type'              => 'boolean',
			'description'       => __( 'Removes RSS Feed Links.', 'performance-kit' ),
			'single'            => true,
			'default'           => false,
			'sanitize_callback' => 'sanitize_key',
		)
	);

	register_setting(
		'kit-settings',
		'kit-pingbacks',
		array(
			'type'              => 'boolean',
			'description'       => __( 'Disables Self Pingbacks.', 'performance-kit' ),
			'single'            => true,
			'default'           => false,
			'sanitize_callback' => 'sanitize_key',
		)
	);

	register_setting(
		'kit-settings',
		'kit-rest-api',
		array(
			'type'              => 'boolean',
			'description'       => __( 'Remove REST API Links.', 'performance-kit' ),
			'single'            => true,
			'default'           => false,
			'sanitize_callback' => 'sanitize_key',
		)
	);

	register_setting(
		'kit-settings',
		'kit-dashicons',
		array(
			'type'              => 'boolean',
			'description'       => __( 'Disable Dashicons.', 'performance-kit' ),
			'single'            => true,
			'default'           => false,
			'sanitize_callback' => 'sanitize_key',
		)
	);

	register_setting(
		'kit-settings',
		'kit-comment-urls',
		array(
			'type'              => 'boolean',
			'description'       => __( 'Removes Comment URLs.', 'performance-kit' ),
			'single'            => true,
			'default'           => false,
			'sanitize_callback' => 'sanitize_key',
		)
	);

	register_setting(
		'kit-settings',
		'kit-heartbeat',
		array(
			'type'              => 'number',
			'description'       => __( 'Disable Hearbeat.', 'performance-kit' ),
			'single'            => true,
			'default'           => '0',
			'sanitize_callback' => 'sanitize_key',
		)
	);

	register_setting(
		'kit-settings',
		'kit-hearbeat-frequency',
		array(
			'type'              => 'number',
			'description'       => __( 'Modifies Heartbeat Frequency.', 'performance-kit' ),
			'single'            => true,
			'default'           => '15',
			'sanitize_callback' => 'sanitize_key',
		)
	);

	register_setting(
		'kit-settings',
		'kit-revisions',
		array(
			'type'              => 'number',
			'description'       => __( 'Limit Post Revisions.', 'performance-kit' ),
			'single'            => true,
			'default'           => '-1',
			'sanitize_callback' => 'sanitize_key',
		)
	);

	register_setting(
		'kit-settings',
		'kit-auto-save',
		array(
			'type'              => 'number',
			'description'       => __( 'Modifies Autosave Interval.', 'performance-kit' ),
			'single'            => true,
			'default'           => '0',
			'sanitize_callback' => 'sanitize_key',
		)
	);

	register_setting(
		'kit-settings',
		'kit-comment-system',
		array(
			'type'              => 'boolean',
			'description'       => __( 'Removes the WordPress Comment System functions.', 'performance-kit' ),
			'single'            => true,
			'default'           => false,
			'sanitize_callback' => 'sanitize_key',
		)
	);

	register_setting(
		'kit-settings',
		'kit-screen-options',
		array(
			'type'              => 'boolean',
			'description'       => __( 'Removes the WordPress Screen Options button.', 'performance-kit' ),
			'single'            => true,
			'default'           => '0',
			'sanitize_callback' => 'sanitize_key',
		)
	);

	register_setting(
		'kit-settings',
		'kit-comment-system',
		array(
			'type'              => 'boolean',
			'description'       => __( 'Removes the WordPress Screen Options button.', 'performance-kit' ),
			'single'            => true,
			'default'           => false,
			'sanitize_callback' => 'sanitize_key',
		)
	);

	register_setting(
		'kit-settings',
		'kit-core-options',
		array(
			'type'              => 'boolean',
			'description'       => __( 'Disables WP Core automatic updates.', 'performance-kit' ),
			'single'            => true,
			'default'           => false,
			'sanitize_callback' => 'sanitize_key',
		)
	);

	register_setting(
		'kit-settings',
		'kit-themes-updates',
		array(
			'type'              => 'boolean',
			'description'       => __( 'Disables Themes automatic updates.', 'performance-kit' ),
			'single'            => true,
			'default'           => false,
			'sanitize_callback' => 'sanitize_key',
		)
	);

	register_setting(
		'kit-settings',
		'kit-plugin-updates',
		array(
			'type'              => 'boolean',
			'description'       => __( 'Disables Plugins automatic updates.', 'performance-kit' ),
			'single'            => true,
			'default'           => false,
			'sanitize_callback' => 'sanitize_key',
		)
	);

	register_setting(
		'kit-settings',
		'kit-file-editor',
		array(
			'type'              => 'boolean',
			'description'       => __( 'Disables Theme or Plugin file editors. E.g: Appereance > Theme Editor.', 'performance-kit' ),
			'single'            => true,
			'default'           => false,
			'sanitize_callback' => 'sanitize_key',
		)
	);

	register_setting(
		'kit-settings',
		'kit-woo-scripts',
		array(
			'type'              => 'boolean',
			'description'       => __( 'Disables WooCommerce related scripts from non-WooCommerce pages.', 'performance-kit' ),
			'single'            => true,
			'default'           => false,
			'sanitize_callback' => 'sanitize_key',
		)
	);

	register_setting(
		'kit-settings',
		'kit-woo-cart',
		array(
			'type'              => 'boolean',
			'description'       => __( 'Disables Cart Fragmentation on non-WooCommerce pages.', 'performance-kit' ),
			'single'            => true,
			'default'           => false,
			'sanitize_callback' => 'sanitize_key',
		)
	);

	register_setting(
		'kit-settings',
		'kit-woo-status',
		array(
			'type'              => 'boolean',
			'description'       => __( 'Disables Status Meta Box on WordPress Admin dashboard.', 'performance-kit' ),
			'single'            => true,
			'default'           => false,
			'sanitize_callback' => 'sanitize_key',
		)
	);

	register_setting(
		'kit-settings',
		'kit-woo-widgets',
		array(
			'type'              => 'boolean',
			'description'       => __( 'Removes all WooCommerce widgets.', 'performance-kit' ),
			'single'            => true,
			'default'           => false,
			'sanitize_callback' => 'sanitize_key',
		)
	);

	register_setting(
		'kit-settings',
		'kit-password-strength',
		array(
			'type'              => 'boolean',
			'description'       => __( 'Disables Password Strength Meter on non-WooCommerce pages.', 'performance-kit' ),
			'single'            => true,
			'default'           => false,
			'sanitize_callback' => 'sanitize_key',
		)
	);

}

add_action( 'init', 'kit_register_data' );
