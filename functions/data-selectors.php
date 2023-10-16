<?php
/*
 * Created on Tue Jan 31 2023 9:18:07 PM
 * Author Fedor Nikonov (fritylo) (https://github.com/fritylo)
 * Copyright (c) 2023 Frity Lo
 */

function select_index_page_sections() {
	// параметры по умолчанию
	$sections = get_posts([
		'numberposts' => -1,
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
		'numberposts' => -1,
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
		'numberposts' => -1,
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

	//var_dump($items);

	return $items;
}

function select_events() {
	// параметры по умолчанию
	$items = get_posts([
		'numberposts' => -1,
		'category'    => 0,
		'orderby'     => 'menu_order',
		//'order'       => 'DESC',
		//'include'     => [],
		//'exclude'     => [],
		//'meta_key'    => '',
		//'meta_value'  => '',
		'post_type'   => 'event',
		//'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
	]);

	return $items;
}

function select_numerology_sections() {
	// параметры по умолчанию
	$items = get_posts([
		'numberposts' => -1,
		'category'    => 0,
		'orderby'     => 'menu_order',
		//'order'       => 'DESC',
		//'include'     => [],
		//'exclude'     => [],
		//'meta_key'    => '',
		//'meta_value'  => '',
		'post_type'   => 'numerology-section',
		//'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
	]);

	return $items;
}

function select_shop_products(string $price, string $theme, string $format) {
	$format_term = false;
	$theme_term = false;

	if ($format !== '*')
		$format_term = get_term_by('slug', $format, 'product-type');
	if ($theme !== '*')
		$theme_term = get_term_by('slug', $theme, 'theme');

	$meta_query = [ 'relation' => 'AND' ];

	if ($format_term) {
		array_push($meta_query, [
			'key' => 'type',
			'compare' => 'LIKE',
			'value' => $format_term->term_id,
		]);
	}
	if ($theme_term) {
		array_push($meta_query, [
			'key' => 'themes',
			'compare' => 'LIKE',
			'value' => $theme_term->term_id,
		]);
	}

	$items = get_posts([
		'numberposts' => -1,
		'category'    => 0,
		'orderby'     => 'menu_order',
		//'order'       => 'DESC',
		//'include'     => [],
		//'exclude'     => [],
		'post_type'   => 'product',
		//'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
		'meta_query' => $meta_query,
	]);

	if ($price === '*') return $items;

	$items_price_filtered = [];

	$price_range = explode('-', $price);
	$price_min = floatval($price_range[0]);
	$price_max = floatval($price_range[1]);

	foreach ($items as $item) {
		$item_price_normal = get_field('price_normal', $item->ID);
		$item_price_sale = get_field('price_sale', $item->ID);

		$item_price = $item_price_normal;
		
		if ($item_price_sale)
			$item_price = $item_price_sale;

		$item_price = floatval($item_price);

		$is_in_price_range = ($price_min <= $item_price && $item_price <= $price_max);

		if ($is_in_price_range) {
			array_push($items_price_filtered, $item);
		}
	}

	return $items_price_filtered;
}

function select_blog_themes() {
	$items = get_terms([
		'taxonomy' => 'theme',
		'hide_empty' => false,
	]);

	return $items;
}

function select_blog_posts_recent() {
	$items = get_posts([
		'numberposts' => 2,
		'category'    => 0,
		'orderby'     => 'date',
		//'order'       => 'DESC',
		//'include'     => [],
		//'exclude'     => [],
		'post_type'   => 'post',
		//'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
		'meta_query' => [],
	]);

	return $items;
}

function select_blog_posts_popular() {
	$items = get_posts([
		'numberposts' => 2,
		'category'    => 0,
		'orderby'     => 'meta_value',
		'meta_key'    => 'view_count',
		//'order'       => 'DESC',
		//'include'     => [],
		//'exclude'     => [],
		'post_type'   => 'post',
		//'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
		'meta_query' => [],
	]);

	return $items;
}

function select_posts_by_theme(string $theme) {
	$theme_term = get_term_by('slug', $theme, 'theme');

	$meta_query = [];

	if ($theme_term) {
		array_push($meta_query, [
			'key' => 'themes',
			'compare' => 'LIKE',
			'value' => $theme_term->term_id,
		]);
	}

	$items = get_posts([
		'numberposts' => -1,
		'category'    => 0,
		'orderby'     => 'menu_order',
		//'order'       => 'DESC',
		//'include'     => [],
		//'exclude'     => [],
		'post_type'   => 'post',
		//'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
		'meta_query' => $meta_query,
	]);

	return $items;
}
