<?php

namespace App\Helpers;

use App\Enums\UserRole;
use App\Models\User;

class Helper
{
    static function addUsers(): string
    {
        return User::role(UserRole::USER())->count();
    }
}
