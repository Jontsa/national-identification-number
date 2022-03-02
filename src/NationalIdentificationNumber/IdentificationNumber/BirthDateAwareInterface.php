<?php
declare(strict_types=1);

namespace Jontsa\NationalIdentificationNumber\IdentificationNumber;

interface BirthDateAwareInterface
{

    public function getBirthDate() : ?\DateTimeInterface;

}
