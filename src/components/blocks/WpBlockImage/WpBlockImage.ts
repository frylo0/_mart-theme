/*
 * Author:  Fedor Nikonov (fritylo)
 * Date:    2023-02-08, 12:44:27 AM
 * Company: frity.org
 */

import './WpBlockImage.php';
import './WpBlockImage.scss';

import $ from 'jquery';

import tippy from 'tippy.js';
import 'tippy.js/dist/tippy.css';
import 'tippy.js/dist/backdrop.css';
import 'tippy.js/dist/border.css';
import 'tippy.js/themes/light.css';
import 'tippy.js/animations/shift-away-subtle.css';

function calcHeight(img: HTMLImageElement) {
	return (img.clientWidth / img.naturalWidth) * img.naturalHeight;
}

$('figure.wp-block-image')
	.on('click', (e) => {
		const $figure = $(e.currentTarget);
		const $img = $figure.find('img');
		const img = $img.get(0);

		if (!img) return;

		const isOpened = $figure.hasClass('figure_opened');

		if (isOpened) {
			$figure.removeClass('figure_opened');
			$img.css('height', '');
		} else {
			// closed
			$figure.addClass('figure_opened');
			$img.css('height', calcHeight(img) + 'px');
		}
	})
	.has('figcaption')
	.addClass('figure_with-title');

$(window).on('resize', () => {
	$('figure.figure_opened img').each(function () {
		const img = this as HTMLImageElement;
		$(img).css('height', calcHeight(img) + 'px');
	});
});

tippy('figure.wp-block-image', {
	content: 'Нажмите чтобы развернуть/свернуть',
	theme: 'light',
	popperOptions: {
		strategy: 'fixed',
	},
});
