<?php
/*
 * Author:  Fedor Nikonov (fritylo)
 * Date:    2023-01-31, 9:45:47 PM
 * Company: frity.org
 */
?>

<?php
function SectionContent (
	$is_main,
	$title,
	$text,
	$button_text,
	$button_link,
	$shadow_image,
	$attributes = []
) { ?>
	<?php 
		attributes_extract($attributes, 'class', $class);
		attributes($attributes);

		$is_main_hide_title = true;
		$is_read_more = true;

		$show_title = !($is_main_hide_title && $is_main);
	?>

	<div class="section__content col jcc <?= $class ?>" <?= $attributes ?>>
		<div class="rel">
			<div class="section__content-text rel">
				<?php if ($show_title) : ?>
					<?php Title($title) ?>
				<?php endif; ?>

            	<div class="mtb1o5">
					<?= $text ?>
			    </div>
               
				<?php if ($is_read_more && $button_text) : ?>
					<center>
						<a href="<?= $button_link ?>">
							<?php Button::Start() ?>
								<?= $button_text ?>
							<?php Button::End() ?>
						</a>
					</center>
				<?php endif; ?>
			</div>

			<div class="section__content-shadow abs top0">
				<img src="<?= $shadow_image['url'] ?>" alt="<?= $shadow_image['alt'] ?>">
			</div>
		</div>
    </div>
<?php } ?>
