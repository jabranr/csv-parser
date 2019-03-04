<?php namespace Jabran\Tests\Exception;

use PHPUnit\Framework\TestCase;
use Jabran\Exception\InvalidResourceException;

/**
 * InvalidResourceException
 */
class InvalidResourceExceptionTest extends TestCase {
    public function testMatchException() {
        $this->expectException(InvalidResourceException::class);
		throw new InvalidResourceException('foo');
	}
}
