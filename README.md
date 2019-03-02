# CSV Parser (PHP)  [![Build Status](https://travis-ci.org/jabranr/csv-parser.svg?branch=master)](https://travis-ci.org/jabranr/csv-parser) [![Latest Stable Version](https://poser.pugx.org/jabranr/csv-parser/v/stable.svg)](https://packagist.org/packages/jabranr/csv-parser) [![Total Downloads](https://poser.pugx.org/jabranr/csv-parser/downloads.svg)](https://packagist.org/packages/jabranr/csv-parser)

PHP client to parse CSV data from a path, file, stream, resource or string into indexed or associative arrays.

#### Migration from v2 to v3

* PHP support updated to 5.5+ in v3

# Install
Install using [composer](http://getcomposer.org)

```json
#composer.json

{
  "require": {
    "jabranr/csv-parser": "~2.1.*"
  }
}
```

Run following to install
```shell
$ comsposer install
```

# Use
Initiate a new instance
```php
$csv = new Jabran\CSV_Parser();
```

# API

Get data from a string
```php
/* @param: string $str */
$csv->fromString($str);
```

Get data from a stream (Will be deprecated in future)
```php
/* @param: resource $stream (f.e. php://input) */
$csv->fromStream($stream);
```

Get data from a resource (Since v2.0.2)
```php
/* @param: resource $resource (f.e. resource created using fopen()) */
$csv->fromResource($resource);
```

Get data from a file path (Will be deprecated in future)
```php
/* @param: string $file */
$csv->fromFile($file);
```

Get data from a path/URL (Since v2.0.2)
```php
/* @param: string $path */
$csv->fromPath($path);
```

Parse data for output
```php
/**
 * Set $headers true/false to include top/first row
 * and output an associative array
 *
 * @param: boolean $headers (Default: true)
 * @return: array
 */
$csv->parse($headers);
```

More useful methods (Since v2.0.2)

```php
/**
 * Set columns
 * @param array $columns
 * @return Jabran\CSV_Parser
 */
$csv->setColumns($columns);

/**
 * Set rows
 * @param array $rows
 * @return Jabran\CSV_Parser
 */
$csv->setRows($rows);

/**
 * Set headers
 * @param array $headers
 * @return Jabran\CSV_Parser
 */
$csv->setHeaders($headers);

/**
 * Get columns
 * @return array
 */
$csv->getColumns();

/**
 * Get rows
 * @return array
 */
$csv->getRows();

/**
 * Get headers
 * @return array
 */
$csv->getHeaders();
```

# Example

Example input string
```php
require 'path/to/vendor/autoload.php';

$csv = new Jabran\CSV_Parser;

$str = 'id,first_name,last_name;1,Jabran,Rafique';

$csv->fromString($str);

// Output with headers:
$csv->parse();

Array(
  [id] => 1,
  [first_name] => 'Jabran',
  [last_name] => 'Rafique'
)

// Output without headers:
$csv->parse(false);

Array(
  [0] => array(
    [0] => 'id',
    [1] => 'first_name',
    [2] => 'last_name'
 ),
  [1] => array(
    [0] => 1,
    [1] => 'Jabran',
    [2] => 'Rafique'
 )
)
```

# License
&copy; 2015&mdash;2017 MIT License - [Jabran Rafique](http://jabran.me)

[![Analytics](https://ga-beacon.appspot.com/UA-50688851-1/csv-parser)](https://github.com/igrigorik/ga-beacon)
