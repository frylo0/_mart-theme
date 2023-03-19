<?php
/*
 * Author:  Fedor Nikonov (fritylo)
 * Date:    2023-03-05, 4:20:43 PM
 * Company: frity.org
 */
?>

<?php
function ShopFilters($attributes = []) { return function(
	
) use ($attributes) { ?>
	<?php 
		attributes_extract($attributes, 'class', $class);
		attributes($attributes);

		$query = new UrlQuery();

		$selected_theme = $query->get('theme') ?? '*';
		$selected_price = $query->get('price') ?? '*';
		$selected_format = $query->get('format') ?? '*';

		function get_taxonomy_options($taxonomy, $default_option) {
			$options = [ '*' => $default_option ];

			array_map(function ($term) use (&$options) {
				$options[$term->slug] = $term->name;
			}, get_terms([
				'taxonomy' => $taxonomy,
				'hide_empty' => false,
			]));

			return $options;
		}

		$formats = get_taxonomy_options('product-type', 'Любой формат');
		$themes = get_taxonomy_options('theme', 'Любая тематика');
	?>

	<div class="shop-filters row selects jcc <?= $class ?>" <?= $attributes ?>>
		<!-- Theme -->
		<?php Select()($themes, [
			'selected_value' => $selected_theme,
			'Option' => ShopFilterOption('theme')
		]) ?>

		<!-- Price -->
        <?php Select()([
            '*' => 'Любая цена',
            '0-0' => 'Бесплатно',
            '1-200' => '1 - 200 руб',
            '200-500' => '200 - 500 руб',
            '500-1000' => '500 - 1 000 руб',
            '1000-2000' => '1 000 - 2 000 руб',
            '2000-5000' => '2 000 - 5 000 руб',
            '5000-10000' => '5 000 - 10 000 руб',
            '10000-20000' => '10 000 - 20 000 руб',
            '20000-50000' => '20 000 - 50 000 руб',
		], [ 'selected_value' => $selected_price, 'Option' => ShopFilterOption('price') ]) ?>

		<!-- Format -->
		<?php Select()($formats, [
			'selected_value' => $selected_format,
			'Option' => ShopFilterOption('format')
		]) ?>
    </div>
<?php };} ?>

<?php function ShopFilterOption($query_param) { return function(
	$attributes = []
) use ($query_param) { return function(
	$title,
	$value,
	$is_selected,
) use ($attributes, $query_param) { ?>
	<?php 
		attributes_extract($attributes, 'class', $class);
		attributes($attributes);

		$query = new UrlQuery();
		$query->set($query_param, $value);
	?>

	<a href="<?= $query->toString() ?>" class="<?= $class ?>" <?= $attributes ?>>
		<?= $title ?>
	</a>
<?php };};} ?>
