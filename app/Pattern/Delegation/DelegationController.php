<?php

namespace App\Pattern\Delegation;

use App\Http\Controllers\Controller;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Contracts\View\View;

class DelegationController extends Controller
{
    public function __invoke(): View
    {
        $pattern = new DelegationPattern();

        $item = new AppMessenger();

        $item->setReceiver('S6S3H@example.com');
        $item->setSender('S6S5H@example.com');
        $item->sendMessage('Текст для email');
        $item->send();

        Debugbar::info($item);

        $item->toSms();
        $item->setSender('+7 999 999 99 99');
        $item->setReceiver('+7 888 888 88 88');
        $item->sendMessage('Текст для sms');
        $item->send();

        Debugbar::info($item);

        return view('pattern.pattern', compact('pattern', 'item'));
    }
}