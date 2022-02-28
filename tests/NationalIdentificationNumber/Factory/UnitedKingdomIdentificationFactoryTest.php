<?php
declare(strict_types=1);

namespace Jontsa\Tests\NationalIdentificationNumber\Factory;

use Jontsa\NationalIdentificationNumber\Exception\InvalidSyntaxException;
use Jontsa\NationalIdentificationNumber\Factory;
use Jontsa\NationalIdentificationNumber\IdentificationNumber\UnitedKingdomIdentificationNumber;
use PHPUnit\Framework\TestCase;

class UnitedKingdomIdentificationFactoryTest extends TestCase
{

    use ValidIdentifierTestTrait;

    protected function createIdentifierUsingFactory(string $value) : UnitedKingdomIdentificationNumber
    {
        return Factory::UK($value);
    }

    /**
     * @test
     * @dataProvider invalidSyntaxProvider
     */
    public function invalidSyntaxTest(string $value) : void
    {
        $this->expectException(InvalidSyntaxException::class);
        $this->createIdentifierUsingFactory($value);
    }

    /**
     * @return array<string[]>
     */
    public function invalidSyntaxProvider() : array
    {
        return [
            [''],
            ['0'],
            ['A 01 23 44 B'],
            ['AA 1 23 44 B'],
            ['AA 11 2 44 B'],
            ['AA 11 22 4 B'],
            ['AA 11 22 44 4'],
            ['00 11 22 44 B'],
        ];
    }

    /**
     * @return array<array{0: string, 1: string, 2: array<string, string|null|bool>}>
     */
    public function validIdentifierProvider() : array
    {
        return [
            ['AA 01 23 44 B', 'AA012344B', []],
            ['xx112233Y', 'XX112233Y', []],
        ];
    }

}
