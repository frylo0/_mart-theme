<?php
/*
 * Author:  Fedor Nikonov (fritylo)
 * Date:    2023-01-09, 8:26:27 PM
 * Company: frity.org
 */
?>

<?php
function _Link(
	$text,
	$href,
	$attributes = []
) { ?>
	<?php 
		attributes_extract($attributes, 'class', $class);
		attributes($attributes);
	?>

	<a href="<?= $href ?>" class="link dib shadow_link <?= $class ?>" <?= $attributes ?>><?= $text ?></a>
<?php } ?>
