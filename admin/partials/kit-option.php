<?php
/**
 * Provide a input view for the options
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://pressx.co
 * @since      1.0.0
 *
 * @package    Performance_Kit
 * @subpackage Performance_Kit/admin/partials
 */
?>

<div class="kit-option">

  <label for="<?php echo $key['function']; ?>">

	<div class="option-title">
	  <span><?php echo $key['title']; ?></span>
	  <div class="option-tooltip">
		<span class="tooltip">?</span>
		<span class="tooltip-text">
		  <?php echo $key['description']; ?>
		</span>
	  </div>
	</div>

	<?php 
	// Check the input types
	if ( $key['type'] == 'checkbox' ) : ?>
	<div class="switch">
	  <input 
		type="checkbox" 
		class="kit_option" 
		id="<?php echo $key['function']; ?>"
		name="<?php echo $key['function']; ?>"
		value="<?php if ( get_option( $key['function'] ) === '1' ) { echo '1'; } else { echo '0';} ?>" <?php if ( get_option( $key['function'] ) === '1' ) { echo 'checked';} ?> />
	  <span class="slider round"></span>
	</div>

	<?php 
	// Condition for select boxes
	elseif ( $key['type'] == 'select' ) : ?>
	<div class="select">
	  <select class="custom" name="<?php echo $key['function']; ?>">
		<?php foreach ( $key['options'] as $option => $value ) : ?>
		<option value="<?php echo $value; ?>" <?php if ( get_option( $key['function'] ) === $value ) { echo 'selected';} ?>>
			<?php echo $option; ?>
		</option>
		<?php endforeach; ?>
	  </select>
	</div>

	<?php 
	// Condition for number inputs
	elseif ( $key['type'] == 'inputnumber' ) : ?>
	<div class="select">
	  <input 
	  type="number" 
	  class="kit_option" 
	  id="<?php echo $key['function']; ?>"
	  name="<?php echo $key['function']; ?>" 
	  value="" 
	  placeholder="<?php if ( $key['placeholder'] ) { echo $key['placeholder']; } ?>"
	  />
	</div>

	<?php 
	// Condition for text inpurts
	elseif ( $key['type'] == 'inputtext' ) : ?>
	<div class="select">
	  <input 
		type="text" 
		class="kit_option" 
		id="<?php echo $key['function']; ?>" 
		name="<?php echo $key['function']; ?>"
		value="<?php if ( ! empty( get_option( $key['function'] ) ) ) { echo get_option( $key['function'] ); }; ?>" 
		placeholder="<?php if ( $key['placeholder'] ) { echo $key['placeholder']; } ?>" />
	</div>

	<?php endif; ?>

  </label>

</div>
