<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace App\Dictionary;

class StatusDictionary
{
    public const ARRAY_STATUS = [
        "nowe" => "new",
        "w trakcie realizacji" => "in progress",
        "odrzucone" => "rejected",
        "zrealizowane" => "completed",
        "duplikat" => "duplicate",
    ];

}