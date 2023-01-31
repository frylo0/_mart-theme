export class Timediffer {
	id?: NodeJS.Timeout;
	delay: number;

	constructor(delay: number) {
		this.id = undefined;
		this.delay = delay;
	}
	ifReached(callback: () => void) {
		clearInterval(this.id);
		this.id = setTimeout(callback, this.delay);
	}
}
