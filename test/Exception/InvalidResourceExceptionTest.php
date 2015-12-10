<?php namespace Jabran\Tests\Exception;

/**
 * InvalidResourceException
 */

class InvalidResourceExceptionTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @expectedException \Jabran\Exception\InvalidResourceException
	 */
	public function testMatchException() {
		throw new \Jabran\Exception\InvalidResourceException('foo');
	}
}