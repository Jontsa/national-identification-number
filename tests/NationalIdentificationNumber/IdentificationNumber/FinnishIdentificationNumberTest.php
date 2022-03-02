<?php
declare(strict_types=1);

namespace Jontsa\Tests\NationalIdentificationNumber\IdentificationNumber;

use Jontsa\NationalIdentificationNumber\IdentificationNumber\FinnishIdentificationNumber;
use Jontsa\NationalIdentificationNumber\IdentificationNumber\GenderAwareInterface;
use PHPUnit\Framework\TestCase;

class FinnishIdentificationNumberTest extends TestCase
{

    /**
     * @test
     */
    public function createsObjectAndCalculatesChecksumTest() : void
    {
        $identification = new FinnishIdentificationNumber('19', '-', '79', '01', '31', '082');
        $this->assertSame(GenderAwareInterface::GENDER_FEMALE, $identification->getGender());
        $this->assertInstanceOf(\DateTimeInterface::class, $identification->getBirthDate());
        $this->assertEquals(new \DateTimeImmutable('1979-01-31 00:00:00'), $identification->getBirthDate());
        $this->assertSame('082', $identification->getSerial());
        $this->assertSame('U', $identification->getCheckSum());
    }

}
