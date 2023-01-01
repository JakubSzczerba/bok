<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace App\Services\Information;

use App\Entity\Application;
use App\Entity\Information;
use Symfony\Component\Security\Core\User\UserInterface as User;

class PersistInformation
{
    public function createInformation(string $content, Application $application, User $user): Information
    {
        $information = new Information();
        $information->setContent($content);
        $information->setApplication($application);
        $information->setUser($user);

        return $information;
    }
}