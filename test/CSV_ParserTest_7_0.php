<?php declare(strict_types=1);

namespace Jabran\Tests;

use PHPUnit\Framework\TestCase;
use Jabran\CSV_Parser;

/**
 * Unit test for CSV_Parser
 */
class CSV_ParserTest_7_0 extends TestCase {

	/* @var CSV_Parser */
	public $csv;

	/* @var string Sample data input */
	public $sampleInput;

	/* @var string Sample data input with accent characters */
	public $sampleInputUTF8;

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
}
