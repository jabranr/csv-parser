<?php namespace Jabran\Test\Exception;

/**
 * InvalidPathException
 */

class InvalidPathExceptionTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @expectedException \Jabran\Exception\InvalidPathException
	 */
	public function testMatchException() {
		throw new \Jabran\Exception\InvalidPathException('foo');
	}
}