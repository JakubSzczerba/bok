<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace App\Provider;

use App\Dictionary\OrganizationDictionary;

class OrganizationProvider
{
    public function getOrganizations(): array
    {
        return json_decode(OrganizationDictionary::JSON_ORGANIZATIONS, true);
    }
}