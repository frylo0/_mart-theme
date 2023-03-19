<?php
/*
 * Author:  Fedor Nikonov (fritylo)
 * Date:    2023-01-09, 11:20:39 PM
 * Company: frity.org
 */
?>

<?php
function SelectOption($attributes = []) { return function(
	callable $Option,
	string $title,
	string $value,
	bool $is_selected,
) use ($attributes) { ?>
	<?php
		$class_name = ' select__option ' . ($is_selected ? 'select__option_selected' : '');

		if (!array_key_exists('class', $attributes)) {
			$attributes['class'] = $class_name;
		} else {
			$attributes['class'] .= $class_name;
		}
	?>

	<?php $Option($attributes)($title, $value, $is_selected) ?>
<?php };} ?>
