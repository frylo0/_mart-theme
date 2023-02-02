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

		$products = [1, 1, 1, 1];
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
				<?php Product(
					'Длинное название',
					'Lacus in iaculis ut ut facilisi suspendisse pharetra. 
					Scelerisque convallis ac tellus felis mauris egestas amet, 
					aenean urna. Scelerisque egestas sed cursus 
					at felis urna nullam. Orci neque ultrices pretium 
					est et lectus enim vitae pellentesque.
					Augue cursus massa gravida et non risus tellus hac risus. 
					Consectetur varius integer sed at pulvinar 
					id nunc. Pulvinar laoreet neque vulputate ultricies felis.
					Pellentesque pellentesque mattis morbi odio turpis 
					nam. Tellus interdum scelerisque.',
					'#',
					'#',
					'1250руб',
					'https://frity.ru/sbl/jf/__php/../__assets/115.jpeg?t=1675370952',
					0,
					'Купить',
					['class' => 'product_normal']
				) ?>
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
