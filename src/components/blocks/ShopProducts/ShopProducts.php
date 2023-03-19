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
	?>

	<div class="shop-products <?= $class ?>" <?= $attributes ?>>
        
    </div>
<?php }; } ?>
