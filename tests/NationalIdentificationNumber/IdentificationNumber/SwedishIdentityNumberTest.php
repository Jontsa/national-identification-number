<?php
declare(strict_types=1);

namespace Jontsa\Tests\NationalIdentificationNumber\IdentificationNumber;

use Jontsa\NationalIdentificationNumber\IdentificationNumber\GenderAwareInterface;
use Jontsa\NationalIdentificationNumber\IdentificationNumber\SwedishIdentificationNumber;
use PHPUnit\Framework\TestCase;

class SwedishIdentityNumberTest extends TestCase
{

    /**
     * @test
     */
    public function createsObjectAndCalculatesChecksumTest() : void
    {
        $identification = new SwedishIdentificationNumber('19', '79', '01', '31', '082');
        $this->assertSame(GenderAwareInterface::GENDER_FEMALE, $identification->getGender());
        $this->assertEquals(new \DateTimeImmutable('1979-01-31 00:00:00'), $identification->getBirthDate());
        $this->assertSame('082', $identification->getSerial());
        $this->assertSame('6', $identification->getCheckSum());
        $this->assertFalse($identification->isOrganization());
        $this->assertFalse($identification->isTemporary());
        $this->assertNull($identification->getCompanyGroupNumber());
    }

}
