<?php

class lastTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($collection, $expected)
	{
		$actual = Dash\last($collection);
		$this->assertEquals($expected, $actual);
	}

	public function cases()
	{
		return array(
			'With an empty array' => array(
				[],
				null
			),
			'With a non-empty array' => array(
				array('a', 'b', 'c'),
				'c'
			),
			'With a non-empty array with null as the last element' => array(
				array('a', 'b', null),
				null
			),
		);
	}
}
