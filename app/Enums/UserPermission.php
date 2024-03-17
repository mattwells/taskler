<?php

namespace App\Enums;

enum UserPermission : string
{
    case Admin = 'admin';
    case Editor = 'editor';
    case Viewer = 'viewer';
    case Self = 'self';
}
