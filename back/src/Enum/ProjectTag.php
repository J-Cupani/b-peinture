<?php

namespace App\Enum;

enum ProjectTag: string
{
    case WEBSITE = 'website';
    case WEBAPP = 'webapp';
    case API = 'api';

    public function label(): string
    {
        return match($this) {
            self::WEBSITE => 'Site Internet',
            self::WEBAPP => 'Application Web',
            self::API => 'API',
        };
    }
}