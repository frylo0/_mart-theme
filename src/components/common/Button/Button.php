<?php
/*
 * Author:  Fedor Nikonov (fritylo)
 * Date:    2022-11-21, 10:45:49 PM
 * Company: frity corp.
 */
?>

<?php

class Button {
	public static function Start(
		$attributes = []
	) { ?>
		<?php 
			attributes_extract($attributes, 'class', $class);
			attributes($attributes);
		?>

		<button class="button rel cup <?= $class ?>" <?= $attributes ?>>
			<div class="button__inflation button__inflation_1 abs"></div>
			<div class="button__inflation button__inflation_2 abs"></div>
			<div class="button__inflation button__inflation_3 abs"></div>
			<div class="button__inflation button__inflation_4 abs"></div>
			<div class="button__inflation button__inflation_5 abs"></div>
			<div class="button__inflation button__inflation_6 abs"></div>
	<?php }

	public static function End() { ?>
		</button>
	<?php }
}
