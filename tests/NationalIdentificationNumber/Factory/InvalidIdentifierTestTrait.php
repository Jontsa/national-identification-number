<?php
declare(strict_types=1);

namespace Jontsa\Tests\NationalIdentificationNumber\Factory;

use Jontsa\NationalIdentificationNumber\Exception\InvalidChecksumException;
use Jontsa\NationalIdentificationNumber\Exception\InvalidSyntaxException;
use Jontsa\NationalIdentificationNumber\IdentificationNumber\IdentificationNumberInterface;

trait InvalidIdentifierTestTrait
{

    abstract protected function createIdentifierUsingFactory(string $value) : IdentificationNumberInterface;

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
     * @test
     * @dataProvider invalidChecksumProvider
     */
    public function invalidChecksumTest(string $value) : void
    {
        $this->expectException(InvalidChecksumException::class);
        $this->createIdentifierUsingFactory($value);
    }

}
