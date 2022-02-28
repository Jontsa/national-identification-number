<?php
declare(strict_types=1);

namespace Jontsa\Tests\NationalIdentificationNumber\Factory;

use Jontsa\NationalIdentificationNumber\Factory;
use Jontsa\NationalIdentificationNumber\IdentificationNumber\EstonianIdentificationNumber;
use PHPUnit\Framework\TestCase;

class EstonianIdentificationFactoryTest extends TestCase
{

    use InvalidIdentifierTestTrait,
        ValidIdentifierTestTrait;

    protected function createIdentifierUsingFactory(string $value) : EstonianIdentificationNumber
    {
        return Factory::EE($value);
    }

    /**
     * @return array<string[]>
     */
    public function invalidSyntaxProvider() : array
    {
        return [
            [''],
            ['0'],
            ['X9012011234'],
            ['9012011234'],
            ['3901201123'],
            ['77107290014']
        ];
    }

    /**
     * @return array<string[]>
     */
    public function invalidChecksumProvider() : array
    {
        return [
            ['37107290013'],
            ['37107290024'],
        ];
    }

    /**
     * @return array<array{0: string, 1: string, 2: array<string, string|null|bool>}>
     */
    public function validIdentifierProvider() : array
    {
        return [
            ['37107290014', '37107290014', ['BirthDate' => '1971-07-29', 'Gender' => 'M', 'Serial' => '001', 'Checksum' => '4']],
            ['49002124277', '49002124277', ['BirthDate' => '1990-02-12', 'Gender' => 'F', 'Serial' => '427', 'Checksum' => '7']],
            ['47502124911', '47502124911', ['BirthDate' => '1975-02-12', 'Gender' => 'F', 'Serial' => '491', 'Checksum' => '1']]
        ];
    }

}
