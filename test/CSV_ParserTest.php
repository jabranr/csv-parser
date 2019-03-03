<?php namespace Jabran\Tests;

use PHPUnit\Framework\TestCase;
use Jabran\CSV_Parser;

/**
 * Unit test for CSV_Parser
 */
class CSV_ParserTest extends TestCase {

	/* @var Jabran\CSV_Parser */
	public $csv;

	/* @var string Sample data input */
	public $sampleInput;

	/* @var array Sample data output */
	public $sampleOutput;

	/* @var string Sample data file */
	public $sampleDataFile;

	/* @var string Sample empty file */
	public $sampleEmptyFile;

	/**
	 * Default setUp method
	 */
	protected function setUp() {
		$this->csv = new CSV_Parser();
		$this->sampleInput = 'name,homepage;CSV_Parser,https://github.com/jabranr/csv-parser';
		$this->sampleInputUTF8 = 'Zażółć gęślą jaźń,Zażółć gęślą jaźń';
		$this->sampleDataFile = __DIR__ . '/foo.txt';
		$this->sampleEmptyFile = __DIR__ . '/bar.txt';
		$this->sampleOutput = array(
			array(
				'name' => 'CSV_Parser',
				'homepage' => 'https://github.com/jabranr/csv-parser'
				)
            );
	}

	/**
	 * Default tearDown method
	 */
	protected function tearDown() {
		unset($this->csv);
		unset($this->sampleInput);
		unset($this->sampleDataFile);
		unset($this->sampleEmptyFile);
		unset($this->sampleOutput);
	}

	/**
	 * Create sample PHP input stream
	 */
	public function sampleStream() {
		return fopen($this->sampleDataFile, 'rb');
	}

	/**
	 * ---------------------------------------------------------------
	 * Jabran\CSV_Parser attribute existence tests
	 * ---------------------------------------------------------------
	 */

	/**
	 * Test existence of $encoding attribute
	 */
	public function testEncodingAttribute_Existence() {
		$this->assertObjectHasAttribute('encoding', $this->csv);
	}

	/**
	 * Test existence of $data attribute
	 */
	public function testDataAttribute_Existence() {
		$this->assertObjectHasAttribute('data', $this->csv);
	}

	/**
	 * Test existence of $headers attribute
	 */
	public function testHeadersAttribute_Existence() {
		$this->assertObjectHasAttribute('headers', $this->csv);
	}

	/**
	 * Test existence of $columns attribute
	 */
	public function testColumnsAttribute_Existence() {
		$this->assertObjectHasAttribute('columns', $this->csv);
	}

	/**
	 * Test existence of $rows attribute
	 */
	public function testRowsAttribute_Existence() {
		$this->assertObjectHasAttribute('rows', $this->csv);
	}

	/**
	 * ---------------------------------------------------------------
	 * Jabran\CSV_Parser default attribute value tests
	 * ---------------------------------------------------------------
	 */

	/**
	 * Test default value for $data attribute
	 */
	public function testDataAttribute_DefaultValue() {
		$this->assertEmpty($this->csv->getData());
	}

	/**
	 * Test default value for $headers attribute
	 */
	public function testHeadersAttribute_DefaultValue() {
		$this->assertEmpty($this->csv->getHeaders());
	}

	/**
	 * Test default value for $columns attribute
	 */
	public function testColumnsAttribute_DefaultValue() {
		$this->assertEmpty($this->csv->getColumns());
	}

	/**
	 * Test default value for $rows attribute
	 */
	public function testRowsAttribute_DefaultValue() {
		$this->assertEmpty($this->csv->getRows());
	}

	/**
	 * ---------------------------------------------------------------
	 * Jabran\CSV_Parser::setEncoding tests
	 * ---------------------------------------------------------------
	 */

	/**
	 * Test setEncoding method
     * @expectedException Jabran\Exception\InvalidEncodingException
	 */
	public function testSetEncoding_NoArguments() {
        $this->csv->setEncoding(null);
	}

	/**
	 * Test setEncoding method
	 * @expectedException Jabran\Exception\InvalidEncodingException
	 */
	public function testSetEncoding_ArgumentAsArray() {
		return $this->csv->setEncoding(array());
	}

