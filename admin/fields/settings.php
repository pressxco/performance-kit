<?php
/**
 * Provide settings for Performance Kit.
 *
 * This file is used to markup the settings fields of the plugin.
 *
 * @link  https://pressx.co
 * @since 1.0.0
 *
 * @package    Performance_Kit
 * @subpackage Performance_Kit/admin/fields
 */

global $kit_wordpress_options;
global $kit_config_options;
global $kit_advanced_options;
global $kit_woocommerce_options;
global $kit_cdn_options;
global $kit_analytics_options;
global $kit_misc_options;

$kit_wordpress_options = array(
	'xml-rpc'             => array(
		'title'             => 'Disable XML-RPC',
		'description'       => __( 'Disables XML-RPC functionality', 'performance-kit' ),
		'function'          => 'kit-xmlrpc',
		'default'           => '0',
		'type'              => 'checkbox',
		'setting_type'      => 'boolean',
		'sanitize_callback' => 'sanitize_key',
	),
	'emojis'              => array(
		'title'             => 'Disable Emojis',
		'description'       => __( 'Removes Emoji Javascript file. Be cautious as this option affects your current emojis.', 'performance-kit' ),
		'function'          => 'kit-emojis',
		'default'           => '0',
		'type'              => 'checkbox',
		'setting_type'      => 'boolean',
		'sanitize_callback' => 'sanitize_key',
	),
	'embeds'              => array(
		'title'             => 'Disable Embeds',
		'description'       => __( 'Removes Embeds Javascript file. Be cautios as this option affects your current embeds.', 'performance-kit' ),
		'function'          => 'kit-embeds',
		'default'           => '0',
		'type'              => 'checkbox',
		'setting_type'      => 'boolean',
		'sanitize_callback' => 'sanitize_key',
	),
	'query-strings'       => array(
		'title'             => 'Remove Query Strings',
		'description'       => __( 'Removes Query Strings from assets like CSS and Javascript files.', 'performance-kit' ),
		'function'          => 'kit-query-strings',
		'default'           => '0',
		'type'              => 'checkbox',
		'setting_type'      => 'boolean',
		'sanitize_callback' => 'sanitize_key',
	),
	'jquery-migrate'      => array(
		'title'             => 'Remove jQuery Migrate',
		'description'       => __( 'Removes jQuery Migrate Javascript file. Be cautious as this option may affect your theme functionality if you are using a very old theme', 'performance-kit' ),
		'function'          => 'kit-jquery-migrate',
		'default'           => '0',
		'type'              => 'checkbox',
		'setting_type'      => 'boolean',
		'sanitize_callback' => 'sanitize_key',
	),
	'wp-version'          => array(
		'title'             => 'Hide WP Version',
		'description'       => __( 'Hides WordPress Version in the <head> section.', 'performance-kit' ),
		'function'          => 'kit-wp-version',
		'default'           => '0',
		'type'              => 'checkbox',
		'setting_type'      => 'boolean',
		'sanitize_callback' => 'sanitize_key',
	),
	'wlwmanifest'         => array(
		'title'             => 'Remove wlwmanifest Link',
		'description'       => __( 'Removes wlwmanifest Link.', 'performance-kit' ),
		'function'          => 'kit-manifest',
		'default'           => '0',
		'type'              => 'checkbox',
		'setting_type'      => 'boolean',
		'sanitize_callback' => 'sanitize_key',
	),
	'rsd-link'            => array(
		'title'             => 'Remove RSD Link',
		'description'       => __( 'Removes RSD Link.', 'performance-kit' ),
		'function'          => 'kit-rsd',
		'default'           => '0',
		'type'              => 'checkbox',
		'setting_type'      => 'boolean',
		'sanitize_callback' => 'sanitize_key',
	),
	'short-link'          => array(
		'title'             => 'Remove Shortlink',
		'description'       => __( 'Removes Shortlink.', 'performance-kit' ),
		'function'          => 'kit-shortlink',
		'default'           => '0',
		'type'              => 'checkbox',
		'setting_type'      => 'boolean',
		'sanitize_callback' => 'sanitize_key',
	),
	'rss-feeds'           => array(
		'title'             => 'Disable RSS Feeds',
		'description'       => __( 'Removes RSS Feeds.', 'performance-kit' ),
		'function'          => 'kit-rss-feed',
		'default'           => '0',
		'type'              => 'checkbox',
		'setting_type'      => 'boolean',
		'sanitize_callback' => 'sanitize_key',
	),
	'rss-links'           => array(
		'title'             => 'Remove RSS Feed Links',
		'description'       => __( 'Removes RSS Feed Links.', 'performance-kit' ),
		'function'          => 'kit-rss-links',
		'default'           => '0',
		'type'              => 'checkbox',
		'setting_type'      => 'boolean',
		'sanitize_callback' => 'sanitize_key',
	),
	'self-pingbacks'      => array(
		'title'             => 'Disable Self Pingbacks',
		'description'       => __( 'Disables Self Pingbacks.', 'performance-kit' ),
		'function'          => 'kit-pingbacks',
		'default'           => '0',
		'type'              => 'checkbox',
		'setting_type'      => 'boolean',
		'sanitize_callback' => 'sanitize_key',
	),
	'api-links'           => array(
		'title'             => 'Remove REST API Links',
		'description'       => __( 'Remove REST API Links.', 'performance-kit' ),
		'function'          => 'kit-restapi-links',
		'default'           => '0',
		'type'              => 'checkbox',
		'setting_type'      => 'boolean',
		'sanitize_callback' => 'sanitize_key',
	),
	'dashicons'           => array(
		'title'             => 'Disable Dashicons',
		'description'       => __( 'Disable Dashicons.', 'performance-kit' ),
		'function'          => 'kit-dashicons',
		'default'           => '0',
		'type'              => 'checkbox',
		'setting_type'      => 'boolean',
		'sanitize_callback' => 'sanitize_key',
	),
	'comment-urls'        => array(
		'title'             => 'Remove Comment URLs',
		'description'       => __( 'Removes Comment URLs.', 'performance-kit' ),
		'function'          => 'kit-comment-urls',
		'default'           => '0',
		'type'              => 'checkbox',
		'setting_type'      => 'boolean',
		'sanitize_callback' => 'sanitize_key',
	),
	'heart'               => array(
		'title'             => 'Disable Heartbeat',
		'description'       => __( 'Disable Hearbeat.', 'performance-kit' ),
		'function'          => 'kit-heartbeat',
		'type'              => 'select',
		'options'           => array(
			'Default'                             => '0',
			'Disable Everywhere'                  => '1',
			'Only Allow When Editing Posts/Pages' => '2',
		),
		'setting_type'      => 'number',
		'sanitize_callback' => 'sanitize_key',
	),
	'heartbeat-frequency' => array(
		'title'             => 'Heartbeat Frequency',
		'description'       => __( 'Modifies Heartbeat Frequency.', 'performance-kit' ),
		'function'          => 'kit-heartbeat-frequeny',
		'type'              => 'select',
		'options'           => array(
			'15 Seconds (Default)' => '15',
			'30 Seconds'           => '30',
			'45 Seconds'           => '45',
			'60 Seconds'           => '60',
			'90 Seconds'           => '90',
			'120 Seconds'          => '120',
		),
		'setting_type'      => 'number',
		'sanitize_callback' => 'sanitize_key',
	),
	'post-revisions'      => array(
		'title'             => 'Limit Post Revisions',
		'description'       => __( 'Limit Post Revisions.', 'performance-kit' ),
		'function'          => 'kit-revisions',
		'type'              => 'select',
		'options'           => array(
			'Default'                => '-1',
			'Disable Post Revisions' => '0',
			'1'                      => '1',
			'2'                      => '2',
			'3'                      => '3',
			'4'                      => '4',
			'5'                      => '5',
			'6'                      => '6',
			'7'                      => '7',
			'8'                      => '8',
			'9'                      => '9',
			'10'                     => '10',
			'20'                     => '20',
			'25'                     => '25',
			'35'                     => '35',
			'40'                     => '40',
		),
		'setting_type'      => 'number',
		'sanitize_callback' => 'sanitize_key',
	),
	'autosave-interval'   => array(
		'title'             => 'Autosave Interval',
		'description'       => __( 'Modifies Autosave Interval.', 'performance-kit' ),
		'function'          => 'kit-autosave',
		'type'              => 'select',
		'options'           => array(
			'1 Minute' => '1',
			'2 Minute' => '2',
			'3 Minute' => '3',
			'4 Minute' => '4',
			'5 Minute' => '5',
			'Disable'  => '0',
		),
		'setting_type'      => 'number',
		'sanitize_callback' => 'sanitize_key',
	),
);

