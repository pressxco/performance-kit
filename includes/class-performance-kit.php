<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://pressx.co
 * @since      1.0.0
 *
 * @package    Performance_Kit
 * @subpackage Performance_Kit/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Performance_Kit
 * @subpackage Performance_Kit/includes
 * @author     PressX <info@pressx.co>
 */
class Performance_Kit {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      class    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;
	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		if ( defined( 'PERFORMANCE_KIT_VERSION' ) ) {
			$this->version = PERFORMANCE_KIT_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'performance-kit';

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
		);

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Performance_Kit_Loader. Orchestrates the hooks of the plugin.
	 * - Performance_Kit_i18n. Defines internationalization functionality.
	 * - Performance_Kit_Admin. Defines all hooks for the admin area.
	 * - Performance_Kit_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-performance-kit-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-performance-kit-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 * 
		 */

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/fields/settings.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-performance-kit-admin.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/modules/wordpress-module.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/modules/woocommerce-module.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/modules/analytics-module.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/modules/cdn-module.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/modules/misc-module.php';


		$this->loader = new Performance_Kit_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Performance_Kit_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Performance_Kit_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Performance_Kit_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts', true );

		$this->loader->add_action( 'admin_footer', $plugin_admin, 'add_javascript' );

		// Add menu item.
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_plugin_admin_menu' );

		$this->loader->add_action( 'init', $plugin_admin, 'performance_kit_options' );

		// Add Settings link to the plugin.
		$plugin_basename = plugin_basename( plugin_dir_path( __DIR__ ) . $this->plugin_name . '.php' );

		$this->loader->add_filter( 'plugin_action_links_' . $plugin_basename, $plugin_admin, 'add_action_links' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Performance_Kit_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
