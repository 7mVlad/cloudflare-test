<?php

namespace App\Enums;

enum SslMode: string
{
    case Off = 'off';
    case Flexible = 'flexible';
    case Full = 'full';
    case Strict = 'strict';
}
