<?php
/*
 * Author:  Fedor Nikonov (fritylo)
 * Date:    2023-03-28, 10:36:56 PM
 * Company: frity.org
 */
?>

<?php
function ProductPreview ($attributes = []) { return function (
	WP_Post $product,
	string $mode,
	string $type,
) use ($attributes) { ?>
	<?php 
		attributes_extract($attributes, 'class', $class);
		attributes($attributes);

		switch ($mode) {
			case 'normal':
			case 'button':
				break;
			default:
				throw new Exception('Unexpected ProductPreview $mode argument: "' . $mode . '"');
		}

		$action_text = '';
		$action_link = '';

		switch ($type) {
			case 'enroll':
				$action_text = 'Записаться';
				$action_link = '#';
				break;
			case 'buy':
				$action_text = 'Купить';
				$action_link = '#';
				break;
			case 'read':
				$action_text = '';
				$action_link = '';
				break;
			default:
				throw new Exception('Unexpected ProductPreview $type argument: "' . $type . '"');
		}

		$has_action = $action_text !== '';

		$title = get_the_title($product);
		$datetime = '';
		$tags = get_field('themes', $product->ID);
		$format = get_field('type', $product->ID)->name;

		$price_normal = get_field('price_normal', $product->ID);
		$price_sale = get_field('price_sale', $product->ID);
		$price = $price_sale ?? $price_normal;

		if ($price)
			$price = format_price($price);
		if ($price_normal)
			$price_normal = format_price($price_normal);
		if ($price_sale)
			$price_sale = format_price($price_sale);

		$image = get_field('picture', $product->ID);
		$image_pos = get_field('picture_position', $product->ID);

		if ($datetime) {
			$title .= " ($datetime)";
		}

		$get_tag_link = function ($tag) {
			return site_url('/shop') . '?theme=' . $tag->slug;
		};

		// TODO: Add real buy and enroll links
	?>

	<div class="
		product-preview 
		col 
		<?= $mode === 'button' ? 'product-preview_button' : '' ?> 
		<?= $class ?>
	" <?= $attributes ?>>
		<?php if ($mode === 'normal') : ?>
			<div class="product-preview__image" style="
				background-image: url('<?= $image['url'] ?>');
				background-position: <?= $image_pos['x'] ?>% <?= $image_pos['y'] ?>%
			"></div>
		<?php elseif ($mode === 'button') : ?>
			<a href="<?= $action_link ?>" class="product-preview__image col jcc ff-ars-b" style="
				background-image: linear-gradient(to right, var(--c2), transparent), url('<?= $image['url'] ?>');
				background-position: <?= $image_pos['x'] ?>% <?= $image_pos['y'] ?>%
			">
				<?php if ($has_action) : ?>
					<?= mb_strtoupper($action_text) ?>
					<div>
						<?= $price ?>
					</div>
				<?php endif; ?>
			</a>
		<?php endif; ?>

		<?php if ($has_action) : ?>
			<a href="<?= $action_link ?>">
				<?php Button::Start(['class' => 'product-preview__button w100']) ?>
					<?= $action_text ?>
				<?php Button::End() ?>
			</a>
		<?php endif; ?>

		<div class="product-preview__title">
			<?= $title ?>
		</div>

		<div class="product-preview__tags">
			<?php foreach ($tags as $tag) : ?>
				<a
					href="<?= $get_tag_link($tag) ?>" 
					class="product-preview__tag product-shop__tag dib tdn cup"
				><?= format_tag_name($tag->name) ?></a>
			<?php endforeach; ?>
		</div>

		<div class="product-preview__type">
			<?= $format ?>
		</div>

		<div>
			<?php if ($price_sale) : ?>
				<div class="product-preview__price product-preview__price-sale">
					<?= $price_sale ?>
				</div>
				<div class="product-preview__price product-preview__price-before">
					<?= $price_normal ?>
				</div>
			<?php else : ?>
				<div class="product-preview__price product-preview__price-normal">
					<?= $price_normal ?>
				</div>
			<?php endif; ?>
		</div>
    </div>

<?php }; } ?>
