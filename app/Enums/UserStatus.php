<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static ACTIVE()
 * @method static static BLOCK()
 * @method static static ASSIGN()
 */
final class UserStatus extends Enum
{
    const ACTIVE = 'active';
    const BLOCK = 'block';
    const ASSIGN = 'assign';
}
