<?php
declare(strict_types=1);

namespace Jontsa\NationalIdentificationNumber\IdentificationNumber;

/**
 * A National Insurance number, generally called an NI Number (NINO), syntax is LL NN NN NN L, for example AA 01 23 44 B.
 * There is no check digit.
 */
final class UnitedKingdomIdentificationNumber implements IdentificationNumberInterface
{

    private string $serial;

    public function __construct(string $serial)
    {
        $this->serial = $serial;
    }

    public function __toString() : string
    {
        return $this->format();
    }

    public function format() : string
    {
        return $this->serial;
    }

}
