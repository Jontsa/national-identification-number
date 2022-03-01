<?php
declare(strict_types=1);

namespace Jontsa\NationalIdentificationNumber\Exception;

final class UnsupportedCountryException extends \Exception
{

    public function __construct(string $country)
    {
        parent::__construct('"' . $country . '" is not supported.');
    }

}
