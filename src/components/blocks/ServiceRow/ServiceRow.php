<?php
/*
 * Author:  Fedor Nikonov (fritylo)
 * Date:    2023-02-05, 10:54:25 PM
 * Company: frity.org
 */
?>

<?php
function ServiceRow (
	WP_Post $service,
	$attributes = []
) { ?>
	<?php 
		attributes_extract($attributes, 'class', $class);
		attributes($attributes);

		$more_link = get_the_permalink($service);
		$sign_up_link = '#';
		$title = get_the_title($service);
		$price = get_field('price', $service->ID);
	?>

	<div class="service-row row <?= $class ?>" <?= $attributes ?>>
    	<a href="<?= $more_link ?>" class="service-row__title">
			<?= $title ?>
		</a>
    	<div class="service-row__info">
    		<div class="service-row__price"><?= $price ?></div>
    		<a href="<?= $sign_up_link ?>" class="service-row__button">
				<?php Button::Start(['class' => 'w100']) ?>
					Записаться
				<?php Button::End() ?>
			</a>
		</div>
    </div>

<?php } ?>
