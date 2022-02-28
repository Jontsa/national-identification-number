<?php
declare(strict_types=1);

namespace Jontsa\Tests\NationalIdentificationNumber\IdentificationNumber;

use Jontsa\NationalIdentificationNumber\IdentificationNumber\GenderAwareIdentificationNumberInterface;
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
        $this->assertSame(GenderAwareIdentificationNumberInterface::GENDER_FEMALE, $identification->getGender());
        $this->assertSame('1979-01-31', $identification->getBirthDate());
        $this->assertSame('082', $identification->getSerial());
        $this->assertSame('6', $identification->getCheckSum());
        $this->assertFalse($identification->isOrganization());
        $this->assertFalse($identification->isTemporary());
        $this->assertNull($identification->getCompanyGroupNumber());
    }

}
