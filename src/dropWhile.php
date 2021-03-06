<?php

namespace Dash;

/**
 * @incomplete
 * Returns a subset of $iterable that excludes elements from the beginning.
 * Elements are dropped until $predicate returns falsey.
 *
 * @param iterable|stdClass $iterable
 * @param callable $predicate Invoked with ($value, $key, $iterable)
 * @return array
 */
function dropWhile($iterable, $predicate = 'Dash\identity')
{
	assertType($iterable, ['iterable', 'stdClass'], __FUNCTION__);

	$keys = [];
	$done = false;

	foreach ($iterable as $key => $value) {
		if (!$done && call_user_func($predicate, $value, $key, $iterable)) {
			continue;
		}
		else {
			$done = true;
			$keys[] = $key;
		}
	}

	return pick($iterable, $keys);
}
