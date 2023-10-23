<?php
/*
 * Author:  Fedor Nikonov (fritylo)
 * Date:    2023-09-25, 11:02:19 PM
 * Company: frity.org
 */
?>

<?php
function PreviewAny ($attributes = []) { return function (
	WP_Post $product,
) use ($attributes) { ?>
	<?php 
		$post_type = get_post_type($product);

		$class = isset($attributes['class']) ? $attributes['class'] : '';
		$attributes['class'] = "preview-any preview-any_{$post_type} {$class}";
	?>

	<?php 
		if ($post_type === "product") {
			ProductShop($attributes)($product, false, false);
		}
		elseif ($post_type === "service-type") {
			$price = get_field('price', $product->ID);
			$attributes['class'] .= ' product_normal';
			Product($product, 0, 'Записаться', $price, $attributes);
		}
		elseif ($post_type === "service") {

		}
		else if ($post_type === "numerology-section") {
			$price = null;
			$attributes['class'] .= ' product_normal';
			Product($product, 0, 'Записаться', $price, $attributes);
		}
		elseif ($post_type === "event") {

		}
		else {
			echo "Invalid post type \"$post_type\" for PreviewAny";
			die;
		}
	?>
<?php }; } ?>