	/**
	 * Test setEncoding method
	 * @expectedException Jabran\Exception\InvalidEncodingException
	 */
	public function testSetEncoding_ArgumentAsNumber() {
		return $this->csv->setEncoding(10);
	}

	/**
	 * Test setEncoding method
	 * @expectedException Jabran\Exception\InvalidEncodingException
	 */
	public function testSetEncoding_ArgumentAsFloat() {
	    return $this->csv->setEncoding(1.2);
	}

	/**
	 * Test setEncoding method
	 * @expectedException Jabran\Exception\InvalidEncodingException
	 */
	public function testSetEncoding_ArgumentAsBoolean() {
	    return $this->csv->setEncoding(true);
	}

	/**
	 * Test setEncoding method
	 * @expectedException Jabran\Exception\InvalidEncodingException
	 */
	public function testSetEncoding_ArgumentAsUnsupportedEncoding() {
	    return $this->csv->setEncoding('FOO-9');
	}

	/**
	 * Test setEncoding method
	 */
	public function testSetEncoding_ArgumentAsSupportedEncoding() {
        $this->csv->setEncoding('UTF-8');
        $this->assertEquals('UTF-8', $this->csv->getEncoding());
	}

	/**
	 * ---------------------------------------------------------------
	 * Jabran\CSV_Parser::setData tests
	 * ---------------------------------------------------------------
	 */

	/**
	 * Test setData method
	 * @expectedException Jabran\Exception\InvalidDataException
	 */
	public function testSetData_ArgumentAsArray() {
		return $this->csv->setData(array());
	}

	/**
	 * Test setData method
	 * @expectedException Jabran\Exception\InvalidDataException
	 */
	public function testSetData_ArgumentAsNumber() {
		return $this->csv->setData(10);
	}

	/**
	 * Test setData method
	 * @expectedException Jabran\Exception\InvalidDataException
	 */
	public function testSetData_ArgumentAsFloat() {
		return $this->csv->setData(2.5);
	}

	/**
	 * Test setData method
	 * @expectedException Jabran\Exception\InvalidDataException
	 */
	public function testSetData_ArgumentAsBoolean() {
		return $this->csv->setData(true);
	}

	/**
	 * Test setData method
	 */
	public function testSetData_ArgumentAsString() {
		$this->csv->setData($this->sampleInput);
		$this->assertNotNull($this->csv->getData());
	}

	/**
	 * ---------------------------------------------------------------
	 * Jabran\CSV_Parser::getData tests
	 * ---------------------------------------------------------------
	 */

	/**
	 * Test getData method
	 */
	public function testGetData_WithoutData() {
		$this->assertEmpty($this->csv->getData());
	}

	/**
	 * Test getData method
	 */
	public function testGetData_WithData() {
		$this->csv->setData($this->sampleInput);
		$this->assertNotEmpty($this->csv->getData());
	}

	/**
	 * ---------------------------------------------------------------
	 * Jabran\CSV_Parser::setHeaders tests
	 * ---------------------------------------------------------------
	 */


	/**
	 * Test setHeaders method
	 * @expectedException Jabran\Exception\InvalidDataException
	 */
	public function testSetHeaders_ArgumentAsString() {
		return $this->csv->setHeaders('');
	}

	/**
	 * Test setHeaders method
	 * @expectedException Jabran\Exception\InvalidDataException
	 */
	public function testSetHeaders_ArgumentAsNumber() {
		return $this->csv->setHeaders(10);
	}

	/**
	 * Test setHeaders method
	 * @expectedException Jabran\Exception\InvalidDataException
	 */
	public function testSetHeaders_ArgumentAsFloat() {
		return $this->csv->setHeaders(2.5);
	}

	/**
	 * Test setHeaders method
	 * @expectedException Jabran\Exception\InvalidDataException
	 */
	public function testSetHeaders_ArgumentAsBoolean() {
		return $this->csv->setHeaders(true);
	}

	/**
	 * Test setHeaders method
	 */
	public function testSetHeaders_ArgumentAsArray() {
		$this->csv->setHeaders(array());
		$this->assertEmpty($this->csv->getHeaders());
	}

	/**
	 * ---------------------------------------------------------------
	 * Jabran\CSV_Parser::getHeaders tests
	 * ---------------------------------------------------------------
	 */

