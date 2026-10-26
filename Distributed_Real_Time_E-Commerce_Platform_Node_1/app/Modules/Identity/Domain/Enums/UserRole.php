<?php

namespace App\Modules\Identity\Domain\Enums;

enum UserRole: string
{
    case CUSTOMER = 'customer';
    case RESPONSIBLE = 'responsible';
}
