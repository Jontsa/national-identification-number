<?php
declare(strict_types=1);

namespace Jontsa\NationalIdentificationNumber\IdentificationNumber;

interface IdentificationNumberInterface
{

    public function format() : string;

}
