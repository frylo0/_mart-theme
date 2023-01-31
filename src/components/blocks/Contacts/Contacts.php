<?php
/*
 * Author:  Fedor Nikonov (fritylo)
 * Date:    2023-01-10, 9:33:02 PM
 * Company: frity.org
 */
?>

<?php
function ContactsCard (
	$text,
	$link,
	$icon,
	$attributes = []
) { ?>
	<?php 
		attributes_extract($attributes, 'class', $class);
		attributes($attributes);
	?>

	<a href="<?= $link ?>" target="_blank" class="contacts__card col aic <?= $class ?>" <?= $attributes ?>>
    	<img src="~assets/images/<?= $icon ?>" class="mbo25" />
    	<span><?= $text ?></span>
	</a>
<?php } ?>


<?php
function ContactsCardExtra (
	$text,
	$link,
	$icon,
	$iconPos,
	$attributes = []
) { ?>
	<?php 
		attributes_extract($attributes, 'class', $class);
		attributes($attributes);
	?>
	<a href="<?= $link ?>" <?= $attributes ?> class="
		contacts__card 
		contacts__card_extra 
		col 
		<?= $iconPos === 'right' ? 'aife' : 'aifs' ?>
		<?= $class ?>
	">
    	<div class="contacts__card-extra-imgs row jcc aic mbo25 rel">
			<img src="~assets/images/<?= $icon ?>" />
			<img src="~assets/images/<?= $icon ?>" data-i="1" class="contacts__card-img-copy abs" />
			<img src="~assets/images/<?= $icon ?>" data-i="2" class="contacts__card-img-copy abs" />
			<img src="~assets/images/<?= $icon ?>" data-i="3" class="contacts__card-img-copy abs" />
			<img src="~assets/images/<?= $icon ?>" data-i="4" class="contacts__card-img-copy abs" />
		</div>
		<span><?= $text ?></span>
	</a>
<?php } ?>


<?php
function Contacts (
	$attributes = []
) { ?>
	<?php 
		attributes_extract($attributes, 'class', $class);
		attributes($attributes);
	?>

    <div class="contacts <?= $class ?>" <?= $attributes ?>>
		<?php Title('Контакты', ['class' => 'mb2']) ?>

    	<div class="row jcc mb1">
			<?php ContactsCard('fi(69)', 'fi(68)', 'contacts_facebook.png') ?>
			<?php ContactsCard('fi(72)', 'fi(71)', 'contacts_instagram.png', ['id' => 'contact_instagram']) ?>
			<?php ContactsCard('fi(75)', 'fi(74)', 'contacts_skype.png') ?>
		</div>
    	<div class="row jcc">
			<?php
				$tel = 'fi(160)';
				$tel_link = 'tel:+'.$tel;
				$tel_html = '<span>+'.substr($tel,0,1).' ('.substr($tel,1,3).')</span> '.substr($tel,4,3).'-'.substr($tel,7,2).'-'.substr($tel,9,2);
				$email = 'fi(161)';
				$at = strpos($email, '@');
				$email_html = '<span>'.substr($email,0,$at).'</span>'.substr($email,$at);
				$email_link = 'mailto:'.$email;
			?>
			<?php ContactsCardExtra($tel_html, $tel_link, 'contacts_phone-call.svg', 'right', ['id' => 'contact_phone']) ?>
			<?php ContactsCardExtra($email_html, $email_link, 'contacts_email.svg', 'left') ?>
		</div>
    </div>
<?php } ?>
