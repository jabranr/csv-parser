<?php namespace Jabran\Tests\Exception;

use PHPUnit\Framework\TestCase;
use Jabran\Exception\InvalidResourceException;

/**
 * InvalidResourceException
 */
class InvalidResourceExceptionTest extends TestCase {

	/**
	 * @expectedException Jabran\Exception\InvalidResourceException
	 */
	public function testMatchException() {
		throw new InvalidResourceException('foo');
	}
}
