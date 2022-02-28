<?php
declare(strict_types=1);

namespace Jontsa\Tests\NationalIdentificationNumber\Algorithm;

use Jontsa\NationalIdentificationNumber\Algorithm\Modulus11;
use PHPUnit\Framework\TestCase;

class Modulus11Test extends TestCase
{

    /**
     * @test
     * @dataProvider invalidValuesProvider
     */
    public function invalidValueTest(string $value) : void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(Modulus11::class . '::calculateCheckSum expects parameter to contain only digits. "' . $value . '" given.');
        Modulus11::calculateCheckSum($value);
    }

    /**
     * @param int[] $weights
     * @test
     * @dataProvider checkSumsProvider
     */
    public function calculatesCorrectChecksumTest(string $partial, array $weights, ?int $expected) : void
    {
        $checksum = Modulus11::calculateCheckSum($partial, $weights);
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
     * @return array<array{0: string, 1: int[], 2: int}>
     */
    public function checkSumsProvider() : array
    {
        return [
            ['3710729001', [1, 2, 3, 4, 5, 6, 7, 8, 9, 1], 10],
            ['3710729001', [3, 4, 5, 6, 7, 8, 9, 1, 2, 3], 4],
            ['392844404', [10, 9, 8, 7, 6, 5, 4, 3, 2], 9],
            ['167703625', [4, 3, 2, 7, 6, 5, 4, 3, 2], 8],
        ];
    }

}
