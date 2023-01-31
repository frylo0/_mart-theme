<?php
/*
 * Author:  Fedor Nikonov (fritylo)
 * Date:    2023-01-09, 8:27:19 PM
 * Company: frity.org
 */
?>

<?php
function Arrow(
	$direction, 
	$color ='#EDA69C', 
	$size = 42, 
	$attributes = []
) { ?>
	<?php 
		attributes_extract($attributes, 'class', $class);
		attributes($attributes);
	?>

	<div class="arrow rel <?= $class ?>" <?= $attributes ?>>
		<?php 
			$rotate = 0;
			$tX = '50%';
			$tY = '50%';

			if ($direction === 'up') $rotate = 180;
			else if ($direction === 'left') $rotate = 90;
			else if ($direction === 'right') $rotate = -90;
			else { 
				$tX = '-' . $tX; 
				$tY = '-' . $tY;
			}

			$rotate .= 'deg';
		?>

		<svg class="abs" width="<?= $size ?>"
			viewBox="0 0 42 14"
			fill="none"
			xmlns="http://www.w3.org/2000/svg"
			style="transform: rotate(<?= $rotate ?>) translate(<?= $tX ?>, <?= $tY ?>);"
		>
			<path
				d="M0.339661 1.05658L19.5 12.2918V12.2918C20.3281 12.7774 21.3532 12.7809 22.1846 12.3009L22.2003 12.2918L41.6603 1.05658"
				stroke="<?= $color ?>"
			/>
		</svg>
		
	</div>
<?php } ?>
