<?php

namespace App\Enum;

enum SaludStatusEnum:string
{
    case SALUDABLE = 'Healthy';
    case ENFERMO = 'Sick';
    case HAMBRIENTO = 'Hungry';
}
