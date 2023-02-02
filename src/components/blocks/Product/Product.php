<?php
/*
 * Author:  Fedor Nikonov (fritylo)
 * Date:    2023-02-02, 11:23:36 PM
 * Company: frity.org
 */
?>

<?php
function Product (
	$title,
	$annotation_text,
	$more_link,
	$buy_link,
	$price,
	$image,
	$image_padding = 0,
	$action_button_text = 'Купить',
	$attributes = []
) { ?>
	<?php 
		attributes_extract($attributes, 'class', $class);
		attributes($attributes);
	?>

	<div class="product col <?= $class ?>" <?= $attributes ?>>
        
    	<div class="product__image-wrapper rel row jcc aic">
			<div class="product__image w100 h100 abs ct-abs w100 h100" style="
				background-image: url('<?= $image ?>'); 
				width: calc(100% - 2 * <?= $image_padding ?>); 
				height: calc(100% - 2 * <?= $image_padding ?>);
			"></div>

			<div
				class="product__image-gradient abs top0 left0 w100 h100"
				style="background-image: linear-gradient(#ffffff00 8.85%, #F6D3CE90);"
			>
				<div class="product__title ct-abs_horiz bottomo5 w100 tac ff-ars-b fz1o25">
					<?= $title ?>
				</div>
			</div>
		</div>

    	<div class="product__description taj mtb1">
			<?= $annotation_text ?>
		</div>

    	<div class="product__footer row jcsb w100">
    		<a href="<?= $more_link ?>">
				<?php Button::Start() ?>
					Подробнее
				<?php Button::End() ?>
			</a>

    		<a href="<?= $buy_link ?>">
				<?php Button::Start(['class' => 'rel']) ?>
					<?= $action_button_text ?>

    				<div class="product__price ct-abs_horiz w100"><?= $price ?></div>
				<?php Button::End() ?>
			</a>
		</div>
    </div>

<?php } ?>
