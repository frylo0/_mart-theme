<?php
/*
 * Author:  Fedor Nikonov (fritylo)
 * Date:    Fri Feb 03 2023 10:48:32 PM
 */

add_action('init', 'theme_taxonomies');
add_action('init', 'theme_use_taxonomies');

function theme_taxonomies() {
	register_taxonomy('product-type', [], [
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => [
			'name'              => 'Типы продуктов',
			'singular_name'     => 'Тип продукта',
			'search_items'      => 'Найти тип',
			'all_items'         => 'Все типы',
			'view_item '        => 'Показать тип',
			'parent_item'       => 'Родительский тип',
			'parent_item_colon' => 'Родительский тип:',
			'edit_item'         => 'Редактировать тип',
			'update_item'       => 'Обновить тип',
			'add_new_item'      => 'Добавить новый тип',
			'new_item_name'     => 'Новое название типа',
			'menu_name'         => 'Типы продуктов',
			'back_to_items'     => '← Назад к типам продуктов',
		],
		'description'           => 'Определяют все возможные типы продуктов на сайте', // описание таксономии
		'public'                => true,
		// 'publicly_queryable'    => null, // равен аргументу public
		// 'show_in_nav_menus'     => true, // равен аргументу public
		// 'show_ui'               => true, // равен аргументу public
		// 'show_in_menu'          => true, // равен аргументу show_ui
		// 'show_tagcloud'         => true, // равен аргументу show_ui
		// 'show_in_quick_edit'    => null, // равен аргументу show_ui
		'hierarchical'          => false,

		'rewrite'               => true,
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'          => [],
		'meta_box_cb'           => null, // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
		'show_admin_column'     => false, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
		'show_in_rest'          => true, // добавить в REST API
		'rest_base'             => null, // $taxonomy
		// '_builtin'              => false,
		//'update_count_callback' => '_update_post_term_count',
	]);

	register_taxonomy('theme', [], [
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => [
			'name'              => 'Тематики',
			'singular_name'     => 'Тематика',
			'search_items'      => 'Найти тематику',
			'all_items'         => 'Все тематики',
			'view_item '        => 'Показать тематику',
			'parent_item'       => 'Родительская тематика',
			'parent_item_colon' => 'Родительская тематика:',
			'edit_item'         => 'Редактировать тематику',
			'update_item'       => 'Обновить тематику',
			'add_new_item'      => 'Добавить новую тематику',
			'new_item_name'     => 'Новое название тематики',
			'menu_name'         => 'Тематики',
			'back_to_items'     => '← Назад к тематикам',
		],
		'description'           => 'Используются между разными сущностями сайта для определения принадлежности к тематике', // описание таксономии
		'public'                => true,
		// 'publicly_queryable'    => null, // равен аргументу public
		// 'show_in_nav_menus'     => true, // равен аргументу public
		// 'show_ui'               => true, // равен аргументу public
		// 'show_in_menu'          => true, // равен аргументу show_ui
		// 'show_tagcloud'         => true, // равен аргументу show_ui
		// 'show_in_quick_edit'    => null, // равен аргументу show_ui
		'hierarchical'          => false,

		'rewrite'               => true,
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'          => [],
		'meta_box_cb'           => null, // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
		'show_admin_column'     => false, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
		'show_in_rest'          => true, // добавить в REST API
		'rest_base'             => null, // $taxonomy
		// '_builtin'              => false,
		//'update_count_callback' => '_update_post_term_count',
	]);
}

function theme_use_taxonomies() {
	register_taxonomy_for_object_type('product-type', 'product');
	register_taxonomy_for_object_type('theme', 'product');
}
