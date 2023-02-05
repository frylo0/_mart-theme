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

	register_post_type('infopage', [
		'label'  => null,
		'labels' => [
			'name'               => 'Инфо страницы', // основное название для типа записи
			'singular_name'      => 'Инфо страница', // название для одной записи этого типа
			'add_new'            => 'Добавить страницу', // для добавления новой записи
			'add_new_item'       => 'Добавить новую страницу', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактировать страницу', // для редактирования типа записи
			'new_item'           => 'Новая страница', // текст новой записи
			'view_item'          => 'Просмотреть страницу', // для просмотра записи этого типа.
			'search_items'       => 'Найти страницу', // для поиска по этим типам записи
			'not_found'          => 'Страницы не найдены', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Нет подходящих страниц в корзине', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Инфо страницы', // название меню
		],
		'description'         => 'Отвечают за конкретные информативные страницы на сайте',
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
		'menu_icon'           => 'dashicons-format-aside',
		//'capability_type'   => 'post',
		//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
		//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
		'hierarchical'        => false,
		'supports'            => ['title', 'editor', 'revisions'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => [],
		'has_archive'         => false,
		'rewrite'             => true,
		'query_var'           => true,
		'rewrite'             => [
			'slug' => 'info',
		],
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
		'menu_position'       => 50,
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

	register_post_type('product', [
		'label'  => null,
		'labels' => [
			'name'               => 'Продукты', // основное название для типа записи
			'singular_name'      => 'Продукт', // название для одной записи этого типа
			'add_new'            => 'Добавить продукт', // для добавления новой записи
			'add_new_item'       => 'Добавить новый продукт', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактировать продукт', // для редактирования типа записи
			'new_item'           => 'Новый продукт', // текст новой записи
			'view_item'          => 'Просмотреть продукт', // для просмотра записи этого типа.
			'search_items'       => 'Найти продукт', // для поиска по этим типам записи
			'not_found'          => 'Продукты не найдены', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Нет подходящих продуктов в корзине', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Продукты', // название меню
		],
		'description'         => 'Определяют продукты, которые предоставляет сайт',
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
		'menu_icon'           => 'dashicons-cart',
		//'capability_type'   => 'post',
		//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
		//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
		'hierarchical'        => false,
		'supports'            => ['title', 'editor', 'author', 'comments', 'revisions'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => [],
		'has_archive'         => false,
		'rewrite'             => true,
		'query_var'           => true,
	]);

	register_post_type('service', [
		'label'  => null,
		'labels' => [
			'name'               => 'Услуги', // основное название для типа записи
			'singular_name'      => 'Услуга', // название для одной записи этого типа
			'add_new'            => 'Добавить услугу', // для добавления новой записи
			'add_new_item'       => 'Добавить новую услугу', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактировать услугу', // для редактирования типа записи
			'new_item'           => 'Новая услуга', // текст новой записи
			'view_item'          => 'Просмотреть услугу', // для просмотра записи этого типа.
			'search_items'       => 'Найти услугу', // для поиска по этим типам записи
			'not_found'          => 'Услуги не найдены', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Нет подходящих услуг в корзине', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Услуги', // название меню
		],
		'description'         => 'Определяют услуги, представленные на странице "Консультации психолога"',
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
		'menu_icon'           => 'dashicons-money-alt',
		//'capability_type'   => 'post',
		//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
		//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
		'hierarchical'        => false,
		'supports'            => ['title', 'editor', 'author', 'comments', 'revisions'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => [],
		'has_archive'         => false,
		'rewrite'             => true,
		'query_var'           => true,
	]);

	register_post_type('service-type', [
		'label'  => null,
		'labels' => [
			'name'               => 'Типы услуг', // основное название для типа записи
			'singular_name'      => 'Тип услуги', // название для одной записи этого типа
			'add_new'            => 'Добавить тип', // для добавления новой записи
			'add_new_item'       => 'Добавить новый тип', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактировать тип', // для редактирования типа записи
			'new_item'           => 'Новый тип', // текст новой записи
			'view_item'          => 'Просмотреть тип', // для просмотра записи этого типа.
			'search_items'       => 'Найти тип', // для поиска по этим типам записи
			'not_found'          => 'Типы услуг не найдены', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Нет подходящих типов в корзине', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Типы услуг', // название меню
		],
		'description'         => 'Определяют типы услуги, представленные на странице "Консультации психолога"',
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
		'menu_icon'           => 'dashicons-tickets',
		//'capability_type'   => 'post',
		//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
		//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
		'hierarchical'        => false,
		'supports'            => ['title', 'editor', 'author', 'comments', 'revisions'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => [],
		'has_archive'         => false,
		'rewrite'             => true,
		'query_var'           => true,
	]);
}
