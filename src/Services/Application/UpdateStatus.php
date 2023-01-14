<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace App\Services\Application;

use App\Entity\Application;

class UpdateStatus
{
    public function updateData(Application $application, string $value): Application
    {
        $application->setStatus($value);


        return $application;
    }

}