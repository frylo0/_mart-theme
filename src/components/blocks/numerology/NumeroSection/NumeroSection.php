<?php
/*
 * Author:  Fedor Nikonov (fritylo)
 * Date:    2023-02-07, 12:12:24 AM
 * Company: frity.org
 */

function NumeroSection($attributes = []) {
	return function (
		WP_Post $section,
	) use ($attributes) { ?>
		<?php
		attributes_extract($attributes, 'class', $class);
		attributes($attributes);

		$post_title = get_the_title($section);
		preg_match('/^(.*?)( (.*))?$/', $post_title, $matches);

		$title = $matches[1];
		$subtitle = count($matches) > 2 ? $matches[3] : '';
		$section_title = "$title <span style=\"color: #e16a59\">$subtitle</span>";

		$content = get_the_content(null, false, $section);

		$link = '';
		$contacts_link = '#';
		$enroll_link = '#';

		$shadows = get_field('shadow', $section->ID);

		$shadows_visible = [];

		if ($shadows) {
			foreach ($shadows as $i => $shadow) {
				if (!$shadow['visible']) continue;
				array_push($shadows_visible, $shadow);
			}
		}
		?>

		<?php Title($section_title, [
			'id' => $link,
			'class' => 'numero-content-title',
		]) ?>

		<div class="numero-section <?= $class ?>" data-json="" <?= $attributes ?>>
			<?= $content ?>

			<p class="numero-section__action">
				<span style="color: #e16a59">
					Запишитесь на консультацию прямо сейчас:
				</span>

				воспользуйтесь
				<a href="<?= $contacts_link ?>" style="color: black">контактами психолога</a>

				или
				<a href="<?= $enroll_link ?>">
					<?php Button::Start(['style' => 'padding-left: 0.5em; padding-right: 0.5em']) ?>
					запишитесь на сайте
					<?php Button::End() ?>
				</a>
			</p>
		</div>

		<?php foreach ($shadows_visible as $shadow) : ?>
			<?php Diashad()(
				$shadow['opacity'],
				$shadow['margin_top'],
				$shadow['inverse'],
				$shadow['rotation'],
			) ?>
		<?php endforeach; ?>

<?php };
}
