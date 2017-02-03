<?php namespace Jabran\Tests;

use Jabran\CSV_Parser;

/**
 * Unit test for CSV_Parser
 */
class CSV_ParserTest extends \PHPUnit_Framework_TestCase {

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
	public function setUp() {
		$this->csv = new CSV_Parser;
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
	public function tearDown() {
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
		return $this->assertObjectHasAttribute('encoding', $this->csv);
	}

	/**
	 * Test existence of $data attribute
	 */
	public function testDataAttribute_Existence() {
		return $this->assertObjectHasAttribute('data', $this->csv);
	}

	/**
	 * Test existence of $headers attribute
	 */
	public function testHeadersAttribute_Existence() {
		return $this->assertObjectHasAttribute('headers', $this->csv);
	}

	/**
	 * Test existence of $columns attribute
	 */
	public function testColumnsAttribute_Existence() {
		return $this->assertObjectHasAttribute('columns', $this->csv);
	}

	/**
	 * Test existence of $rows attribute
	 */
	public function testRowsAttribute_Existence() {
		return $this->assertObjectHasAttribute('rows', $this->csv);
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
		return $this->assertNull($this->csv->getData());
	}

	/**
	 * Test default value for $headers attribute
	 */
	public function testHeadersAttribute_DefaultValue() {
		return $this->assertNull($this->csv->getHeaders());
	}

	/**
	 * Test default value for $columns attribute
	 */
	public function testColumnsAttribute_DefaultValue() {
		return $this->assertNull($this->csv->getColumns());
	}

	/**
	 * Test default value for $rows attribute
	 */
	public function testRowsAttribute_DefaultValue() {
		return $this->assertNull($this->csv->getRows());
	}

	/**
	 * ---------------------------------------------------------------
	 * Jabran\CSV_Parser::setEncoding tests
	 * ---------------------------------------------------------------
	 */

	/**
	 * Test setEncoding method
	 */
	public function testSetEncoding_NoArguments() {
	    return $this->csv->setEncoding(null);
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
	    return $this->csv->setEncoding('UTF-8');
	}

	/**
	 * ---------------------------------------------------------------
	 * Jabran\CSV_Parser::setData tests
	 * ---------------------------------------------------------------
	 */

	/**
	 * Test setData method
	 * @expectedException Jabran\Exception\InvalidArgumentException
	 */
	public function testSetData_NoArguments() {
		return $this->csv->setData();
	}

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
		return $this->assertNotNull($this->csv->getData());
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
		return $this->assertNull($this->csv->getData());
	}

	/**
	 * Test getData method
	 */
	public function testGetData_WithData() {
		$this->csv->setData($this->sampleInput);
		return $this->assertNotNull($this->csv->getData());
	}

	/**
	 * ---------------------------------------------------------------
	 * Jabran\CSV_Parser::setHeaders tests
	 * ---------------------------------------------------------------
	 */

