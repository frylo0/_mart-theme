<?php
/*
 * Created on Tue Jan 31 2023 9:18:07 PM
 * Author Fedor Nikonov (fritylo) (https://github.com/fritylo)
 * Copyright (c) 2023 Frity Lo
 */

function select_index_page_sections() {
	// параметры по умолчанию
	$sections = get_posts([
		'numberposts' => 0,
		'category'    => 0,
		'orderby'     => 'menu_order',
		//'order'       => 'DESC',
		//'include'     => [],
		//'exclude'     => [],
		//'meta_key'    => '',
		//'meta_value'  => '',
		'post_type'   => 'index-page-sections',
		//'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
	]);

	return $sections;
}

function select_setting(string $field) {
	// параметры по умолчанию
	$settings = get_posts([
		'numberposts' => 1,
		'category'    => 0,
		'orderby'     => 'menu_order',
		//'order'       => 'DESC',
		//'include'     => [],
		//'exclude'     => [],
		//'meta_key'    => '',
		//'meta_value'  => '',
		'post_type'   => 'setting',
		//'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
	]);

	$setting = get_field($field, $settings[0]);

	return $setting;
}

function select_recommended_products($count) {
	// параметры по умолчанию
	$items = get_posts([
		'numberposts' => $count,
		'category'    => 0,
		'orderby'     => 'menu_order',
		//'order'       => 'DESC',
		//'include'     => [],
		//'exclude'     => [],
		//'meta_key'    => '',
		//'meta_value'  => '',
		'post_type'   => 'product',
		//'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
	]);

	return $items;
}

function select_consult_types() {
	// параметры по умолчанию
	$items = get_posts([
		'numberposts' => 0,
		'category'    => 0,
		'orderby'     => 'menu_order',
		//'order'       => 'DESC',
		//'include'     => [],
		//'exclude'     => [],
		//'meta_key'    => '',
		//'meta_value'  => '',
		'post_type'   => 'service-type',
		//'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
	]);

	return $items;
}

function select_consult_list() {
	// параметры по умолчанию
	$items = get_posts([
		'numberposts' => 0,
		'category'    => 0,
		'orderby'     => 'menu_order',
		//'order'       => 'DESC',
		//'include'     => [],
		//'exclude'     => [],
		//'meta_key'    => '',
		//'meta_value'  => '',
		'post_type'   => 'service',
		//'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
	]);

	return $items;
}

?>
