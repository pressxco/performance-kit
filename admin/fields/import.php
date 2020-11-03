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

class Performance_Kit_Import_Export extends Performance_Kit_Admin {

	public $all_options;

	public $my_options = array();

	public function __construct() {

		$this->all_options = wp_load_alloptions();

	}

	public function encode_arr( $data ) {

		return base64_encode( serialize( $data ) );

	}

	public function decode_arr( $data ) {

			return unserialize( base64_decode( $data ) );

	}

	public function setting_export() {

		foreach ( $this->all_options as $name => $value ) {
			if ( stristr( $name, 'kit-' ) ) {
					$this->my_options[ $name ] = $value;
			}
		}
		echo $this->encode_arr( $this->my_options );

	}

	public function performance_kit_import_process() {

		if ( isset( $_POST['import_code'] ) ) {
			$import_array = $this->decode_arr( $_POST['import_code'] );

			foreach ( $import_array as $import_option => $import_key ) {

				update_option( $import_option, $import_key );

			}
		} else {
			// echo 'hello2';
		}

	}

	public function options_setup() {
		?>

		<form id="performance_kit_export_options" method="post" name="" action="#">
			<?php $this->section_heading( 'Export Options', 'Modify the WordPress Core functionalities...' ); ?>
			<textarea class="kit-option kit_option_export" name="export_code" rows="10"><?php $this->setting_export(); ?></textarea>
			<?php submit_button( __( 'Import Options', 'performance-kit' ), 'primary kit-button', 'restore_options', true ); ?>
		</form>

		<form id="performance_kit_import_options" method="post" name="" action="#">

			<?php
			wp_nonce_field( 'performance_kit_update', 'performance_kit_form' );

			$this->section_heading( 'Import Options', 'Modify the WordPress Core functionalities...' );
			?>
		  <textarea class="kit-option kit_option_impot" rows="10" name="import_code"></textarea>
		<?php

				$this->performance_kit_import_process();
				submit_button( __( 'Import Options', 'performance-kit' ), 'primary kit-button', 'restore_options', true );

		?>

		</form>

		<?php
	}

}

// Initialize
$init = new Performance_Kit_Import_Export();
$init->options_setup();

?>