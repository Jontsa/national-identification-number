<?php
declare(strict_types=1);

namespace Jontsa\NationalIdentificationNumber\Factory;

use Jontsa\NationalIdentificationNumber\Exception\InvalidChecksumException;
use Jontsa\NationalIdentificationNumber\Exception\InvalidSyntaxException;
use Jontsa\NationalIdentificationNumber\Exception\SuspiciousDateException;
use Jontsa\NationalIdentificationNumber\IdentificationNumber\EstonianIdentificationNumber;

class EstonianIdentificationFactory implements IdentificationFactoryInterface
{

    public static function fromString(string $value) : EstonianIdentificationNumber
    {
        $pattern = '/^([1-6])(\d{2})(0[0-9]|1[0-2])(0[1-9]|[1-2][0-9]|3[0-1])([\d]{3})(\d)$/';
        $hits = preg_match($pattern, $value, $matches);
        if (1 !== $hits) {
            throw new InvalidSyntaxException($value);
        }

        [, $centuryHint, $year, $month, $day, $serial, $checksum] = $matches;


        $identity = new EstonianIdentificationNumber(self::getCentury($centuryHint), $centuryHint, $year, $month, $day, $serial);

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
            case '1':
            case '2':
                return '18';
            case '3':
            case '4':
                return '19';
            case '5':
            case '6':
            default:
                return '20';
        }
    }

}
