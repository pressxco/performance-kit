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

		$this->kit_wordpress_options = array(
			'xml-rpc'             => array(
				'title'       => 'Disable XML-RPC',
				'description' => __( 'Disables XML-RPC functionality', 'performance-kit' ),
				'function'    => 'kit-xmlrpc',
				'value'       => '0',
				'type'        => 'checkbox',
			),
			'emojis'              => array(
				'title'       => 'Disable Emojis',
				'description' => __( 'Removes Emoji Javascript file. Be cautious as this option affects your current emojis.', 'performance-kit' ),
				'function'    => 'kit-emojis',
				'value'       => '0',
				'type'        => 'checkbox',
			),
			'embeds'              => array(
				'title'       => 'Disable Embeds',
				'description' => __( 'Removes Embeds Javascript file. Be cautios as this option affects your current embeds.', 'performance-kit' ),
				'function'    => 'kit-embeds',
				'value'       => '0',
				'type'        => 'checkbox',
			),
			'query-strings'       => array(
				'title'       => 'Remove Query Strings',
				'description' => __( 'Removes Query Strings from assets like CSS and Javascript files.', 'performance-kit' ),
				'function'    => 'kit-query-strings',
				'value'       => '0',
				'type'        => 'checkbox',
			),
			'jquery-migrate'      => array(
				'title'       => 'Remove jQuery Migrate',
				'description' => __( 'Removes jQuery Migrate Javascript file. Be cautious as this option may affect your theme functionality if you are using a very old theme', 'performance-kit' ),
				'function'    => 'kit-jquery-migrate',
				'value'       => '0',
				'type'        => 'checkbox',
			),
			'wp-version'          => array(
				'title'       => 'Hide WP Version',
				'description' => __( 'Hides WordPress Version in the <head> section.', 'performance-kit' ),
				'function'    => 'kit-wp-version',
				'value'       => '0',
				'type'        => 'checkbox',
			),
			'wlwmanifest'         => array(
				'title'       => 'Remove wlwmanifest Link',
				'description' => __( 'Removes wlwmanifest Link.', 'performance-kit' ),
				'function'    => 'kit-manifest',
				'value'       => '0',
				'type'        => 'checkbox',
			),
			'rsd-link'            => array(
				'title'       => 'Remove RSD Link',
				'description' => __( 'Removes RSD Link.', 'performance-kit' ),
				'function'    => 'kit-rsd',
				'value'       => '0',
				'type'        => 'checkbox',
			),
			'short-link'          => array(
				'title'       => 'Remove Shortlink',
				'description' => __( 'Removes Shortlink.', 'performance-kit' ),
				'function'    => 'kit-shortlink',
				'value'       => '0',
				'type'        => 'checkbox',
			),
			'rss-feeds'           => array(
				'title'       => 'Disable RSS Feeds',
				'description' => __( 'Removes RSS Feeds.', 'performance-kit' ),
				'function'    => 'kit-rss-feed',
				'value'       => '0',
				'type'        => 'checkbox',
			),
			'rss-links'           => array(
				'title'       => 'Remove RSS Feed Links',
				'description' => __( 'Removes RSS Feed Links.', 'performance-kit' ),
				'function'    => 'kit-rss-links',
				'value'       => '0',
				'type'        => 'checkbox',
			),
			'self-pingbacks'      => array(
				'title'       => 'Disable Self Pingbacks',
				'description' => __( 'Disables Self Pingbacks.', 'performance-kit' ),
				'function'    => 'kit-pingbacks',
				'value'       => '0',
				'type'        => 'checkbox',
			),
			'api-links'           => array(
				'title'       => 'Remove REST API Links',
				'description' => __( 'Remove REST API Links.', 'performance-kit' ),
				'function'    => 'kit-restapi-links',
				'value'       => '0',
				'type'        => 'checkbox',
			),
			'dashicons'           => array(
				'title'       => 'Disable Dashicons',
				'description' => __( 'Disable Dashicons.', 'performance-kit' ),
				'function'    => 'kit-dashicons',
				'value'       => '0',
				'type'        => 'checkbox',
			),
			'comment-urls'        => array(
				'title'       => 'Remove Comment URLs',
				'description' => __( 'Removes Comment URLs.', 'performance-kit' ),
				'function'    => 'kit-comment-urls',
				'value'       => '0',
				'type'        => 'checkbox',
			),
			'heart'               => array(
				'title'       => 'Disable Heartbeat',
				'description' => __( 'Disable Hearbeat.', 'performance-kit' ),
				'function'    => 'kit-heartbeat',
				'type'        => 'select',
				'options'     => array(
					'Default'                             => '0',
					'Disable Everywhere'                  => '1',
					'Only Allow When Editing Posts/Pages' => '2',
				),
			),
			'heartbeat-frequency' => array(
				'title'       => 'Heartbeat Frequency',
				'description' => __( 'Modifies Heartbeat Frequency.', 'performance-kit' ),
				'function'    => 'kit-heartbeat-frequeny',
				'type'        => 'select',
				'options'     => array(
					'15 Seconds (Default)' => '15',
					'30 Seconds'           => '30',
					'45 Seconds'           => '45',
					'60 Seconds'           => '60',
					'90 Seconds'           => '90',
					'120 Seconds'          => '120',
				),
			),
			'post-revisions'      => array(
				'title'       => 'Limit Post Revisions',
				'description' => __( 'Limit Post Revisions.', 'performance-kit' ),
				'function'    => 'kit-revisions',
				'type'        => 'select',
				'options'     => array(
					'Default'  => '-1',
					'Disable Post Revisions'   => '0',
					'1'  => '1',
					'2'  => '2',
					'3'  => '3',
					'4'  => '4',
					'5'  => '5',
					'6'  => '6',
					'7'  => '7',
					'8'  => '8',
					'9'  => '9',
					'10' => '10',
					'20' => '20',
					'25' => '25',
					'35' => '35',
					'40' => '40',
				),
			),
			'autosave-interval'   => array(
				'title'       => 'Autosave Interval',
				'description' => __( 'Modifies Autosave Interval.', 'performance-kit' ),
				'function'    => 'kit-autosave',
				'type'        => 'select',
				'options'     => array(
					'1 Minute' => '1',
					'2 Minute' => '2',
					'3 Minute' => '3',
					'4 Minute' => '4',
					'5 Minute' => '5',
					'Disable'  => '0',
				),
			),
			'jquery-cdn'              => array(
				'title'       => 'Move jQuery to Global CDN',
				'description' => __( 'Move default jQuery to one of the Global CDNs.', 'performance-kit' ),
				'function'    => 'kit-jquery',
				'type'        => 'select',
				'options'     => array(
					'Default'    => 'default',
					'Google CDN' => 'GOOGLE',
					'CDNJS'      => 'CDNJS',
					'jsDelivr'   => 'JSDELIVER',
				),
			),

		);

		$this->kit_config_options = array(
			'wordpress-cron'             => array(
				'title'       => 'Disable WP_CRON',
				'description' => __( 'Disables WP_CRON functionality through wp-config.php.', 'performance-kit' ),
				'function'    => 'kit-wp-cron',
				'type'        => 'checkbox',
				'value'       => '0',
			),
			'wordpress-wp-cache'         => array(
				'title'       => 'Enable WP_CACHE',
				'description' => __( 'Enable WP_CACHE on wp-config.php.', 'performance-kit' ),
				'function'    => 'kit-wp-cache',
				'type'        => 'checkbox',
				'value'       => '0',
			),
			'wordpress-concatenate'      => array(
				'title'       => 'Enable CONCATENATE_SCRIPTS',
				'description' => __( 'Enable CONCATENATE_SCRIPTS on wp-config.php.', 'performance-kit' ),
				'function'    => 'kit-wp-concatenate',
				'type'        => 'checkbox',
				'value'       => '0',
			),
			'wordpress-compress-css'     => array(
				'title'       => 'Enable COMPRESS_CSS',
				'description' => __( 'Enable COMPRESS_CSS on wp-config.php.', 'performance-kit' ),
				'function'    => 'kit-wp-compress-css',
				'type'        => 'checkbox',
				'value'       => '0',
			),
			'wordpress-compress-scripts' => array(
				'title'       => 'Enable COMPRESS_SCRIPTS',
				'description' => __( 'Enable COMPRESS_SCRIPTS on wp-config.php.', 'performance-kit' ),
				'function'    => 'kit-wp-compress-scripts',
				'type'        => 'checkbox',
				'value'       => '0',
			),
			'wordpress-enforce'          => array(
				'title'       => 'Enable ENFORCE_GZIP',
				'description' => __( 'Enable ENFORCE_GZIP on wp-config.php.', 'performance-kit' ),
				'function'    => 'kit-wp-gzip',
				'type'        => 'checkbox',
				'value'       => '0',
			),
		);

		$this->kit_advanced_options = array(
			'comment-system'  => array(
				'title'       => 'Disable Comment System',
				'description' => __( 'Removes the WordPress Comment System functions.', 'performance-kit' ),
				'function'    => 'kit-comment-system',
				'type'        => 'checkbox',
				'value'       => '0',
			),
			'screen-options'  => array(
				'title'       => 'Disable Screen Options Button',
				'description' => __( 'Removes the WordPress Screen Options button.', 'performance-kit' ),
				'function'    => 'kit-screen-options',
				'type'        => 'checkbox',
				'value'       => '0',
			),
			'core-updates'    => array(
				'title'       => 'Disable WP Core Auto Update',
				'description' => __( 'Disables WP Core automatic updates.', 'performance-kit' ),
				'function'    => 'kit-core-options',
				'type'        => 'checkbox',
				'value'       => '0',
			),
			'theme-updates'   => array(
				'title'       => 'Disable Themes Auto Update',
				'description' => __( 'Disables Themes automatic updates.', 'performance-kit' ),
				'function'    => 'kit-theme-updates',
				'type'        => 'checkbox',
				'value'       => '0',
			),
			'plugins-updates' => array(
				'title'       => 'Disable Plugins Auto Update',
				'description' => __( 'Disables Plugins automatic updates.', 'performance-kit' ),
				'function'    => 'kit-plugin-updated',
				'type'        => 'checkbox',
				'value'       => '0',
			),
			'file-editor'     => array(
				'title'       => 'Disable Theme/Plugin File Editors',
				'description' => __( 'Disables Theme or Plugin file editors. E.g: Appereance > Theme Editor.', 'performance-kit' ),
				'function'    => 'kit-file-editor',
				'type'        => 'checkbox',
				'value'       => '0',
			),
		);

		$options_array = array_merge($this->kit_wordpress_options, $this->kit_config_options, $this->kit_advanced_options);

	}

	public function options_setup() {
		?>

		<form id="performance_kit_wordpress_options" method="post" name="" action="#">
			
			<?php
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

				$this->performance_kit_catch();

			?>

		</form>

		<?php
	}
}

// Initialize
$init = new Performance_Kit_Wordpress_Options();
$init->options_setup();


?>
