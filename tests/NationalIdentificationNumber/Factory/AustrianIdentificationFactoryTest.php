<?php
declare(strict_types=1);

namespace Jontsa\Tests\NationalIdentificationNumber\Factory;

use Jontsa\NationalIdentificationNumber\Factory;
use Jontsa\NationalIdentificationNumber\IdentificationNumber\AustrianIdentificationNumber;
use PHPUnit\Framework\TestCase;

class AustrianIdentificationFactoryTest extends TestCase
{

    use InvalidIdentifierTestTrait,
        ValidIdentifierTestTrait;

    protected function createIdentifierUsingFactory(string $value) : AustrianIdentificationNumber
    {
        return Factory::AT($value);
    }

    /**
     * @return array<string[]>
     */
    public function invalidSyntaxProvider() : array
    {
        return [
            [''],
            ['0'],
            ['7829500755'],
            ['782828075'],
            ['0829280755']
        ];
    }

    /**
     * @return array<string[]>
     */
    public function invalidChecksumProvider() : array
    {
        return [
            ['7828280755'],
            ['7829280756'],
        ];
    }

    /**
     * @return array<array{0: string, 1: string, 2: array<string, string|null|bool>}>
     */
    public function validIdentifierProvider() : array
    {
        return [
            ['7829280755', '7829280755', ['BirthDate' => '1955-07-28', 'Serial' => '782', 'Checksum' => '9']],
            ['7829 28 07 55', '7829280755', ['BirthDate' => '1955-07-28', 'Serial' => '782', 'Checksum' => '9']],
            ['1237010180', '1237010180', ['BirthDate' => '1980-01-01', 'Serial' => '123', 'Checksum' => '7']],
        ];
    }

}
