<?php
declare(strict_types=1);

namespace Jontsa\Tests\NationalIdentificationNumber;

use Jontsa\NationalIdentificationNumber\Exception\UnsupportedCountryException;
use Jontsa\NationalIdentificationNumber\Factory;
use PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase
{

    /**
     * @test
     */
    public function invalidCountryThrowsExceptionTest() : void
    {
        $this->expectException(UnsupportedCountryException::class);
        $this->expectExceptionMessage('"FU" is not supported.');
        Factory::create('FU', '123');
    }

}
