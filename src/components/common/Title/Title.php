<?php
/*
 * Author:  Fedor Nikonov (fritylo)
 * Date:    2023-01-09, 8:26:56 PM
 * Company: frity.org
 */
?>

<?php
function Title(
	$text,
	$attributes = []
) { ?>
	<?php 
		attributes_extract($attributes, 'class', $class);
		attributes($attributes);
	?>

	<center class="title ff-ars-b <?= $class ?>" <?= $attributes ?>>
		<?= $text ?>
	</center>
<?php } ?>
