<?php
declare(strict_types=1);

namespace Jontsa\Tests\NationalIdentificationNumber\Factory;

use Jontsa\NationalIdentificationNumber\IdentificationNumber\IdentificationNumberInterface;

trait ValidIdentifierTestTrait
{

    abstract protected function createIdentifierUsingFactory(string $value) : IdentificationNumberInterface;

    /**
     * @param array<string, string|null|bool> $properties
     * @test
     * @dataProvider validIdentifierProvider
     */
    public function validIdentifierTest(string $value, string $formatted, array $properties) : void
    {
        $identity = $this->createIdentifierUsingFactory($value);
        $this->assertSame($formatted, $identity->format());
        foreach ($properties as $propertyName => $propertyValue) {
            if (true === \is_bool($propertyValue)) {
                $getter = 'is' . $propertyName;
            } else {
                $getter = 'get' . $propertyName;
            }
            $this->assertSame($propertyValue, $identity->{$getter}());
        }
    }

}
