<?php
/*
 * Author:  Fedor Nikonov (fritylo)
 * Date:    2023-01-09, 8:27:52 PM
 * Company: frity.org
 */
?>

<?php
function ArrowSmall(
	$direction, 
	$color = '#EDA69C', 
	$size = 16,
	$attributes = []
) { ?>
	<?php 
		attributes_extract($attributes, 'class', $class);
		attributes($attributes);
	?>

	<div class="arrow-small rel <?= $class ?>" <?= $attributes ?>>
		<?php
			$rotate = 0; 
			$tX = '50%'; 
			$tY = '50%';

			if ($direction === 'up') $rotate = 180;
			else if ($direction === 'left') $rotate = 90;
			else if ($direction === 'right') $rotate = -90;
			else { 
				$tX = '-' . $tX; 
				$tY = '-'. $tY; 
			}

			$rotate .= 'deg';
		?>

		<svg class="abs" width="<?= $size ?>"
			viewBox='0 0 18 7'
			fill='none'
			xmlns='http://www.w3.org/2000/svg'
			style="transform: rotate(<?= $rotate ?>) translate(<?= $tX ?>, <?= $tY ?>);"
		>
			<path
				d='M1 1L8.41918 5.67325V5.67325C8.73656 5.87316 9.14016 5.87457 9.45893 5.67688L9.46478 5.67325L17 1'
				stroke="<?= $color ?>"
			/>
		</svg>

	</div>
<?php } ?>
