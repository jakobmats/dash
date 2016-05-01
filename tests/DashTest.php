<?php

use Dash\Dash;

class DashTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForStandalone
	 */
	public function testStandalone($method, $args, $expected)
	{
		$actual = call_user_func_array('Dash\Dash::' . $method, $args);
		$this->assertEquals($expected, $actual);
	}

	public function casesForStandalone()
	{
		return array(
			array(
				'map',
				array(array(1, 2, 3), function ($n) { return $n * 2; }),
				array(2, 4, 6),
			)
		);
	}

	/**
	 * @expectedException Exception
	 * @expectedExceptionMessage No callable method found for "foobar"
	 */
	public function testStandaloneInvalid()
	{
		Dash::foobar(array(1, 2, 3));
	}

	public function testWith()
	{
		$chain = Dash::with(array(1, 2, 3));
		$this->assertEquals(array(1, 2, 3), $chain->value());
	}

	public function testChainingWithInitialValue()
	{
		$chain = Dash::with(array(1, 2, 3))
			->map(function($n) { return $n * 2; })
			->filter(function($n) { return $n < 6; });

		$this->assertEquals(array(2, 4), $chain->value());
	}

	public function testChainingWithoutInitialValue()
	{
		$chain = Dash::with()
			->map(function($n) { return $n * 2; })
			->filter(function($n) { return $n < 6; });

		try {
			$chain->value();
			$this->assertFalse(true);
		}
		catch (Exception $e) {
			$this->assertTrue(true);
		}

		$actual = $chain->with(array(1, 2, 3))->value();
		$expected = array(2, 4);
		$this->assertEquals($expected, $actual);
	}

	public function testChainingReuse()
	{
		$chain = Dash::with(array(1, 2, 3))
			->map(function($n) { return $n * 2; });

		$this->assertEquals(array(2, 4, 6), $chain->value());

		$chain->with(array(4, 5, 6));

		$this->assertEquals(array(8, 10, 12), $chain->value());
	}
}
