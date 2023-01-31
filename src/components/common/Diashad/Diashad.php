<?php
/*
 * Author:  Fedor Nikonov (fritylo)
 * Date:    2023-01-09, 8:28:07 PM
 * Company: frity.org
 */
?>

<?php
function Diashad(
	$opacity,
	$marginTop = 0,
	$inverse = false,
	$rotation = 7.1,
	$attributes = []
) { ?>
	<?php 
		attributes_extract($attributes, 'class', $class);
		attributes($attributes);
	?>

	<div class="diashad <?= $class ?>" <?= $attributes ?>>
		<div class="diashad__shadow" style="
			background: linear-gradient(
				<?= $inverse * 180 + (1 + ($inverse * -2)) * $rotation + 90 ?>deg, 
				rgba(246, 211, 206, 0), 
				rgba(246, 211, 206, <?= $opacity / 100 ?>), 
				rgba(246, 211, 206, 0)
			);
			transform: rotate(<?= -$rotation * (1 + $inverse * -2) ?>deg);
			margin-top: <?= $marginTop ?>em;
		"></div>
	</div>
<?php } ?>
