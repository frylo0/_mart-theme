<?php use_header() ?>

<?php Button('Hello, World!') ?>
<?php Circle() ?>
<?php Slider() ?>

<!-- Raw insert -->
<img src="~assets/images/puppy.jpg" alt="Puppy" />

<!-- Single quotes -->
<?php $puppy_url = '~assets/images/puppy.jpg'; ?>
<img src="<?= $puppy_url ?>" alt="Puppy" />

<!-- Double quotes -->
<?php $puppy_url = "~assets/images/puppy.jpg"; ?>
<img src="<?= $puppy_url ?>" alt="Puppy" />

<!-- Multiline -->
<?php 
echo <<<STRING
    <img src="~assets/images/puppy.jpg" alt="Puppy" />
STRING;
?>

<div class="flex">
	<div class="flex-item flex-item_a"></div>
	<div class="flex-item flex-item_b"></div>
	<div class="flex-item flex-item_c"></div>
</div>

<?php use_footer() ?>