	/**
	 * Test getHeaders method
	 */
	public function testGetHeaders_WithoutData() {
		$this->assertEmpty($this->csv->getHeaders());
	}

	/**
	 * Test getHeaders method
	 */
	public function testGetHeaders_WithData() {
		$this->csv->setHeaders(array());
		$this->assertNotNull($this->csv->getHeaders());
	}

	/**
	 * ---------------------------------------------------------------
	 * Jabran\CSV_Parser::setColumns tests
	 * ---------------------------------------------------------------
	 */

	/**
	 * Test setColumns method
	 * @expectedException Jabran\Exception\InvalidDataException
	 */
	public function testSetColumns_ArgumentAsArray() {
		return $this->csv->setColumns('');
	}

	/**
	 * Test setColumns method
	 * @expectedException Jabran\Exception\InvalidDataException
	 */
	public function testSetColumns_ArgumentAsNumber() {
		return $this->csv->setColumns(10);
	}

	/**
	 * Test setColumns method
	 * @expectedException Jabran\Exception\InvalidDataException
	 */
	public function testSetColumns_ArgumentAsFloat() {
		return $this->csv->setColumns(2.5);
	}

	/**
	 * Test setColumns method
	 * @expectedException Jabran\Exception\InvalidDataException
	 */
	public function testSetColumns_ArgumentAsBoolean() {
		return $this->csv->setColumns(true);
	}

	/**
	 * Test setColumns method
	 */
	public function testSetColumns_WithValidData() {
		$this->csv->fromString($this->sampleInput);
		$this->csv->parse();
		$this->assertNotNull($this->csv->getColumns());
	}

	/**
	 * ---------------------------------------------------------------
	 * Jabran\CSV_Parser::getColumns tests
	 * ---------------------------------------------------------------
	 */

	/**
	 * Test getColumns method
	 */
	public function testGetColumns_WithoutData() {
		$this->assertEmpty($this->csv->getColumns());
	}

	/**
	 * Test getColumns method
	 */
	public function testGetColumns_WithData() {
		$this->csv->fromString($this->sampleInput);
		$this->csv->parse();
		$this->assertNotNull($this->csv->getColumns());
	}

	/**
	 * ---------------------------------------------------------------
	 * Jabran\CSV_Parser::setRows tests
	 * ---------------------------------------------------------------
	 */

	/**
	 * Test setRows method
	 * @expectedException Jabran\Exception\InvalidDataException
	 */
	public function testSetRows_ArgumentAsArray() {
		return $this->csv->setRows('');
	}

	/**
	 * Test setRows method
	 * @expectedException Jabran\Exception\InvalidDataException
	 */
	public function testSetRows_ArgumentAsNumber() {
		return $this->csv->setRows(10);
	}

	/**
	 * Test setRows method
	 * @expectedException Jabran\Exception\InvalidDataException
	 */
	public function testSetRows_ArgumentAsFloat() {
		return $this->csv->setRows(2.5);
	}

	/**
	 * Test setRows method
	 * @expectedException Jabran\Exception\InvalidDataException
	 */
	public function testSetRows_ArgumentAsBoolean() {
		return $this->csv->setRows(true);
	}

	/**
	 * Test setRows method
	 */
	public function testSetRows_WithValidData() {
		$this->csv->fromString($this->sampleInput);
		$this->csv->parse();
		$this->assertNotNull($this->csv->getRows());
	}

	/**
	 * ---------------------------------------------------------------
	 * Jabran\CSV_Parser::getRows tests
	 * ---------------------------------------------------------------
	 */

	/**
	 * Test getRows method
	 */
	public function testGetRows_WithoutData() {
		$this->assertEmpty($this->csv->getRows());
	}

	/**
	 * Test getRows method
	 */
	public function testGetRows_WithData() {
		$this->csv->fromString($this->sampleInput);
		$this->csv->parse();
		$this->assertNotNull($this->csv->getRows());
	}


	/**
	 * ---------------------------------------------------------------
	 * Jabran\CSV_Parser::fromPath tests
	 * ---------------------------------------------------------------
	 */


