<?php
declare(strict_types=1);

namespace Jontsa\NationalIdentificationNumber\Exception;

use Jontsa\NationalIdentificationNumber\IdentificationNumber\IdentificationNumberInterface;

interface InvalidIdentifierExceptionInterface extends \Throwable
{
    public function getIdentificationNumber() : IdentificationNumberInterface;
}
