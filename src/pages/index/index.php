<?php use_header() ?>

<div class="page page-index">
	<?php _Header() ?>
	<?php ScrollTopButton() ?>

	<?php Devicer::Start() ?>
		<?php $sections = select_index_page_sections(); ?>

		<?php foreach ($sections as $i => $section) : ?>
			<?php $is_main = $i === 0; ?>
			<?php $is_reversed = $i % 2 === 0; ?>
			<?php Section($section, $is_main, $is_reversed) ?>
		<?php endforeach; ?>

		<?php Contacts() ?>
	<?php Devicer::End() ?>

	<?php Footer() ?>
</div>

<?php use_footer() ?>
