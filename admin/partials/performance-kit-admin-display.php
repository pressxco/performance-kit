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
$tab = isset( $_GET['tab'] ) ? $_GET['tab'] : $default_tab;

settings_errors();
?>

<div id="performance-kit" class="wrap">

  <div class="kit-title">
		<?php 
		// Display Branding
		echo file_get_contents( plugin_dir_path( PERFORMANCE_KIT_FILE ) . '/admin/assets/icons/logo.svg');
		echo $this->display_plugin_name(); 
		?>
		<a href="/">
			<span class="version"><?php echo 'v' . $this->version; ?></span>
		</a>
		<div class="title-nav">
			<a href="/">
				<?php echo file_get_contents( plugin_dir_path( PERFORMANCE_KIT_FILE ) . '/admin/assets/icons/docs.svg'); ?>
				<span><?php echo __( 'Documentation', 'performance-kit' ); ?></span>
			</a>
			<a href="/">
				<?php echo file_get_contents( plugin_dir_path( PERFORMANCE_KIT_FILE ) . '/admin/assets/icons/support.svg'); ?>
				<span><?php echo __( 'Support', 'performance-kit' ); ?></span>
			</a>
		</div>
  </div>

  <div class="kit_wrapper">

		<nav class="nav-tab-wrapper">
		
			<a href="?page=performance-kit" 
			class="nav-tab <?php if ( $tab === null ) :?> nav-tab-active <?php endif;?>">
			<?php echo __('Core', 'performance-kit'); ?>
			</a>

			<a href="?page=performance-kit&tab=woocommerce" 
			class="nav-tab <?php if ( $tab === 'woocommerce' ) :?> nav-tab-active <?php endif;?>">
			<?php echo __('WooCommerce', 'performance-kit'); ?>
			</a>

			<a href="?page=performance-kit&tab=cdn" 
			class="nav-tab <?php if ( $tab === 'cdn' ) :?> nav-tab-active <?php endif;?>">
			<?php echo __('CDN', 'performance-kit'); ?>
			</a>

			<a href="?page=performance-kit&tab=analytics" 
			class="nav-tab <?php if ( $tab === 'analytics' ) :?> nav-tab-active <?php endif;?>">
			<?php echo __('Analytics', 'performance-kit'); ?>
			</a>

			<a href="?page=performance-kit&tab=misc" 
			class="nav-tab <?php if ( $tab === 'misc' ) :?> nav-tab-active <?php endif;?>">
			<?php echo __('Extras', 'performance-kit'); ?>
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
		default:
			include plugin_dir_path( PERFORMANCE_KIT_FILE ) . 'admin/fields/wordpress.php';
			break;
	  endswitch;
	?>

  </div>


</div>
