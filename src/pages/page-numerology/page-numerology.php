<?php use_header() ?>

<div class="page page-numerology">
	<?php
		// FIXME: Menu links do not work
		// FIXME: Image plus do not work
		// FIXME: Video has plus
		// FIXME: <figure> and <figcaption> wordpress css bugs

		$sections = select_numerology_sections();

		function starts_with($string, $beginning) {
			return substr($string, 0, strlen($beginning)) === $beginning;
		};

		$sections_consult = array_filter($sections, function ($section) {
			return starts_with(
				get_the_title($section), 
				'Консультации'
			);
		});
		$sections_study = array_filter($sections, function ($section) {
			return starts_with(
				get_the_title($section), 
				'Обучение'
			);
		});
	?>

	<?php _Header() ?>
	<?php ScrollTopButton() ?>

	<?php Devicer::Start(['class' => 'rel page__content']) ?>
		<div class="numero-menu">
			<?php Title('Нумерология', ['class' => 'title_numerology']) ?>

			<?php Diashad(['class' => 'diashad_only-mobile'])(30, 9) ?>
			<?php Diashad(['class' => 'diashad_only-mobile'])(40, 12) ?>

    		<div class="numero-menu__content">
    			<div class="numero-submenu col aic">
    				<div class="numero-subtitle numenu-item__trigger cup" data-target="consult-conversation">
						Консультации
					</div>
					<?php foreach ($sections_consult as $section) : ?>
						<?php NumenuItem()($section) ?>
					<?php endforeach; ?>
				</div>

    			<div class="numero-submenu col aic">
    				<div class="numero-subtitle numenu-item__trigger cup" data-target="study">
						Обучение
					</div>
					<?php foreach ($sections_study as $section) : ?>
						<?php NumenuItem()($section) ?>
					<?php endforeach; ?>
				</div>
			</div>
		</div>

		<?php Diashad()(50, -9) ?>
		<?php Diashad()(30, -4, true) ?>

		<?php foreach ($sections as $section) : ?>
			<?php NumeroSection()($section) ?>
		<?php endforeach; ?>
	<?php Devicer::End() ?>

	<?php Footer() ?>
</div>

<?php use_footer() ?>
