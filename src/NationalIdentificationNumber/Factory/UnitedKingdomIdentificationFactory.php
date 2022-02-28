<?php
declare(strict_types=1);

namespace Jontsa\NationalIdentificationNumber\Factory;

use Jontsa\NationalIdentificationNumber\Exception\InvalidSyntaxException;
use Jontsa\NationalIdentificationNumber\IdentificationNumber\UnitedKingdomIdentificationNumber;

class UnitedKingdomIdentificationFactory implements IdentificationFactoryInterface
{

    public static function fromString(string $value) : UnitedKingdomIdentificationNumber
    {
        $pattern = '/^([a-zA-Z]{2})\s?([0-9]{2})\s?([0-9]{2})\s?([0-9]{2})\s?([a-zA-Z])$/';
        $hits = preg_match($pattern, $value, $matches);
        if (1 !== $hits) {
            throw new InvalidSyntaxException($value);
        }

        unset($matches[0]);
        $nino = \strtoupper(\implode('', $matches));

        return new UnitedKingdomIdentificationNumber($nino);
    }

}
