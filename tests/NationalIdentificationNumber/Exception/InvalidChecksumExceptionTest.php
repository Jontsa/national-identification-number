<?php
declare(strict_types=1);

namespace Jontsa\Tests\NationalIdentificationNumber\Exception;

use Jontsa\NationalIdentificationNumber\Exception\InvalidChecksumException;
use Jontsa\NationalIdentificationNumber\IdentificationNumber\IdentificationNumberInterface;
use PHPUnit\Framework\TestCase;

class InvalidChecksumExceptionTest extends TestCase
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
        $exception = new InvalidChecksumException($identificationMock, 'xooxer');
        $this->assertSame('"xooxer" checksum is not valid. Expected "abc123".', $exception->getMessage());
        $this->assertSame(0, $exception->getCode());
        $this->assertSame($identificationMock, $exception->getIdentificationNumber());
    }

}
