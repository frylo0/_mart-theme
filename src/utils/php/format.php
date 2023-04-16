<?php

function format_price(float $price) {
	return number_format($price, 0, ',', ' ') . ' руб';
}

function format_tag_name(string $tag_name) {
	return str_replace(' ', '-', $tag_name);
}
