<?php use_header() ?>

<?php 
	$themes = select_blog_themes();
	
	$cylinder_sides = [[],[],[],[],[]];

	for ($i = 0; $i < count($themes); $i++) {
		$col = $i - ((int) ($i / 5)) * 5; // $col is 0-4
		array_push($cylinder_sides[$col], $themes[$i]);
	}

	$posts_popular = select_blog_posts();
	$posts_recent = select_blog_posts();
?>

<div class="page page-blog">
	<?php _Header() ?>
	<?php ScrollTopButton() ?>

	<?php Devicer::Start() ?>
		<?php BlogTitle()() ?>

		<?php Cylinder(['id' => 'cylinder', 'class' => 'rel grid-pc'])([
			0 => function () use ($cylinder_sides) {
				foreach ($cylinder_sides[4] as $theme)
					BlogBlock()($theme);
			},

			1 => function () use ($cylinder_sides) {
				foreach ($cylinder_sides[2] as $theme)
					BlogBlock()($theme);
			},

			2 => function () use ($cylinder_sides) {
				foreach ($cylinder_sides[0] as $theme)
					BlogBlock()($theme);
			},

			3 => function () use ($cylinder_sides) {
				foreach ($cylinder_sides[1] as $theme)
					BlogBlock()($theme);
			},
			
			4 => function () use ($cylinder_sides) {
				foreach ($cylinder_sides[3] as $theme)
					BlogBlock()($theme);
			},
		]) ?>

		<div class="grid-mobile row wrap jcc">
			<?php
				foreach ($themes as $theme) {
					BlogBlock()($theme);
				}
			?>
		</div>

		<?php Title('Популярные записи', ['class' => 'title_articles title_articles-popular']) ?>
		<div class="articles rel row wrap jcc">
			<?php foreach ($posts_popular as $post) : ?>
				<?php ProductShop()($post, true, true) ?>
			<?php endforeach; ?>
		</div>

		<?php Title('Свежие записи', ['class' => 'title_articles title_articles-recent']) ?>
		<div class="articles rel row wrap jcc">
			<?php foreach ($posts_recent as $post) : ?>
				<?php ProductShop()($post, true, true) ?>
			<?php endforeach; ?>
		</div>

	<?php Devicer::End() ?>

	<?php Footer() ?>
</div>

<?php use_footer() ?>
