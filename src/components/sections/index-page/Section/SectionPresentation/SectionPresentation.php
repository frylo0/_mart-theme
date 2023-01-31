<?php
/*
 * Author:  Fedor Nikonov (fritylo)
 * Date:    2023-01-31, 9:45:55 PM
 * Company: frity.org
 */
?>

<?php
function SectionPresentation (
	bool $is_main,
	string $link,
	array $image,
	array $image_pos,
	$attributes = []
) { ?>
	<?php 
		attributes_extract($attributes, 'class', $class);
		attributes($attributes);

		$is_sales = select_setting('sales_badge')['is_shown'];
		$show_sales = $is_main && $is_sales;

		$background_pos = "{$image_pos['x']}% {$image_pos['y']}%";
	?>


	<div class="section__presentation rel row jcc <?= $class ?>" <?= $attributes ?>>
		<?php if ($show_sales) : ?>
			<?php SectionSalesBlock() ?>
		<?php endif; ?>

		<a href="<?= $link ?>" class="cup">
    		<div class="section__presentation-back w100 h100" style="
				background-image: 
					linear-gradient(to right, #fff 0%, #ffffff88 50%, #fff 100%), 
					url(<?= $image['url'] ?>); 
				background-position: <?= $background_pos ?>;
			">
    			<div class="section__presentation-front w100 h100" style="
					background-image: url(<?= $image['url'] ?>); 
					background-position: <?= $background_pos ?>;
				"></div>
			</div>
		</a>
    </div>

<?php } ?>
