<?php namespace Jabran\Tests\Exception;

use PHPUnit\Framework\TestCase;
use Jabran\Exception\InvalidArgumentException;

/**
 * InvalidArgumentException
 */
class InvalidArgumentExceptionTest extends TestCase {

	/**
	 * @expectedException Jabran\Exception\InvalidArgumentException
	 */
	public function testMatchException() {
		throw new InvalidArgumentException('foo');
	}
}
