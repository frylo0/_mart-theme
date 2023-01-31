<?php
/*
 * Author:  Fedor Nikonov (fritylo)
 * Date:    Wed Feb 01 2023 12:37:19 AM
 */

function remove_yaost_on_some_post_types() {
	remove_meta_box('wpseo_meta', 'setting', 'normal');
}
add_action('add_meta_boxes', 'remove_yaost_on_some_post_types', 100);
