<?php namespace Jabran\Tests\Exception;

use PHPUnit\Framework\TestCase;
use Jabran\Exception\UnreadableResourceException;

/**
 * UnreadableResourceException
 */
class UnreadableResourceExceptionTest extends TestCase {
    public function testMatchException() {
        $this->expectException(UnreadableResourceException::class);
		throw new UnreadableResourceException('foo');
	}
}
