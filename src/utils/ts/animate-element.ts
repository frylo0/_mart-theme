export function animateElement(
	$element: JQuery,
	animationKeyframe: Keyframe,
	options: KeyframeAnimationOptions = { duration: 250 }
) {
	const animation = $element[0].animate([animationKeyframe], options);

	animation.onfinish = () => {
		$element.css(animationKeyframe as JQuery.PlainObject);
	};

	return animation.finished;
}
