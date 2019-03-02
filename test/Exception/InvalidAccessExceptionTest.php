<?php namespace Jabran\Tests\Exception;

use PHPUnit\Framework\TestCase;
use Jabran\Exception\InvalidAccessException;

/**
 * InvalidAccessException
 */
class InvalidAccessExceptionTest extends TestCase {

	/**
	 * @expectedException Jabran\Exception\InvalidAccessException
	 */
	public function testMatchException() {
		throw new InvalidAccessException('foo');
	}
}
