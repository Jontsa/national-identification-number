<?php
declare(strict_types=1);

namespace Jontsa\NationalIdentificationNumber\Factory;

use Jontsa\NationalIdentificationNumber\IdentificationNumber\IdentificationNumberInterface;

interface IdentificationFactoryInterface
{

    public static function fromString(string $value) : IdentificationNumberInterface;

}
