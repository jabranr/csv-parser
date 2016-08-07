<?php namespace Jabran\Tests\Exception;

use Jabran\Exception\InvalidDataException;

/**
 * InvalidDataException
 */
class InvalidDataExceptionTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @expectedException Jabran\Exception\InvalidDataException
	 */
	public function testMatchException() {
		throw new InvalidDataException('foo');
	}
}