	/**
	 * Test fromPath method
	 * @expectedException Jabran\Exception\InvalidPathException
	 */
	public function testFromPath_WithArray() {
		return $this->csv->fromPath(array());
	}

	/**
	 * Test fromPath method
	 * @expectedException Jabran\Exception\InvalidPathException
	 */
	public function testFromPath_WithNumber() {
		return $this->csv->fromPath(10);
	}

	/**
	 * Test fromPath method
	 * @expectedException Jabran\Exception\InvalidPathException
	 */
	public function testFromPath_WithFloat() {
		return $this->csv->fromPath(2.5);
	}

	/**
	 * Test fromPath method
	 * @expectedException Jabran\Exception\InvalidPathException
	 */
	public function testFromPath_WithBoolean() {
		return $this->csv->fromPath(true);
	}

	/**
	 * Test fromPath method
	 * @expectedException Jabran\Exception\InvalidAccessException
	 */
	public function testFromPath_InaccessiblePath() {
		return $this->csv->fromPath('/path/to/foo.txt');
	}

	/**
	 * Test fromPath method
	 * @expectedException Jabran\Exception\EmptyResourceException
	 */
	public function testFromPath_EmptyResource() {
		return $this->csv->fromPath($this->sampleEmptyFile);
	}

	/**
	 * Test fromPath method
	 */
	public function testFromPath_ValidFile() {
		$this->csv->fromPath($this->sampleDataFile);
		$this->assertNotNull($this->csv->getData());
	}

	/**
	 * Test fromPath method
	 * @depends testFromPath_ValidFile
	 */
	public function testFromPath_DataType() {
		$this->csv->fromPath($this->sampleDataFile);
		$this->assertEquals('string', gettype($this->csv->getData()));
	}

	/**
	 * ---------------------------------------------------------------
	 * Jabran\CSV_Parser::fromString tests
	 * ---------------------------------------------------------------
	 */

	/**
	 * Test fromString method
	 * @expectedException Jabran\Exception\InvalidDataTypeException
	 */
	public function testFromString_WithArray() {
		return $this->csv->fromString(array());
	}

	/**
	 * Test fromString method
	 * @expectedException Jabran\Exception\InvalidDataTypeException
	 */
	public function testFromString_WithNumber() {
		return $this->csv->fromString(10);
	}

	/**
	 * Test fromString method
	 * @expectedException Jabran\Exception\InvalidDataTypeException
	 */
	public function testFromString_WithFloat() {
		return $this->csv->fromString(2.5);
	}

	/**
	 * Test fromString method
	 * @expectedException Jabran\Exception\InvalidDataTypeException
	 */
	public function testFromString_WithBoolean() {
		return $this->csv->fromString(true);
	}

	/**
	 * Test fromString method
	 * @expectedException Jabran\Exception\EmptyResourceException
	 */
	public function testFromString_EmptyString() {
		return $this->csv->fromString('');
	}

	/**
	 * Test fromString method
	 */
	public function testFromString_ValidString() {
		$this->csv->fromString($this->sampleInput);
		$this->assertNotNull($this->csv->getData());
	}

	/**
	 * Test fromString method
	 * @depends testFromString_ValidString
	 */
	public function testFromString_DataType() {
		$this->csv->fromString($this->sampleInput);
		$this->assertEquals('string', gettype($this->csv->getData()));
	}

	/**
	 * ---------------------------------------------------------------
	 * Jabran\CSV_Parser::trimRecursively tests
	 * ---------------------------------------------------------------
	 */

	/**
	 * Test trim recursively for an integer
	 * @depends testFromString_DataType
	 */
	public function testTrimRecursivelyInteger() {
		$trimmed = $this->csv->trimRecursively(1);
		$this->assertEquals(1, $trimmed);
	}

	/**
	 * Test trim recursively for a string
	 * @depends testFromString_DataType
	 */
	public function testTrimRecursivelyString() {
		$trimmed = $this->csv->trimRecursively(' foo');
		$this->assertEquals('foo', $trimmed);
	}

	/**
	 * Test trim recursively for an array
	 * @depends testFromString_DataType
	 */
	public function testTrimRecursivelyArray() {
		$trimmed = $this->csv->trimRecursively(array(' foo', ' bar', ' baz'));
		$this->assertEquals(array('foo', 'bar', 'baz'), $trimmed);
	}

