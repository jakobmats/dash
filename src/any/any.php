<?php

namespace Dash;

function any($collection, $predicate)
{
	if (isEmpty($collection)) {
		return false;
	}

	foreach ($collection as $key => $value) {
		if (call_user_func($predicate, $value, $key)) {
			return true;
		}
	}

	return false;
}