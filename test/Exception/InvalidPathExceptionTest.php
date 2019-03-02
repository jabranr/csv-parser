<?php namespace Jabran\Tests\Exception;

use PHPUnit\Framework\TestCase;
use Jabran\Exception\InvalidPathException;

/**
 * InvalidPathException
 */
class InvalidPathExceptionTest extends TestCase {

	/**
	 * @expectedException Jabran\Exception\InvalidPathException
	 */
	public function testMatchException() {
		throw new InvalidPathException('foo');
	}
}
