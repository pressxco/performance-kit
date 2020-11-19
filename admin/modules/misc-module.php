<?php
/**
 * Provide a option functions for particular sections
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
 * Enable SVG Support
 *
 * @since 1.0.0
 * -----------------------------------------------------------------------------
 * -----------------------------------------------------------------------------
 */

if ( ! empty( get_option( 'kit-svg-support' ) ) && get_option( 'kit-svg-support' ) == '1' ) {

	function kit_mime_types( $mimes ) {

		// New allowed mime types.
		$mimes['svg']  = 'image/svg+xml';
		$mimes['svgz'] = 'image/svg+xml';

		return $mimes;
	}

	add_filter( 'upload_mimes', 'kit_mime_types', 99 );

	function kit_svgs_upload_check( $checked, $file, $filename, $mimes ) {

		if ( ! $checked['type'] ) {

			$check_filetype		= wp_check_filetype( $filename, $mimes );
			$ext				= $check_filetype['ext'];
			$type				= $check_filetype['type'];
			$proper_filename	= $filename;

			if ( $type && 0 === strpos( $type, 'image/' ) && $ext !== 'svg' ) {
				$ext = $type = false;
			}

			$checked = compact( 'ext','type','proper_filename' );
		}

		return $checked;

	}
	add_filter( 'wp_check_filetype_and_ext', 'kit_svgs_upload_check', 10, 4 );

	function kit_vgs_allow_svg_upload( $data, $file, $filename, $mimes ) {

		global $wp_version;
		if ( $wp_version !== '4.7.1' || $wp_version !== '4.7.2' ) {
			return $data;
		}

		$filetype = wp_check_filetype( $filename, $mimes );

		return [
			'ext'				=> $filetype['ext'],
			'type'				=> $filetype['type'],
			'proper_filename'	=> $data['proper_filename']
		];

	}
	add_filter( 'wp_check_filetype_and_ext', 'kit_vgs_allow_svg_upload', 10, 4 );

}


/**
 * Disable Google Maps
 *
 * @since 1.0.0
 * -----------------------------------------------------------------------------
 * -----------------------------------------------------------------------------
 */

if ( ! empty( get_option( 'kit-google-maps' ) ) && get_option( 'kit-google-maps' ) == '1' ) {
	add_action( 'template_redirect', 'kit_disable_google_maps' );
}

function kit_disable_google_maps() {
	ob_start( 'kit_disable_google_maps_regex' );
}

function kit_disable_google_maps_regex( $html ) {
	$html = preg_replace( '/<script[^<>]*\/\/maps.(googleapis|google|gstatic).com\/[^<>]*><\/script>/i', '', $html );
	return $html;
}

/**
 * Disable Google Fonts
 *
 * @since 1.0.0
 * -----------------------------------------------------------------------------
 * -----------------------------------------------------------------------------
 */

if ( ! empty( get_option( 'kit-google-fonts' ) ) && get_option( 'kit-google-fonts' ) == '1' ) {
	add_action( 'template_redirect', 'kit_disable_google_fonts' );
}

function kit_disable_google_fonts() {
	ob_start( 'kit_disable_google_fonts_regex' );
}

function kit_disable_google_fonts_regex( $html ) {
	$html = preg_replace( '/<link[^<>]*\/\/fonts\.(googleapis|google|gstatic)\.com[^<>]*>/i', '', $html );
	return $html;
}

/**
 * Disable Gutenberg
 *
 * @since 1.0.0
 * -----------------------------------------------------------------------------
 * -----------------------------------------------------------------------------
 */

