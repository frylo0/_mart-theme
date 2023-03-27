<?php
/*
 * Author:  Fedor Nikonov (fritylo)
 * Date:    2023-03-26, 6:22:07 PM
 * Company: frity.org
 */
?>

<?php
function BlogBlock ($attributes = []) { return function (
	WP_Term $theme,
) use ($attributes) { ?>
	<?php 
		attributes_extract($attributes, 'class', $class);
		attributes($attributes);

		$link = get_term_link($theme);
		$image_object = get_field('thumbnail', $theme);
		$image = $image_object ? $image_object['url'] : '';
		$title = $theme->name;
		$button_text = 'Подробнее';
	?>

	<a href="<?= $link ?>" class="blog-block rel db <?= $class ?>" <?= $attributes ?> style="
		background: linear-gradient(#f6d3ce1c, #f6d3ce7c), url('<?= $image ?>') center/cover no-repeat;
	">
		<div class="blog-block__title abs ct-abs ff-ars-b">
			<?= $title ?>
		</div>
		<div class="blog-block__button abs ct-abs_horiz row jcc aic cup">
			<?= $button_text ?>
		</div>
    </a>
<?php }; } ?>
