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

class Performance_Kit_Misc_Options extends Performance_Kit_Admin {

	public function __construct() {

		$this->kit_misc_options = array(
			'test-5'  => array(
				'title'       => 'Enable SVG Support',
				'description' => __( 'Activates the support of SVG files on Media Library.', 'performance-kit' ),
				'function'    => 'kit-svg-support',
				'type'        => 'checkbox',
			),
			'test-0'  => array(
				'title'       => 'Disable Google Maps',
				'description' => __( 'Disables Google Maps globally.', 'performance-kit' ),
				'function'    => 'kit-google-maps',
				'type'        => 'checkbox',
			),
			'test-1'  => array(
				'title'       => 'Disable Gutenberg Editor',
				'description' => __( 'Disables Guternberg Editor and activated the classic editor.', 'performance-kit' ),
				'function'    => 'kit-gutenberg-editor',
				'type'        => 'checkbox',
			),
			'test-3'  => array(
				'title'       => 'Disable HTML in Comments',
				'description' => __( 'Disables HTML in comments.', 'performance-kit' ),
				'function'    => 'kit-html-comments',
				'type'        => 'checkbox',
			),
			'test-11' => array(
				'title'       => 'Disable Font Awesome',
				'description' => __( 'Removes Font Awesome globally.', 'performance-kit' ),
				'function'    => 'kit-font-awesome',
				'type'        => 'checkbox',
			),
			'test-12' => array(
				'title'       => 'Disable Google Fonts',
				'description' => __( 'Removes Google Fonts globally.', 'performance-kit' ),
				'function'    => 'kit-google-fonts',
				'type'        => 'checkbox',
			),
		);

		$this->env = array(
			__( 'System name', 'performance-kit' ) => php_uname(),
			__( 'PHP Version', 'performance-kit' ) => phpversion(),
			__( 'Zend Engine version', 'performance-kit' ) => zend_version(),
			__( 'Server Api', 'performance-kit' ) => php_sapi_name(),
			__( 'Loaded configuration file', 'performance-kit' ) => php_ini_loaded_file(),
			__( 'PHP Script Owner', 'performance-kit' ) => get_current_user(),
			__( 'PHP Script Owner UID', 'performance-kit' ) => getmyuid(),
			__( 'PHP Script Owner GUID', 'performance-kit' ) => getmygid(),
			__( 'Memory usage', 'performance-kit' ) => memory_get_usage(),
			__( 'Memory peak usage', 'performance-kit' ) => memory_get_peak_usage(),
			__( 'Temporary directory', 'performance-kit' ) => sys_get_temp_dir(),
  	);


	}

	public function options_setup() {
		?>

		<form id="performance_kit_misc_options" method="post" name="" action="#">

			<?php
				wp_nonce_field( 'performance_kit_update', 'performance_kit_form' );

				$this->performance_kit_section(
					'WordPress Misc Options',
					'Adjust the WordPress Miscellaneous options for better performance...',
					'kit_misc_options', 
					$this->kit_misc_options,
					'kit_option'
				);				

			?>

		</form>

		<?php
	}
}

// Initialize
$init = new Performance_Kit_Misc_Options();
$init->options_setup();

?>
