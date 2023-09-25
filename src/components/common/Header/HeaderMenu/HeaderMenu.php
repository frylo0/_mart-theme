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
		global $wp;

		attributes_extract($attributes, 'class', $class);
		attributes($attributes);

		$current_url = home_url($wp->request);
	?>

	<div class="header__menu rel <?= $class ?>" <?= $attributes ?>>
		<div class="header__menu-underline header__menu-underline_main abs"></div>
		<div class="header__menu-underline abs"></div>
		<div class="header__menu-content">
			<?php foreach ($links as $title => $href) : ?>
				<?php $current_class = $href === $current_url ? 'header__menu-li_current' : ''; ?>
				<?php _Link($title, $href, ['class' => "header__menu-li ml1o25 rel $current_class"]) ?>
			<?php endforeach; ?>
		</div>
	</div>
<?php } ?>
