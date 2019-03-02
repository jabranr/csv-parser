<?php namespace Jabran\Tests\Exception;

use PHPUnit\Framework\TestCase;
use Jabran\Exception\UnreadableResourceException;

/**
 * UnreadableResourceException
 */
class UnreadableResourceExceptionTest extends TestCase {

	/**
	 * @expectedException Jabran\Exception\UnreadableResourceException
	 */
	public function testMatchException() {
		throw new UnreadableResourceException('foo');
	}
}
