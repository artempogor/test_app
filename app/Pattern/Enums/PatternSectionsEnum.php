<?php

namespace App\Pattern\Enums;

enum PatternSectionsEnum: string
{
    case FUNDAMENTAL = 'fundamental';
    case COMPOSITION = 'composition';
    case MIXINS = 'mixins';
    case ASPECTS = 'aspects';
}
