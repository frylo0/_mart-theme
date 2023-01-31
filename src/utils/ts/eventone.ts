type EventoneStoreItem = [number, EventoneCallback];
export type EventoneStore = Record<
	string,
	{
		before: EventoneStoreItem[];
		after: EventoneStoreItem[];
	}
>;

type EventoneCallback = (...args: EventoneArgs) => void;
type EventoneArgs = any[];
type EventoneLabel = string | string[];

const __EVENTONE__: EventoneStore = {};

export function action(label: string, inPlaceCallback?: EventoneCallback) {
	return function (...args: EventoneArgs) {
		let reactors;

		if (__EVENTONE__[label])
			// giving shorten name
			reactors = __EVENTONE__[label];

		if (reactors) {
			// reactors before main reactor
			if (Array.isArray(reactors.before) && reactors.before.length > 0)
				reactors.before.forEach(([, reactor]) => reactor(...args));
			// main reactor with 0 callPlace
			if (inPlaceCallback) inPlaceCallback(...args);
			// reactors after main reactor
			if (Array.isArray(reactors.after) && reactors.after.length > 0)
				reactors.after.forEach(([, reactor]) => reactor(...args));
		} else if (inPlaceCallback) {
			inPlaceCallback(...args); //just main reactor call
		}
	};
}

export function when(actionLabel: EventoneLabel, reactor: EventoneCallback, callPlace = 0) {
	if (typeof actionLabel == 'string') {
		whenLogic(actionLabel);
	} else if (Array.isArray(actionLabel)) {
		for (let singleActionLabel of actionLabel) {
			whenLogic(singleActionLabel);
		}
	}

	function whenLogic(actionLabel: string) {
		let placeDimension: 'before' | 'after' = callPlace < 0 ? 'before' : 'after';
		if (!__EVENTONE__[actionLabel])
			// check actionLabel exist
			__EVENTONE__[actionLabel] = {
				before: [],
				after: [],
			}; // create if not

		__EVENTONE__[actionLabel][placeDimension].push([callPlace, reactor]); // pushing reactor inside
		__EVENTONE__[actionLabel][placeDimension].sort((a, b) => a[0] - b[0]); // sorting reactors by callPlace
	}
}

window.__EVENTONE__ = __EVENTONE__;
