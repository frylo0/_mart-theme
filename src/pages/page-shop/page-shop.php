<?php use_header() ?>

<div class="page page-shop">
	<?php _Header() ?>
	<?php ScrollTopButton() ?>

	<?php Devicer::Start() ?>
		<?php Title('Магазин шпаргалок', ['class' => 'title_page']) ?>

		<?php ShopFilters()() ?>
		<?php ShopProducts()() ?>
	<?php Devicer::End() ?>

	<?php Footer() ?>
</div>

<?php use_footer() ?>
