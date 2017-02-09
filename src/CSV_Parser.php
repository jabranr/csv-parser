<?php

namespace Jabran;

use Jabran\Exception\InvalidPathException;
use Jabran\Exception\InvalidEncodingException;
use Jabran\Exception\InvalidDataException;
use Jabran\Exception\EmptyResourceException;
use Jabran\Exception\InvalidAccessException;
use Jabran\Exception\InvalidArgumentException;
use Jabran\Exception\InvalidDataTypeException;
use Jabran\Exception\InvalidResourceException;
use Jabran\Exception\UnreadableResourceException;

/**
 * CSV_Parser class
 *
 * Parse CSV data from a file, path, stream, resource or string
 *
 * @author: Jabran Rafique <hello@jabran.me>
 * @version: 2.0.4
 * @license: MIT License
 * @link: https://github.com/jabranr/csv-parser
 */
class CSV_Parser {

	/* @var string $data */
	protected $data;

	/* @var string $encoding */
	protected $encoding;

	/* @var array $columns */
	protected $columns;

	/* @var array $rows */
	protected $rows;

	/* @var array $headers */
	protected $headers;

	/**
	 * Setup default values
	 *
	 * @return self
	 */
	public function __construct() {
		$this->setData(null);
		$this->setEncoding('UTF-8');
		$this->setHeaders(null);
		$this->setRows(null);
		$this->setColumns(null);
		return $this;
	}

	/**
	 * Set data
	 *
	 * @param string $data
	 * @throws Jabran\Exception\InvalidArgumentException
	 * @throws Jabran\Exception\InvalidDataException
	 * @return self
	 */
	public function setData($data = null) {
		if (func_num_args() < 1) {
			throw new InvalidArgumentException('Required arguments are missing.');
		}

		if (null !== $data && ! is_string($data)) {
			throw new InvalidDataException('Unexpected data.');
		}

		$this->data = $data;
		return $this;
	}

	/**
	 * Get data
	 *
	 * @return string|null
	 */
	public function getData() {
		return $this->data;
	}

	/**
	 * Set encoding
	 *
	 * @param string $encoding
	 * @throws Jabran\Exception\InvalidArgumentException
	 * @throws Jabran\Exception\InvalidEncodingException
	 * @return self
	 */
	public function setEncoding($encoding = null) {
	    if (func_num_args() < 1) {
			throw new InvalidArgumentException('Required arguments are missing.');
	    }

	    if (null !== $encoding && ! is_string($encoding)) {
			throw new InvalidEncodingException('Unexpected encoding.');
	    }

	    if ($encoding != $this->_isValidEncoding($encoding)) {
			throw new InvalidEncodingException('Unsupported character encoding');
	    }

	    $this->encoding = $encoding;
	    return $this;
	}

	/**
	 * Get encoding
	 *
	 * @return string|null
	 */
	public function getEncoding() {
		return $this->encoding;
	}

	/**
	 * Set headers
	 *
	 * @param array $headers
	 * @throws Jabran\Exception\InvalidArgumentException
	 * @throws Jabran\Exception\InvalidDataException
	 * @return self
	 */
	public function setHeaders($headers = null) {
		if (func_num_args() < 1) {
			throw new InvalidArgumentException('Required arguments are missing.');
		}

		if (null !== $headers && ! is_array($headers)) {
			throw new InvalidDataException('Unexpected headers data.');
		}

		$this->headers = $headers;
		return $this;
	}

	/**
	 * Get headers
	 *
	 * @return array|null
	 */
	public function getHeaders() {
		return $this->headers;
	}

	/**
	 * Set columns
	 *
	 * @param array $columns
	 * @throws Jabran\Exception\InvalidArgumentException
	 * @throws Jabran\Exception\InvalidDataException
	 * @return self
	 */
	public function setColumns($columns = null) {
		if (func_num_args() < 1) {
			throw new InvalidArgumentException('Required arguments are missing.');
		}

		if (null !== $columns && ! is_array($columns)) {
			throw new InvalidDataException('Unexpected columns data.');
		}

		$this->columns = $columns;
		return $this;
	}

	/**
	 * Get columns
	 *
	 * @return array|null
	 */
	public function getColumns() {
		return $this->columns;
	}

	/**
	 * Set rows
	 *
	 * @param array $rows
	 * @throws Jabran\Exception\InvalidArgumentException
	 * @throws Jabran\Exception\InvalidDataException
	 * @return self
	 */
	public function setRows($rows = null) {
		if (func_num_args() < 1) {
			throw new InvalidArgumentException('Required arguments are missing.');
		}

		if (null !== $rows && ! is_array($rows)) {
			throw new InvalidDataException('Unexpected rows data.');
		}

		$this->rows = $rows;
		return $this;
	}

	/**
	 * Get rows
	 *
	 * @return array|null
	 */
	public function getRows() {
		return $this->rows;
	}

