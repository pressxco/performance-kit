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
$_GET   = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

if(isset($_GET['tab'])) {
	$tab_data = htmlspecialchars($_GET['tab']);
}

$tab = isset( $tab_data ) ? $tab_data : $default_tab;

settings_errors();
?>

<div id="performance-kit" class="wrap">

  <div class="kit-title">
		<?php 
		// Display Branding
		echo file_get_contents( plugin_dir_path( PERFORMANCE_KIT_FILE ) . '/admin/assets/icons/logo.svg');
		echo $this->display_plugin_name(); 
		?>
		<a target="_blank" href="<?php echo esc_url('https://wordpress.org/support/plugin/performance-kit/'); ?>">
			<span class="version"><?php echo 'v' . $this->version; ?></span>
		</a>
		<div class="title-nav">
			<a class="<?php if ( $tab === 'import' ) :?>active<?php endif;?>" 
			href="<?php echo esc_url('?page=performance-kit&tab=import'); ?>">
				<?php echo file_get_contents( plugin_dir_path( PERFORMANCE_KIT_FILE ) . '/admin/assets/icons/restore.svg'); ?>
				<span><?php esc_html_e( 'Import / Export', 'performance-kit' ); ?></span>
			</a>
			<a href="<?php echo esc_url('mailto:info@pressx.co'); ?>">
				<?php echo file_get_contents( plugin_dir_path( PERFORMANCE_KIT_FILE ) . '/admin/assets/icons/support.svg'); ?>
				<span><?php esc_html_e( 'Support', 'performance-kit' ); ?></span>
			</a>
		</div>
  </div>

  <div class="kit_wrapper">

		<nav class="nav-tab-wrapper">
		
			<a href="<?php echo esc_url('?page=performance-kit'); ?>" 
			class="nav-tab <?php if ( $tab === null ) :?> nav-tab-active <?php endif;?>">
			<?php esc_html_e('Core', 'performance-kit'); ?>
			</a>

			<a href="<?php echo esc_url('?page=performance-kit&tab=woocommerce'); ?>" 
			class="nav-tab <?php if ( $tab === 'woocommerce' ) :?> nav-tab-active <?php endif;?>">
			<?php esc_html_e('WooCommerce', 'performance-kit'); ?>
			</a>

			<a href="<?php echo esc_url('?page=performance-kit&tab=cdn'); ?>" 
			class="nav-tab <?php if ( $tab === 'cdn' ) :?> nav-tab-active <?php endif;?>">
			<?php esc_html_e('CDN', 'performance-kit'); ?>
			</a>

			<a href="<?php echo esc_url('?page=performance-kit&tab=analytics'); ?>" 
			class="nav-tab <?php if ( $tab === 'analytics' ) :?> nav-tab-active <?php endif;?>">
			<?php esc_html_e('Analytics', 'performance-kit'); ?>
			</a>

			<a href="<?php echo esc_url('?page=performance-kit&tab=misc'); ?>" 
			class="nav-tab <?php if ( $tab === 'misc' ) :?> nav-tab-active <?php endif;?>">
			<?php esc_html_e('Extras', 'performance-kit'); ?>
			</a>

		</nav>

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
