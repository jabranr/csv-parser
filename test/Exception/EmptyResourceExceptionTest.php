<?php namespace Jabran\Tests\Exception;

/**
 * EmptyResourceException
 */

class EmptyResourceExceptionTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @expectedException \Jabran\Exception\EmptyResourceException
	 */
	public function testMatchException() {
		throw new \Jabran\Exception\EmptyResourceException('foo');
	}
}