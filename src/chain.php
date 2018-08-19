<?php

namespace Dash;

/**
 * Creates a new chain. Alias for `_::chain()`.
 *
 * @category Utility
 * @param mixed $input (optional) Initial input value of the chain
 * @return Dash\_ A new chain
 *
 * @example
	Dash\chain([1, 2, 3])
		->filter(function ($n) { return $n < 3; })
		->map(function ($n) { return $n * 2; })
		->value();
	// === [2, 4]
 */
function chain($input = null)
{
	return _::chain($input);
}
