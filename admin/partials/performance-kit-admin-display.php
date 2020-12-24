<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://pressx.co
 * @since      1.0.0
 *
 * @package    Performance_Kit
 * @subpackage Performance_Kit/admin/partials
 */


$default_tab = null;
$tab_data    = filter_input( INPUT_GET, 'tab', FILTER_SANITIZE_SPECIAL_CHARS );
$current_tab = ( isset( $tab_data ) ) ? $tab_data : null;
$tab         = isset( $current_tab ) ? $current_tab : $default_tab;

?>

<div id="performance-kit" class="wrap">

	<div class="kit-title">

		<svg class="logo" width="25" height="29" viewBox="0 0 25 29" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M14.1287 0H2.5431C1.86863 0 1.22177 0.268828 0.744856 0.747344C0.267932 1.22586 0 1.87487 0 2.55159V25.0757C0 25.7525 0.267932 26.4014 0.744856 26.8799C1.22177 27.3585 1.86863 27.6273 2.5431 27.6273C3.9063 27.6271 5.23213 27.1801 6.31906 26.3547C7.406 25.5292 8.1946 24.3703 8.565 23.054L10.483 16.225C10.498 16.1711 10.5003 16.1144 10.4898 16.0592C10.4793 16.0042 10.4562 15.9524 10.4223 15.908C10.3884 15.8633 10.3447 15.8273 10.2946 15.8026C10.2445 15.7778 10.1894 15.765 10.1336 15.7654H5.2648C5.20418 15.7661 5.14437 15.7515 5.09086 15.7229C5.03735 15.6943 4.99186 15.6527 4.95859 15.6019C4.92533 15.5511 4.90536 15.4926 4.90051 15.4321C4.89568 15.3714 4.90612 15.3106 4.93089 15.2551L9.41529 4.94347C9.4432 4.87885 9.4893 4.82381 9.5479 4.78506C9.60651 4.74632 9.67512 4.72556 9.7453 4.72531H15.3051C15.3655 4.72524 15.4248 4.74031 15.4777 4.76914C15.5307 4.79798 15.5757 4.83967 15.6086 4.89041C15.6413 4.94114 15.661 4.99931 15.6656 5.05961C15.6702 5.11992 15.6599 5.18043 15.6352 5.23564L12.9485 11.4179C12.9238 11.4731 12.9133 11.5336 12.918 11.5939C12.9226 11.6542 12.9423 11.7124 12.9751 11.7631C13.0079 11.8139 13.0529 11.8555 13.1058 11.8844C13.1588 11.9132 13.2182 11.9283 13.2785 11.9282H18.3492C18.4204 11.9278 18.4901 11.9486 18.5495 11.9879C18.609 12.0272 18.6556 12.0833 18.6835 12.1491C18.7113 12.2149 18.719 12.2875 18.7058 12.3577C18.6926 12.4279 18.659 12.4926 18.6093 12.5438L10.8713 20.5802C10.7713 20.6839 10.7042 20.8151 10.6786 20.9569C10.653 21.0989 10.6699 21.2453 10.7273 21.3776C10.7847 21.5098 10.8799 21.622 11.001 21.6999C11.122 21.7779 11.2633 21.8179 11.407 21.8152H14.1249C17.0081 21.8152 19.7732 20.666 21.812 18.6203C23.8507 16.5748 24.9961 13.8004 24.9961 10.9076C24.9961 8.01538 23.8513 5.24158 21.8133 3.19613C19.7755 1.15068 17.0113 0.00103293 14.1287 0Z" fill="url(#paint0_linear)" />
			<defs>
			<linearGradient id="paint0_linear" x1="1.25796" y1="20.4205" x2="20.023" y2="0.455901" gradientUnits="userSpaceOnUse">
				<stop stop-color="#03E8E8" />
				<stop offset="1" stop-color="#32EEA3" />
			</linearGradient>
			</defs>
		</svg>

		<a class="plugin-name" href="<?php echo esc_url( 'admin.php?page=performance-kit' ); ?>"><?php esc_html_e( 'Performance Kit' ); ?></a>

		<a target="_blank" href="<?php echo esc_url( 'https://wordpress.org/support/plugin/performance-kit/' ); ?>">
			<span class="version"><?php echo 'v' . esc_html( $this->version ); ?></span>
		</a>

		<div class="title-nav">

			<a class=" <?php echo ( 'import' === $tab ) ? 'active' : ''; ?>" href="<?php echo esc_url( '?page=performance-kit&tab=import' ); ?>">
				<svg width="15" height="15" viewBox="0 0 15 15">
					<path d="M1.90321 7.29677C1.90321 10.341 4.11041 12.4147 6.58893 12.8439C6.87255 12.893 7.06266 13.1627 7.01355 13.4464C6.96444 13.73 6.69471 13.9201 6.41109 13.871C3.49942 13.3668 0.86084 10.9127 0.86084 7.29677C0.860839 5.76009 1.55996 4.55245 2.37639 3.63377C2.96124 2.97568 3.63034 2.44135 4.16846 2.03202L2.53205 2.03202C2.25591 2.03202 2.03205 1.80816 2.03205 1.53202C2.03205 1.25588 2.25591 1.03202 2.53205 1.03202L5.53205 1.03202C5.80819 1.03202 6.03205 1.25588 6.03205 1.53202L6.03205 4.53202C6.03205 4.80816 5.80819 5.03202 5.53205 5.03202C5.25591 5.03202 5.03205 4.80816 5.03205 4.53202L5.03205 2.68645L5.03054 2.68759L5.03045 2.68766L5.03044 2.68767L5.03043 2.68767C4.45896 3.11868 3.76059 3.64538 3.15554 4.3262C2.44102 5.13021 1.90321 6.10154 1.90321 7.29677ZM13.0109 7.70321C13.0109 4.69115 10.8505 2.6296 8.40384 2.17029C8.12093 2.11718 7.93465 1.84479 7.98776 1.56188C8.04087 1.27898 8.31326 1.0927 8.59616 1.14581C11.4704 1.68541 14.0532 4.12605 14.0532 7.70321C14.0532 9.23988 13.3541 10.4475 12.5377 11.3662C11.9528 12.0243 11.2837 12.5586 10.7456 12.968L12.3821 12.968C12.6582 12.968 12.8821 13.1918 12.8821 13.468C12.8821 13.7441 12.6582 13.968 12.3821 13.968L9.38205 13.968C9.10591 13.968 8.88205 13.7441 8.88205 13.468L8.88205 10.468C8.88205 10.1918 9.10591 9.96796 9.38205 9.96796C9.65819 9.96796 9.88205 10.1918 9.88205 10.468L9.88205 12.3135L9.88362 12.3123C10.4551 11.8813 11.1535 11.3546 11.7585 10.6738C12.4731 9.86976 13.0109 8.89844 13.0109 7.70321Z" fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"></path>
				</svg>
				<span><?php esc_html_e( 'Import / Export', 'performance-kit' ); ?></span>
			</a>

			<a href="<?php echo esc_url( 'mailto:info@pressx.co' ); ?>">
				<svg width="15" height="15" viewBox="0 0 15 15">
					<path d="M1 2C0.447715 2 0 2.44772 0 3V12C0 12.5523 0.447715 13 1 13H14C14.5523 13 15 12.5523 15 12V3C15 2.44772 14.5523 2 14 2H1ZM1 3L14 3V3.92494C13.9174 3.92486 13.8338 3.94751 13.7589 3.99505L7.5 7.96703L1.24112 3.99505C1.16621 3.94751 1.0826 3.92486 1 3.92494V3ZM1 4.90797V12H14V4.90797L7.74112 8.87995C7.59394 8.97335 7.40606 8.97335 7.25888 8.87995L1 4.90797Z"
					fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"></path>
				</svg>
				<span><?php esc_html_e( 'Support', 'performance-kit' ); ?></span>
			</a>
		
		</div>
	</div>

	<div class="kit_wrapper">

		<nav class="nav-tab-wrapper">

			<a href="<?php echo esc_url( '?page=performance-kit' ); ?>" class="nav-tab <?php echo ( null === $tab ) ? 'nav-tab-active' : ''; ?>">
				<?php esc_html_e( 'Core', 'performance-kit' ); ?>
			</a>

			<a href="<?php echo esc_url( '?page=performance-kit&tab=woocommerce' ); ?>" class="nav-tab <?php echo ( 'woocommerce' === $tab ) ? 'nav-tab-active' : ''; ?>">
				<?php esc_html_e( 'WooCommerce', 'performance-kit' ); ?>
			</a>

			<a href="<?php echo esc_url( '?page=performance-kit&tab=cdn' ); ?>" class="nav-tab <?php echo ( 'cdn' === $tab ) ? 'nav-tab-active' : ''; ?>">
				<?php esc_html_e( 'CDN', 'performance-kit' ); ?>
			</a>

			<a href="<?php echo esc_url( '?page=performance-kit&tab=analytics' ); ?>" class="nav-tab <?php echo ( 'analytics' === $tab ) ? 'nav-tab-active' : ''; ?>">
				<?php esc_html_e( 'Analytics', 'performance-kit' ); ?>
			</a>

			<a href="<?php echo esc_url( '?page=performance-kit&tab=misc' ); ?>" class="nav-tab <?php echo ( 'misc' === $tab ) ? 'nav-tab-active' : ''; ?>">
				<?php esc_html_e( 'Extras', 'performance-kit' ); ?>
			</a>

		</nav>

		<?php settings_errors(); ?>

		<!-- For admin notices -->
		<h2></h2>
		<!-- End admin notices -->

		<?php
		switch ( $tab ) :
			case 'woocommerce':
				include plugin_dir_path( PERFORMANCE_KIT_FILE ) . 'admin/fields/woocommerce.php';
				break;
			case 'cdn':
				include plugin_dir_path( PERFORMANCE_KIT_FILE ) . 'admin/fields/cdn.php';
				break;
			case 'analytics':
				include plugin_dir_path( PERFORMANCE_KIT_FILE ) . 'admin/fields/analytics.php';
				break;
			case 'misc':
				include plugin_dir_path( PERFORMANCE_KIT_FILE ) . 'admin/fields/misc.php';
				break;
			case 'import':
				include plugin_dir_path( PERFORMANCE_KIT_FILE ) . 'admin/fields/import.php';
				break;
			default:
				include plugin_dir_path( PERFORMANCE_KIT_FILE ) . 'admin/fields/wordpress.php';
				break;
		endswitch;
		?>

	</div>



</div>
