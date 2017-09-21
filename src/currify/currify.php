<?php

namespace Dash;

/**
 * Creates a new, curried version of `$callable` where the first `$rotate` arguments
 * are moved to the end of the arguments list.
 *
 * In essence, this takes a data-first function and returns a curryable data-last function.
 *
 * @see curry(), partial()
 *
 * @category Callable
 * @param callable $callable
 * @param array $args (optional) Initial arguments to pass to the final curried function
 * @param integer $rotate (optional) The number of arguments to move from start to end; see Dash\rotate()
 * @return function|mixed
 *
 * @example
	$greet = function ($name, $greeting, $punctuation) {
		return "$greeting, $name$punctuation";
	};

	$goodMorning = Dash\currify($greet, ['Good morning', '!']);
	$goodMorning('John')
	// === 'Good morning, John!'
 *
 * @example With a custom `$rotate`
	$greet = function ($salutation, $name, $greeting, $punctuation) {
		return "$greeting, $salutation $name$punctuation";
	};

	$goodMorning = Dash\currify($greet, ['Good morning', '!'], 2);
	$goodMorning('Sir', 'John')
	// === 'Good morning, Sir John!'
 */
function currify(callable $callable, array $args = [], $rotate = 1)
{
	$curryable = function () use ($callable, $rotate) {
		return call_user_func_array($callable, rotate(func_get_args(), -$rotate));
	};

	$totalArgs = (new \ReflectionFunction($callable))->getNumberOfParameters();
	$curried = call_user_func_array('Dash\curryN', [$curryable, $totalArgs]);

	return call_user_func_array($curried, $args);
}
