<?php

declare(strict_types=1);

namespace App\Enums\Permission;

enum UserPermission: string
{
    case ViewAny = 'view any users';
    case View = 'view users';
    case Create = 'create users';
    case Update = 'update users';
    case Delete = 'delete users';
    case Restore = 'restore users';
}
