<?php
declare(strict_types=1);

namespace Jontsa\NationalIdentificationNumber\IdentificationNumber;

use Jontsa\NationalIdentificationNumber\Algorithm\Modulus11;

/**
 * Austrian identity number (Versicherungsnummer) consists of three number serial, a check digit calculated
 * using Modulus11, day, month and two digit year. Century is not available in the identifier but
 */
final class AustrianIdentificationNumber implements IdentificationNumberInterface
{

    use BirthDateTrait;

    private string $serial;

    /**
     * The personal id in Austria is always 10 digits and the checksum is an integer between 1 and 9. If the checksum
     * is 10 or over, the id is not valid.
     */
    private string $checkSum;

    public function __construct(string $century, string $year, string $month, string $day, string $serial, ?string $checkSum = null)
    {
        $this->century = $century;
        $this->year = $year;
        $this->month = $month;
        $this->day = $day;
        $this->serial = $serial;
        if (null === $checkSum) {
            $this->checkSum = (string) Modulus11::calculateCheckSum($serial . $day . $month . $year, [3, 7, 9, 5, 8, 4, 2, 1, 6]);
        }
    }

    public function __toString() : string
    {
        return $this->format();
    }

    public function format() : string
    {
        return $this->serial . $this->checkSum . $this->day . $this->month . $this->year;
    }

    /**
     * Returns date of birth if personal id contains a valid birthdate.
     * In austria if the reserved number of personal ids per day is exhausted, a month over 12 or
     * day over 31 may be included.
     * @todo I was unable to verify if there is a pattern how the days or months are incremented in such cases
     * so if the date is not valid, we return null here.
     */
    public function getBirthDate() : ?string
    {
        if (31 < (int)$this->day || 12 < (int) $this->month) {
            return null;
        }
        return $this->century . $this->year . '-' . $this->month . '-' . $this->day;
    }

    public function getSerial() : string
    {
        return $this->serial;
    }

    public function getCheckSum() : string
    {
        return $this->checkSum;
    }

}
