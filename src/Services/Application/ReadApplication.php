<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace App\Services\Application;

use App\Entity\Application;

class ReadApplication
{
    public function updateData(Application $application): Application
    {
        $application->setIsRead(true);
        $application->setDateRead(new \DateTime());

        return $application;
    }

}