<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link  https://pressx.co
 * @since 1.0.0
 *
 * @package    Performance_Kit
 * @subpackage Performance_Kit/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Performance_Kit
 * @subpackage Performance_Kit/admin
 * @author     PressX <info@pressx.co>
 */
class Performance_Kit_Admin {


	/**
	 * The ID of this plugin.
	 *
	 * @since  1.0.0
	 * @access private
	 * @var    string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since  1.0.0
	 * @access private
	 * @var    string    $version    The current version of this plugin.
	 */
	private $version;

	public $kit_wordpress_options;


	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 * @param string $plugin_name The name of this plugin.
	 * @param string $version     The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

		global $kit_wordpress_options;
		global $kit_config_options;
		global $kit_advanced_options;
		global $kit_woocommerce_options;
		global $kit_cdn_options;
		global $kit_analytics_options;
		global $kit_misc_options;

		$this->kit_wordpress_options   = $kit_wordpress_options;
		$this->kit_config_options      = $kit_config_options;
		$this->kit_advanced_options    = $kit_advanced_options;
		$this->kit_woocommerce_options = $kit_woocommerce_options;
		$this->kit_analytics_options   = $kit_analytics_options;
		$this->kit_cdn_options         = $kit_cdn_options;
		$this->kit_misc_options        = $kit_misc_options;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Performance_Kit_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Performance_Kit_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/css/app.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Performance_Kit_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Performance_Kit_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/js/app.js', array( 'jquery' ), '1.0.2', false );

	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since 1.0.0
	 */
	public function add_plugin_admin_menu() {

		/**
		 * Add a settings page for this plugin to the Settings menu.
		 *
		 * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
		 *
		 *        Administration Menus: http://codex.wordpress.org/Administration_Menus
		 *
		 * add_options_page( $page_title, $menu_title, $capability, $menu_slug, $function);
		 *
		 * @link https://codex.wordpress.org/Function_Reference/add_options_page
		 */
		add_menu_page(
			esc_html__( 'Performance Kit', 'performance-kit' ),
			'Performance Kit',
			'manage_options',
			'performance-kit',
			array( $this, 'display_plugin_setup_page' ),
			plugins_url( 'performance-kit/admin/assets/icons/flash.svg' ),
			999999999
		);
	}

	/**
	 * Add custom jQuery script to the admin panel.
	 *
	 * @since 1.0.0
	 */
	public function add_javascript() {
		?>
			<script>
			jQuery('input[type=checkbox].kit_option').click(function() {
				if (jQuery(this).val() == '0') {
					jQuery(this).val('1');
				} else {
					jQuery(this).val('0');
				}
			});
			</script>
		<?php
	}

	/**
	 * Add settings action link to the plugins page.
	 *
	 * @param array $links Returns the plugin links.
	 * @since 1.0.0
	 */
	public function add_action_links( $links ) {

		/**
		*  Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
		*/
		$settings_link = array( '<a href="' . admin_url( 'admin.php?page=' . $this->plugin_name ) . '">' . __( 'Settings', $this->plugin_name ) . '</a>' );
		return array_merge( $settings_link, $links );

	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since 1.0.0
	 */
	public function display_plugin_setup_page() {
		include_once 'partials/' . $this->plugin_name . '-admin-display.php';
	}

	/**
	 * Render the plugin name.
	 *
	 * @since 1.0.0
	 */
	public function display_plugin_name() {
		$name = str_replace( '-', ' ', $this->plugin_name );
		$name = ucwords( $name );
		return '<a class="plugin-name" href="admin.php?page=performance-kit">' . esc_html( $name ) . '</a>';
	}

	/**
	 * Render the section heading.
	 *
	 * @since 1.0.0
	 */
	public function section_heading( $title, $description ) {
		?>

			<div class="section-title">
				<h3><?php esc_html_e( $title, 'performance-kit' ); ?></h3>
				<p><?php esc_html_e( $description, 'performance-kit' ); ?></p>
			</div>

		<?php
	}

	/**
	 * WooCommerce Checker
	 *
	 * @since 1.0.0
	 */
	public function woocommerce_checker() {
		if ( class_exists( 'WooCommerce' ) ) {
			$this->kit_woocommerce = true;
			return true;
		} else {
			$this->kit_woocommerce = false;
			return false;
		}
	}

	/**
	 * Register Options
	 *
	 * @since 1.0.0
	 */
	public function performance_kit_options() {

		$kit_wp_options = array_merge( $this->kit_wordpress_options, $this->kit_config_options, $this->kit_advanced_options, $this->kit_woocommerce_options, $this->kit_analytics_options, $this->kit_cdn_options, $this->kit_misc_options );

		foreach ( $kit_wp_options as $options => $key ) {
			register_setting(
				$key['setting_group'],
				$key['function'],
				array(
					'type'              => $key['setting_type'],
					'description'       => $key['description'],
					'single'            => true,
					'sanitize_callback' => $key['sanitize_callback'],
				)
			);
		}

	}

	/**
	 * Render the list layout.
	 *
	 * @since 1.0.0
	 */
	public function performance_kit_list_layout( $array, $key ) {

		foreach ( $array as $key ) {
			include 'partials/kit-option.php';
		}

	}

	/**
	 * Render the section.
	 *
	 * @since 1.0.0
	 */
	public function performance_kit_section( $title, $description, $section, $array, $key ) {

		echo '<div id="' . $section . '" class="pk-section">';

		switch ( $section ) :
			case 'kit_config_options':
				$this->section_heading( $title, $description );
				if ( ! file_exists( ABSPATH . 'wp-config.php' ) || ! is_writable( ABSPATH . 'wp-config.php' ) ) {
					echo '<div class="notification">';
					echo file_get_contents( plugin_dir_path( PERFORMANCE_KIT_FILE ) . '/admin/assets/icons/alert.svg' );
					echo esc_html__( 'Seems like your wp-config.php is not in the default place and this section requires a standard wp-config placement.', 'performance-kit' );
					echo '<a target="_blank" href="' . esc_url( 'mailto:hello@pressx.co' ) . '">' . esc_html__( 'Contact us for more information.', 'performance-kit' ) . '</a>';
					echo '</div>';
				}
				$this->performance_kit_list_layout( $array, $key );
				break;
			case 'kit_woocommerce_options':
				$this->section_heading( $title, $description );
				include 'partials/kit-woocommerce.php';
				echo '<div class="woocommerce_wrapper">';
				$this->performance_kit_list_layout( $array, $key );
				echo '</div>';
				break;
			default:
				$this->section_heading( $title, $description );
				$this->performance_kit_list_layout( $array, $key );
				break;
		endswitch;

		submit_button( esc_html__( 'Save Changes', 'performance-kit' ), 'primary kit-button', $section, true );

		echo '</div>';

	}

}
