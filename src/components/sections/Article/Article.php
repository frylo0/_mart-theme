<?php
/*
 * Author:  Fedor Nikonov (fritylo)
 * Date:    2023-04-17, 8:31:26 PM
 * Company: frity.org
 */
?>

<?php
function Article ($attributes = []) { return function (
	WP_Post $post,
	string $type,
) use ($attributes) { ?>
	<?php 
		attributes_extract($attributes, 'class', $class);
		attributes($attributes);
	?>

	<div class="article <?= $class ?>" <?= $attributes ?>>
		<?php ProductPreview()($post, 'normal', $type) ?>
		<?php the_content() ?>
		<?php ProductPreview()($post, 'button', $type) ?>
    </div>
<?php }; } ?>
