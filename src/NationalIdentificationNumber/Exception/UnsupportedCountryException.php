<?php
declare(strict_types=1);

namespace Jontsa\NationalIdentificationNumber\Exception;

final class UnsupportedCountryException extends \Exception implements UnsupportedCountryExceptionInterface
{

    private string $country;

    public function __construct(string $country)
    {
        parent::__construct('"' . $country . '" is not supported.');
        $this->country = $country;
    }

    public function getCountry() : string
    {
        return $this->country;
    }

}
