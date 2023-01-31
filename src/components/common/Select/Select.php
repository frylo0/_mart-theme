<?php
/*
 * Author:  Fedor Nikonov (fritylo)
 * Date:    2023-01-09, 8:27:43 PM
 * Company: frity.org
 */
?>

<?php
function Select (
	array $select_props,
	int $select_selected,
	string $get_query_bind_prop,
	$attributes = []
) { ?>
	<?php 
		attributes_extract($attributes, 'class', $class);
		attributes($attributes);
	?>

    <div class="select rel <?= $class ?>" <?= $attributes ?>>
    	<div class="select__basis row">
        	<?php $title = $select_props[array_keys($select_props)[$select_selected]]; ?>
        	<div class="select__title">
				<?= $title ?>
			</div>
			<?php Button::Start(['class' => 'select__toggle']) ?>
				<?php ArrowSmall('down', 'black') ?>
			<?php Button::End() ?>
		</div>
    	<div class="select__dropdown abs dn">
    		<?php $i = 0; ?>
    		<?php foreach ($select_props as $tag => $name) : ?>
				<?php $is_selected = $i == $select_selected; ?>
				<?php SelectOption($tag, $name, $is_selected, $get_query_bind_prop) ?>
    			<?php $i++; ?>
    		<?php endforeach; ?>
		</div>
    </div>
<?php } ?>
