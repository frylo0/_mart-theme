<?php
/*
 * Author:  Fedor Nikonov (fritylo)
 * Date:    2023-03-05, 4:20:53 PM
 * Company: frity.org
 */
?>

<?php
function ShopProducts ($attributes = []) { return function (
	
) use ($attributes) { ?>
	<?php 
		attributes_extract($attributes, 'class', $class);
		attributes($attributes);

		$query = new UrlQuery();

		$selected_theme = $query->get('theme') ?? '*';
		$selected_price = $query->get('price') ?? '*';
		$selected_format = $query->get('format') ?? '*';
		$selected_sale = $query->get('sale') ?? '*';

		$products = select_shop_products($selected_price, $selected_theme, $selected_format, $selected_sale);

		$has_result = count($products) > 0;
	?>

	<div class="shop-products products row wrap jcc <?= $class ?>" <?= $attributes ?>>
		<?php if ($has_result) : ?>
			<?php foreach ($products as $product) : ?>
				<?php ProductShop()($product) ?>
			<?php endforeach; ?>
		<?php else : ?>
			<?php Title('Нет найденных товаров', [
				'style' => 'color: var(--c3); margin-bottom: 6rem; letter-spacing: 0.25em;'
			]) ?>
		<?php endif; ?>
    </div>
<?php }; } ?>
