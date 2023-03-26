<?php
/*
 * Author:  Fedor Nikonov (fritylo)
 * Date:    2023-03-26, 4:30:50 PM
 * Company: frity.org
 */
?>

<?php
function BlogTitle ($attributes = []) { return function (
	
) use ($attributes) { ?>
	<?php 
		attributes_extract($attributes, 'class', $class);
		attributes($attributes);

		$settings = select_setting('blog_header');

		$quote = $settings['quote'];
		$author = $settings['author'];
	?>

	<div class="blog-title row aic <?= $class ?>" <?= $attributes ?> style="
		background-image: url('~assets/images/bg_blog.png')
	">
		<div class="blog-title__basis col jcc aifs">
			<div class="blog-title__main ff-ars-b">
				БЛОГ
			</div>
			<div class="blog-title__sub ff-rlw-r">
				Ирены Беркуты
			</div>
		</div>
		<div class="blog-title__quote col jcc">
			<div class="blog-title-quote__text taj">
				<?= $quote ?>
			</div>
			<?php if ($author) : ?>
				<div class="blog-title-quote__author tar">
					<?= $author ?>
				</div>
			<?php endif; ?>
		</div>
    </div>

<?php }; } ?>
