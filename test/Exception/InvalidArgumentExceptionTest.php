<?php namespace Jabran\Tests\Exception;

use Jabran\Exception\InvalidArgumentException;

/**
 * InvalidArgumentException
 */
class InvalidArgumentExceptionTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @expectedException Jabran\Exception\InvalidArgumentException
	 */
	public function testMatchException() {
		throw new InvalidArgumentException('foo');
	}
}
