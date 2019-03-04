<?php namespace Jabran\Tests\Exception;

use PHPUnit\Framework\TestCase;
use Jabran\Exception\InvalidArgumentException;

/**
 * InvalidArgumentException
 */
class InvalidArgumentExceptionTest extends TestCase {
    public function testMatchException() {
        $this->expectException(InvalidArgumentException::class);
		throw new InvalidArgumentException('foo');
	}
}