$kit_config_options = array(
	'wordpress-cron'             => array(
		'title'             => 'Disable WP_CRON',
		'description'       => __( 'Disables WP_CRON functionality through wp-config.php.', 'performance-kit' ),
		'function'          => 'kit-wp-cron',
		'type'              => 'checkbox',
		'default'           => '0',
		'setting_type'      => 'boolean',
		'sanitize_callback' => 'sanitize_key',
	),
	'wordpress-wp-cache'         => array(
		'title'             => 'Enable WP_CACHE',
		'description'       => __( 'Enable WP_CACHE on wp-config.php.', 'performance-kit' ),
		'function'          => 'kit-wp-cache',
		'type'              => 'checkbox',
		'default'           => '0',
		'setting_type'      => 'boolean',
		'sanitize_callback' => 'sanitize_key',
	),
	'wordpress-concatenate'      => array(
		'title'             => 'Enable CONCATENATE_SCRIPTS',
		'description'       => __( 'Enable CONCATENATE_SCRIPTS on wp-config.php.', 'performance-kit' ),
		'function'          => 'kit-wp-concatenate',
		'type'              => 'checkbox',
		'default'           => '0',
		'setting_type'      => 'boolean',
		'sanitize_callback' => 'sanitize_key',
	),
	'wordpress-compress-css'     => array(
		'title'             => 'Enable COMPRESS_CSS',
		'description'       => __( 'Enable COMPRESS_CSS on wp-config.php.', 'performance-kit' ),
		'function'          => 'kit-wp-compress-css',
		'type'              => 'checkbox',
		'default'           => '0',
		'setting_type'      => 'boolean',
		'sanitize_callback' => 'sanitize_key',
	),
	'wordpress-compress-scripts' => array(
		'title'             => 'Enable COMPRESS_SCRIPTS',
		'description'       => __( 'Enable COMPRESS_SCRIPTS on wp-config.php.', 'performance-kit' ),
		'function'          => 'kit-wp-compress-scripts',
		'type'              => 'checkbox',
		'default'           => '0',
		'setting_type'      => 'boolean',
		'sanitize_callback' => 'sanitize_key',
	),
	'wordpress-enforce'          => array(
		'title'             => 'Enable ENFORCE_GZIP',
		'description'       => __( 'Enable ENFORCE_GZIP on wp-config.php.', 'performance-kit' ),
		'function'          => 'kit-wp-gzip',
		'type'              => 'checkbox',
		'default'           => '0',
		'setting_type'      => 'boolean',
		'sanitize_callback' => 'sanitize_key',
	),
);

