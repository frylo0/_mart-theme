<?php use_header() ?>

<?php $product = $post; ?>

<div class="page single-product">
	<?php _Header() ?>
	<?php ScrollTopButton() ?>

	<?php Devicer::Start() ?>
		<?php Article()($product, 'buy') ?>
	<?php Devicer::End() ?>

	<?php Footer() ?>
</div>

<?php use_footer() ?>
