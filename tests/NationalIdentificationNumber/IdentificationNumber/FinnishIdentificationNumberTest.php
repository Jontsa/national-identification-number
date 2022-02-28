<?php
declare(strict_types=1);

namespace Jontsa\Tests\NationalIdentificationNumber\IdentificationNumber;

use Jontsa\NationalIdentificationNumber\IdentificationNumber\FinnishIdentificationNumber;
use Jontsa\NationalIdentificationNumber\IdentificationNumber\GenderAwareIdentificationNumberInterface;
use PHPUnit\Framework\TestCase;

class FinnishIdentificationNumberTest extends TestCase
{

    /**
     * @test
     */
    public function createsObjectAndCalculatesChecksumTest() : void
    {
        $identification = new FinnishIdentificationNumber('19', '-', '79', '01', '31', '082');
        $this->assertSame(GenderAwareIdentificationNumberInterface::GENDER_FEMALE, $identification->getGender());
        $this->assertSame('1979-01-31', $identification->getBirthDate());
        $this->assertSame('082', $identification->getSerial());
        $this->assertSame('U', $identification->getCheckSum());
    }

}
