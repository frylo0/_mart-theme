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

$allowed_post_types = ['product', 'service', 'service-type', 'numerology-section', 'event'];
$enroll_post_types = ['numerology-section', 'event'];

if (!in_array($post_type, $allowed_post_types)) {
	echo "Invalid post type";
	die;
}

$is_enroll = in_array($post_type, $enroll_post_types);
$url_encoded = urlencode((new UrlQuery())->url);
?>

<?php
$settings = select_setting('buy');

$viber_deep_link = get_deep_message('viber', $settings, $is_enroll, $url_encoded);
$whatsapp_deep_link = get_deep_message('whatsapp', $settings, $is_enroll, $url_encoded);
?>

<?php 
function strong($text) {
	return "<strong>$text</strong>";
}
?>

<?php 
switch ($post_type) {
	case 'product':
		$title = 'Покупка';
		$text_to_pay = 'К оплате ' . strong(get_product_price($product)->valuable->pretty);
		$text_pay_guide = 'Договориться об оплате вы можете в удобном для вас мессенджере:';
		break;
	case 'service-type':
		$title = 'Записаться на консультацию';
		$text_to_pay = 'К оплате ' . strong(get_field('price', $product->ID));
		$text_pay_guide = 'Договориться об оплате вы можете в удобном для вас мессенджере:';
		break;
	case 'service':
		$title = 'Приобрести услугу';
		$text_to_pay = 'К оплате ' . strong(get_field('price', $product->ID));
		$text_pay_guide = 'Договориться об оплате вы можете в удобном для вас мессенджере:';
		break;
	case 'numerology-section':
		$title = 'Записаться на нумерологическую консультацию';
		$text_to_pay = null;
		$text_pay_guide = 'Чтобы записаться перейдите в один из следующих мессенджеров:';
		break;
	case 'event':
		$title = 'Записаться на мероприятие';
		$text_to_pay = null;
		$text_pay_guide = 'Чтобы записаться перейдите в один из следующих мессенджеров:';
		break;
	default:
		echo 'Invalid post type for variables setup';
		die;
}
?>

<?php use_header() ?>

<div class="page page-buy">
	<?php _Header() ?>
	<?php ScrollTopButton() ?>

	<?php Devicer::Start() ?>
		<?php Title($title, ['class' => 'title_page']) ?>

		<?php if ($post_type === 'service') : ?>
			<?php $service_title = get_the_title($product); ?>
			<?php Title($service_title); ?>
		<?php endif; ?>

		<div class="products mA wfc">
			<?php PreviewAny()($product) ?>

			<div class="payment">
				<center class="messengers-text">
					<?php if ($text_to_pay !== null) : ?>
						<p><?= $text_to_pay ?></p>
					<?php endif; ?>
					<p><?= $text_pay_guide ?></p>
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
