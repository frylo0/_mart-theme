<?php
require_once __DIR__ . '/components/common/entry.php';
require_once __DIR__ . '/components/blocks/Circle/Circle.php';
require_once __DIR__ . '/components/sections/Slider/Slider.php';

insert_to_page([
	'head' => [ 'styles' => [
		'/components/common/entry.css',
		'/css/index.css',
	]],
	'body' => [ 'scripts' => [
		'/components/common/entry.js',
		'/js/index.js',
	]],
], '21-12-22--00:12:23');
?>

<?php use_header() ?>

<?php Button('Hello, World!') ?>
<?php Circle() ?>
<?php Slider() ?>

<!-- Raw insert -->
<img src="<?= URL_ROOT ?>/assets/images/puppy.jpg" alt="Puppy" />

<!-- Single quotes -->
<?php $puppy_url = URL_ROOT . '/assets/images/puppy.jpg'; ?>
<img src="<?= $puppy_url ?>" alt="Puppy" />

<!-- Double quotes -->
<?php $puppy_url = "$URL_ROOT/assets/images/puppy.jpg"; ?>
<img src="<?= $puppy_url ?>" alt="Puppy" />

<!-- Multiline -->
<?php 
echo <<<STRING
    <img src="$URL_ROOT/assets/images/puppy.jpg" alt="Puppy" />
STRING;
?>

<div class="flex">
	<div class="flex-item flex-item_a"></div>
	<div class="flex-item flex-item_b"></div>
	<div class="flex-item flex-item_c"></div>
</div>

<?php use_footer() ?>
