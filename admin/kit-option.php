<div class="kit-option">

  <label for="<?php echo $key['function']; ?>">

	<div class="option-title">
	  <span><?php echo $key['title']; ?></span>
	  <div class="option-tooltip">
		<span class="tooltip">
		  ?
		</span>
		<span class="tooltip-text">
		  <?php echo $key['description']; ?>
		</span>
	  </div>
	</div>

	<?php if ( $key['type'] == 'checkbox' ) : ?>
	<div class="switch">
	  <input type="checkbox" class="kit_option" id="<?php echo $key['function']; ?>"
		name="<?php echo $key['function']; ?>"
		value="<?php if ( get_option( $key['function'] ) === '1' ) { echo '1'; } else { echo '0';} ?>" <?php if ( get_option( $key['function'] ) === '1' ) {
			echo 'checked';}?>
		 />
	  <span class="slider round"></span>
	</div>


	<?php elseif ( $key['type'] == 'select' ) : ?>
	<div class="select">
	  <select class="custom" name="<?php echo $key['function']; ?>">
		<?php foreach ( $key['options'] as $option => $value ) : ?>
		<option value="<?php echo $value; ?>" 
								  <?php
									if ( get_option( $key['function'] ) === $value ) {
										echo 'selected';}
									?>
		>
			<?php echo $option; ?>
		</option>
		<?php endforeach; ?>
	  </select>
	</div>

	<?php elseif ( $key['type'] == 'inputnumber' ) : ?>
	<div class="select">
	  <input 
	  type="number" 
	  class="kit_option" 
	  id="<?php echo $key['function']; ?>"
	  name="<?php echo $key['function']; ?>" 
	  value="" 
	  placeholder="
		<?php
		if ( $key['placeholder'] ) {
			echo $key['placeholder']; }
		?>
		 "
	  />
	</div>

	<?php elseif ( $key['type'] == 'inputtext' ) : ?>
	<div class="select">
	  <input type="text" class="kit_option" id="<?php echo $key['function']; ?>" name="<?php echo $key['function']; ?>"
		value="
		<?php
		if ( ! empty( get_option( $key['function'] ) ) ) {
			echo get_option( $key['function'] );
		};
		?>
		" placeholder="
		<?php
		if ( $key['placeholder'] ) {
									echo $key['placeholder'];
		}
		?>
										 " />
	</div>

	<?php endif; ?>

  </label>

</div>
