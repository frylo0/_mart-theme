/*
 * Author:  Fedor Nikonov (fritylo)
 * Date:    2023-03-26, 5:00:35 PM
 * Company: frity.org
 */

import './Cylinder.php';
import './Cylinder.scss';

import 'utils/php/attributes-string.php';

import $ from 'jquery';

type Point = {
	x: number;
	y: number;
};

type CursorPosition = Point;
type ScrollPosition = Point;

const CYLINDER_CONFIG = {
	ROTATION: {
		START_DEGREE: 90, // Basis rotation of cylinder
		FACTOR: 0.3, // 1 = screen width equals 180deg
	},
	RENDER: {
		RATE: 10, // Time in ms for setInterval
		PERSPECTIVE: 0.58, // Magic number representing fraction between heights of the most far and the nearest sides
		MARGIN_TOP: -100, // Control the Y shift of cylinder content
	},
	COLUMNS: 10, // Total number of columns (visible and free). This number used to calculate start rotation
};

const zeroPoint: Point = { x: 0, y: 0 };

class CylinderManager {
	private $cylinder: JQuery;

	private cylinder: HTMLDivElement;
	private frame: HTMLDivElement;
	private container: HTMLDivElement;
	private strip: HTMLDivElement;
	private sides: HTMLDivElement[];

	private cursorPosition: CursorPosition = { x: 0.5, y: 0.5 };
	private scrollPosition: ScrollPosition = { ...zeroPoint };

	private interval: NodeJS.Timeout | number = 0;

	constructor(cylinder: HTMLDivElement) {
		this.$cylinder = $(cylinder);

		this.cylinder = cylinder;

		this.frame = this.$cylinder.find('.cylinder-frame').get(0) as HTMLDivElement;
		this.container = this.$cylinder.find('.cylinder-container').get(0) as HTMLDivElement;
		this.strip = this.$cylinder.find('.strip').get(0) as HTMLDivElement;

		this.sides = $('.cylinder-l', this.strip).toArray() as HTMLDivElement[];

		$(window)
			.on('mousemove', this.onMousemove.bind(this))
			.on('scroll', this.onScroll.bind(this))
			.on('resize', this.onResize.bind(this));

		this.prepare();
		this.loop();
	}

	public loop() {
		const rate = CYLINDER_CONFIG.RENDER.RATE;

		this.interval = setInterval(() => {
			this.render();
		}, rate);
	}

	public killLoop() {
		clearInterval(this.interval);
	}

	public prepare() {
		this.fitContentHeight();
		this.renewScrollPosition();
	}

	private render() {
		this.frame.style.transform = `
			rotateY(${this.rotation}deg)
			translate(${this.frameShift.x}px, ${this.frameShift.y}px)
		`;

		this.container.style.transform = `
			translate(${this.containerShift.x}px, ${this.containerShift.y}px)
		`;
	}

	private get contentHeight(): number {
		const columnsHeight = this.sides
			.map((side) => parseFloat(getComputedStyle(side).height))
			.filter((height) => height);

		return Math.max(...columnsHeight);
	}

	private fitContentHeight() {
		this.frame.style.height = `${this.contentHeight}px`;
	}

	private renewScrollPosition() {
		const bounds = this.cylinder.getBoundingClientRect();

		this.scrollPosition = {
			x: bounds.left,
			y: bounds.top,
		};
	}

	private get rotation(): number {
		const percent = this.cursorPosition.x;

		const config = {
			start: CYLINDER_CONFIG.ROTATION.START_DEGREE,
			factor: CYLINDER_CONFIG.ROTATION.FACTOR,
			columns: CYLINDER_CONFIG.COLUMNS,
		};

		const columnDegree = 360 / config.columns;
		const columnHalfDegree = columnDegree / 2;

		const startDegree = config.start + columnHalfDegree; // 90 + 360 / N / 2 + 0
		const shift = (percent - 0.5) * 180 * config.factor;

		return startDegree + shift;
	}

	private get frameShift(): Point {
		return {
			x: 0,
			y: this.scrollPosition.y,
		};
	}

	private get containerShift(): Point {
		const perspective = CYLINDER_CONFIG.RENDER.PERSPECTIVE;
		const marginTop = CYLINDER_CONFIG.RENDER.MARGIN_TOP;

		return {
			x: 0,
			y: -1 * this.scrollPosition.y * perspective + marginTop,
		};
	}

	private onMousemove(e: JQuery.MouseMoveEvent) {
		this.cursorPosition = {
			x: e.clientX / window.innerWidth,
			y: e.clientY / window.innerHeight,
		};
	}

	private onScroll() {
		this.renewScrollPosition();
	}

	private onResize() {
		this.prepare();
	}
}

type HTMLCylinderElement = HTMLDivElement & { manager: CylinderManager };

$.when($.ready).then(() => {
	const $cylinders = $<HTMLCylinderElement>('.cylinder');

	$cylinders.each((i, cylinder) => {
		cylinder.manager = new CylinderManager(cylinder);
	});
});
