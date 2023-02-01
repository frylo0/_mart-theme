<?php
/*
 * Author:  Fedor Nikonov (fritylo)
 * Date:    2023-01-31, 11:35:56 PM
 * Company: frity.org
 */
?>

<?php
function SectionSalesBlock(
	$attributes = []
) { ?>
	<?php
	attributes_extract($attributes, 'class', $class);
	attributes($attributes);
	
	$settings = select_setting('sales_badge');
	$link = get_permalink(get_page_by_path('sales'));

	$i = -1;
	$D = 150;
	$R = $D / 2;
	$R2 = pow($R, 2);
	$total = 20;
	$padding = 3;
	$middle = $total / 2;
	$step = $D / $total;
	$EM = 14;
	?>

	<div class="section__sales-block abs top0 right0 tac tdn cup <?= $class ?>" <?= $attributes ?>>
		<a href="<?= $link ?>" class="cup tdn">
			<?php while ($i++ < $total) : ?>
				<?php
				$wi = $R - pow($R2 - pow(($i - $middle) * $step + $step / 2, 2), 0.5);
				if ($wi + $padding < $R) $wi += $padding;
				?>
				<div class="section__sales-block-round-fixer" style="width: <?= $wi / $EM ?>em; height: <?= $step / $EM ?>em"></div>
				<div class="section__sales-block-round-fixer" style="width: <?= $wi / $EM ?>em; height: <?= $step / $EM ?>em"></div>
			<?php endwhile; ?>
			<div class="mto25">
				<p><?= $settings['text'] ?></p>
				<h1><?= $settings['percent'] ?>%</h1>
			</div>
			<a href="<?= $link ?>" class="abs bottom1o25 ct-abs_horiz fwb">
				Подробнее
			</a>
		</a>
	</div>
<?php } ?>