if ( ! empty( get_option( 'kit-gutenberg-editor' ) ) && get_option( 'kit-gutenberg-editor' ) == '1' ) {

	if ( version_compare( $GLOBALS['wp_version'], '5.0-beta', '>' ) ) {
		add_filter( 'use_block_editor_for_post_type', '__return_false', 100 );
	} else {
		add_filter( 'gutenberg_can_edit_post_type', '__return_false' );
	}


	function smartwp_remove_wp_block_library_css() {
		wp_dequeue_style( 'wp-block-library' );
		wp_dequeue_style( 'wp-block-library-theme' );
	}
	add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css' );


	add_filter( 'use_block_editor_for_post_type', '__return_false', 10 );

	// Don't load Gutenberg-related stylesheets.
	add_action( 'wp_enqueue_scripts', 'remove_block_css', 100 );

	function remove_block_css() {

		wp_dequeue_style( 'wp-block-library' ); // WordPress core
		wp_dequeue_style( 'wp-block-library-theme' ); // WordPress core
		wp_dequeue_style( 'wc-block-style' ); // WooCommerce
		wp_dequeue_style( 'storefront-gutenberg-blocks' ); // Storefront theme

		remove_action( 'wp_enqueue_scripts', 'gutenberg_register_scripts_and_styles' );
		remove_action( 'admin_enqueue_scripts', 'gutenberg_register_scripts_and_styles' );
		remove_action( 'admin_notices', 'gutenberg_wordpress_version_notice' );
		remove_action( 'rest_api_init', 'gutenberg_register_rest_widget_updater_routes' );
		remove_action( 'admin_print_styles', 'gutenberg_block_editor_admin_print_styles' );
		remove_action( 'admin_print_scripts', 'gutenberg_block_editor_admin_print_scripts' );
		remove_action( 'admin_print_footer_scripts', 'gutenberg_block_editor_admin_print_footer_scripts' );
		remove_action( 'admin_footer', 'gutenberg_block_editor_admin_footer' );
		remove_action( 'admin_enqueue_scripts', 'gutenberg_widgets_init' );
		remove_action( 'admin_notices', 'gutenberg_build_files_notice' );
		remove_action( 'try_gutenberg_panel', 'wp_try_gutenberg_panel' );

		remove_filter( 'load_script_translation_file', 'gutenberg_override_translation_file' );
		remove_filter( 'block_editor_settings', 'gutenberg_extend_block_editor_styles' );
		remove_filter( 'default_content', 'gutenberg_default_demo_content' );
		remove_filter( 'default_title', 'gutenberg_default_demo_title' );
		remove_filter( 'block_editor_settings', 'gutenberg_legacy_widget_settings' );
		remove_filter( 'rest_request_after_callbacks', 'gutenberg_filter_oembed_result' );

		// Previously used, compat for older Gutenberg versions.
		remove_filter( 'wp_refresh_nonces', 'gutenberg_add_rest_nonce_to_heartbeat_response_headers' );
		remove_filter( 'get_edit_post_link', 'gutenberg_revisions_link_to_editor' );
		remove_filter( 'wp_prepare_revision_for_js', 'gutenberg_revisions_restore' );

		remove_action( 'rest_api_init', 'gutenberg_register_rest_routes' );
		remove_action( 'rest_api_init', 'gutenberg_add_taxonomy_visibility_field' );
		remove_filter( 'registered_post_type', 'gutenberg_register_post_prepare_functions' );

		remove_action( 'do_meta_boxes', 'gutenberg_meta_box_save' );
		remove_action( 'submitpost_box', 'gutenberg_intercept_meta_box_render' );
		remove_action( 'submitpage_box', 'gutenberg_intercept_meta_box_render' );
		remove_action( 'edit_page_form', 'gutenberg_intercept_meta_box_render' );
		remove_action( 'edit_form_advanced', 'gutenberg_intercept_meta_box_render' );
		remove_filter( 'redirect_post_location', 'gutenberg_meta_box_save_redirect' );
		remove_filter( 'filter_gutenberg_meta_boxes', 'gutenberg_filter_meta_boxes' );

		remove_filter( 'body_class', 'gutenberg_add_responsive_body_class' );
		remove_filter( 'admin_url', 'gutenberg_modify_add_new_button_url' ); // old
		remove_action( 'admin_enqueue_scripts', 'gutenberg_check_if_classic_needs_warning_about_blocks' );
		remove_filter( 'register_post_type_args', 'gutenberg_filter_post_type_labels' );

	}
}


/**
 * Disable HTML in Comments
 *
 * @since 1.0.0
 * -----------------------------------------------------------------------------
 * -----------------------------------------------------------------------------
 */

if ( ! empty( get_option( 'kit-html-comments' ) ) && get_option( 'kit-html-comments' ) == '1' ) {
	add_filter( 'pre_comment_content', 'esc_html' );
}
