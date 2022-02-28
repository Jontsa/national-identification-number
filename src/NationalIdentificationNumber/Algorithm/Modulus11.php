<?php
declare(strict_types=1);

namespace Jontsa\NationalIdentificationNumber\Algorithm;

class Modulus11
{

    /**
     * @param int[] $weights
     */
    public static function calculateCheckSum(string $partialString, array $weights = [2, 3, 4, 5, 6, 7]) : int
    {
        if(!preg_match('/^\d+$/', $partialString)) {
            throw new \InvalidArgumentException(__METHOD__ . ' expects parameter to contain only digits. "' . $partialString . '" given.');
        }

        $sum = 0;
        $digits = \array_map('intval', \str_split($partialString));
        $weightIndex = 0;
        foreach ($digits as $digit) {
            if (false === isset($weights[$weightIndex])) {
                $weightIndex = 0;
            }
            $sum += $digit * $weights[$weightIndex++];
        }
        return $sum % 11;
    }

}
