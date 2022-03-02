<?php
declare(strict_types=1);

namespace Jontsa\NationalIdentificationNumber\IdentificationNumber;

class FinnishIdentificationNumber implements BirthDateAwareInterface, GenderAwareInterface, IdentificationNumberInterface
{

    use BirthDateTrait;

    private string $centuryHint;

    private string $serial;

    private string $checkSum;

    public function __construct(string $century, string $centuryHint, string $year, string $month, string $day, string $serial, ?string $checkSum = null)
    {
        $this->century = $century;
        $this->year = $year;
        $this->month = $month;
        $this->day = $day;
        $this->centuryHint = $centuryHint;
        $this->serial = $serial;
        if (null === $checkSum) {
            $this->checkSum = $this->calculateCheckSum($day, $month, $year, $serial);
        }
    }

    public function __toString() : string
    {
        return $this->format();
    }

    private function calculateCheckSum(string $day, string $month, string $year, string $serial) : string
    {
        $base = (int) $day . $month . $year . $serial;
        $remainder = $base % 31;
        return \substr("0123456789ABCDEFHJKLMNPRSTUVWXY", $remainder, 1);
    }

    public function format() : string
    {
        return $this->day . $this->month . $this->year . $this->centuryHint . $this->serial . $this->checkSum;
    }

    public function getGender() : string
    {
        $digit = \intval(\substr($this->serial, -1));
        if ($digit % 2 === 0) {
            return self::GENDER_FEMALE;
        } else {
            return self::GENDER_MALE;
        }
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
