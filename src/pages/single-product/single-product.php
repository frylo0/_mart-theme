<?php use_header() ?>

<?php $product = $post; ?>

<div class="page single-product">
	<?php _Header() ?>
	<?php ScrollTopButton() ?>

	<?php Devicer::Start() ?>
		<div class="single-product__content">
			<?php ProductPreview()($product, 'normal', 'buy') ?>
			<?php the_content() ?>
			<?php ProductPreview()($product, 'button', 'buy') ?>
		</div>
	<?php Devicer::End() ?>

	<?php Footer() ?>
</div>

<?php use_footer() ?>
