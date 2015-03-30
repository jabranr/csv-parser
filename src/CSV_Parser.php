<?php

/**
 * CSV_Parser class
 *
 * Parse CSV data from a file, stream or string
 *
 * @author: hello@jabran.me
 * @version: 1.0.1
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

		$data = array();
		
		if ( strpos($this->data, ';') !== false ) {
			$lines = explode(';', $this->data);
		}
		else {
			$lines = explode('\n', $this->data);
		}

		$data = array();
		if ( $lines && count($lines) ) {
			$arr = array();
			foreach ($lines as $line) {
				$arr[] = str_getcsv($line, ',');
			}

			if ( $headers ) {
				$this->headers = $arr[0];
				array_shift($arr);

				foreach ($arr as $dataArr) {
					$data[] = array_combine($this->headers, $dataArr);
				}
			}
			else {
				$data = $arr;
			}
		}

		return $data;
	}

}