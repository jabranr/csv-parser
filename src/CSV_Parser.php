<?php declare(strict_types=1);

/**
 * CSV_Parser class
 *
 * Parse CSV data from a file, path, stream, resource or string
 *
 * @author: Jabran Rafique <hello@jabran.me>
 * @version: 3.0.0
 * @license: MIT License
 * @link: https://github.com/jabranr/csv-parser
 */

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

class CSV_Parser {

	const DEFAULT_ENCODING = 'UTF-8';

	/* @var string $data */
	protected $data = '';

	/* @var string $encoding */
	protected $encoding = '';

	/* @var array $columns */
	protected $columns = [];

	/* @var array $rows */
	protected $rows = [];

	/* @var array $headers */
	protected $headers = [];

    /**
     * CSV_Parser constructor
     *
     * @throws InvalidArgumentException
     * @throws InvalidDataException
     * @throws InvalidEncodingException
     */
	public function __construct() {
		$this->setEncoding(static::DEFAULT_ENCODING);
	}

    /**
     * Set data
     *
     * @param null $data
     *
     * @return CSV_Parser
     * @throws InvalidDataException
     */
	public function setData($data) : self {
		if (!is_string($data)) {
			throw new InvalidDataException('Unexpected data');
		}

		$this->data = $data;
		return $this;
	}

    /**
     * Get data
     *
     * @return string
     */
	public function getData() : string {
		return $this->data;
	}

    /**
     * Set encoding
     *
     * @param null $encoding
     *
     * @return CSV_Parser
     * @throws InvalidEncodingException
     */
	public function setEncoding($encoding) : self {
	    if (!is_string($encoding)) {
			throw new InvalidEncodingException('Unexpected encoding');
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
	 * @return string
	 */
	public function getEncoding() : string {
		return $this->encoding;
	}

    /**
     * Set headers
     *
     * @param null $headers
     *
     * @return CSV_Parser
     * @throws InvalidDataException
     */
	public function setHeaders($headers) : self {
		if (!is_array($headers)) {
			throw new InvalidDataException('Unexpected headers data');
		}

		$headers = $this->trimRecursively($headers);
		$this->headers = $headers;
		return $this;
	}

	/**
	 * Get headers
	 *
	 * @return array
	 */
	public function getHeaders() : array {
		return $this->headers;
	}

    /**
     * Set columns
     *
     * @param null $columns
     *
     * @return CSV_Parser
     * @throws InvalidDataException
     */
	public function setColumns($columns) : self {
		if (!is_array($columns)) {
			throw new InvalidDataException('Unexpected columns data');
		}

		$columns = $this->trimRecursively($columns);
		$this->columns = $columns;
		return $this;
	}

	/**
	 * Trim data recursively
	 *
	 * @param array|string $data
	 * @return array|string
	 */
	public function trimRecursively($data) {
		if (!is_string($data) && !is_array($data)) {
			return $data;
		}

		if (is_string($data)) {
			return trim($data);
		}

		return array_map(array($this, 'trimRecursively'), $data);
	}

	/**
	 * Get columns
	 *
	 * @return array
	 */
	public function getColumns() : array {
		return $this->columns;
	}

    /**
     * Set rows
     *
     * @param null $rows
     *
     * @return CSV_Parser
     * @throws InvalidDataException
     */
	public function setRows($rows) : self {
		if (!is_array($rows)) {
			throw new InvalidDataException('Unexpected rows data');
		}

		$rows = $this->trimRecursively($rows);
		$this->rows = $rows;
		return $this;
	}

	/**
	 * Get rows
	 *
	 * @return array
	 */
	public function getRows() : array {
		return $this->rows;
	}

    /**
     * Get data from a path
     *
     * @param string $path
     *
     * @return CSV_Parser
     * @throws InvalidPathException
     * @throws InvalidAccessException
     */
	public function fromPath($path) : self {
		if (!is_string($path)) {
			throw new InvalidPathException('Invalid resource path');
		}

		if (!file_exists($path) || !is_readable($path)) {
			throw new InvalidAccessException('Unable to retrieve the resource');
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
     * @param string $str
     *
     * @return CSV_Parser
     * @throws EmptyResourceException
     * @throws InvalidArgumentException
     * @throws InvalidDataException
     * @throws InvalidDataTypeException
     */
	public function fromString($str) : self {
		if (!is_string($str)) {
			throw new InvalidDataTypeException('Invalid or unexpected data');
		}

		if (empty($str)) {
			throw new EmptyResourceException('No data in resource');
		}

		$this->setData($str);
		return $this;
	}

    /**
     * Get data from a resource
     *
     * @param null $resource
     *
     * @return CSV_Parser
     * @throws InvalidResourceException
     * @throws UnreadableResourceException
     */
	public function fromResource($resource) : self {
		if (!is_resource($resource)) {
			throw new InvalidResourceException('Invalid or unexpected resource');
		}

		if (false === ($content = stream_get_contents($resource))) {
			throw new UnreadableResourceException('Unable to read data from resource');
		}

		return $this->fromString($content);
	}

    /**
     * Parse data
     *
     * @param bool $headers
     *
     * @return array
     */
	public function parse($headers = true) : array {
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
     *
     * @return CSV_Parser
     * @throws InvalidArgumentException
     * @throws InvalidDataException
     * @throws InvalidEncodingException
     */
	public function encode() : self {
	    $data = $this->getData();
	    $encodedData = mb_convert_encoding($data, $this->getEncoding(), mb_detect_encoding($this->getData()));
	    $this->setData($encodedData);

	    if ($this->getEncoding() !== mb_detect_encoding($this->getData())) {
	    	throw new InvalidEncodingException(
	    		sprintf('Unable to convert character encoding from "%s" to "%s".', mb_detect_encoding($this->getData()), $this->getEncoding())
	    	);
	    }

	    return $this;
	}

    /**
     * Split data for line breaks to make columns
     *
     * @return CSV_Parser
     * @throws InvalidArgumentException
     * @throws InvalidDataException
     */
	private function _makeColumns() : self {
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
     * @return CSV_Parser
     * @throws InvalidArgumentException
     * @throws InvalidDataException
     */
	private function _makeRowsWithHeaders() : self {
		$columns = $this->getColumns();

		if ( count($columns) < 1 ) {
			return $this;
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
     * @return $this
     * @throws InvalidArgumentException
     * @throws InvalidDataException
     */
	private function _makeRows() : self {
		$columns = $this->getColumns();
		$rows = array();

		if (!is_array($columns) || count($columns) < 1) {
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
     * @param string $encoding
     *
     * @return bool
     */
	private function _isValidEncoding($encoding) : bool {
	    return in_array($encoding, mb_list_encodings());
	}
}
