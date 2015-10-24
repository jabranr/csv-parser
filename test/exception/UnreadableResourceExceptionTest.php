<?php namespace Jabran\Test\Exception;

/**
 * UnreadableResourceException
 */

class UnreadableResourceExceptionTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @expectedException \Jabran\Exception\UnreadableResourceException
	 */
	public function testMatchException() {
		throw new \Jabran\Exception\UnreadableResourceException('foo');
	}
}