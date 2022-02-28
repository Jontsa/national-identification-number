<?php
declare(strict_types=1);

namespace Jontsa\Tests\NationalIdentificationNumber\Exception;

use Jontsa\NationalIdentificationNumber\Exception\SuspiciousDateException;
use Jontsa\NationalIdentificationNumber\IdentificationNumber\IdentificationNumberInterface;
use PHPUnit\Framework\TestCase;

class SuspiciousDateExceptionTest extends TestCase
{

    /**
     * @test
     */
    public function createsExceptionTest() : void
    {
        $identificationMock = $this->createMock(IdentificationNumberInterface::class);
        $identificationMock
            ->expects($this->once())
            ->method('format')
            ->willReturn('abc123');
        $exception = new SuspiciousDateException($identificationMock);
        $this->assertSame('"abc123" contains a suspicious date.', $exception->getMessage());
        $this->assertSame(0, $exception->getCode());
        $this->assertSame($identificationMock, $exception->getIdentificationNumber());
    }

}
