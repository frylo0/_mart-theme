/*
 * Author:  Fedor Nikonov (fritylo)
 * Date:    2023-01-09, 9:21:50 PM
 * Company: frity.org
 */

import './HeaderMenu.php';
import './HeaderMenu.scss';

import 'utils/php/attributes-string.php';

import $ from 'jquery';
import { Timediffer } from 'utils/ts/timediffer';

export class UnderlineManipulator {
	$menu: JQuery;
	$underline: JQuery;
	underline: HTMLElement;
	$underlineStatic: JQuery;
	$defaultElement: JQuery;
	position: Keyframe;

	constructor($underlineStatic: JQuery, $underline: JQuery, $defaultElement: JQuery, $menu: JQuery) {
		this.$menu = $menu;
		this.$underline = $underline;
		this.underline = $underline[0];
		this.$underlineStatic = $underlineStatic; // TODO: move static underline on screen resize

		this.$defaultElement = $defaultElement;
		this.position = {};

		this.revertPosition();
		$underlineStatic.css(this._getTargetPos($defaultElement));
	}

	_getMenuPos() {
		return this.$menu[0].getBoundingClientRect();
	}
	_getTargetPos($target: JQuery) {
		const targetRect = $target[0].getBoundingClientRect();
		const menuPos = this._getMenuPos();
		return {
			left: targetRect.left - menuPos.left + 'px',
			top: targetRect.bottom - menuPos.top + 'px',
			width: targetRect.width + 'px',
		};
	}

	async animate(animationKeyframe: Keyframe, duration = 250) {
		const animation = this.underline.animate([animationKeyframe], { duration, easing: 'ease' });

		animation.oncancel = saveState.bind(this);
		animation.onfinish = saveState.bind(this);

		function saveState(this: UnderlineManipulator) {
			this.$underline.css(animationKeyframe as JQuery.PlainObject);
			this.position = animationKeyframe;
		}

		return animation.finished;
	}
	moveToTarget($target: JQuery) {
		this.animate(this._getTargetPos($target));
	}
	revertStatic() {
		this.$underlineStatic.css(this._getTargetPos(this.$defaultElement));
	}
	revertPosition(isRevertStatic = false) {
		this.moveToTarget(this.$defaultElement);
		if (isRevertStatic == true) this.revertStatic();
	}
}

$.when($.ready).then(() => {
	const pref = '.header__menu'; // prefix for current folder

	const $underlineStatic = $(pref + '-underline');
	const $underline = $(pref + '-underline_main');
	const $menu = $(pref);
	const $lis = $<HTMLAnchorElement>(pref + '-li');

	const currentLi = $lis.toArray().find((li) => li.classList.contains('header__menu-li_current'));
	let $currentLi;

	if (!currentLi) {
		$currentLi = $lis.first();
	} else {
		$currentLi = $(currentLi);
	}

	const locationPathname = window.location.pathname.split('/');
	let currentPage = locationPathname.pop();
	if (!currentPage) currentPage = locationPathname.pop();

	$currentLi.on('click', (e) => e.preventDefault());

	const manipulator = new UnderlineManipulator($underlineStatic, $underline, $currentLi, $menu);

	window.menuManipulator = manipulator;

	let hoveredLi: HTMLElement | undefined;
	const revertTimediffer = new Timediffer(500);
	const resizeTimediffer = new Timediffer(500);

	$lis.on('mouseenter', liHoverIn);
	$lis.on('mouseleave', liHoverOut);

	$(window).on('resize', () => {
		resizeTimediffer.ifReached(() => {
			if (window.innerWidth > window.MOBILE_BREAK) $(pref + '-content').css('display', '');
			manipulator.revertPosition(true);
		});
	});

	async function liHoverIn(e: JQuery.TriggeredEvent) {
		hoveredLi = e.target as HTMLElement;
		manipulator.moveToTarget($(hoveredLi));
	}

	function liHoverOut() {
		hoveredLi = undefined;

		revertTimediffer.ifReached(() => {
			if (!hoveredLi) manipulator.revertPosition();
		});
	}

	// Wry menu on load fix
	setTimeout(() => manipulator.revertPosition(true), 50);
});