	/**
	 * Test setHeaders method
	 * @expectedException Jabran\Exception\InvalidArgumentException
	 */
	public function testSetHeaders_NoArguments() {
		return $this->csv->setHeaders();
	}

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
		return $this->assertNotNull($this->csv->getHeaders());
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
		return $this->assertNull($this->csv->getHeaders());
	}

	/**
	 * Test getHeaders method
	 */
	public function testGetHeaders_WithData() {
		$this->csv->setHeaders(array());
		return $this->assertNotNull($this->csv->getHeaders());
	}

	/**
	 * ---------------------------------------------------------------
	 * Jabran\CSV_Parser::setColumns tests
	 * ---------------------------------------------------------------
	 */

	/**
	 * Test setColumns method
	 * @expectedException Jabran\Exception\InvalidArgumentException
	 */
	public function testSetColumns_NoArguments() {
		return $this->csv->setColumns();
	}

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
		return $this->assertNotNull($this->csv->getColumns());
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
		return $this->assertNull($this->csv->getColumns());
	}

	/**
	 * Test getColumns method
	 */
	public function testGetColumns_WithData() {
		$this->csv->fromString($this->sampleInput);
		$this->csv->parse();
		return $this->assertNotNull($this->csv->getColumns());
	}

	/**
	 * ---------------------------------------------------------------
	 * Jabran\CSV_Parser::setRows tests
	 * ---------------------------------------------------------------
	 */

	/**
	 * Test setRows method
	 * @expectedException Jabran\Exception\InvalidArgumentException
	 */
	public function testSetRows_NoArguments() {
		return $this->csv->setRows();
	}

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
		return $this->assertNotNull($this->csv->getRows());
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
		return $this->assertNull($this->csv->getRows());
	}

	/**
	 * Test getRows method
	 */
	public function testGetRows_WithData() {
		$this->csv->fromString($this->sampleInput);
		$this->csv->parse();
		return $this->assertNotNull($this->csv->getRows());
	}





	/**
	 * ---------------------------------------------------------------
	 * Jabran\CSV_Parser::fromFile tests
	 * ---------------------------------------------------------------
	 */

	/**
	 * Test fromFile method
	 * @expectedException Jabran\Exception\InvalidPathException
	 */
	public function testFromFile_NoArguments() {
		return $this->csv->fromFile();
	}

	/**
	 * Test fromFile method
	 * @expectedException Jabran\Exception\InvalidPathException
	 */
	public function testFromFile_WithArray() {
		return $this->csv->fromFile(array());
	}

	/**
	 * Test fromFile method
	 * @expectedException Jabran\Exception\InvalidPathException
	 */
	public function testFromFile_WithNumber() {
		return $this->csv->fromFile(10);
	}

	/**
	 * Test fromFile method
	 * @expectedException Jabran\Exception\InvalidPathException
	 */
	public function testFromFile_WithFloat() {
		return $this->csv->fromFile(2.5);
	}

	/**
	 * Test fromFile method
	 * @expectedException Jabran\Exception\InvalidPathException
	 */
	public function testFromFile_WithBoolean() {
		return $this->csv->fromFile(true);
	}

	/**
	 * Test fromFile method
	 * @expectedException Jabran\Exception\InvalidAccessException
	 */
	public function testFromFile_InaccessiblePath() {
		return $this->csv->fromFile('/path/to/foo.txt');
	}

	/**
	 * Test fromFile method
	 * @expectedException Jabran\Exception\EmptyResourceException
	 */
	public function testFromFile_InvalidResource() {
		return $this->csv->fromFile($this->sampleEmptyFile);
	}

	/**
	 * Test fromFile method
	 */
	public function testFromFile_ValidFile() {
		$this->csv->fromFile($this->sampleDataFile);
		return $this->assertNotNull($this->csv->getData());
	}

	/**
	 * Test fromFile method
	 * @depends testFromFile_ValidFile
	 */
	public function testFromFile_DataType() {
		$this->csv->fromFile($this->sampleDataFile);
		return $this->assertEquals('string', gettype($this->csv->getData()));
	}

	/**
	 * ---------------------------------------------------------------
	 * Jabran\CSV_Parser::fromPath tests
	 * ---------------------------------------------------------------
	 */

	/**
	 * Test fromPath method
	 * @since 2.0.2
	 * @expectedException Jabran\Exception\InvalidPathException
	 */
	public function testFromPath_NoArguments() {
		return $this->csv->fromPath();
	}

	/**
	 * Test fromPath method
	 * @since 2.0.2
	 * @expectedException Jabran\Exception\InvalidPathException
	 */
	public function testFromPath_WithArray() {
		return $this->csv->fromPath(array());
	}

	/**
	 * Test fromPath method
	 * @since 2.0.2
	 * @expectedException Jabran\Exception\InvalidPathException
	 */
	public function testFromPath_WithNumber() {
		return $this->csv->fromPath(10);
	}

	/**
	 * Test fromPath method
	 * @since 2.0.2
	 * @expectedException Jabran\Exception\InvalidPathException
	 */
	public function testFromPath_WithFloat() {
		return $this->csv->fromPath(2.5);
	}

	/**
	 * Test fromPath method
	 * @since 2.0.2
	 * @expectedException Jabran\Exception\InvalidPathException
	 */
	public function testFromPath_WithBoolean() {
		return $this->csv->fromPath(true);
	}

	/**
	 * Test fromPath method
	 * @since 2.0.2
	 * @expectedException Jabran\Exception\InvalidAccessException
	 */
	public function testFromPath_InaccessiblePath() {
		return $this->csv->fromPath('/path/to/foo.txt');
	}

	/**
	 * Test fromPath method
	 * @since 2.0.2
	 * @expectedException Jabran\Exception\EmptyResourceException
	 */
	public function testFromPath_EmptyResource() {
		return $this->csv->fromPath($this->sampleEmptyFile);
	}

	/**
	 * Test fromPath method
	 * @since 2.0.2
	 */
	public function testFromPath_ValidFile() {
		$this->csv->fromPath($this->sampleDataFile);
		return $this->assertNotNull($this->csv->getData());
	}

	/**
	 * Test fromPath method
	 * @since 2.0.2
	 * @depends testFromPath_ValidFile
	 */
	public function testFromPath_DataType() {
		$this->csv->fromPath($this->sampleDataFile);
		return $this->assertEquals('string', gettype($this->csv->getData()));
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
	public function testFromString_NoArguments() {
		return $this->csv->fromString();
	}

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
		return $this->assertNotNull($this->csv->getData());
	}

	/**
	 * Test fromString method
	 * @depends testFromString_ValidString
	 */
	public function testFromString_DataType() {
		$this->csv->fromString($this->sampleInput);
		return $this->assertEquals('string', gettype($this->csv->getData()));
	}


	/**
	 * ---------------------------------------------------------------
	 * Jabran\CSV_Parser::fromStream tests
	 * ---------------------------------------------------------------
	 */

	/**
	 * Test fromStream method
	 * @expectedException Jabran\Exception\InvalidResourceException
	 */
	public function testFromStream_NoArguments() {
		return $this->csv->fromStream();
	}

	/**
	 * Test fromStream method
	 * @expectedException Jabran\Exception\InvalidResourceException
	 */
	public function testFromStream_WithArray() {
		return $this->csv->fromStream(array());
	}

	/**
	 * Test fromStream method
	 * @expectedException Jabran\Exception\InvalidResourceException
	 */
	public function testFromStream_WithNumber() {
		return $this->csv->fromStream(10);
	}

	/**
	 * Test fromStream method
	 * @expectedException Jabran\Exception\InvalidResourceException
	 */
	public function testFromStream_WithFloat() {
		return $this->csv->fromStream(2.5);
	}

	/**
	 * Test fromStream method
	 * @expectedException Jabran\Exception\InvalidResourceException
	 */
	public function testFromStream_WithBoolean() {
		return $this->csv->fromStream(true);
	}

	/**
	 * Test fromStream method
	 * @expectedException Jabran\Exception\InvalidResourceException
	 */
	public function testFromStream_WithString() {
		return $this->csv->fromStream('');
	}

	/**
	 * Test fromStream method
	 */
	public function testFromStream_ValidData() {
		$this->csv->fromStream($this->sampleStream());
		return $this->assertNotNull($this->csv->getData());
	}

	/**
	 * Test fromStream method
	 * @depends testFromStream_ValidData
	 */
	public function testFromStream_DataType() {
		$this->csv->fromStream($this->sampleStream());
		return $this->assertEquals('string', gettype($this->csv->getData()));
	}

	/**
	 * ---------------------------------------------------------------
	 * Jabran\CSV_Parser::fromResource tests
	 * ---------------------------------------------------------------
	 */

	/**
	 * Test fromResource method
	 * @since 2.0.2
	 * @expectedException Jabran\Exception\InvalidResourceException
	 */
	public function testFromResource_NoArguments() {
		return $this->csv->fromResource();
	}

	/**
	 * Test fromResource method
	 * @since 2.0.2
	 * @expectedException Jabran\Exception\InvalidResourceException
	 */
	public function testFromResource_WithArray() {
		return $this->csv->fromResource(array());
	}

	/**
	 * Test fromResource method
	 * @since 2.0.2
	 * @expectedException Jabran\Exception\InvalidResourceException
	 */
	public function testFromResource_WithNumber() {
		return $this->csv->fromResource(10);
	}

	/**
	 * Test fromResource method
	 * @since 2.0.2
	 * @expectedException Jabran\Exception\InvalidResourceException
	 */
	public function testFromResource_WithFloat() {
		return $this->csv->fromResource(2.5);
	}

	/**
	 * Test fromResource method
	 * @since 2.0.2
	 * @expectedException Jabran\Exception\InvalidResourceException
	 */
	public function testFromResource_WithBoolean() {
		return $this->csv->fromResource(true);
	}

	/**
	 * Test fromResource method
	 * @since 2.0.2
	 * @expectedException Jabran\Exception\InvalidResourceException
	 */
	public function testFromResource_WithString() {
		return $this->csv->fromResource('');
	}

	/**
	 * Test fromResource method
	 * @since 2.0.2
	 */
	public function testFromResource_ValidData() {
		$this->csv->fromResource($this->sampleStream());
		return $this->assertNotNull($this->csv->getData());
	}

	/**
	 * Test fromResource method
	 * @since 2.0.2
	 * @depends testFromResource_ValidData
	 */
	public function testFromResource_DataType() {
		$this->csv->fromResource($this->sampleStream());
		return $this->assertEquals('string', gettype($this->csv->getData()));
	}


	/**
	 * ---------------------------------------------------------------
	 * Jabran\CSV_Parser::convertEncoding tests
	 * ---------------------------------------------------------------
	 */

	/**
	 * Test convertEncoding method
	 * @expectedException Jabran\Exception\InvalidEncodingException
	 */
	public function testConvertEncoding_ASCIIToUTF8() {
		$this->csv->fromString($this->sampleInput);
		$this->csv->setEncoding('UTF-8');
		$this->csv->convertEncoding();
		return $this->assertEquals(
		    $this->csv->getEncoding(), 
		    mb_detect_encoding($this->csv->getData())
		);
	}

	/**
	 * Test convertEncoding method
	 */
	public function testConvertEncoding_UTF8ToASCII() {
		$this->csv->fromString($this->sampleInputUTF8);
		$this->csv->setEncoding('ASCII');
		$this->csv->convertEncoding();
		return $this->assertEquals(
		    $this->csv->getEncoding(), 
		    mb_detect_encoding($this->csv->getData())
		);
	}

	/**
	 * Test convertEncoding method
	 * @expectedException Jabran\Exception\InvalidEncodingException
	 */
	public function testConvertEncoding_UTF8ToUTF16() {
		$this->csv->fromString($this->sampleInputUTF8);
		$this->csv->setEncoding('UTF-16');
		$this->csv->convertEncoding();
		return $this->assertEquals(
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
		return $this->assertEquals(array(), $this->csv->parse());
	}

	/**
	 * Test parse method with sample data
	 */
	public function testParse_WithData() {
		$this->csv->fromString($this->sampleInput);
		$this->csv->parse();
		return $this->assertEquals('array', gettype($this->csv->getColumns()));
	}

	/**
	 * Test parse method with sample data to match expected output
	 */
	public function testParse_WithDataMatchOutput() {
		$this->csv->fromString($this->sampleInput);
		return $this->assertEquals($this->sampleOutput, $this->csv->parse());
	}

}
