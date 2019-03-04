<?php namespace Jabran\Tests\Exception;

use PHPUnit\Framework\TestCase;
use Jabran\Exception\InvalidDataTypeException;

/**
 * InvalidDataTypeException
 */
class InvalidDataTypeExceptionTest extends TestCase {
    public function testMatchException() {
        $this->expectException(InvalidDataTypeException::class);
		throw new InvalidDataTypeException('foo');
	}
}