$kit_advanced_options = array(
	'comment-system'  => array(
		'title'             => 'Disable Comment System',
		'description'       => __( 'Removes the WordPress Comment System functions.', 'performance-kit' ),
		'function'          => 'kit-comment-system',
		'type'              => 'checkbox',
		'default'           => '0',
		'setting_type'      => 'boolean',
		'sanitize_callback' => 'sanitize_key',
	),
	'screen-options'  => array(
		'title'             => 'Disable Screen Options Button',
		'description'       => __( 'Removes the WordPress Screen Options button.', 'performance-kit' ),
		'function'          => 'kit-screen-options',
		'type'              => 'checkbox',
		'default'           => '0',
		'setting_type'      => 'boolean',
		'sanitize_callback' => 'sanitize_key',
	),
	'core-updates'    => array(
		'title'             => 'Disable WP Core Auto Update',
		'description'       => __( 'Disables WP Core automatic updates.', 'performance-kit' ),
		'function'          => 'kit-core-options',
		'type'              => 'checkbox',
		'default'           => '0',
		'setting_type'      => 'boolean',
		'sanitize_callback' => 'sanitize_key',
	),
	'theme-updates'   => array(
		'title'             => 'Disable Themes Auto Update',
		'description'       => __( 'Disables Themes automatic updates.', 'performance-kit' ),
		'function'          => 'kit-theme-updates',
		'type'              => 'checkbox',
		'default'           => '0',
		'setting_type'      => 'boolean',
		'sanitize_callback' => 'sanitize_key',
	),
	'plugins-updates' => array(
		'title'             => 'Disable Plugins Auto Update',
		'description'       => __( 'Disables Plugins automatic updates.', 'performance-kit' ),
		'function'          => 'kit-plugin-updated',
		'type'              => 'checkbox',
		'default'           => '0',
		'setting_type'      => 'boolean',
		'sanitize_callback' => 'sanitize_key',
	),
	'file-editor'     => array(
		'title'             => 'Disable Theme/Plugin File Editors',
		'description'       => __( 'Disables Theme or Plugin file editors. E.g: Appereance > Theme Editor.', 'performance-kit' ),
		'function'          => 'kit-file-editor',
		'type'              => 'checkbox',
		'default'           => '0',
		'setting_type'      => 'boolean',
		'sanitize_callback' => 'sanitize_key',
	),
);

