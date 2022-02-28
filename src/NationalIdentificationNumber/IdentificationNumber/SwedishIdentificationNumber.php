<?php
declare(strict_types=1);

namespace Jontsa\NationalIdentificationNumber\IdentificationNumber;

use Jontsa\NationalIdentificationNumber\Algorithm\Luhn10;

final class SwedishIdentificationNumber implements GenderAwareIdentificationNumberInterface, IdentificationNumberInterface
{

    use BirthDateTrait;

    private string $serial;

    private string $checkSum;

    public function __construct(string $century, string $year, string $month, string $day, string $serial, ?string $checkSum = null)
    {
        $this->century = $century;
        $this->year = $year;
        $this->month = $month;
        $this->day = $day;
        $this->serial = $serial;
        if (null === $checkSum) {
            $this->checkSum = (string) Luhn10::calculateCheckSum($year . $month . $day . $serial);
        }
    }

    public function __toString() : string
    {
        return $this->format();
    }

    private function getCenturyHint() : string
    {
        return (\intval(\date('Y')) - \intval($this->century . $this->year) < 100) ? '-' : '+';
    }

    public function format() : string
    {
        return $this->year . $this->month . $this->day . $this->getCenturyHint() . $this->serial . $this->checkSum;
    }

    /**
     * Organization identifiers use 20+ as month.
     */
    public function isOrganization() : bool
    {
        return \intval($this->month) >= 20;
    }

    /**
     * People who have no Swedish personal identity number can receive a co-ordination number (Swedish: samordningsnummer) instead.
     * This is identified by advancing day in the date of birth by 60 (giving a number between 61 and 91)
     */
    public function isTemporary() : bool
    {
        return false === $this->isOrganization() && \intval($this->day) > 60;
    }

    public function getBirthDate() : ?string
    {
        if (true === $this->isOrganization()) {
            return null;
        }
        $day = $this->isTemporary() ? (string) (\intval($this->day) - 60) : $this->day;
        return $this->century . $this->year . '-' . $this->month . '-' . $day;
    }

    /**
     * Company identifiers have the company type as part of year portion.
     */
    public function getCompanyGroupNumber() : ?int
    {
        if (false === $this->isOrganization()) {
            return null;
        }
        return (int) \substr($this->year, 0, 1);
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
