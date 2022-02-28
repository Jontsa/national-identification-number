<?php
declare(strict_types=1);

namespace Jontsa\NationalIdentificationNumber\IdentificationNumber;

trait BirthDateTrait
{

    private string $century;

    private string $year;

    private string $month;

    private string $day;

    public function getBirthDate() : string
    {
        return $this->century . $this->year . '-' . $this->month . '-' . $this->day;
    }

}
