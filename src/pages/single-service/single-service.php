<?php use_header() ?>

<?php $product = $post; ?>

<div class="page single-service">
	<?php _Header() ?>
	<?php ScrollTopButton() ?>

	<?php Devicer::Start() ?>
		<?php Article()($product, 'enroll') ?>
	<?php Devicer::End() ?>

	<?php Footer() ?>
</div>

<?php use_footer() ?>
