<?php
/*
 * Author:  Fedor Nikonov (fritylo)
 * Date:    2023-01-09, 8:26:49 PM
 * Company: frity.org
 */
?>

<?php

class Devicer {
	public static function Start(
		$attributes = []
	) { ?>
		<?php 
			attributes_extract($attributes, 'class', $class);
			attributes($attributes);
		?>

		<div class="devicer mA <?= $class ?>" <?= $attributes ?>>
	<?php }

	public static function End() { ?>
		</div>
	<?php }
}
