<?php namespace Jabran\Tests\Exception;

use Jabran\Exception\InvalidAccessException;

/**
 * InvalidAccessException
 */
class InvalidAccessExceptionTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @expectedException Jabran\Exception\InvalidAccessException
	 */
	public function testMatchException() {
		throw new InvalidAccessException('foo');
	}
}
