<?php
declare(strict_types=1);

namespace Jontsa\NationalIdentificationNumber;

use Jontsa\NationalIdentificationNumber\Exception\UnsupportedCountryException;
use Jontsa\NationalIdentificationNumber\Factory as CountryFactories;
use Jontsa\NationalIdentificationNumber\IdentificationNumber;

class Factory
{

    public static function create(string $country, string $value) : IdentificationNumber\IdentificationNumberInterface
    {
        switch($country) {
            case 'AT':
                return static::AT($value);
            case 'EE':
                return static::EE($value);
            case 'FI':
                return static::FI($value);
            case 'SE':
                return static::SE($value);
            case 'UK':
            case 'GB':
                return static::UK($value);
        }
        throw new UnsupportedCountryException($country);
    }

    public static function AT(string $value) : IdentificationNumber\AustrianIdentificationNumber
    {
        return CountryFactories\AustrianIdentificationFactory::fromString($value);
    }

    public static function EE(string $value) : IdentificationNumber\EstonianIdentificationNumber
    {
        return CountryFactories\EstonianIdentificationFactory::fromString($value);
    }

    public static function FI(string $value) : IdentificationNumber\FinnishIdentificationNumber
    {
        return CountryFactories\FinnishIdentificationFactory::fromString($value);
    }

    public static function SE(string $value) : IdentificationNumber\SwedishIdentificationNumber
    {
        return CountryFactories\SwedishIdentificationFactory::fromString($value);
    }

    public static function UK(string $value) : IdentificationNumber\UnitedKingdomIdentificationNumber
    {
        return CountryFactories\UnitedKingdomIdentificationFactory::fromString($value);
    }

}
