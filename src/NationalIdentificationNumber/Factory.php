<?php
declare(strict_types=1);

namespace Jontsa\NationalIdentificationNumber;

use Jontsa\NationalIdentificationNumber\Factory as CountryFactories;
use Jontsa\NationalIdentificationNumber\IdentificationNumber;

class Factory
{

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
