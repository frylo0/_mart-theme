<?php
/*
 * Author:  Fedor Nikonov (fritylo)
 * Date:    2023-02-07, 12:07:21 AM
 * Company: frity.org
 */
?>

<?php
function NumenuItem ($attributes = []) { return function (
	WP_Post $section,
) use ($attributes) { ?>
	<?php 
		attributes_extract($attributes, 'class', $class);
		attributes($attributes);
		
		$post_title = get_the_title($section);
		preg_match('/^.*? (.*)$/', $post_title, $matches);
		
		$is_visible = count($matches) > 0;
		
		$title = $is_visible ? $matches[1] : '';
		$icon = get_field('icon', $section->ID);
		
		$target = $post_title;
	?>
	
	<?php if ($is_visible) : ?>
		<div
			class="numenu-item numenu-item__trigger row jcsb aic cup <?= $class ?>"
			data-target="<?= $target ?>"
			<?= $attributes ?>
		>
			<div class="numenu-item__title"><?= $title ?></div>
			<div 
				class="numenu-item__icon"
				style="background-image: url(<?= $icon['url'] ?>);"
			></div>
		</div>
	<?php endif; ?>

<?php }; } ?>
