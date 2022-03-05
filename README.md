# PHP classes to parse, validate and format personal identification numbers

![Tests](https://github.com/Jontsa/national-identification-number/workflows/Tests/badge.svg)

This package can be used to parse, validate and format national personal identification numbers. In some countries
these might be called social security numbers, national insurance numbers etc.

There are other similar packages available but some are not updated anymore, some do not work with newer PHP versions,
some only support one country etc. This package was created to better suit our needs. It only supports limited set of
countries but adding new countries should be easy if syntax is described somewhere.

## Features

- Parse and validate national identifier string
- Returns object with known properties extracted from the identifier
- Supported countries
  - Austria
  - Estonia
  - Finland
  - Sweden both personal- and organization numbers
  - United Kingdom NI Number

## Requirements

- PHP 7.4 or higher
- composer

## Installation

Make sure Composer is installed globally, as explained in the
[installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Open a command console, enter your project directory and execute:

```console
$ composer require jontsa/national-identification-number
```

## Usage

Parse and validate identity number:

```php
use Jontsa\NationalIdentificationNumber\Exception\InvalidIdentifierExceptionInterface;
use Jontsa\NationalIdentificationNumber\Exception\InvalidSyntaxExceptionInterface;
use Jontsa\NationalIdentificationNumber\Exception\UnsupportedCountryException;
use Jontsa\NationalIdentificationNumber\Factory;
use Jontsa\NationalIdentificationNumber\IdentificationNumber\BirthDateAwareInterface;
use Jontsa\NationalIdentificationNumber\IdentificationNumber\GenderAwareInterface;

$country = 'FI';
$string = '150921A123A';
try {
    $identificationNumber = Factory::create($country, $string);
    echo "Yay, this is a valid personal identification number.\n";
    if ($identificationNumber instanceof BirthDateAwareInterface) {
        if ($identificationNumber instanceof GenderAwareInterface) {
            $pronoun = $identificationNumber->getGender() === GenderAwareInterface::GENDER_MALE ? 'He' : 'She';
        } else {
            $pronoun = 'Person'
        }
        echo $pronoun . " was born on " . $identificationNumber->getBirthDate()->format('Y-m-d') . "\n";
    }
} catch (UnsupportedCountryException $e) {
    echo 'Sorry but ' . $country . ' is not supported. Maybe you can create a ticket or PR in Github?';
} catch (InvalidSyntaxExceptionInterface|InvalidIdentifierExceptionInterface $e) {
    echo 'The supplied string was not a valid personal identification number';
}
```

Alternative method for parsing identity number for specific country:

```php
use Jontsa\NationalIdentificationNumber\Exception\InvalidIdentifierExceptionInterface;
use Jontsa\NationalIdentificationNumber\Exception\InvalidSyntaxExceptionInterface;
use Jontsa\NationalIdentificationNumber\Factory;

try {
    $identificationNumber = Factory::FI('150921A123A');
    echo "Yay, this is a valid personal identification number.\n";
    echo 'Gender: ' . $identificationNumber->getGender() . "\n";
    echo 'Born: ' . $identificationNumber->getBirthDate() . "\n";
} catch (InvalidSyntaxExceptionInterface|InvalidIdentifierExceptionInterface $e) {
    echo 'The supplied string was not valid Finnish personal identification number';
}
```

Calculate checksum and format Finnish personal identity number:

```php

use Jontsa\NationalIdentificationNumber\IdentificationNumber\FinnishIdentificationNumber;

$identificationNumber = new FinnishIdentificationNumber('19', '-', '79', '01', '31', '082');
echo 'Correct checksum: ' . $identificationNumber->getCheckSum() . "\n";
echo 'Formatted: ' . $identificationNumber->format() . "\n";

// output
// Correct checksum: U
// Formatted: 310179-082U
```
