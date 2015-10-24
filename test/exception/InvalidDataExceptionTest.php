<?php namespace Jabran\Test\Exception;

/**
 * InvalidDataException
 */

class InvalidDataExceptionTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @expectedException \Jabran\Exception\InvalidDataException
	 */
	public function testMatchException() {
		throw new \Jabran\Exception\InvalidDataException('foo');
	}
}