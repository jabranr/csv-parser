<?php

/**
 * Unit test for CSV_Parser
 */

// require '../vendor/autoload.php';

class CSV_ParserTest extends PHPUnit_Framework_TestCase {
	public $data, $csv;

	public function setUp() {
		$this->data = 'id,first_name,last_name,email,phone;1,Dave,John,dave@john.com,0123456789;2,John,Davis,john@davis.com,0978564321';
		$this->csv = new CSV_Parser;
	}

	public function tearDown() {
		$this->csv = null;
	}

	/**
	 * @dataProvider testCaseCSVData
	 */
	public function testFromString($arr) {
		$this->csv->fromString($this->data);
		$result = $this->csv->parse();
		$this->assertEquals($result, $arr);
	}

	public function testCaseCSVData() {
		return array(
			array(
				array('id','first_name','last_name','email','phone'),
				array(1,'Dave','John','dave@john.com','0123456789'),
				array(2,'John','Davis','john@davis.com','0978564321')
			)
		);
	}
}