<?php

namespace App\Enums;

enum TaskStatus: string
{
    case Pending = 'pending';
    case Doing = 'doing';
    case Complete = 'complete';
}
