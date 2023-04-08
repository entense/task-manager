<?php

namespace App\Enums;

enum TaskStatus: int
{
    case ACTIVE = 0;
    case CLOSED = 1;
}
