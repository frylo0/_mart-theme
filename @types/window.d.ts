import { UnderlineManipulator } from 'common/Header/HeaderMenu/HeaderMenu';
import { EventoneStore } from 'utils/ts/eventone';

declare global {
	interface Window {
		menuManipulator: UnderlineManipulator;
		MOBILE_BREAK: number;
		__EVENTONE__: EventoneStore;
	}
}
