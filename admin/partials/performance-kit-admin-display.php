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
	<svg class="logo" width="25" height="29" viewBox="0 0 25 29" fill="none" xmlns="http://www.w3.org/2000/svg">
	  <path
		d="M14.1287 0H2.5431C1.86863 0 1.22177 0.268828 0.744856 0.747344C0.267932 1.22586 0 1.87487 0 2.55159V25.0757C0 25.7525 0.267932 26.4014 0.744856 26.8799C1.22177 27.3585 1.86863 27.6273 2.5431 27.6273C3.9063 27.6271 5.23213 27.1801 6.31906 26.3547C7.406 25.5292 8.1946 24.3703 8.565 23.054L10.483 16.225C10.498 16.1711 10.5003 16.1144 10.4898 16.0592C10.4793 16.0042 10.4562 15.9524 10.4223 15.908C10.3884 15.8633 10.3447 15.8273 10.2946 15.8026C10.2445 15.7778 10.1894 15.765 10.1336 15.7654H5.2648C5.20418 15.7661 5.14437 15.7515 5.09086 15.7229C5.03735 15.6943 4.99186 15.6527 4.95859 15.6019C4.92533 15.5511 4.90536 15.4926 4.90051 15.4321C4.89568 15.3714 4.90612 15.3106 4.93089 15.2551L9.41529 4.94347C9.4432 4.87885 9.4893 4.82381 9.5479 4.78506C9.60651 4.74632 9.67512 4.72556 9.7453 4.72531H15.3051C15.3655 4.72524 15.4248 4.74031 15.4777 4.76914C15.5307 4.79798 15.5757 4.83967 15.6086 4.89041C15.6413 4.94114 15.661 4.99931 15.6656 5.05961C15.6702 5.11992 15.6599 5.18043 15.6352 5.23564L12.9485 11.4179C12.9238 11.4731 12.9133 11.5336 12.918 11.5939C12.9226 11.6542 12.9423 11.7124 12.9751 11.7631C13.0079 11.8139 13.0529 11.8555 13.1058 11.8844C13.1588 11.9132 13.2182 11.9283 13.2785 11.9282H18.3492C18.4204 11.9278 18.4901 11.9486 18.5495 11.9879C18.609 12.0272 18.6556 12.0833 18.6835 12.1491C18.7113 12.2149 18.719 12.2875 18.7058 12.3577C18.6926 12.4279 18.659 12.4926 18.6093 12.5438L10.8713 20.5802C10.7713 20.6839 10.7042 20.8151 10.6786 20.9569C10.653 21.0989 10.6699 21.2453 10.7273 21.3776C10.7847 21.5098 10.8799 21.622 11.001 21.6999C11.122 21.7779 11.2633 21.8179 11.407 21.8152H14.1249C17.0081 21.8152 19.7732 20.666 21.812 18.6203C23.8507 16.5748 24.9961 13.8004 24.9961 10.9076C24.9961 8.01538 23.8513 5.24158 21.8133 3.19613C19.7755 1.15068 17.0113 0.00103293 14.1287 0Z"
		fill="url(#paint0_linear)" />
	  <defs>
		<linearGradient id="paint0_linear" x1="1.25796" y1="20.4205" x2="20.023" y2="0.455901"
		  gradientUnits="userSpaceOnUse">
		  <stop stop-color="#03E8E8" />
		  <stop offset="1" stop-color="#32EEA3" />
		</linearGradient>
	  </defs>
	</svg>
	<?php echo $this->display_plugin_name(); ?>
	<a href="/">
	  <span class="version"><?php echo 'v' . $this->version; ?></span>
	</a>
	<div class="title-nav">
	  <a href="/">
		<svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
		  <path
			d="M3 2.5C3 2.22386 3.22386 2 3.5 2H9.08579C9.21839 2 9.34557 2.05268 9.43934 2.14645L11.8536 4.56066C11.9473 4.65443 12 4.78161 12 4.91421V12.5C12 12.7761 11.7761 13 11.5 13H3.5C3.22386 13 3 12.7761 3 12.5V2.5ZM3.5 1C2.67157 1 2 1.67157 2 2.5V12.5C2 13.3284 2.67157 14 3.5 14H11.5C12.3284 14 13 13.3284 13 12.5V4.91421C13 4.51639 12.842 4.13486 12.5607 3.85355L10.1464 1.43934C9.86514 1.15804 9.48361 1 9.08579 1H3.5ZM4.5 4C4.22386 4 4 4.22386 4 4.5C4 4.77614 4.22386 5 4.5 5H7.5C7.77614 5 8 4.77614 8 4.5C8 4.22386 7.77614 4 7.5 4H4.5ZM4.5 7C4.22386 7 4 7.22386 4 7.5C4 7.77614 4.22386 8 4.5 8H10.5C10.7761 8 11 7.77614 11 7.5C11 7.22386 10.7761 7 10.5 7H4.5ZM4.5 10C4.22386 10 4 10.2239 4 10.5C4 10.7761 4.22386 11 4.5 11H10.5C10.7761 11 11 10.7761 11 10.5C11 10.2239 10.7761 10 10.5 10H4.5Z"
			fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"></path>
		</svg>
		<span><?php echo __( 'Documentation', 'performance-kit' ); ?></span>
	  </a>
	  <a href="/">
		<svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
		  <path
			d="M1 2C0.447715 2 0 2.44772 0 3V12C0 12.5523 0.447715 13 1 13H14C14.5523 13 15 12.5523 15 12V3C15 2.44772 14.5523 2 14 2H1ZM1 3L14 3V3.92494C13.9174 3.92486 13.8338 3.94751 13.7589 3.99505L7.5 7.96703L1.24112 3.99505C1.16621 3.94751 1.0826 3.92486 1 3.92494V3ZM1 4.90797V12H14V4.90797L7.74112 8.87995C7.59394 8.97335 7.40606 8.97335 7.25888 8.87995L1 4.90797Z"
			fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"></path>
		</svg>
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


	  <a href="?page=performance-kit&tab=woocommerce" class="nav-tab 
	  <?php
		if ( $tab === 'woocommerce' ) :
			?>
 nav-tab-active
																									<?php
	  endif;
		?>
	  ">
		WooCommerce
	  </a>
	  <a href="?page=performance-kit&tab=cdn" class="nav-tab 
	  <?php
		if ( $tab === 'cdn' ) :
			?>
 nav-tab-active
																					<?php
	endif;
		?>
	">
		CDN
	  </a>
	  <a href="?page=performance-kit&tab=analytics" class="nav-tab 
	  <?php
		if ( $tab === 'analytics' ) :
			?>
 nav-tab-active
																								<?php
	  endif;
		?>
	  ">
		Analytics
	  </a>
	  <a href="?page=performance-kit&tab=misc" class="nav-tab 
	  <?php
		if ( $tab === 'misc' ) :
			?>
 nav-tab-active
																					  <?php
	endif;
		?>
	">
		Extras
	  </a>
	</nav>

	<h2></h2>

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

  <?php //$this->setting_export(); ?>


</div>
