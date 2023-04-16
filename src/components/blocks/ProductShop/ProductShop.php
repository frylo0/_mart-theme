<?php
/*
 * Author:  Fedor Nikonov (fritylo)
 * Date:    2023-03-19, 7:19:44 PM
 * Company: frity.org
 */
?>

<?php
function ProductShop ($attributes = []) { return function (
	WP_Post $product,
	bool $show_creation_date = false,
	bool $show_read_button = false,
) use ($attributes) { ?>
	<?php 
		attributes_extract($attributes, 'class', $class);
		attributes($attributes);

		$price_normal = get_field('price_normal', $product->ID);
		$price_sale = get_field('price_sale', $product->ID);
		$is_sales = isset($price_sale) && $price_sale > 0;

		$price_normal_pretty = '';
		$price_sale_pretty = '';

		if ($price_normal)
			$price_normal_pretty = number_format(floatval($price_normal), 0, ',', ' ') . ' руб';
		if ($price_sale)
			$price_sale_pretty = number_format(floatval($price_sale), 0, ',', ' ') . ' руб';

		$annotation_text = get_field('annotation_text', $product->ID);
		$annotation_image = get_field('annotation_picture', $product->ID)['url'];

		$tags = get_field('themes', $product->ID);

		$use_read_button = $show_read_button;

		$creation_date = get_the_date('d.m.Y', $product);

		$title = get_the_title($product);
		$format = get_field('type', $product->ID)->name;

		$more_link = get_the_permalink($product);
		$buy_link = site_url('/buy' . '/' . $product->ID);

		$query = new UrlQuery();
		$shop_page = site_url('/shop');
	?>

	<div class="product-shop row rel <?= $class ?>" <?= $attributes ?>>
		<?php if ($is_sales) : ?>
			<div class="product-shop__sales-badge abs row jcc aic">
				Акция
			</div>
		<?php endif; ?>

		<div class="col product-shop__card">
			<div class="product-shop__image product__image-wrapper rel row jcc aic">
				<div class="product__image w100 h100 abs ct-abs w100 h100" style="
					background-image: url('<?= $annotation_image ?>')
				"></div>

				<div class="product__image-gradient abs top0 left0 w100 h100" style="
					background-image: linear-gradient(180deg, rgba(255, 255, 255, 0) 8.85%, #F6D3CE 100%);
				"></div>

				<?php if ($show_creation_date) : ?>
					<div class="product-shop__creation-date abs">
						<?= $creation_date ?>
					</div>
				<?php endif; ?>
			</div>

			<div class="product-shop__title">
				<?= $title ?>
			</div>

			<?php if (!$use_read_button) : ?>
				<div class="product-shop__type">
					<?= $format ?>
				</div>
			<?php endif; ?>
			
			<?php if (!$use_read_button) : ?>
				<?php if ($is_sales) : ?>
					<div class="product-shop__price-block row">
						<div class="product-shop__price_sales">
							<?= $price_sale_pretty ?>
						</div>
						<div class="product-shop__price_before">
							<?= $price_normal_pretty ?>
						</div>
					</div>
				<?php elseif ($price_normal) : ?>
					<div class="product-shop__price-block product-shop__price">
						<?= $price_normal_pretty ?>
					</div>
				<?php endif; ?>
			<?php else : ?>
				<div class="product-shop__price-block product-shop__price"></div>
			<?php endif; ?>

			<div class="product-shop__controls">
				<?php if ($use_read_button) : ?>
					<a href="<?= $more_link ?>">
						<?php Button::Start(['class' => 'product-shop__button-read-only']) ?>
							Читать
						<?php Button::End() ?>
					</a>
				<?php else : ?>
					<a href="<?= $more_link ?>">
						<?php Button::Start(['class' => 'product-shop__button-read-more ']) ?>
							Подробнее
						<?php Button::End() ?>
					</a>
					<a href="<?= $buy_link ?>">
						<?php Button::Start(['class' => 'product-shop__button-buy']) ?>
							Купить
						<?php Button::End() ?>
					</a>
				<?php endif; ?>
			</div>
		</div>

		<div class="col product-shop__content">
			<div class="product-shop__tags">
				<?php foreach ($tags as $tag) : ?>
					<?php $query->set('theme', $tag->slug) ?>
					<a
						href="<?= $shop_page ?><?= $query->toString() ?>"
						class="product-shop__tag dib tdn"
					><?= format_tag_name($tag->name) ?></a>
				<?php endforeach; ?>
			</div>

			<div class="product-shop__description">
				<?= $annotation_text ?>
			</div>
		</div>
    </div>
<?php }; } ?>
