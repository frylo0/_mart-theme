<?php
/*
 * Author:  Fedor Nikonov (fritylo)
 * Date:    2023-04-20, 11:14:28 PM
 * Company: frity.org
 */
?>

<?php
function BlogThemePreview ($attributes = []) { return function (
	WP_Term $theme,
) use ($attributes) { ?>
	<?php 
		attributes_extract($attributes, 'class', $class);
		attributes($attributes);

		$image_object = get_field('thumbnail', $theme);
		
		$image = $image_object ? $image_object['url'] : '';
		$title = $theme->name;
		$description = term_description($theme->term_id);
	?>

	<div class="blog-theme-preview row <?= $class ?>" <?= $attributes ?>>
		<div class="btp__image" style="
			background-image: url('<?= $image ?>');
		"></div>

		<div class="btp__content">
			<div class="btp__decor-title ff-ars-b usn">
				БЛОГ
			</div>
			<div class="btp__title ff-ars-b">
				<?= $title ?>
			</div>
			<div class="btp__text">
				<?= $description ?>
			</div>
		</div>
    </div>

<?php }; } ?>
