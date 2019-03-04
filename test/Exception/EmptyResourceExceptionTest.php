<?php namespace Jabran\Tests\Exception;

use PHPUnit\Framework\TestCase;
use Jabran\Exception\EmptyResourceException;

/**
 * EmptyResourceException
 */
class EmptyResourceExceptionTest extends TestCase {
	public function testMatchException() {
        $this->expectException(EmptyResourceException::class);
		throw new EmptyResourceException('foo');
	}
}
