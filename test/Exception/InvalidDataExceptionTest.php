<?php namespace Jabran\Tests\Exception;

use PHPUnit\Framework\TestCase;
use Jabran\Exception\InvalidDataException;

/**
 * InvalidDataException
 */
class InvalidDataExceptionTest extends TestCase {

	/**
	 * @expectedException Jabran\Exception\InvalidDataException
	 */
	public function testMatchException() {
		throw new InvalidDataException('foo');
	}
}
