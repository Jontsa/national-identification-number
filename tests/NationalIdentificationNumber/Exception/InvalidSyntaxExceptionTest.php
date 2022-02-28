<?php
declare(strict_types=1);

namespace Jontsa\Tests\NationalIdentificationNumber\Exception;

use Jontsa\NationalIdentificationNumber\Exception\InvalidSyntaxException;
use PHPUnit\Framework\TestCase;

class InvalidSyntaxExceptionTest extends TestCase
{

    /**
     * @test
     */
    public function createsExceptionTest() : void
    {
        $exception = new InvalidSyntaxException('xooxer');
        $this->assertSame('"xooxer" is not a valid personal identification number.', $exception->getMessage());
        $this->assertSame(0, $exception->getCode());
    }

}
