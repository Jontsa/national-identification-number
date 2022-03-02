<?php
declare(strict_types=1);

namespace Jontsa\NationalIdentificationNumber\Exception;

interface UnsupportedCountryExceptionInterface extends \Throwable
{

    public function getCountry() : string;

}
