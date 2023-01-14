<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace App\Provider;

use App\Dictionary\StatusDictionary;

class StatusProvider
{
    public function getStatus(): array
    {
        return StatusDictionary::ARRAY_STATUS;
    }

}