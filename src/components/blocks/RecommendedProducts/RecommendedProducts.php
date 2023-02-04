<?php
/*
 * Author:  Fedor Nikonov (fritylo)
 * Date:    2023-02-02, 11:21:43 PM
 * Company: frity.org
 */
?>

<?php
function RecommendedProducts (
	$is_show_title = true,
	$more_button_modifiers = [],
	$attributes = []
) { ?>
	<?php 
		attributes_extract($attributes, 'class', $class);
		attributes($attributes);

		$products = select_recommended_products(4);

		$more_link = site_url('/shop');
		$more_class = implode(' ', array_map(function ($mod) {
			return "button_$mod";
		}, $more_button_modifiers));
	?>

	<div class="recommended-products <?= $class ?>" <?= $attributes ?>>
        <?php if ($is_show_title) : ?>
    		<center class="title ff-ars-b mb2">
				Рекомендуемые товары
			</center>
		<?php endif; ?>
    	   
    	<div class="recommended-products__content row jcc">
			<?php foreach ($products as $product) : ?>
				<?php Product($product, 0, 'Купить', ['class' => 'product_normal']) ?>
			<?php endforeach; ?>
		</div>
    	      
    	<center class="more-recommended">
    		<a href="<?= $more_link ?>">
				<?php Button::Start(['class' => $more_class]) ?>
					Больше рекомендуемых
				<?php Button::End() ?>
			</a>
		</center>
    </div>
<?php } ?>
