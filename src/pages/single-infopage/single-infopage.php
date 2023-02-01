<?php use_header() ?>

<div class="page single-infopage">
	<?php _Header() ?>
	<?php ScrollTopButton() ?>

	<?php Devicer::Start() ?>
		<?php Section($post, true, true) ?>
		<!-- TODO: Add recommended products -->
		<?php Contacts() ?>
	<?php Devicer::End() ?>
</div>

<?php use_footer() ?>
