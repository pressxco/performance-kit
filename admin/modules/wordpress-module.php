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
 * Disable XML-RPC
 *
 * @since 1.0.0
 * -----------------------------------------------------------------------------
 * -----------------------------------------------------------------------------
 */

if ( ! empty( get_option( 'kit-xmlrpc' ) ) && get_option( 'kit-xmlrpc' ) == '1' ) {
	add_filter( 'xmlrpc_enabled', '__return_false' );
	add_filter( 'wp_headers', 'kit_remove_x_pingback' );
	add_filter( 'pings_open', '__return_false', 9999 );
}

function kit_remove_x_pingback( $headers ) {
	unset( $headers['X-Pingback'], $headers['x-pingback'] );
	return $headers;
}

/**
 * Remove Emojis
 *
 * @since 1.0.0
 * -----------------------------------------------------------------------------
 * -----------------------------------------------------------------------------
 */

if ( ! empty( get_option( 'kit-emojis' ) ) && get_option( 'kit-emojis' ) == '1' ) {
	add_action( 'init', 'kit_disable_emojis' );
}

function kit_disable_emojis() {
	 remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'kit_disable_emojis_tinymce' );
	add_filter( 'wp_resource_hints', 'kit_disable_emojis_dns_prefetch', 10, 2 );
	add_filter( 'emoji_svg_url', '__return_false' );
}

function kit_disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

function kit_disable_emojis_dns_prefetch( $urls, $relation_type ) {
	if ( 'dns-prefetch' == $relation_type ) {
		$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2.2.1/svg/' );
		$urls          = array_diff( $urls, array( $emoji_svg_url ) );
	}
	return $urls;
}

/**
 * Disable Embeds
 *
 * @since 1.0.0
 * -----------------------------------------------------------------------------
 * -----------------------------------------------------------------------------
 */

if ( ! empty( get_option( 'kit-embeds' ) ) && get_option( 'kit-embeds' ) == '1' ) {
	add_action( 'init', 'kit_disable_embeds', 9999 );
}

function kit_disable_embeds() {

	global $wp;

	$wp->public_query_vars = array_diff( $wp->public_query_vars, array( 'embed' ) );

	remove_action( 'rest_api_init', 'wp_oembed_register_route' );

	add_filter( 'embed_oembed_discover', '__return_false' );

	remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );

	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

	remove_action( 'wp_head', 'wp_oembed_add_host_js' );

	add_filter( 'tiny_mce_plugins', 'kit_disable_embeds_tiny_mce_plugin' );

	add_filter( 'rewrite_rules_array', 'kit_disable_embeds_rewrites' );

	remove_filter( 'pre_oembed_result', 'wp_filter_pre_oembed_result', 10 );

}

function kit_disable_embeds_tiny_mce_plugin( $plugins ) {
	return array_diff( $plugins, array( 'wpembed' ) );
}

function kit_disable_embeds_rewrites( $rules ) {
	foreach ( $rules as $rule => $rewrite ) {
		if ( false !== strpos( $rewrite, 'embed=true' ) ) {
			unset( $rules[ $rule ] );
		}
	}
	return $rules;
}

/**
 * Remove Query Strings
 *
 * @since 1.0.0
 * -----------------------------------------------------------------------------
 * -----------------------------------------------------------------------------
 */

if ( ! empty( get_option( 'kit-query-strings' ) ) && get_option( 'kit-query-strings' ) == '1' ) {
	add_action( 'init', 'kit_remove_query_strings' );
}

function kit_remove_query_strings() {
	if ( ! is_admin() ) {
		add_filter( 'script_loader_src', 'kit_remove_query_strings_split', 15 );
		add_filter( 'style_loader_src', 'kit_remove_query_strings_split', 15 );
	}
}

function kit_remove_query_strings_split( $src ) {
	$output = preg_split( '/(&ver|\?ver)/', $src );
	return $output[0];
}

/**
 * Remove jQuery Migrate
 *
 * @since 1.0.0
 * -----------------------------------------------------------------------------
 * -----------------------------------------------------------------------------
 */

if ( ! empty( get_option( 'kit-jquery-migrate' ) ) && get_option( 'kit-jquery-migrate' ) == '1' ) {
	add_filter( 'wp_default_scripts', 'kit_remove_jquery_migrate' );
}

