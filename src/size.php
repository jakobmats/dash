<?php

namespace Dash;

/**
 * Gets the number of items in `$value`.
 *
 * For iterables, this is the number of elements.
 * For strings, this is number of characters.
 *
 * @param iterable|string $value
 * @param string $encoding (optional) The character encoding of `$value` if it is a string;
 *                         see `mb_list_encodings()` for the list of supported encodings
 * @return integer Size of `$value` or zero if `$value` is neither iterable nor a string
 *
 * @alias count
 *
 * @example
	Dash\size([1, 2, 3]);
	// === 3

	Dash\size('Beyoncé');
	// === 7
 */
function size($value, $encoding = 'UTF-8')
{
	if (is_array($value) || $value instanceof Countable) {
		$size = \count($value);
	}
	elseif (isType($value, ['iterable', 'stdClass'])) {
		$size = 0;
		foreach ($value as $value) {
			$size++;
		}
	}
	elseif (is_string($value)) {
		$size = function_exists('mb_strlen') ? mb_strlen($value, $encoding) : strlen($value);
	}
	else {
		$size = 0;
	}

	return $size;
}

function count()
{
	return call_user_func_array('Dash\size', func_get_args());
}
