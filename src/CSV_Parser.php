<?php

/**
 * CSV_Parser class
 *
 * Parse CSV data from a file, stream or string
 *
 * @author: hello@jabran.me
 * @version: 2.0.1
 * @license: MIT License
 * @link: https://github.com/jabranr/csv-parser
 */


class CSV_Parser {

	/**
	 * @var string $data
	 * @var array $headers
	 */
	protected $data;
	protected $headers;


	/**
	 * Constructor
	 */
	public function __construct() {
		$this->data = null;
		return $this;
	}


	/**
	 * Get data from a file
	 *
	 * @param string $file
	 * @return object|class
	 */
	public function fromFile( $file ) {
		if ( file_exists($file) && is_readable($file) )
			$this->data = file_get_contents($file);
		return $this;
	}


	/**
	 * Get data from PHP stream
	 *
	 * @param stream $stream
	 * @return object|class
	 */
	public function fromStream( $stream ) {
		if ( $stream )
			$this->data = $stream;
		return $this;
	}



	/**
	 * Get data from simple string
	 *
	 * @param string $str
	 * @return object|class
	 */
	public function fromString( $str ) {
		if ( $str )
			$this->data = $str;
		return $this;
	}


	/**
	 * Parse data
	 *
	 * @return array
	 */
	public function parse( $headers = true ) {
		if ( ! $this->data )
			return array();

		// Make columns
		$this->makeColumns();

		// Make rows with header
		if ( $headers )
			return $this->makeRowsWithHeader();

		// Make rows without header
		return $this->makeRows();
	}


	/**
	 * Split data for line breaks to make columns
	 *
	 * @return array
	 */
	private function makeColumns() {
		if ( ! $this->data )
			return array();

		if ( preg_match('/[^\x20-\x7f]/', $this->data) ) {
			$this->data = preg_split('/[^\x20-\x7f]/', $this->data);
		}
		else if ( strpos($this->data, ';') !== false ) {
			$this->data = explode(';', $this->data);
		}
		else {
			$this->data = explode('\n', $this->data);
		}

		return $this;
	}


	/**
	 * Make an optional header row
	 *
	 * @return array
	 */
	private function makeRowsWithHeader() {
		$data = array();
		if ( ! $this->data || ! is_array($this->data) )
			return $data;

		if ( count($this->data) ) {
			$rows = $this->makeRows();
			$this->headers = $rows[0];
			array_shift($rows);

			foreach ($rows as $row) {

				// Ignore rows that do not have same length
				if ( count($this->headers) !== count($row) )
					continue;

				$data[] = array_combine($this->headers, $row);
			}
		}

		return $data;
	}


	/**
	 * Make rows
	 *
	 * @return array
	 */
	private function makeRows() {
		$data = array();

		if ( ! $this->data || ! is_array($this->data) )
			return $data;

		if ( count($this->data) ) {
			foreach ($this->data as $rows) {
				$data[] = str_getcsv($rows, ',');
			}
		}
		return $data;
	}
}
