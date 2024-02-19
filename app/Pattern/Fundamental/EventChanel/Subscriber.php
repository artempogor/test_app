<?php

namespace App\Pattern\Fundamental\EventChanel;

use Barryvdh\Debugbar\Facades\Debugbar;

class Subscriber implements SubscriberInterface
{
    private string $name;

    public function __construct(string $name){
        $this->name = $name;
    }
    public function notify($data): void
    {
        Debugbar::info(sprintf(
            'Подписчик %s получил уведомление c содержимым %s',
            $this->getName(),
            $data
        ));
    }
    public function getName(): string
    {
        return $this->name;
    }
}