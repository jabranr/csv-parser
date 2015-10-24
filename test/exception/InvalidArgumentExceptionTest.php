<?php namespace Jabran\Test\Exception;

/**
 * InvalidArgumentException
 */

class InvalidArgumentExceptionTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @expectedException \Jabran\Exception\InvalidArgumentException
	 */
	public function testMatchException() {
		throw new \Jabran\Exception\InvalidArgumentException('foo');
	}
}