<?php namespace Jabran\Tests\Exception;

use PHPUnit\Framework\TestCase;
use Jabran\Exception\EmptyResourceException;

/**
 * EmptyResourceException
 */
class EmptyResourceExceptionTest extends TestCase {

	/**
	 * @expectedException Jabran\Exception\EmptyResourceException
	 */
	public function testMatchException() {
		throw new EmptyResourceException('foo');
	}
}
