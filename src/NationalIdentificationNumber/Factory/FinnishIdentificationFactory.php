<?php
declare(strict_types=1);

namespace Jontsa\NationalIdentificationNumber\Factory;

use Jontsa\NationalIdentificationNumber\Exception\InvalidChecksumException;
use Jontsa\NationalIdentificationNumber\Exception\InvalidSyntaxException;
use Jontsa\NationalIdentificationNumber\Exception\SuspiciousDateException;
use Jontsa\NationalIdentificationNumber\IdentificationNumber\FinnishIdentificationNumber;

class FinnishIdentificationFactory implements IdentificationFactoryInterface
{

    public static function fromString(string $value) : FinnishIdentificationNumber
    {
        $pattern = '/^(0[1-9]|[1-2][0-9]|3[0-1])(0[0-9]|1[0-2])(\d{2})([+-A])([\d]{3})([0-9A-Y])$/';
        $hits = preg_match($pattern, $value, $matches);
        if (1 !== $hits) {
            throw new InvalidSyntaxException($value);
        }

        [, $day, $month, $year, $centuryHint, $serial, $checksum] = $matches;

        $identity = new FinnishIdentificationNumber(self::getCentury($centuryHint), $centuryHint, $year, $month, $day, $serial);

        if ($identity->getCheckSum() !== $checksum) {
            throw new InvalidChecksumException($identity, $value);
        }

        $birthDate = new \DateTime($identity->getBirthDate() . ' 00:00:00');
        $currentDate = new \DateTime('midnight');
        if ($birthDate > $currentDate) {
            throw new SuspiciousDateException($identity);
        }

        return $identity;
    }

    private static function getCentury(string $centuryHint) : string
    {
        switch($centuryHint) {
            case '+':
                return '18';
            case '-':
                return '19';
            case 'A':
            default:
                return '20';
        }
    }
}
