<?php namespace Jabran\Tests\Exception;

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