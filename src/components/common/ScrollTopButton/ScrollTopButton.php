<?php
/*
 * Author:  Fedor Nikonov (fritylo)
 * Date:    2023-01-09, 8:27:14 PM
 * Company: frity.org
 */
?>

<?php
function ScrollTopButton (
	$attributes = []
) { ?>
	<?php 
		attributes_extract($attributes, 'class', $class);
		attributes($attributes);
	?>

    <div class="scroll-top-button <?= $class ?>" <?= $attributes ?>>
        
    </div>
<?php } ?>
