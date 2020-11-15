  <?php

  $kit_woocommerce = false;
  if ( class_exists( 'WooCommerce' ) ) {
    $kit_woocommerce = true;
  } else {
    $kit_woocommerce = false;
  }
  ?>
  <div class="kit-option">
    <div class="option-title">
      <span><?php echo __( 'WooCommerce Status', 'performance-kit' ); ?></span>
    </div>

    <div class="option-text">
      <?php if ( $kit_woocommerce == false ) : ?>
      <span class="text red"><?php echo __( '&#9675; Not Active', 'performance-kit' ); ?> </span>
      <?php else : ?>
      <span class="text green"><?php echo __( '&#9679; Active', 'performance-kit' ); ?> </span>
      <?php endif; ?>
    </div>

    <?php if ( $kit_woocommerce == false ) : ?>
    <div class="notification woocommerce">
      <?php
      echo file_get_contents( plugin_dir_path( PERFORMANCE_KIT_FILE ) . '/admin/assets/icons/alert.svg' );
      echo __( 'In order to manage WooCommerce options, you will need WooCommerce plugin installed and activated.', 'performance-kit' );
      ?>
    </div>
    <?php else : ?>
    <div class="notification woocommerce green">
      <?php
      echo file_get_contents( plugin_dir_path( PERFORMANCE_KIT_FILE ) . '/admin/assets/icons/check.svg' );
      echo __( 'WooCommerce is installed and activated.', 'performance-kit' );
      ?>
    </div>
    <?php endif; ?>
</div>