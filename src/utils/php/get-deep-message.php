<?php 

function get_deep_message(string $platform, array $settings, bool $is_enroll, string $url_placeholder_replacer) {
	$phone = $settings[$platform]['phone'];

	$message_text = $is_enroll 
		? $settings[$platform]['message_enroll']
		: $settings[$platform]['message_buy'];

	$message_text = str_replace('%url%', $url_placeholder_replacer, $message_text);

	switch ($platform) {
		case 'viber':
			return "viber://chat/?number=%2B$phone&draft=$message_text";
		case 'whatsapp':
			return "whatsapp://send?phone=%2B$phone&text=$message_text";
		default:
			throw new Exception("Unexpected platform '$platform' for deep message");
	}
	
}
