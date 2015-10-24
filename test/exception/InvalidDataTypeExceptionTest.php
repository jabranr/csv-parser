<?php namespace Jabran\Test\Exception;

/**
 * InvalidDataTypeException
 */

class InvalidDataTypeExceptionTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @expectedException \Jabran\Exception\InvalidDataTypeException
	 */
	public function testMatchException() {
		throw new \Jabran\Exception\InvalidDataTypeException('foo');
	}
}