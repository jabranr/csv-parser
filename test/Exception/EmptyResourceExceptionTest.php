<?php namespace Jabran\Tests\Exception;

use Jabran\Exception\EmptyResourceException;

/**
 * EmptyResourceException
 */
class EmptyResourceExceptionTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @expectedException Jabran\Exception\EmptyResourceException
	 */
	public function testMatchException() {
		throw new EmptyResourceException('foo');
	}
}
