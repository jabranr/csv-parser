<?php namespace Jabran\Tests\Exception;

use PHPUnit\Framework\TestCase;
use Jabran\Exception\InvalidPathException;

/**
 * InvalidPathException
 */
class InvalidPathExceptionTest extends TestCase {
    public function testMatchException() {
        $this->expectException(InvalidPathException::class);
		throw new InvalidPathException('foo');
	}
}
