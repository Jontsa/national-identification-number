<?php
declare(strict_types=1);

namespace Jontsa\NationalIdentificationNumber\IdentificationNumber;

interface GenderAwareInterface
{

    const GENDER_MALE = 'M',
        GENDER_FEMALE = 'F';

    public function getGender() : string;

}