$kit_woocommerce_options = array(
	'woo-scripts'       => array(
		'title'             => 'Disable Scripts',
		'description'       => __( 'Disables WooCommerce related scripts from non-WooCommerce pages.', 'performance-kit' ),
		'function'          => 'kit-woo-scripts',
		'type'              => 'checkbox',
		'setting_type'      => 'boolean',
		'sanitize_callback' => 'sanitize_key',
	),
	'woo-cart'          => array(
		'title'             => 'Disable Cart Fragmentation',
		'description'       => __( 'Disables Cart Fragmentation on non-WooCommerce pages.', 'performance-kit' ),
		'function'          => 'kit-woo-cart',
		'type'              => 'checkbox',
		'setting_type'      => 'boolean',
		'sanitize_callback' => 'sanitize_key',
	),
	'woo-status'        => array(
		'title'             => 'Disable Status Meta Box',
		'description'       => __( 'Disables Status Meta Box on WordPress Admin dashboard.', 'performance-kit' ),
		'function'          => 'kit-woo-status',
		'type'              => 'checkbox',
		'setting_type'      => 'boolean',
		'sanitize_callback' => 'sanitize_key',
	),
	'woo-widgets'       => array(
		'title'             => 'Disable Widgets',
		'description'       => __( 'Removes all WooCommerce widgets.', 'performance-kit' ),
		'function'          => 'kit-woo-widgets',
		'type'              => 'checkbox',
		'setting_type'      => 'boolean',
		'sanitize_callback' => 'sanitize_key',
	),
	'password-strength' => array(
		'title'             => 'Disable Password Strength Meter',
		'description'       => __( 'Disables Password Strength Meter on non-WooCommerce pages.', 'performance-kit' ),
		'function'          => 'kit-password-strength',
		'type'              => 'checkbox',
		'setting_type'      => 'boolean',
		'sanitize_callback' => 'sanitize_key',
	),
);

$kit_cdn_options = array(
	'rewrite'              => array(
		'title'             => 'Enable CDN Rewrite',
		'description'       => __( 'Enables the CDN rewrite and starts applying the settings below.', 'performance-kit' ),
		'function'          => 'kit-cdn-rewrite',
		'type'              => 'checkbox',
		'setting_type'      => 'boolean',
		'sanitize_callback' => 'sanitize_key',
	),
	'cdn-url'              => array(
		'title'             => 'CDN URL',
		'description'       => __( 'Your CDN URL provided by your CDN provider. Without a "/" trail.', 'performance-kit' ),
		'function'          => 'kit-cdn-url',
		'type'              => 'inputtext',
		'placeholder'       => 'https://',
		'setting_type'      => 'string',
		'sanitize_callback' => 'sanitize_text_field',
	),
	'included-directories' => array(
		'title'             => 'Included Directories',
		'description'       => __( 'Define which directories you want to add your pull zone.', 'performance-kit' ),
		'function'          => 'kit-cdn-included',
		'type'              => 'inputtext',
		'placeholder'       => 'wp-content,wp-includes',
		'setting_type'      => 'string',
		'sanitize_callback' => 'sanitize_text_field',
	),
	'excluded-directories' => array(
		'title'             => 'Excluded Directories',
		'description'       => __( 'Define which directories you DO NOT want to add your pull zone.', 'performance-kit' ),
		'function'          => 'kit-cdn-excluded',
		'type'              => 'inputtext',
		'placeholder'       => 'wp-admin',
		'setting_type'      => 'string',
		'sanitize_callback' => 'sanitize_text_field',
	),
	'excluded-files'       => array(
		'title'             => 'Excluded Format',
		'description'       => __( 'Define which file formats you DO NOT want to add your pull zone.', 'performance-kit' ),
		'function'          => 'kit-cdn-excluded-files',
		'type'              => 'inputtext',
		'placeholder'       => '.png,.svg',
		'setting_type'      => 'string',
		'sanitize_callback' => 'sanitize_text_field',
	),
	'debug_mode'           => array(
		'title'             => 'Enable Debug Mode',
		'description'       => __( 'Enables Debug Mode which is preventing rewriting urls when you are admin.', 'performance-kit' ),
		'function'          => 'kit-debug-mode',
		'type'              => 'checkbox',
		'setting_type'      => 'boolean',
		'sanitize_callback' => 'sanitize_key',
	),

);

