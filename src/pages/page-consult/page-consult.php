<?php use_header() ?>

<div class="page page-consult">
	<?php _Header() ?>
	<?php ScrollTopButton() ?>

	<?php Devicer::Start() ?>

		<?php Title('Виды консультаций', ['class' => 'title_consult-types mt2o5']) ?>
		<div class="row jcc wrap">
			<?php $types = select_consult_types(); ?>
			<?php foreach ($types as $product) : ?>
				<?php $price = get_field('price', $product->ID) ?>
				<?php Product($product, 0, 'Записаться', $price, ['class' => 'product_normal']) ?>
			<?php endforeach; ?>
		</div>

		<?php Title('Рейтинг услуг', ['class' => 'title_services']) ?>
    	<div class="services">
			<?php $rating = select_consult_list(); ?>
			<?php foreach ($rating as $product) : ?>
				<?php ServiceRow($product) ?>
			<?php endforeach; ?>
		</div>

	<?php Devicer::End() ?>

	<?php Footer() ?>
</div>

<?php use_footer() ?>
