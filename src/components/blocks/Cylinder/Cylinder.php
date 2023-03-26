<?php
/*
 * Author:  Fedor Nikonov (fritylo)
 * Date:    2023-03-26, 5:00:35 PM
 * Company: frity.org
 */
?>

<?php
function Cylinder ($attributes = []) { return function (
	array $sides,
) use ($attributes) { ?>
	<?php 
		attributes_extract($attributes, 'class', $class);
		attributes($attributes);

		$max = 10;
		$i = 0;
	?>

	<div class="cylinder <?= $class ?>" <?= $attributes ?>>
		<div class="cylinder-container">
			<div class="cylinder-frame">
				<div class="strip">
					<?php while ($i < $max) : ?>
						<div class="cylinder-l cylinder-l-<?= $i ?>">
							<?php if (isset($sides[$i])) {
								$sides[$i]();
							} ?>
						</div>
						<?php $i++; ?>
					<?php endwhile; ?>
				</div>
			</div>
		</div>
    </div>

<?php }; } ?>