$kit_analytics_options = array(
	'local-analytics'        => array(
		'title'             => 'Enable Local Analytics',
		'description'       => __( 'Enable fetching and serving the ga.js code from the Google Analytics, locally.', 'performance-kit' ),
		'function'          => 'kit-local-analytics',
		'type'              => 'checkbox',
		'setting_type'      => 'boolean',
		'sanitize_callback' => 'sanitize_key',
	),
	'tracking-code-type'     => array(
		'title'             => 'Tracking Code Type',
		'description'       => __( 'Define your tracking code type.', 'performance-kit' ),
		'function'          => 'kit-tracking-type',
		'type'              => 'select',
		'options'           => array(
			'Classic Google Analytics' => 'classic_google_analytics',
		),
		'setting_type'      => 'string',
		'sanitize_callback' => 'sanitize_text_field',
	),
	'tracking-id'            => array(
		'title'             => 'Tracking ID',
		'description'       => __( 'Define your tracking ID provided by your analytics provider.', 'performance-kit' ),
		'function'          => 'kit-tracking-id',
		'type'              => 'inputtext',
		'placeholder'       => '',
		'setting_type'      => 'string',
		'sanitize_callback' => 'sanitize_text_field',
	),
	'tracking-code-position' => array(
		'title'             => 'Tracking Code Position',
		'description'       => __( 'Select the position where your analytics codes will be added.', 'performance-kit' ),
		'function'          => 'kit-tracking-position',
		'type'              => 'select',
		'options'           => array(
			'Header' => 'wp_head',
			'Footer' => 'wp_footer',
		),
		'setting_type'      => 'string',
		'sanitize_callback' => 'sanitize_text_field',
	),
	'optimize-tracking'      => array(
		'title'             => 'Optimize Analytics',
		'description'       => __( 'Optimize the analytics code by removing external marketing scripts and requests.', 'performance-kit' ),
		'function'          => 'kit-optimize-analytics',
		'type'              => 'checkbox',
		'setting_type'      => 'boolean',
		'sanitize_callback' => 'sanitize_key',
	),
	'anonymize-ip'           => array(
		'title'             => 'Anonymize IP',
		'description'       => __( 'Anonymize the IP.', 'performance-kit' ),
		'function'          => 'kit-anon-ip',
		'type'              => 'checkbox',
		'setting_type'      => 'boolean',
		'sanitize_callback' => 'sanitize_key',
	),
	'track-admins'           => array(
		'title'             => 'Track Logged In Admins',
		'description'       => __( 'Enable tracking for logged in admins.', 'performance-kit' ),
		'function'          => 'kit-track-admins',
		'type'              => 'checkbox',
		'setting_type'      => 'boolean',
		'sanitize_callback' => 'sanitize_key',
	),
);

$kit_misc_options = array(
	'test-5'  => array(
		'title'             => 'Enable SVG Support',
		'description'       => __( 'Activates the support of SVG files on Media Library.', 'performance-kit' ),
		'function'          => 'kit-svg-support',
		'type'              => 'checkbox',
		'setting_type'      => 'boolean',
		'sanitize_callback' => 'sanitize_key',
	),
	'test-0'  => array(
		'title'             => 'Disable Google Maps',
		'description'       => __( 'Disables Google Maps globally.', 'performance-kit' ),
		'function'          => 'kit-google-maps',
		'type'              => 'checkbox',
		'setting_type'      => 'boolean',
		'sanitize_callback' => 'sanitize_key',
	),
	'test-1'  => array(
		'title'             => 'Disable Gutenberg Editor',
		'description'       => __( 'Disables Guternberg Editor and activated the classic editor.', 'performance-kit' ),
		'function'          => 'kit-gutenberg-editor',
		'type'              => 'checkbox',
		'setting_type'      => 'boolean',
		'sanitize_callback' => 'sanitize_key',
	),
	'test-3'  => array(
		'title'             => 'Disable HTML in Comments',
		'description'       => __( 'Disables HTML in comments.', 'performance-kit' ),
		'function'          => 'kit-html-comments',
		'type'              => 'checkbox',
		'setting_type'      => 'boolean',
		'sanitize_callback' => 'sanitize_key',
	),
	'test-11' => array(
		'title'             => 'Disable Font Awesome',
		'description'       => __( 'Removes Font Awesome globally.', 'performance-kit' ),
		'function'          => 'kit-font-awesome',
		'type'              => 'checkbox',
		'setting_type'      => 'boolean',
		'sanitize_callback' => 'sanitize_key',
	),
	'test-12' => array(
		'title'             => 'Disable Google Fonts',
		'description'       => __( 'Removes Google Fonts globally.', 'performance-kit' ),
		'function'          => 'kit-google-fonts',
		'type'              => 'checkbox',
		'setting_type'      => 'boolean',
		'sanitize_callback' => 'sanitize_key',
	),
);
