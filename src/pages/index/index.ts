import './index.php';
import './index.scss';

import 'blocks/Circle/Circle';
import 'sections/Slider/Slider';

import $ from 'jquery';

$.when($.ready).then(() => {
	alert('jQuery hello 1');
});
