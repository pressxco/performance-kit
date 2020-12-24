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

	<label for="<?php echo esc_attr( $key['function'] ); ?>">

		<div class="option-title">
			<span><?php echo esc_html( $key['title'] ); ?></span>
			<div class="option-tooltip">
			<span class="tooltip"><?php echo esc_html( '?' ); ?></span>
			<span class="tooltip-text">
				<?php echo esc_html( $key['description'] ); ?>
			</span>
			</div>
		</div>

	<?php if ( 'checkbox' === $key['type'] ) : ?>

		<?php
		$input_value = ( get_option( $key['function'] ) === '1' ) ? '1' : '0';
		$input_state = ( get_option( $key['function'] ) === '1' ) ? 'checked' : '';
		?>

		<div class="switch">
			<input 
			type="checkbox" 
			class="kit_option" 
			id="<?php echo esc_attr( $key['function'] ); ?>" 
			name="<?php echo esc_attr( $key['function'] ); ?>" 
			value="<?php echo esc_attr( $input_value ); ?>" 
			<?php echo esc_attr( $input_state ); ?> />
			<span class="slider round"></span>
		</div>


	<?php elseif ( 'select' === $key['type'] ) : ?>

		<div class="select">
			<select class="custom" name="<?php echo esc_attr( $key['function'] ); ?>">
			<?php foreach ( $key['options'] as $option => $value ) : ?>
				<?php $select_state = ( get_option( $key['function'] ) === $value ) ? 'selected' : ''; ?>
			<option value="<?php echo esc_attr( $value ); ?>" <?php echo esc_attr( $select_state ); ?>>
				<?php echo esc_html( $option ); ?>
			</option>
			<?php endforeach; ?>
			</select>
		</div>

	<?php elseif ( 'inputnumber' === $key['type'] ) : ?>
		<?php $placeholder = ( $key['placeholder'] ) ? $key['placeholder'] : ''; ?>
		<div class="select">
			<input 
			type="number" 
			class="kit_option" 
			id="<?php echo esc_attr( $key['function'] ); ?>"
			name="<?php echo esc_attr( $key['function'] ); ?>" 
			value="" 
			placeholder="<?php echo esc_html( $placeholder ); ?>"
			/>
		</div>

	<?php elseif ( 'inputtext' === $key['type'] ) : ?>

		<?php
		$input_value = ( ! empty( get_option( $key['function'] ) ) ) ? get_option( $key['function'] ) : '';
		$placeholder = ( $key['placeholder'] ) ? $key['placeholder'] : '';
		?>

		<div class="select">
			<input 
			type="text" 
			class="kit_option" 
			id="<?php echo esc_attr( $key['function'] ); ?>" 
			name="<?php echo esc_attr( $key['function'] ); ?>"
			value="<?php echo esc_attr( $input_value ); ?>" 
			placeholder="<?php echo esc_attr( $placeholder ); ?>" />
		</div>

		<?php endif; ?>

	</label>

</div>
