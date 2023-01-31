<?php

function attributes_extract(array &$attributes, string $key, &$variable) {
	$value = array_key_exists($key, $attributes) ? $attributes[$key] : '';
	$variable = $value;
	unset($attributes[$key]);
}

function attributes(array &$attributes) {
	// Build attributes string
	$res = '';

	foreach ($attributes as $name => $value) {
		$res .= " $name=\"$value\"";
	}

	$attributes = $res;
}
