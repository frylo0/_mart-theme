<?php
require_once __DIR__ . '/components/common/entry.php';

insert_to_page([
	'head' => [ 'styles' => [
		'/components/common/entry.css',
		'/css/page-tmp.css',
	]],
	'body' => [ 'scripts' => [
		'/components/common/entry.js',
		'/js/page-tmp.js',
	]],
], '10-12-22--23:52:36');
?>

<?php use_header() ?>

tmp

<?php use_footer() ?>