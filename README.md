# CSV Parser (PHP)

PHP parser to parse CSV data from a file, stream or string


# Install
Install using [composer](http://getcomposer.org)

```json
#composer.json

{
  "require": {
    "jabranr/csv_parser": ">=1.0.0"
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
$csv = new CSV_Parser();
```

# API

Get data from a string
```php
/* @param: string $str */
$csv->fromString( $str );
```

Get data from a stream
```php
/* @param: stream $stream (e.g. php://input) */
$csv->fromStream( $stream );
```

Get data from a file
```php
/* @param: file $file */
$csv->fromFile( $file );
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
$csv->parse( $headers );
```

# Examples

Example input string
```php
$str = 'id,first_name,last_name;1,Jabran,Rafique';

$csv->fromString( $str );

// Output with headers:
$csv->parse();

Array(
  [id] => 1,
  [first_name] => 'Jabran',
  [last_name] => 'Rafique'
)

// Output without headers:
$csv->parse( false );

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
&copy; 2015 MIT License - [Jabran Rafique](http://jabran.me)
