<?php
declare(strict_types=1);

namespace Jontsa\Tests\NationalIdentificationNumber\Factory;

use Jontsa\NationalIdentificationNumber\Factory;
use Jontsa\NationalIdentificationNumber\IdentificationNumber\SwedishIdentificationNumber;
use PHPUnit\Framework\TestCase;

class SwedishIdentificationFactoryTest extends TestCase
{

    use InvalidIdentifierTestTrait,
        ValidIdentifierTestTrait;

    protected function createIdentifierUsingFactory(string $value) : SwedishIdentificationNumber
    {
        return Factory::SE($value);
    }

    /**
     * @return array<string[]>
     */
    public function invalidSyntaxProvider() : array
    {
        return [
            [''],
            ['0'],
            ['19790131 0826'],
            ['17790131-0826'],
            ['21790131-0826'],
            ['19790131-082'],
        ];
    }

    /**
     * @return array<string[]>
     */
    public function invalidChecksumProvider() : array
    {
        return [
            ['200012055918'],
            ['19790130-0826'],
        ];
    }

    /**
     * @return array<array{0: string, 1: string, 2: array<string, string|null|bool|\DateTimeImmutable>}>
     */
    public function validIdentifierProvider() : array
    {
        return [
            ['19790131-0826', '790131-0826', ['BirthDate' => new \DateTimeImmutable('1979-01-31 00:00:00'), 'Gender' => 'F', 'Serial' => '082', 'Checksum' => '6', 'CompanyGroupNumber' => null, 'Temporary' => false, 'Organization' => false]],
            ['200012055919', '001205-5919', ['BirthDate' => new \DateTimeImmutable('2000-12-05 00:00:00'), 'Gender' => 'M', 'Serial' => '591', 'Checksum' => '9', 'CompanyGroupNumber' => null, 'Temporary' => false, 'Organization' => false]],
            ['0012055919', '001205-5919', ['BirthDate' => new \DateTimeImmutable('2000-12-05 00:00:00'), 'Gender' => 'M', 'Serial' => '591', 'Checksum' => '9', 'CompanyGroupNumber' => null, 'Temporary' => false, 'Organization' => false]],
            ['970814+4465', '970814+4465', ['BirthDate' => new \DateTimeImmutable('1897-08-14 00:00:00'), 'Gender' => 'F', 'Serial' => '446', 'Checksum' => '5', 'CompanyGroupNumber' => null, 'Temporary' => false, 'Organization' => false]],
        ];
    }

}
