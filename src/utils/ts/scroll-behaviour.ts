import $ from 'jquery';

export type EventTypes = 'scroll' | 'scroll down' | 'scroll up' | 'start scroll down' | 'start scroll up';
export type EventHandler = (e: JQuery.ScrollEvent | undefined) => void;

export class ScrollBehaviour {
	prevScroll: number;
	scrollDirection: 'up' | 'down' | null;
	handlers: Record<string, EventHandler[]>;

	constructor() {
		this.prevScroll = 0;
		this.scrollDirection = null;
		this.handlers = {};

		$(window).on('scroll', (e) => this.catchScroll(e));
	}

	catchScroll(e: JQuery.ScrollEvent) {
		const currScroll = window.scrollY;
		const prevScrollDirection = this.scrollDirection;

		this.scrollDirection = this.prevScroll < currScroll ? 'down' : 'up';
		this.prevScroll = currScroll;

		this.trigger('scroll', e);
		if (prevScrollDirection != this.scrollDirection) this.changeDirectionHandler(e);
		else {
			if (this.scrollDirection == 'up') this.trigger('scroll up', e);
			else this.trigger('scroll down', e);
		}
	}

	changeDirectionHandler(e: JQuery.ScrollEvent) {
		if (this.scrollDirection == 'down') this.trigger('start scroll down', e);
		else if (this.scrollDirection == 'up') this.trigger('start scroll up', e);
	}

	subscribe(eventType: EventTypes, callback: EventHandler) {
		if (!this.handlers[eventType]) this.handlers[eventType] = [];
		this.handlers[eventType].push(callback);
	}

	trigger(eventType: EventTypes, e: JQuery.ScrollEvent | undefined = undefined) {
		if (!this.handlers[eventType]) return;
		for (const callback of this.handlers[eventType]) setTimeout(() => callback(e), 0);
	}
}

export const scrollBehaviour = new ScrollBehaviour();
