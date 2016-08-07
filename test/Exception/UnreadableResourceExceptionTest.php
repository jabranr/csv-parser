<?php namespace Jabran\Tests\Exception;

use Jabran\Exception\UnreadableResourceException;

/**
 * UnreadableResourceException
 */
class UnreadableResourceExceptionTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @expectedException Jabran\Exception\UnreadableResourceException
	 */
	public function testMatchException() {
		throw new UnreadableResourceException('foo');
	}
}
