<?php namespace Jabran\Tests\Exception;

use Jabran\Exception\InvalidDataTypeException;

/**
 * InvalidDataTypeException
 */
class InvalidDataTypeExceptionTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @expectedException Jabran\Exception\InvalidDataTypeException
	 */
	public function testMatchException() {
		throw new InvalidDataTypeException('foo');
	}
}
