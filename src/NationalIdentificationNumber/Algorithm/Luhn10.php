<?php
declare(strict_types=1);

namespace Jontsa\NationalIdentificationNumber\Algorithm;

class Luhn10
{

    public static function calculateCheckSum(string $partialString) : int
    {
        if(!preg_match('/^\d+$/', $partialString)) {
            throw new \InvalidArgumentException(__METHOD__ . ' expects parameter to contain only digits. "' . $partialString . '" given.');
        }

        $digits = \array_map('intval', \array_reverse(\str_split($partialString)));
        $sum = 0;

        foreach ($digits as $index => $digit) {
            if ($index % 2 === 0) {
                $sum += \array_sum(\str_split((string) ($digit * 2)));
            } else {
                $sum += $digit;
            }
        }

        $checkDigit = $sum % 10;

        if ($checkDigit === 0) {
            return 0;
        }

        return 10 - $checkDigit;
    }

}
