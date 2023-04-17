<?php use_header() ?>

<div class="page single-post">
	<?php _Header() ?>
	<?php ScrollTopButton() ?>

	<?php Devicer::Start() ?>
		<?php Article()($post, 'read') ?>
	<?php Devicer::End() ?>

	<?php Footer() ?>
</div>

<?php use_footer() ?>
