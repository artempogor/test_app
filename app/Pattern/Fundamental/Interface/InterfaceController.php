<?php

namespace App\Pattern\Fundamental\Interface;

use App\Http\Controllers\Controller;
use App\Pattern\Fundamental\Delegation\SendMessageService;

class InterfaceController extends Controller
{
    public function __invoke()
    {
        $pattern = new InterfacePattern();

        //для демонстрации работы паттерна вывел в сервис отправку сообщения
        $sendMessageService = new SendMessageService();
        $sendMessageService->send();

        return view('pattern.pattern', compact('pattern'));
    }
}