<?php
declare(strict_types=1);

namespace Jontsa\NationalIdentificationNumber\IdentificationNumber;

trait BirthDateTrait
{

    private string $century;

    private string $year;

    private string $month;

    private string $day;

    public function getBirthDate() : ?\DateTimeImmutable
    {
        $dateString = $this->century . $this->year . $this->month . $this->day;
        return \DateTimeImmutable::createFromFormat('YmdHis', $dateString . '000000') ?: null;
    }

}
