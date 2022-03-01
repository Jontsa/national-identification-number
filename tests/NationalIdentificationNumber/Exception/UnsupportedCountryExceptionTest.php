<?php
declare(strict_types=1);

namespace Jontsa\Tests\NationalIdentificationNumber\Exception;

use Jontsa\NationalIdentificationNumber\Exception\UnsupportedCountryException;
use PHPUnit\Framework\TestCase;

class UnsupportedCountryExceptionTest extends TestCase
{

    /**
     * @test
     */
    public function createsExceptionTest() : void
    {
        $exception = new UnsupportedCountryException('xooxer');
        $this->assertSame('"xooxer" is not supported.', $exception->getMessage());
        $this->assertSame(0, $exception->getCode());
    }

}
