<?php
/*
 * Author:  Fedor Nikonov (fritylo)
 * Date:    2023-02-06, 8:33:06 PM
 * Company: frity.org
 */
?>

<?php
function EventBlock (
	WP_Post $event,
	$attributes = []
) { ?>
	<?php 
		attributes_extract($attributes, 'class', $class);
		attributes($attributes);

		$title = get_the_title($event);
		$background_image = get_field('annotation_picture', $event->ID);
		$more_link = get_the_permalink($event);
		$datetime = get_field('datetime', $event->ID);

		$datetime_formatted = preg_replace('/, \d+/', ', ', $datetime);

		$enroll_link = site_url('/buy/?id=' . $event->ID);

		// TODO: Use some logical fields
		$duration = get_field('duration', $event->ID);
	?>

	<div class="event-block row aic jcsb rel <?= $class ?>" <?= $attributes ?>>
		<div 
			class="event-block__background abs left0 top0 w100 h100"
			style="background-image: url(<?= $background_image['url'] ?>)"
		></div>
		<div
			class="event-block__gradient abs left0 top0 w100 h100"
		></div>

		<a href="<?= $more_link ?>" class="event-block__titles col">
			<div class="event-block__datetime">
				<?= $datetime_formatted ?>
			</div>
			<div class="event-block__title">
				<?= $title ?>
			</div>
		</a>

		<div class="event-block__buttons col">
			<a href="<?= $enroll_link ?>">
				<?php Button::Start() ?>
					Записаться
				<?php Button::End() ?>
			</a>
			<a href="<?= $more_link ?>">
				<?php Button::Start() ?>
					Подробнее
				<?php Button::End() ?>
			</a>
		</div>
        
    </div>

<?php } ?>