function kit_remove_jquery_migrate( &$scripts ) {
	if ( ! is_admin() ) {
		$scripts->remove( 'jquery' );
		$scripts->add( 'jquery', false, array( 'jquery-core' ), '1.12.4' );
	}
}

/**
 * Hide WordPress Version
 *
 * @since 1.0.0
 * -----------------------------------------------------------------------------
 * -----------------------------------------------------------------------------
 */

if ( ! empty( get_option( 'kit-wp-version' ) ) && get_option( 'kit-wp-version' ) == '1' ) {
	remove_action( 'wp_head', 'wp_generator' );
	add_filter( 'the_generator', 'kit_hide_wp_version' );
}

function kit_hide_wp_version() {
	return '';
}

/**
 * Remove WLWManifest Link
 *
 * @since 1.0.0
 * -----------------------------------------------------------------------------
 * -----------------------------------------------------------------------------
 */

if ( ! empty( get_option( 'kit-manifest' ) ) && get_option( 'kit-manifest' ) == '1' ) {
	remove_action( 'wp_head', 'wlwmanifest_link' );
}

/**
 * Remove RSD Link
 *
 * @since 1.0.0
 * -----------------------------------------------------------------------------
 * -----------------------------------------------------------------------------
 */

if ( ! empty( get_option( 'kit-rsd' ) ) && get_option( 'kit-rsd' ) == '1' ) {
	remove_action( 'wp_head', 'rsd_link' );
}

/**
 * Remove Shortlink
 *
 * @since 1.0.0
 * -----------------------------------------------------------------------------
 * -----------------------------------------------------------------------------
 */

if ( ! empty( get_option( 'kit-shortlink' ) ) && get_option( 'kit-shortlink' ) == '1' ) {
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );
	remove_action( 'template_redirect', 'wp_shortlink_header', 11, 0 );
}

/**
 * Disable RSS Feeds
 *
 * @since 1.0.0
 * -----------------------------------------------------------------------------
 * -----------------------------------------------------------------------------
 */

if ( ! empty( get_option( 'kit-rss-feed' ) ) && get_option( 'kit-rss-feed' ) == '1' ) {
	add_action( 'template_redirect', 'kit_disable_rss_feeds', 1 );
}

function kit_disable_rss_feeds() {
	if ( ! is_feed() || is_404() ) {
		return;
	}

	global $wp_rewrite;
	global $wp_query;

	// check for GET feed query variable firet and redirect
	if ( isset( $_GET['feed'] ) ) {
		wp_redirect( esc_url_raw( remove_query_arg( 'feed' ) ), 301 );
		exit;
	}

	// unset wp_query feed variable
	if ( get_query_var( 'feed' ) !== 'old' ) {
		set_query_var( 'feed', '' );
	}

	// let WordPress redirect to the proper URL
	redirect_canonical();

	// redirect failed, display error message
	wp_die( sprintf( __( "No feed available, please visit the <a href='%s'>homepage</a>!" ), esc_url( home_url( '/' ) ) ) );
}


/**
 * Remove RSS Feed Links
 *
 * @since 1.0.0
 * -----------------------------------------------------------------------------
 * -----------------------------------------------------------------------------
 */

if ( ! empty( get_option( 'kit-rss-links' ) ) && get_option( 'kit-rss-links' ) == '1' ) {
	remove_action( 'wp_head', 'feed_links', 2 );
	remove_action( 'wp_head', 'feed_links_extra', 3 );
}

/**
 * Disable Self Pingbacks
 *
 * @since 1.0.0
 * -----------------------------------------------------------------------------
 * -----------------------------------------------------------------------------
 */

if ( ! empty( get_option( 'kit-pingbacks' ) ) && get_option( 'kit-pingbacks' ) == '1' ) {
	add_action( 'pre_ping', 'kit_disable_self_pingbacks' );
}

function kit_disable_self_pingbacks( &$links ) {
	$home = get_option( 'home' );
	foreach ( $links as $l => $link ) {
		if ( strpos( $link, $home ) === 0 ) {
			unset( $links[ $l ] );
		}
	}
}

/**
 * Remove REST API Links
 *
 * @since 1.0.0
 * -----------------------------------------------------------------------------
 * -----------------------------------------------------------------------------
 */

if ( ! empty( get_option( 'kit-restapi-links' ) ) && get_option( 'kit-restapi-links' ) == '1' ) {
	remove_action( 'xmlrpc_rsd_apis', 'rest_output_rsd' );
	remove_action( 'wp_head', 'rest_output_link_wp_head' );
	remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );
}

