<?php
declare(strict_types=1);

namespace Jontsa\NationalIdentificationNumber\Exception;

use Jontsa\NationalIdentificationNumber\IdentificationNumber\IdentificationNumberInterface;

final class InvalidChecksumException extends \Exception implements InvalidIdentifierExceptionInterface
{

    private IdentificationNumberInterface $identificationNumber;

    public function __construct(IdentificationNumberInterface $identificationNumber, string $value)
    {
        $this->identificationNumber = $identificationNumber;
        parent::__construct('"' . $value . '" checksum is not valid. Expected "' . $identificationNumber->format() . '".');
    }

    public function getIdentificationNumber() : IdentificationNumberInterface
    {
        return $this->identificationNumber;
    }

}
