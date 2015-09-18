<?php

namespace Dash\Collections;

function at($collection, $index)
{
	$at = null;

	$i = 0;
	foreach ($collection as $key => $value) {
		$at = $value;
		if ($i === intval($index)) {
			break;
		}
		$i++;
	}

	return $at;
}