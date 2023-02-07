<?php use_header() ?>

<div class="page page-numerology">
	<?php
		$sections = select_numerology_sections();

		function starts_with($string, $beginning) {
			return substr($string, 0, strlen($beginning)) === $beginning;
		};

		$sections_consult = [];
		$sections_study = [];

		foreach ($sections as $section) {
			$title = get_the_title($section);

			if (starts_with($title, 'Консультации')) {
				$sections_consult[] = $section;
			} else if (starts_with($title, 'Обучение')) {
				$sections_study[] = $section;
			}
		}

		$target_consult = get_the_title($sections_consult[0]);
		$target_study = get_the_title($sections_study[0]);
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
    				<div class="numero-subtitle numenu-item__trigger cup" data-target="<?= $target_consult ?>">
						Консультации
					</div>
					<?php foreach ($sections_consult as $section) : ?>
						<?php NumenuItem()($section) ?>
					<?php endforeach; ?>
				</div>

    			<div class="numero-submenu col aic">
    				<div class="numero-subtitle numenu-item__trigger cup" data-target="<?= $target_study ?>">
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
