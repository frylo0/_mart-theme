/*
 * Author:  Fedor Nikonov (fritylo)
 * Date:    2023-01-09, 8:27:01 PM
 * Company: frity.org
 */

import './Header.php';
import './Header.scss';

import 'utils/php/attributes-string.php';

import $ from 'jquery';
import { animateElement } from 'utils/ts/animate-element';

import './HeaderMenu/HeaderMenu';
import { scrollBehaviour } from 'utils/ts/scroll-behaviour';

type JQueryAnimations = 'slideUp' | 'slideDown';
type HeaderTypes = 'small' | 'large';

$.when($.ready).then(() => {
	const pref = '.header';

	const MOBILE_BREAK = 900;
	window.MOBILE_BREAK = MOBILE_BREAK;

	function changeDirectionStuff(
		headerType: HeaderTypes,
		sloganAnimation: JQueryAnimations,
		logoTransform: string,
		headerPadding: Keyframe
	) {
		const $header = $(pref);

		if (window.innerWidth < MOBILE_BREAK) {
			$(pref + '__slogan_mobile')
				[sloganAnimation](250)
				.promise();
		} else {
			$(pref + '__slogan_pc')
				[sloganAnimation](250)
				.promise();
		}

		animateElement($(pref + '__logo'), { transform: logoTransform });
		animateElement($header, headerPadding).then(() => {
			$header.removeClass('header_' + (headerType == 'small' ? 'large' : 'small'));
			$header.addClass('header_' + headerType);
		});
	}

	scrollBehaviour.subscribe('start scroll up', () => {
		// make header large
		if (window.innerWidth < MOBILE_BREAK)
			changeDirectionStuff('large', 'slideDown', 'scale(1)', {
				paddingTop: '2em',
				paddingBottom: '1em',
			});
		else
			changeDirectionStuff('large', 'slideDown', 'scale(1)', {
				paddingTop: '3.28571em',
				paddingBottom: '3.28571em',
			});
	});

	scrollBehaviour.subscribe('start scroll down', () => {
		// make header small
		if (window.innerWidth < MOBILE_BREAK)
			changeDirectionStuff('small', 'slideUp', 'scale(0.6)', {
				paddingTop: '1em',
				paddingBottom: '1em',
			});
		else
			changeDirectionStuff('small', 'slideUp', 'scale(0.6)', {
				paddingTop: '0',
				paddingBottom: '0.5em',
			});
	});

	// STOP: mobile menu
	const $menuButton = $('.header__menu');
	const $menuMobile = $('.header__menu-content');

	$menuButton.on('click', () => {
		if (window.innerWidth < MOBILE_BREAK) {
			$menuMobile
				.slideToggle()
				.promise()
				.then(() => window.menuManipulator.revertPosition());
		}
	});
});
