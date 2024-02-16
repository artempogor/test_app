<?php

namespace App\Pattern\Delegation;

use Barryvdh\Debugbar\Facades\Debugbar;

class EmailMessenger extends AbstractMessenger
{
    public function send(): bool
    {
        Debugbar::info('send by' . __METHOD__);

        return parent::send();
    }
}