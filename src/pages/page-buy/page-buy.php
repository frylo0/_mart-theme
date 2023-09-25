<?php
$product_id = $_GET['id'];

$is_valid = is_numeric($product_id);

if (!$is_valid) {
	echo 'Invalid ID';
	die;
}

$product = get_post($product_id);
$post_type = get_post_type($product);

if ($product === null) {
	echo "No product with ID '$product_id'";
	die;
}

$allowed_post_types = ['product', 'service', 'service-type'];

if (!in_array($post_type, $allowed_post_types)) {
	echo "Invalid post type";
	die;
}

$price = get_product_price($product)->valuable->pretty;

$url_encoded = urlencode((new UrlQuery())->url);
?>

<?php
$settings = select_setting('buy');

$viber_phone_number = $settings['viber']['phone'];
$viber_message_text = str_replace('%url%', $url_encoded, $settings['viber']['message']);
$viber_deep_link = "viber://chat/?number=%2B$viber_phone_number&draft=$viber_message_text";

$whatsapp_phone_number = $settings['whatsapp']['phone'];
$whatsapp_message_text = str_replace('%url%', $url_encoded, $settings['whatsapp']['message']);
$whatsapp_deep_link = "whatsapp://send?phone=%2B$whatsapp_phone_number&text=$whatsapp_message_text";
?>

<?php 
switch ($post_type) {
	case 'product':
		$title = 'Покупка';
		break;
	case 'service-type':
		$title = 'Записаться на консультацию';
		break;
}
?>

<?php use_header() ?>

<div class="page page-buy">
	<?php _Header() ?>
	<?php ScrollTopButton() ?>

	<?php Devicer::Start() ?>
		<?php Title($title, ['class' => 'title_page']) ?>

		<div class="products mA wfc">
			<?php PreviewAny()($product) ?>

			<div class="payment">
				<center class="messengers-text">
					<p>К оплате <strong><?= $price ?></strong>.</p>
					<p>
						Договориться об оплате вы можете в удобном для вас мессенджере:
					</p>
				</center>

				<div class="messengers">
					<a class="messenger messenger_viber" href="<?= $viber_deep_link ?>">
						<img src="~assets/images/logo-viber.svg" />
						Перейти в Viber
					</a>
					<a class="messenger messenger_whatsapp" href="<?= $whatsapp_deep_link ?>">
						<img src="~assets/images/logo-whatsapp.svg" />
						Перейти в WhatsApp
					</a>
				</div>
			</div>
		</div>
	<?php Devicer::End() ?>

	<?php Footer() ?>
</div>

<?php use_footer() ?>
