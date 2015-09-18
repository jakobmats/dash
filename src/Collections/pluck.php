<?php

namespace Dash\Collections;

/**
 * Gets the value at a path for all elements in a collection.
 *
 * @param array|object $collection
 * @param string $path Path of the property to retrieve; can be nested by
 *        delimiting each sub-property or array index with a period
 *
 * @return array
 *
 * @example
	Dash\Collections\pluck(
		array(
			array('a' => array('b' => 1)),
			array('a' => 'missing'),
			array('a' => array('b' => 3)),
			array('a' => array('b' => 4)),
		),
		'a.b',
		'default'
	) == array(1, 'default', 3, 4);
 */
function pluck($collection, $path, $default = null)
{
	return map($collection, property($path, $default));
}