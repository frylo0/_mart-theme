<?php
/*
 * Author:  Fedor Nikonov (fritylo)
 * Date:    2022-12-30, 12:06:38 AM
 * Company: frity.org
 */
?>

<?php
/*
 * Author:  Fedor Nikonov (fritylo)
 * Date:    2022-12-30, 12:06:38 AM
 * Company: frity.org
 */
?>

<?php
function Section (
	WP_Post $section,
	bool $is_main,
	bool $is_reversed,
	$attributes = []
) { ?>
	<?php 
		global $post;

		attributes_extract($attributes, 'class', $class);
		attributes($attributes);

		setup_postdata($section);
		$post = $section; // Used by ACF behind scene

		$is_image_right = !$is_reversed;

		$title = get_the_title();
		$content = get_the_content();
		$button_text = get_field('button_text');
		$link = get_field('link');
		$shadow_image = get_field('shadow_image');
		$image = get_field('image');
		$image_pos = get_field('image_pos');
	?>

	<section
		class="
			section row rel 
			<?= $is_main ? 'section_main' : '' ?>
			<?= $is_image_right ? 'section_reversed' : '' ?>
			<?= $class ?>
		"
		<?= $attributes ?>
	>
		<?php SectionContent(
			$is_main,
			$title,
			$content,
			$button_text,
			$link,
			$shadow_image,
		) ?>

		<?php SectionPresentation(
			$is_main,
			$link,
			$image,
			$image_pos,
		) ?>

		<?php if ($is_main) : ?>
			<div class="section__arrows abs bottom2o5 left0 w100">
				<?php Arrow('down', 'inherit', 50, ['class' => 'mA']) ?>
				<?php Arrow('down', 'inherit', 50, ['class' => 'mA']) ?>
				<?php Arrow('down', 'inherit', 50, ['class' => 'mA']) ?>
			</div>
		<?php endif; ?>

	</section>
<?php } ?>

