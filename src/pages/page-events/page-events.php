<?php use_header() ?>

<div class="page page-events">
	<?php _Header() ?>
	<?php ScrollTopButton() ?>

	<?php Devicer::Start() ?>
		<?php Title('Ближайшие мероприятия', ['class' => 'title_events']) ?>
		<div class="events_block">
			<?php $events = select_events(); ?>
			<?php foreach ($events as $event) : ?>
				<?php EventBlock($event) ?>
			<?php endforeach; ?>
		</div>

		<?php Contacts(['id' => 'contacts']) ?>
	<?php Devicer::End() ?>

	<?php Footer() ?>
</div>

<?php use_footer() ?>