	/**
	 * Get data from a file
	 *
	 * @param string $file
	 * @throws Jabran\Exception\InvalidPathException
	 * @throws Jabran\Exception\InvalidAccessException
	 * @return self
	 * @todo Eventually deprecate in favor of fromPath method
	 */
	public function fromFile($file = null) {
		return $this->fromPath($file);
	}

	/**
	 * Get data from a path
	 *
	 * @param string $path
	 * @throws Jabran\Exception\InvalidPathException
	 * @throws Jabran\Exception\InvalidAccessException
	 * @return self
	 * @since 2.0.2
	 */
	public function fromPath($path = null) {
		if (null === $path || ! is_string($path)) {
			throw new InvalidPathException('Invalid resource path.');
		}

		if (! file_exists($path) || ! is_readable($path)) {
			throw new InvalidAccessException('Unable to retrieve the resource.');
		}

		$streamContext = stream_context_create(array(
			'http' => array(
					'timeout' => 30
				)
			)
		);

		$content = file_get_contents($path, false, $streamContext);

		if (false === $content) {
			return $this->fromString('');
		}

		return $this->fromString($content);
	}

	/**
	 * Get data from string
	 *
	 * @param string $string
	 * @throws Jabran\Exception\InvalidDataTypeException
	 * @throws Jabran\Exception\EmptyResourceException
	 * @return self
	 */
	public function fromString($string = null) {
		if (null === $string || ! is_string($string)) {
			throw new InvalidDataTypeException('Invalid or unexpected data.');
		}

		if (empty($string)) {
			throw new EmptyResourceException('No data in resource.');
		}

		$this->setData($string);
		return $this;
	}

	/**
	 * Get data from PHP stream
	 *
	 * @param resource $stream
	 * @throws Jabran\Exception\InvalidResourceException
	 * @return self
	 * @todo Eventually deprecate in favor of fromResource method
	 */
	public function fromStream($stream = null) {
		return $this->fromResource($stream);
	}

	/**
	 * Get data from a resource
	 *
	 * @param resource $resource
	 * @throws Jabran\Exception\InvalidResourceException
	 * @return self
	 * @since 2.0.2
	 */
	public function fromResource($resource = null) {
		if (null === $resource || ! is_resource($resource)) {
			throw new InvalidResourceException('Invalid or unexpected resource.');
		}

		$content = stream_get_contents($resource);

		if (false === $content) {
			throw new UnreadableResourceException('Unable to read data from resource.');
		}

		return $this->fromString($content);
	}

	/**
	 * Parse data
	 *
	 * @param boolean $headers
	 * @return array
	 */
	public function parse($headers = true) {
		if (null === $this->getData()) {
			return array();
		}

		$this->_makeColumns();
		$this->_makeRows();

		if ($headers) {
			$this->_makeRowsWithHeaders();
		}

		return $this->getRows();
	}

	/**
	 * Convert character encoding of data
	 * @throws Jabran\Exception\InvalidEncodingException
	 * @return self
	 */
	public function encode() {
	    $data = $this->getData();
	    $this->setData(mb_convert_encoding(
		$data, 
		$this->getEncoding(), 
		mb_detect_encoding($data)
	    ));

	    if ($this->getEncoding() !== mb_detect_encoding($this->getData())) {
		throw new InvalidEncodingException(
		    'Unable to convert character encoding from '. mb_detect_encoding($this->getData()).
		    ' to '.$this->getEncoding().'.'
		);
	    }

	    return $this;
	}

	/**
	 * Split data for line breaks to make columns
	 *
	 * @return self
	 */
	private function _makeColumns() {
		$data = $this->getData();

		if (preg_match('/[^\x20-\x7f]/', $data)) {
			$data = preg_split('/[^\x20-\x7f]/', $data);
		} else if (false !== strpos($data, ';')) {
			$data = explode(';', $data);
		} else {
			$data = explode('\n', $data);
		}

		$this->setColumns($data);
		return $this;
	}

	/**
	 * Make an optional header row
	 *
	 * @return self
	 */
	private function _makeRowsWithHeaders() {
		$columns = $this->getColumns();

		if ( count($columns) < 1 ) {
			return array();
		}

		$rowsWithHeader = array();
		$rows = $this->getRows();
		$this->setHeaders($rows[0]);
		array_shift($rows);

		foreach ($rows as $row) {

			// Ignore rows that do not have same length
			if ( count($this->getHeaders()) !== count($row) ) {
				continue;
            }

			$rowsWithHeader[] = array_combine($this->getHeaders(), $row);
		}

		$this->setRows($rowsWithHeader);
		return $this;
	}

	/**
	 * Make rows
	 *
	 * @return self
	 */
	private function _makeRows() {
		$columns = $this->getColumns();
		$rows = array();

		if (! is_array($columns) || count($columns) < 1) {
			$this->setRows($rows);
			return $this;
		}

		foreach ($columns as $column) {
			$rows[] = str_getcsv($column, ',');
		}

		$this->setRows($rows);
		return $this;
	}

	/**
	 * Validate character encoding
	 *
	 * @return boolean
	 */
	private function _isValidEncoding($encoding = null) {
	    return in_array($encoding, mb_list_encodings());
	}
}
