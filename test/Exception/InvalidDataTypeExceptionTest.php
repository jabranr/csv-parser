<?php namespace Jabran\Tests\Exception;

use PHPUnit\Framework\TestCase;
use Jabran\Exception\InvalidDataTypeException;

/**
 * InvalidDataTypeException
 */
class InvalidDataTypeExceptionTest extends TestCase {

	/**
	 * @expectedException Jabran\Exception\InvalidDataTypeException
	 */
	public function testMatchException() {
		throw new InvalidDataTypeException('foo');
	}
}
