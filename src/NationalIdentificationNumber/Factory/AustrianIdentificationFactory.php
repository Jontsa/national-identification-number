<?php
declare(strict_types=1);

namespace Jontsa\NationalIdentificationNumber\Factory;

use Jontsa\NationalIdentificationNumber\Exception\InvalidChecksumException;
use Jontsa\NationalIdentificationNumber\Exception\InvalidSyntaxException;
use Jontsa\NationalIdentificationNumber\IdentificationNumber\AustrianIdentificationNumber;

class AustrianIdentificationFactory implements IdentificationFactoryInterface
{

    public static function fromString(string $value) : AustrianIdentificationNumber
    {
        $pattern = '/^([1-9]\d{2})(\d{1})\s?(0[1-9]|[1-2][0-9]|3[0-1])\s?(0[0-9]|1[0-9]|2[0-4])\s?(\d{2})$/';
        $hits = preg_match($pattern, $value, $matches);
        if (1 !== $hits) {
            throw new InvalidSyntaxException($value);
        }

        [, $serial, $checksum, $day, $month, $year] = $matches;

        // If birth year appears to be in the future, the year is most likely from last century
        $century = (int) \substr(\date('Y'), 0, 2);
        if($year > (int) \date('y')){
            $century--;
        }

        $identity = new AustrianIdentificationNumber((string) $century, $year, $month, $day, $serial);

        if ($identity->getCheckSum() !== $checksum) {
            throw new InvalidChecksumException($identity, $value);
        }
        return $identity;
    }

}
