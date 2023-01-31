<?php
/*
 * Author:  Fedor Nikonov (fritylo)
 * Date:    2023-01-09, 9:21:50 PM
 * Company: frity.org
 */
?>

<?php
function HeaderMenu (
	$links,
	$attributes = []
) { ?>
	<?php 
		attributes_extract($attributes, 'class', $class);
		attributes($attributes);
	?>

	<?php $is_logged_in = true; ?>

	<div class="header__menu rel <?= $class ?>" <?= $attributes ?>>
		<div class="header__menu-underline header__menu-underline_main abs"></div>
		<div class="header__menu-underline abs"></div>
		<div class="header__menu-content">
			<?php foreach ($links as $title => $href) : ?>
				<?php _Link($title, $href, ['class' => "header__menu-li ml1o25 rel"]) ?>
			<?php endforeach; ?>

			<?php if ($is_logged_in) : ?>
				<?php _Link('Личный кабинет', '../office', ['class' => "header__menu-li ml1o25 rel"]) ?>
			<?php else: ?>
				<?php _Link('Вход/Регистрация', '../login', ['class' => "header__menu-li ml1o25 rel"]) ?>
			<?php endif; ?>
		</div>
	</div>
<?php } ?>
