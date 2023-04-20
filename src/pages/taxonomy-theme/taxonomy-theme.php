<?php use_header() ?>

<?php 
	$theme = $wp_query->get_queried_object();
	$posts = select_posts_by_theme($theme->slug);
?>

<div class="page taxonomy-theme">
	<?php _Header() ?>
	<?php ScrollTopButton() ?>

	<?php Devicer::Start(['class' => 'ovh']) ?>
		<?php BlogThemePreview()($theme) ?>

		<div class="articles rel row wrap jcc">
			<?php foreach ($posts as $product) : ?>
				<?php ProductShop()($product, true, true) ?>
			<?php endforeach; ?>

			<?php if (count($posts) == 0) : ?>
				<?php Title('В теме пока нет публикаций', [
					'style' => 'color: var(--c3); margin-bottom: 6rem; letter-spacing: 0.25em;'
				]) ?>
			<?php endif; ?>
		</div>
	<?php Devicer::End() ?>

	<?php Footer() ?>
</div>

<?php use_footer() ?>
