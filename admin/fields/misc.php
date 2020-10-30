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
			'test-5' => array(
				'title' => 'Enable SVG Support',
				'description' => __( 'Activates the support of SVG files on Media Library.', 'performance-kit' ),
				'function' => 'kit-svg-support',
				'type' => 'checkbox',
			),
			'test-0' => array(
				'title' => 'Disable Google Maps',
				'description' => __( 'Disables Google Maps globally.', 'performance-kit' ),
				'function' => 'kit-google-maps',
				'type' => 'checkbox',
			),
			'test-1' => array(
				'title' => 'Disable Gutenberg Editor',
				'description' => __( 'Disables Guternberg Editor and activated the classic editor.', 'performance-kit' ),
				'function' => 'kit-gutenberg-editor',
				'type' => 'checkbox',
			),
			'test-3' => array(
				'title' => 'Disable HTML in Comments',
				'description' => __( 'Disables HTML in comments.', 'performance-kit' ),
				'function' => 'kit-html-comments',
				'type' => 'checkbox',
			),
			'test-11' => array(
				'title' => 'Disable Font Awesome',
				'description' => __( 'Removes Font Awesome globally.', 'performance-kit' ),
				'function' => 'kit-font-awesome',
				'type' => 'checkbox',
			),
			'test-12' => array(
				'title' => 'Disable Google Fonts',
				'description' => __( 'Removes Google Fonts globally.', 'performance-kit' ),
				'function' => 'kit-google-fonts',
				'type' => 'checkbox',
			),
		);

	}

	public function options_setup() {
		?>

		<form id="performance_kit_misc_options" method="post" name="" action="#">

			<?php 
				wp_nonce_field( 'performance_kit_update', 'performance_kit_form' ); 

				// WordPress Base Options
				$this->section_heading('WordPress Misc Options', 'Adjust the WordPress Miscellaneous options for better performance...');
				$this->performance_kit_list_layout( $this->kit_misc_options, 'kit_option' );

				submit_button( __( 'Save Changes', 'performance-kit' ), 'primary kit-button', 'submit-disable-scripts', true );

			?>

		</form>

		<?php
	}
}


// Initialize
$init = new Performance_Kit_Misc_Options();
$init->options_setup();

?>