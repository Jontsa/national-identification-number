<?php
declare(strict_types=1);

namespace Jontsa\NationalIdentificationNumber\IdentificationNumber;

use Jontsa\NationalIdentificationNumber\Algorithm\Modulus11;

class EstonianIdentificationNumber implements BirthDateAwareInterface, GenderAwareInterface, IdentificationNumberInterface
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
            $this->checkSum = $this->calculateCheckSum($day, $month, $year, $centuryHint, $serial);
        }
    }

    public function __toString() : string
    {
        return $this->format();
    }

    private function calculateCheckSum(string $day, string $month, string $year, string $centuryHint, string $serial) : string
    {
        $base = $centuryHint . $year . $month . $day . $serial;
        $checkSum = Modulus11::calculateCheckSum($base, [1, 2, 3, 4, 5, 6, 7, 8, 9, 1]);
        if ($checkSum > 9) {
            $checkSum = Modulus11::calculateCheckSum($base, [3, 4, 5, 6, 7, 8, 9, 1, 2, 3]);
            if ($checkSum > 9) {
                $checkSum = 0;
            }
        }
        return (string) $checkSum;
    }

    public function format() : string
    {
        return $this->centuryHint . $this->year . $this->month . $this->day . $this->serial . $this->checkSum;
    }

    public function getGender() : string
    {
        $digit = (int) $this->centuryHint;
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
