<?php

add_action('init', 'theme_post_types');

function theme_post_types() {
	register_post_type('index-page-sections', [
		'label'  => null,
		'labels' => [
			'name'               => 'Секции на главной', // основное название для типа записи
			'singular_name'      => 'Секция на главной', // название для одной записи этого типа
			'add_new'            => 'Добавить секцию', // для добавления новой записи
			'add_new_item'       => 'Добавить новую секцию', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактировать секцию', // для редактирования типа записи
			'new_item'           => 'Новая секция', // текст новой записи
			'view_item'          => 'Просмотреть секцию', // для просмотра записи этого типа.
			'search_items'       => 'Найти секцию', // для поиска по этим типам записи
			'not_found'          => 'Секции не найдены', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Нет подходящих секций в корзине', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Секции на главной', // название меню
		],
		'description'         => 'Определяют порядок и контент секций на главной странице',
		'public'              => true,
		'publicly_queryable'  => null, // зависит от public
		'exclude_from_search' => null, // зависит от public
		'show_ui'             => null, // зависит от public
		'show_in_nav_menus'   => null, // зависит от public
		'show_in_menu'        => true, // показывать ли в меню адмнки
		// 'show_in_admin_bar'   => null, // зависит от show_in_menu
		'show_in_rest'        => true, // добавить в REST API. C WP 4.7
		'rest_base'           => null, // $post_type. C WP 4.7
		'menu_position'       => 40,
		'menu_icon'           => 'dashicons-excerpt-view',
		//'capability_type'   => 'post',
		//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
		//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
		'hierarchical'        => false,
		'supports'            => ['title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions', 'post-formats'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => [],
		'has_archive'         => false,
		'rewrite'             => true,
		'query_var'           => true,
	]);

	register_post_type('setting', [
		'label'  => null,
		'labels' => [
			'name'               => 'Настройки', // основное название для типа записи
			'singular_name'      => 'Настройка', // название для одной записи этого типа
			'add_new'            => 'Добавить настройку', // для добавления новой записи
			'add_new_item'       => 'Добавить новую настройку', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактировать настройку', // для редактирования типа записи
			'new_item'           => 'Новая настройка', // текст новой записи
			'view_item'          => 'Просмотреть настройку', // для просмотра записи этого типа.
			'search_items'       => 'Найти настройку', // для поиска по этим типам записи
			'not_found'          => 'Настройки не найдены', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Нет подходящих настроек в корзине', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Настройки сайта', // название меню
		],
		'description'         => 'Определяют общие вещи на сайте',
		'public'              => true,
		'publicly_queryable'  => null, // зависит от public
		'exclude_from_search' => null, // зависит от public
		'show_ui'             => null, // зависит от public
		'show_in_nav_menus'   => null, // зависит от public
		'show_in_menu'        => true, // показывать ли в меню адмнки
		// 'show_in_admin_bar'   => null, // зависит от show_in_menu
		'show_in_rest'        => true, // добавить в REST API. C WP 4.7
		'rest_base'           => null, // $post_type. C WP 4.7
		'menu_position'       => 40,
		'menu_icon'           => 'dashicons-admin-generic',
		//'capability_type'   => 'post',
		//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
		//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
		'hierarchical'        => false,
		'supports'            => ['title', 'revisions'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => [],
		'has_archive'         => false,
		'rewrite'             => true,
		'query_var'           => true,
	]);
}
