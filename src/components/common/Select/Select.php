<?php
/*
 * Author:  Fedor Nikonov (fritylo)
 * Date:    2023-01-09, 8:27:43 PM
 * Company: frity.org
 */
?>

<?php
function Select($attributes = []) { return function(
	array $options,
	array $params = [],
) use ($attributes) { ?>
	<?php 
		attributes_extract($attributes, 'class', $class);
		attributes($attributes);

		$option_objects = [];

		foreach ($options as $value => $title) {
			$option_objects[] = [
				'title' => $title,
				'value' => $value,
			];
		}

		$options_map = $options;
		$options = $option_objects;

		if (!isset($params['selected_index']) && !isset($params['selected_value'])) {
			throw new Exception('Provide selected_index or selected_value params');
		}
		if (isset($params['selected_index']) && isset($params['selected_value'])) {
			throw new Exception('Can\'t use selected_index and selected_value params at same time');
		}

		if (isset($params['selected_value'])) {
			$selected_index = array_search($params['selected_value'], array_keys($options_map));
		} else {
			$selected_index = $params['selected_index'];
		}

		$selected_option = $options[$selected_index];

		if (!isset($params['Option'])) {
			throw new Exception('Select requires "Option" param to be component');
		}

		$Option = $params['Option'];
	?>

    <div class="select rel <?= $class ?>" <?= $attributes ?>>
    	<div class="select__basis row">
        	<div class="select__title">
				<?= $selected_option['title'] ?>
			</div>
			<?php Button::Start(['class' => 'select__toggle']) ?>
				<?php ArrowSmall('down', 'black') ?>
			<?php Button::End() ?>
		</div>
    	<div class="select__dropdown abs dn">
    		<?php foreach ($options as $i => $option) : ?>
				<?php $is_selected = $i == $selected_index; ?>
				<?php
					SelectOption()(
						$Option,
						$option['title'], 
						$option['value'], 
						$is_selected,
					)
				?>
    		<?php endforeach; ?>
		</div>
    </div>
<?php };} ?>
