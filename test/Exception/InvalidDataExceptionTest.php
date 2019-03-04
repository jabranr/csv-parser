<?php namespace Jabran\Tests\Exception;

use PHPUnit\Framework\TestCase;
use Jabran\Exception\InvalidDataException;

/**
 * InvalidDataException
 */
class InvalidDataExceptionTest extends TestCase {
    public function testMatchException() {
        $this->expectException(InvalidDataException::class);
        throw new InvalidDataException('foo');
	}
}
