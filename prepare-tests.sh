#!/usr/bin/env bash

if [[ ${TRAVIS_PHP_VERSION:0:3} == "7.0" ]]; then
    sed -i -e "s/CSV_ParserTest_7_1/CSV_ParserTest_7_0/g" $(pwd)/test/CSV_ParserTest.php;
else
   sed -i -e "s/CSV_ParserTest_7_0/CSV_ParserTest_7_1/g" $(pwd)/test/CSV_ParserTest.php;
fi
