<?php
declare(strict_types=1);

namespace Jontsa\Tests\NationalIdentificationNumber\Algorithm;

use Jontsa\NationalIdentificationNumber\Algorithm\Luhn10;
use PHPUnit\Framework\TestCase;

class Luhn10Test extends TestCase
{

    /**
     * @test
     * @dataProvider invalidValuesProvider
     */
    public function invalidValueTest(string $value) : void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(Luhn10::class . '::calculateCheckSum expects parameter to contain only digits. "' . $value . '" given.');
        Luhn10::calculateCheckSum($value);
    }

    /**
     * @test
     * @dataProvider checkSumsProvider
     */
    public function calculatesCorrectChecksumTest(string $partial, int $expected) : void
    {
        $checksum = Luhn10::calculateCheckSum($partial);
        $this->assertSame($expected, $checksum);
    }

    /**
     * @return array<string[]>
     */
    public function invalidValuesProvider() : array
    {
        return [
            ['000525-1236'],
            ['00 0525 1236'],
            [''],
            ['000525A1236'],
        ];
    }

    /**
     * @return array<array{0: string, 1: int}>
     */
    public function checkSumsProvider() : array
    {
        return [
            ['000525123', 6],
            ['55566677788', 6],
            ['123456789012345', 2],
            ['56723284', 8],
            ['830511231209', 0]
        ];
    }

}
