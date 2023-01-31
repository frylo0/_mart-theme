<?php
/*
 * Author:  Fedor Nikonov (fritylo)
 * Date:    2023-01-09, 11:20:39 PM
 * Company: frity.org
 */
?>

<?php
function SelectOption(
	$tag,
	$name,
	$is_selected,
	$get_query_bind_prop,
	$attributes = []
) { ?>
	<?php 
		attributes_extract($attributes, 'class', $class);
		attributes($attributes);
	?>

	<div class="select-option <?= $class ?>" <?= $attributes ?>>

		<?php
		function url_query_decode() {
			$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			$query_start_pos = strrpos($actual_link, '?');

			if ($query_start_pos === false)
				$query_start_pos = mb_strlen($actual_link) - 1;
			$actual_query = substr($actual_link, $query_start_pos + 1);

			$query_parts = [];
			if ($actual_query)
				$query_parts = explode('&', $actual_query);

			$query = [];
			foreach ($query_parts as $query_part) {
				if (strpos($query_part, '=') !== false) {
					$split = explode('=', $query_part);
					$query[$split[0]] = urldecode($split[1]);
				} else {
					$query[$query_part] = '';
				}
			}

			return $query;
		}

		function url_query_update($prop, $value) {
			$query = url_query_decode();

			$query[$prop] = $value;

			$target_link = './?';
			foreach ($query as $prop => $value)
				$target_link .= "$prop=$value&";

			$target_link = substr($target_link, 0, -1);

			return $target_link;
		}
		?>

		<a
			class="select__option <?= ($is_selected ? 'select__option_selected' : '') ?>"
			href="<?= url_query_update($get_query_bind_prop, $tag) ?>"
		>
			<?= $name ?>
		</a>

	</div>
<?php } ?>
