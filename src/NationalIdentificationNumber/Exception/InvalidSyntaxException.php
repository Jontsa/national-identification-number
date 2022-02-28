<?php
declare(strict_types=1);

namespace Jontsa\NationalIdentificationNumber\Exception;

final class InvalidSyntaxException extends \Exception implements InvalidSyntaxExceptionInterface
{

    public function __construct(string $value)
    {
        parent::__construct('"' . $value . '" is not a valid personal identification number.');
    }

}
