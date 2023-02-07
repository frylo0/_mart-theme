/*
 * Author:  Fedor Nikonov (fritylo)
 * Date:    2023-02-07, 12:07:21 AM
 * Company: frity.org
 */

import './NumenuItem.php';
import './NumenuItem.scss';

import 'utils/php/attributes-string.php';

import $ from 'jquery';

$(function () {
	const pref = '.numenu-item'; // prefix for current folder

	$(`${pref}__trigger`).on('click', (e) => {
		const headerHeight = document.getElementsByClassName('header')[0].getBoundingClientRect().height;
		const scrollTargetTop = document
			.getElementById(e.currentTarget.dataset.target || '')
			?.getBoundingClientRect().top;

		if (!scrollTargetTop) return;

		window.scrollTo({ top: scrollTargetTop - headerHeight, behavior: 'smooth' });
		e.preventDefault();
	});
});
