<?php namespace Jabran\Tests\Exception;

use PHPUnit\Framework\TestCase;
use Jabran\Exception\InvalidAccessException;

/**
 * InvalidAccessException
 */
class InvalidAccessExceptionTest extends TestCase {
    public function testMatchException() {
        $this->expectException(InvalidAccessException::class);
		throw new InvalidAccessException('foo');
	}
}
