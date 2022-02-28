<?php
declare(strict_types=1);

namespace Jontsa\NationalIdentificationNumber\Exception;

use Jontsa\NationalIdentificationNumber\IdentificationNumber\IdentificationNumberInterface;

final class SuspiciousDateException extends \Exception implements InvalidIdentifierExceptionInterface
{

    private IdentificationNumberInterface $identificationNumber;

    public function __construct(IdentificationNumberInterface $identificationNumber)
    {
        parent::__construct('"' . $identificationNumber->format() . '" contains a suspicious date.');
        $this->identificationNumber = $identificationNumber;
    }

    public function getIdentificationNumber() : IdentificationNumberInterface
    {
        return $this->identificationNumber;
    }

}