/**
 * Disable Dashicons
 *
 * @since 1.0.0
 * -----------------------------------------------------------------------------
 * -----------------------------------------------------------------------------
 */

if ( ! empty( get_option( 'kit-dashicons' ) ) && get_option( 'kit-dashicons' ) == '1' ) {
	add_action( 'wp_enqueue_scripts', 'kit_disable_dashicons' );
}

function kit_disable_dashicons() {
	if ( ! is_user_logged_in() ) {
		wp_dequeue_style( 'dashicons' );
		wp_deregister_style( 'dashicons' );
	}
}

/**
 * Remove Comment URLS
 *
 * @since 1.0.0
 * -----------------------------------------------------------------------------
 * -----------------------------------------------------------------------------
 */

if ( ! empty( get_option( 'kit-comment-urls' ) ) && get_option( 'kit-comment-urls' ) == '1' ) {
	add_filter( 'get_comment_author_link', 'kit_remove_comment_author_link', 10, 3 );
	add_filter( 'get_comment_author_url', 'kit_remove_comment_author_url' );
	add_filter( 'comment_form_default_fields', 'kit_remove_website_field', 9999 );
}

function kit_remove_comment_author_link( $return, $author, $comment_ID ) {
	return $author;
}

function kit_remove_comment_author_url() {
	return false;
}

function kit_remove_website_field( $fields ) {
	unset( $fields['url'] );
	return $fields;
}


/**
 * Limit Post Revisions
 *
 * @since 1.0.0
 * -----------------------------------------------------------------------------
 * -----------------------------------------------------------------------------
 */

if ( ! empty( get_option( 'kit-revisions' ) ) ) {
	if ( defined( 'WP_POST_REVISIONS' ) ) {
		add_action( 'admin_notices', 'kit_admin_notice_post_revisions' );
	} else {
		define( 'WP_POST_REVISIONS', get_option( 'kit-revisions' ) );
	}
}

function kit_admin_notice_post_revisions() {
	echo "<div class='notice notice-error'>";
	echo '<p>';
	echo '<strong>' . __( 'Performance Kit Warning', 'performance-kit' ) . ':</strong> ';
	echo __( 'WP_POST_REVISIONS is already enabled somewhere else on your site. We suggest only enabling this feature in one place.', 'performance-kit' );
	echo '</p>';
	echo '</div>';
}

/**
 * Modify Autosave Interval
 *
 * @since 1.0.0
 * -----------------------------------------------------------------------------
 * -----------------------------------------------------------------------------
 */

if ( ! empty( get_option( 'kit-autosave' ) ) ) {
	if ( defined( 'AUTOSAVE_INTERVAL' ) ) {
		add_action( 'admin_notices', 'performance_kit_admin_notice_autosave_interval' );
	} else {
		define( 'AUTOSAVE_INTERVAL', get_option( 'kit-autosave' ) );
	}
}

function performance_kit_admin_notice_autosave_interval() {
	echo "<div class='notice notice-error'>";
	echo '<p>';
	echo '<strong>' . __( 'Performance Kit Warning', 'performance-kit' ) . ':</strong> ';
	echo __( 'AUTOSAVE_INTERVAL is already enabled somewhere else on your site. We suggest only enabling this feature in one place.', 'performance-kit' );
	echo '</p>';
	echo '</div>';
}


/**
 * Move jQuery to CDN
 *
 * @since 1.0.0
 * -----------------------------------------------------------------------------
 * -----------------------------------------------------------------------------
 */

if ( get_option( 'kit-jquery' ) ) {

	add_action( 'init', 'use_jquery_from_google' );

	function use_jquery_from_google() {
		if ( is_admin() ) {
			return;
		}

		global $wp_scripts;

		$the_option = get_option( 'kit-jquery', 'default' );
		if ($the_option == 'default' ) return;

		if ( isset( $wp_scripts->registered['jquery']->ver ) ) {
			$ver = $wp_scripts->registered['jquery']->ver;
			$ver = str_replace( '-wp', '', $ver );
		} else {
			$ver = '1.12.4';
		}

		if ( $the_option == 'GOOGLE' ) {

			wp_deregister_script( 'jquery' );

			wp_register_script( 'jquery', "//ajax.googleapis.com/ajax/libs/jquery/$ver/jquery.min.js", false, $ver );

		}

		else if ( $the_option == 'CDNJS' ) {

			wp_deregister_script( 'jquery' );

			wp_register_script( 'jquery', "//cdnjs.cloudflare.com/ajax/libs/jquery/$ver/jquery.min.js", false, $ver );

		}

		else if ( $the_option == 'JSDELIVER' ) {

			wp_deregister_script( 'jquery' );

			wp_register_script( 'jquery', "//cdn.jsdelivr.net/npm/jquery@$ver/dist/jquery.min.js", false, $ver );

		}

	}
}


