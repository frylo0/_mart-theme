<?php
/*
 * Author:  Fedor Nikonov (fritylo)
 * Date:    2023-01-09, 8:27:06 PM
 * Company: frity.org
 */
?>

<?php
function Footer(
	$attributes = []
) { ?>
	<?php 
		attributes_extract($attributes, 'class', $class);
		attributes($attributes);

		$footer = select_setting('footer');
	?>

	<div class="footer ptbo5 w100 rel <?= $class ?>" <?= $attributes ?>>
		<?php Devicer::Start() ?>
			<span class="footer__copywrite">
				<?= $footer['company'] ?> &copy; <?= date('Y') ?>
			</span>
			<div class="row footer__production">
				<span class="mr2">
					prod: <?php _Link('Frity', 'http://frity.ru/') ?>
				</span>
				<span>
					icons:
					<?php _Link('Freepik', 'https://www.flaticon.com/authors/freepik') ?>,
					<?php _Link('Gregor Cresnar', 'https://www.flaticon.com/authors/gregor-cresnar') ?>
				</span>
			</div>
		<?php Devicer::End() ?>
	</div>
<?php } ?>
