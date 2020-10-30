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
 * CDN Rewrite URLS
 *
 * @since 1.0.0
 * -----------------------------------------------------------------------------
 * -----------------------------------------------------------------------------
 */

if ( ! empty( get_option( 'kit-cdn-rewrite' ) ) && get_option( 'kit-cdn-rewrite' ) == '1' && ! empty( get_option( 'kit-cdn-url' ) ) ) {
	add_action( 'template_redirect', 'kit_cdn_rewrite' );
}

function kit_cdn_rewrite() {
	ob_start( 'kit_cdn_rewriter' );
}

function kit_cdn_rewriter( $html ) {

	// Prep Site URL
	$escapedSiteURL = quotemeta( get_option( 'home' ) );

	$regExURL = '(https?:|)' . substr( $escapedSiteURL, strpos( $escapedSiteURL, '//' ) );

	$directories = 'wp\-content|wp\-includes';
	if ( ! empty( get_option( 'kit-cdn-included' ) ) ) {
		$directoriesArray = array_map( 'trim', explode( ',', get_option( 'kit-cdn-included' ) ) );
		if ( count( $directoriesArray ) > 0 ) {
			$directories = implode( '|', array_map( 'quotemeta', array_filter( $directoriesArray ) ) );
		}
	}

	$regEx = '#(?<=[(\"\'])(?:' . $regExURL . ')?/(?:((?:' . $directories . ')[^\"\')]+)|([^/\"\']+\.[^/\"\')]+))(?=[\"\')])#';

	$cdnHTML = preg_replace_callback( $regEx, 'kit_cdn_rewrite_url', $html );

	return $cdnHTML;
}

function kit_cdn_rewrite_url( $url ) {

	if ( ! empty( get_option( 'kit-cdn-url' ) ) ) {

		if ( ! empty( get_option( 'kit-cdn-excluded' ) ) ) {
			$exclusions = array_map( 'trim', explode( ',', get_option( 'kit-cdn-excluded' ) ) );
			foreach ( $exclusions as $exclusion ) {
				if ( ! empty( $exclusion ) && stristr( $url[0], $exclusion ) != false ) {
					return $url[0];
				}
			}
		}

		// Don't Rewrite if Previewing
		if ( is_admin_bar_showing() && isset( $_GET['preview'] ) && $_GET['preview'] == 'true' ) {
			return $url[0];
		}

		// Prep Site URL
		$siteURL = get_option( 'home' );
		$siteURL = substr( $siteURL, strpos( $siteURL, '//' ) );

		// Replace URL w/ No HTTP/S Prefix
		if ( strpos( $url[0], '//' ) === 0 ) {
			return str_replace( $siteURL, get_option( 'kit-cdn-url' ), $url[0] );
		}

		// Found Site URL, Replace Non Relative URL w/ HTTP/S Prefix
		if ( strstr( $url[0], $siteURL ) ) {
			return str_replace( array( 'http:' . $siteURL, 'https:' . $siteURL ), get_option( 'kit-cdn-url' ), $url[0] );
		}

		// Replace Relative URL
		return get_option( 'kit-cdn-url' ) . $url[0];
	}

	// Return Original URL
	return $url[0];
}
