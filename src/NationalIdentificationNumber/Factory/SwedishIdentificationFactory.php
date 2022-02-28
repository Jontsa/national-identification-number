<?php
declare(strict_types=1);

namespace Jontsa\NationalIdentificationNumber\Factory;

use Jontsa\NationalIdentificationNumber\Exception\InvalidChecksumException;
use Jontsa\NationalIdentificationNumber\Exception\InvalidSyntaxException;
use Jontsa\NationalIdentificationNumber\IdentificationNumber\SwedishIdentificationNumber;

class SwedishIdentificationFactory implements IdentificationFactoryInterface
{

    public static function fromString(string $value) : SwedishIdentificationNumber
    {
        $pattern = '/^(1[68-9]|20)?(\d{2})(0[1-9]|1[0-2]|[2-9][0-9])(\d{2})([-+]?)(\d{3})(\d)$/';
        $hits = preg_match($pattern, $value, $matches);
        if (1 !== $hits) {
            throw new InvalidSyntaxException($value);
        }

        [, $century, $year, $month, $day, $centuryHint, $serial, $checksum] = $matches;
        if ('' === $century) {
            $century = self::getCenturyFromValues((int) $year, (int) $month, $centuryHint);
        }

        $identity = new SwedishIdentificationNumber((string) $century, $year, $month, $day, $serial);

        if ($identity->getCheckSum() !== $checksum) {
            throw new InvalidChecksumException($identity, $value);
        }
        return $identity;
    }

    private static function getCenturyFromValues(int $year, int $month, string $centuryHint) : string
    {
        if ($month >= 20) {
            // Months 20 and above are for companies and companies use century "16"
            return '16';
        } else {
            $century = (int) \substr(\date('Y'), 0, 2);
            // @todo is this needed since we have century hint?
            if($year > (int) \date('y')){
                $century--;
            }
            if($centuryHint === '+') {
                $century--;
            }
            return (string) $century;
        }
    }

}
