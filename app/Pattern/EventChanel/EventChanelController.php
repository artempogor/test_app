<?php

namespace App\Pattern\EventChanel;

use Illuminate\View\View;

class EventChanelController
{
    public function __invoke(): View
    {
        $pattern = new EventChanelPattern();

        $videHosting = new TrashTube();

        $humor = new Publisher('humor', $videHosting);
        $cats = new Publisher('cats', $videHosting);
        $fishing = new Publisher('fishing', $videHosting);

        $artem = new Subscriber('Artem Pogorelov');
        $annie = new Subscriber('Annie Serezhenko');
        $cat = new Subscriber('Kot Ucheniy');

        $videHosting->subscribe('humor', $artem);
        $videHosting->subscribe('cats', $annie);
        $videHosting->subscribe('fishing', $cat);

        $humor->publish('Ha-ha-ha, I\'m funny');
        $fishing->publish('Big fish!');
        $cats->publish('Meow');

        return view('pattern.pattern', compact('pattern'));
    }
}