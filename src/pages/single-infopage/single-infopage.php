<?php use_header() ?>

<div class="page single-infopage">
	<?php _Header() ?>
	<?php ScrollTopButton() ?>

	<?php Devicer::Start() ?>
		<?php Section($post, true, true) ?>
		<?php RecommendedProducts() ?>
		<?php Contacts() ?>
	<?php Devicer::End() ?>

	<?php Footer() ?>
</div>

<?php use_footer() ?>
