<?php namespace Jabran\Tests\Exception;

use Jabran\Exception\InvalidResourceException;

/**
 * InvalidResourceException
 */
class InvalidResourceExceptionTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @expectedException Jabran\Exception\InvalidResourceException
	 */
	public function testMatchException() {
		throw new InvalidResourceException('foo');
	}
}