/**
 * Disable Comments
 *
 * @since 1.0.0
 * -----------------------------------------------------------------------------
 * -----------------------------------------------------------------------------
 */

if ( ! empty( get_option( 'kit-comment-system' ) ) && get_option( 'kit-comment-system' ) == '1' ) {

	function df_disable_comments_post_types_support() {

		$post_types = get_post_types();

		foreach ( $post_types as $post_type ) {

			if ( post_type_supports( $post_type, 'comments' ) ) {

				 remove_post_type_support( $post_type, 'comments' );

				 remove_post_type_support( $post_type, 'trackbacks' );
			}
		}
	}

	add_action( 'admin_init', 'df_disable_comments_post_types_support' );

	// Close comments on the front-end

	function df_disable_comments_status() {

		return false;
	}

	add_filter( 'comments_open', 'df_disable_comments_status', 20, 2 );

	add_filter( 'pings_open', 'df_disable_comments_status', 20, 2 );

	// Hide existing comments

	function df_disable_comments_hide_existing_comments( $comments ) {

		$comments = array();

		return $comments;
	}

	add_filter( 'comments_array', 'df_disable_comments_hide_existing_comments', 10, 2 );

	// Remove comments page in menu

	function df_disable_comments_admin_menu() {

		remove_menu_page( 'edit-comments.php' );
	}

	add_action( 'admin_menu', 'df_disable_comments_admin_menu' );

	// Redirect any user trying to access comments page

	function df_disable_comments_admin_menu_redirect() {

		global $pagenow;

		if ( $pagenow === 'edit-comments.php' ) {

			wp_redirect( admin_url() );
			exit;
		}
	}

	add_action( 'admin_init', 'df_disable_comments_admin_menu_redirect' );

	// Remove comments metabox from dashboard

	function df_disable_comments_dashboard() {

		remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
	}

	add_action( 'admin_init', 'df_disable_comments_dashboard' );

	// Remove comments links from admin bar

	function df_disable_comments_admin_bar() {

		if ( is_admin_bar_showing() ) {

			remove_action( 'admin_bar_menu', 'wp_admin_bar_comments_menu', 60 );
		}
	}

	add_action( 'init', 'df_disable_comments_admin_bar' );

}

/**
 * Disable Screen Options
 *
 * @since 1.0.0
 * -----------------------------------------------------------------------------
 * -----------------------------------------------------------------------------
 */

if ( ! empty( get_option( 'kit-screen-options' ) ) && get_option( 'kit-screen-options' ) == '1' ) {
	function kit_remove_screen_options() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return false;
		}
		return false;
	}
	add_filter( 'screen_options_show_screen', 'kit_remove_screen_options' );
}


/**
 * Disable WP Core Auto Updates
 *
 * @since 1.0.0
 * -----------------------------------------------------------------------------
 * -----------------------------------------------------------------------------
 */

if ( ! empty( get_option( 'kit-core-options' ) ) && get_option( 'kit-core-options' ) == '1' ) {
	define( 'WP_AUTO_UPDATE_CORE', false );
}


/**
 * Disable WP Theme Auto Updates
 *
 * @since 1.0.0
 * -----------------------------------------------------------------------------
 * -----------------------------------------------------------------------------
 */

if ( ! empty( get_option( 'kit-theme-updates' ) ) && get_option( 'kit-theme-updates' ) == '1' ) {
	add_filter( 'auto_update_plugin', '__return_false' );
}

/**
 * Disable WP Plugins Auto Updates
 *
 * @since 1.0.0
 * -----------------------------------------------------------------------------
 * -----------------------------------------------------------------------------
 */

