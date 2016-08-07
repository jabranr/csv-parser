<?php namespace Jabran\Tests\Exception;

use Jabran\Exception\InvalidPathException;

/**
 * InvalidPathException
 */
class InvalidPathExceptionTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @expectedException Jabran\Exception\InvalidPathException
	 */
	public function testMatchException() {
		throw new InvalidPathException('foo');
	}
}