	/**
	 * Test trim recursively for associative array
	 * @depends testFromString_DataType
	 */
	public function testTrimRecursivelyAssociativeArray() {
		$trimmed = $this->csv->trimRecursively(array('foo' => ' bar', ' baz' => ' meow'));
		$this->assertEquals(array('foo' => 'bar', ' baz' => 'meow'), $trimmed);
	}



	/**
	 * ---------------------------------------------------------------
	 * Jabran\CSV_Parser::fromResource tests
	 * ---------------------------------------------------------------
	 */

	/**
	 * Test fromResource method
	 * @expectedException Jabran\Exception\InvalidResourceException
	 */
	public function testFromResource_WithArray() {
		return $this->csv->fromResource(array());
	}

	/**
	 * Test fromResource method
	 * @expectedException Jabran\Exception\InvalidResourceException
	 */
	public function testFromResource_WithNumber() {
		return $this->csv->fromResource(10);
	}

	/**
	 * Test fromResource method
	 * @expectedException Jabran\Exception\InvalidResourceException
	 */
	public function testFromResource_WithFloat() {
		return $this->csv->fromResource(2.5);
	}

	/**
	 * Test fromResource method
	 * @expectedException Jabran\Exception\InvalidResourceException
	 */
	public function testFromResource_WithBoolean() {
		return $this->csv->fromResource(true);
	}

	/**
	 * Test fromResource method
	 * @expectedException Jabran\Exception\InvalidResourceException
	 */
	public function testFromResource_WithString() {
		return $this->csv->fromResource('');
	}

	/**
	 * Test fromResource method
	 */
	public function testFromResource_ValidData() {
		$this->csv->fromResource($this->sampleStream());
		$this->assertNotNull($this->csv->getData());
	}

	/**
	 * Test fromResource method
	 * @depends testFromResource_ValidData
	 */
	public function testFromResource_DataType() {
		$this->csv->fromResource($this->sampleStream());
		$this->assertEquals('string', gettype($this->csv->getData()));
	}


	/**
	 * ---------------------------------------------------------------
	 * Jabran\CSV_Parser::encode tests
	 * ---------------------------------------------------------------
	 */

	/**
	 * Test encode method
	 * @expectedException Jabran\Exception\InvalidEncodingException
	 */
	public function testConvertEncoding_ASCIIToUTF8() {
		$this->csv->fromString($this->sampleInput);
		$this->csv->encode();
		$this->assertEquals(
		    $this->csv->getEncoding(),
		    mb_detect_encoding($this->csv->getData())
		);
	}

	/**
	 * Test encode method
	 */
	public function testConvertEncoding_UTF8ToASCII() {
		$this->csv->fromString($this->sampleInputUTF8);
		$this->csv->setEncoding('ASCII');
		$this->csv->encode();
		$this->assertEquals(
		    $this->csv->getEncoding(),
		    mb_detect_encoding($this->csv->getData())
		);
	}

	/**
	 * Test encode method
	 * @expectedException Jabran\Exception\InvalidEncodingException
	 */
	public function testConvertEncoding_UTF8ToUTF16() {
		$this->csv->fromString($this->sampleInputUTF8);
		$this->csv->setEncoding('UTF-16');
		$this->csv->encode();
		$this->assertEquals(
		    $this->csv->getEncoding(),
		    mb_detect_encoding($this->csv->getData())
		);
	}

	/**
	 * ---------------------------------------------------------------
	 * Jabran\CSV_Parser::parse tests
	 * ---------------------------------------------------------------
	 */

	/**
	 * Test parse method without any data
	 */
	public function testParse_WithoutData() {
		$this->assertEquals(array(), $this->csv->parse());
	}

	/**
	 * Test parse method with sample data
	 */
	public function testParse_WithData() {
		$this->csv->fromString($this->sampleInput);
		$this->csv->parse();
		$this->assertEquals('array', gettype($this->csv->getColumns()));
	}

	/**
	 * Test parse method with sample data to match expected output
	 */
	public function testParse_WithDataMatchOutput() {
		$this->csv->fromString($this->sampleInput);
		$this->assertEquals($this->sampleOutput, $this->csv->parse());
	}

}
