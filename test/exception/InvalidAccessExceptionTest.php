<?php namespace Jabran\Test\Exception;

/**
 * InvalidAccessException
 */

class InvalidAccessExceptionTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @expectedException \Jabran\Exception\InvalidAccessException
	 */
	public function testMatchException() {
		throw new \Jabran\Exception\InvalidAccessException('foo');
	}
}