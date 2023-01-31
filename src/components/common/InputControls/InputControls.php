<?php
/*
 * Author:  Fedor Nikonov (fritylo)
 * Date:    2023-01-09, 8:28:27 PM
 * Company: frity.org
 */
?>

<?php
class InputControls {
	public static function Start(
		$placeholder,
		$type = 'text',
		$name = '',
		$value = '',
		$attributes = []
	) { ?>
		<?php 
			attributes_extract($attributes, 'class', $class);
			attributes($attributes);
		?>

		<div class="input-controls <?= $class ?>" <?= $attributes ?>>
			<input
				class="input-controls__input"
				placeholder="<?= $placeholder ?>"
				type="<?= $type ?>"
				name="<?= $name ?>"
				value="<?= $value ?>"
			/>
			<div class="input-controls__controls">
	<?php }

	public static function End() { ?>
			</div>
		</div>
	<?php }
}
