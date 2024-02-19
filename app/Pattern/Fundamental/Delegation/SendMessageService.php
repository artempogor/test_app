<?php

namespace App\Pattern\Fundamental\Delegation;

use Barryvdh\Debugbar\Facades\Debugbar;

class SendMessageService
{

    public function send(): void
    {
        $trace = debug_backtrace();

        Debugbar::info('Вывод сообщения из сервиса ' . $trace[0]['file']);

        $appMessenger = new AppMessenger();

        $appMessenger->setReceiver('S6S3H@example.com');
        $appMessenger->setSender('S6S5H@example.com');
        $appMessenger->sendMessage('Текст для email');
        $appMessenger->send();

        Debugbar::info($appMessenger);

        $appMessenger->toSms();
        $appMessenger->setSender('+7 999 999 99 99');
        $appMessenger->setReceiver('+7 888 888 88 88');
        $appMessenger->sendMessage('Текст для sms');
        $appMessenger->send();

        Debugbar::info($appMessenger);
    }
}