if ( ! empty( get_option( 'kit-plugin-updated' ) ) && get_option( 'kit-plugin-updated' ) == '1' ) {
	add_filter( 'auto_update_plugin', '__return_false' );
}



/**
 * Disable Theme Editors
 *
 * @since 1.0.0
 * -----------------------------------------------------------------------------
 * -----------------------------------------------------------------------------
 */

if ( ! empty( get_option( 'kit-file-editor' ) ) && get_option( 'kit-file-editor' ) == '1' ) {

	define( 'DISALLOW_FILE_EDIT', true );

}

/**
 * Configure WordPress config.php
 *
 * @since 1.0.0
 * -----------------------------------------------------------------------------
 * -----------------------------------------------------------------------------
 */


if ( file_exists( ABSPATH . 'wp-config.php' ) && is_writable( ABSPATH . 'wp-config.php' ) ) {

	$config_transformer = new WPConfigTransformer( ABSPATH . 'wp-config.php' );

	// Modify WP_CRON
	if ( get_option( 'kit-wp-cron' ) == '1' ) {
		if ( $config_transformer->exists( 'constant', 'DISABLE_WP_CRON' ) ) {
			$config_transformer->update( 'constant', 'DISABLE_WP_CRON', 'true', array( 'raw' => true, 'normalize' => true ) );
		} else {
			$config_transformer->add( 'constant', 'DISABLE_WP_CRON', 'true', array( 'raw' => true, 'normalize' => true ) );
		}
	}

	if ( get_option( 'kit-wp-cron' ) == '0' ) {
		if ( $config_transformer->exists( 'constant', 'DISABLE_WP_CRON' ) ) {
			$config_transformer->update( 'constant', 'DISABLE_WP_CRON', 'false', array( 'raw' => true, 'normalize' => true ) );
		}
	}

	// Modify WP_CACHE
	if ( get_option( 'kit-wp-cache' ) == '1' ) {
		$config_transformer->update( 'constant', 'WP_CACHE', 'true', array( 'raw' => true, 'normalize' => true ) );
	} else {
		if ( $config_transformer->exists( 'constant', 'WP_CACHE' ) ) {
			$config_transformer->update( 'constant', 'WP_CACHE', 'false', array( 'raw' => true, 'normalize' => true ) );
		}
	}

	// Modify CONCATENATE_SCRIPTS
	if ( get_option( 'kit-wp-concatenate' ) == '1' ) {
		$config_transformer->update( 'constant', 'CONCATENATE_SCRIPTS', 'true', array( 'raw' => true, 'normalize' => true ) );
	} else {
		if ( $config_transformer->exists( 'constant', 'CONCATENATE_SCRIPTS' ) ) {
			$config_transformer->update( 'constant', 'CONCATENATE_SCRIPTS', 'false', array( 'raw' => true, 'normalize' => true ) );
		}
	}

	// Modify COMPRESS_CSS
	if ( get_option( 'kit-wp-compress-css' ) == '1' ) {
		$config_transformer->update( 'constant', 'COMPRESS_CSS', 'true', array( 'raw' => true, 'normalize' => true ) );
	} else {
		if ( $config_transformer->exists( 'constant', 'COMPRESS_CSS' ) ) {
			$config_transformer->update( 'constant', 'COMPRESS_CSS', 'false', array( 'raw' => true, 'normalize' => true ) );
		}
	}

	// Modify COMPRESS_SCRIPTS
	if ( get_option( 'wordpress-compress-scripts' ) == '1' ) {
		$config_transformer->update( 'constant', 'COMPRESS_SCRIPTS', 'true', array( 'raw' => true, 'normalize' => true ) );
	} else {
		if ( $config_transformer->exists( 'constant', 'COMPRESS_SCRIPTS' ) ) {
			$config_transformer->update( 'constant', 'COMPRESS_SCRIPTS', 'false', array( 'raw' => true, 'normalize' => true ) );
		}
	}

	// Modify ENFORCE_GZIP
	if ( get_option( 'kit-wp-gzip' ) == '1' ) {
		$config_transformer->update( 'constant', 'ENFORCE_GZIP', 'true', array( 'raw' => true, 'normalize' => true ) );
	} else {
		if ( $config_transformer->exists( 'constant', 'ENFORCE_GZIP' ) ) {
			$config_transformer->update( 'constant', 'ENFORCE_GZIP', 'false', array( 'raw' => true, 'normalize' => true ) );
		}
	}
}
