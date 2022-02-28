<?php
declare(strict_types=1);

namespace Jontsa\Tests\NationalIdentificationNumber\Factory;

use Jontsa\NationalIdentificationNumber\Factory;
use Jontsa\NationalIdentificationNumber\IdentificationNumber\FinnishIdentificationNumber;
use PHPUnit\Framework\TestCase;

class FinnishIdentificationFactoryTest extends TestCase
{

    use InvalidIdentifierTestTrait,
        ValidIdentifierTestTrait;

    protected function createIdentifierUsingFactory(string $value) : FinnishIdentificationNumber
    {
        return Factory::FI($value);
    }

    /**
     * @return array<string[]>
     */
    public function invalidSyntaxProvider() : array
    {
        return [
            [''],
            ['0'],
            ['150921 123A'],
            ['150921x123A'],
            ['320921-123A'],
            ['151321-123A'],
            ['150921-123'],
        ];
    }

    /**
     * @return array<string[]>
     */
    public function invalidChecksumProvider() : array
    {
        return [
            ['150921+123B'],
            ['160921+123A'],
        ];
    }

    /**
     * @return array<array{0: string, 1: string, 2: array<string, string|null|bool>}>
     */
    public function validIdentifierProvider() : array
    {
        return [
            ['150921-123A', '150921-123A', ['BirthDate' => '1921-09-15', 'Gender' => 'M', 'Serial' => '123', 'Checksum' => 'A']],
            ['150999+320T', '150999+320T', ['BirthDate' => '1899-09-15', 'Gender' => 'F', 'Serial' => '320', 'Checksum' => 'T']],
            ['010112A222P', '010112A222P', ['BirthDate' => '2012-01-01', 'Gender' => 'F', 'Serial' => '222', 'Checksum' => 'P']],
        ];
    }

}
