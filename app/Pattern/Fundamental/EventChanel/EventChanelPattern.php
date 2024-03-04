<?php

namespace App\Pattern\Fundamental\EventChanel;

use App\Pattern\Enums\PatternSectionsEnum;
use App\Pattern\PatternDescription;

class EventChanelPattern extends PatternDescription
{
    public PatternSectionsEnum $section = PatternSectionsEnum::FUNDAMENTAL;

    public string $route = 'eventChanel';

    public string $name = 'Канал событий';

    public string $description = 'Фундаментальный шаблон проектирования, используется для создания канала связи и коммуникации через него посредством событий. Этот канал обеспечивает возможность разным издателям публиковать события и подписчикам, подписываясь на них, получать уведомления.';

    public string $advantages = 'Шаблон Канал событий позволяет легко и быстро создать каналы для публикации и обработки событий (или сообщений), при этом исключив прямого взаимодействия между издателем и подписчиком, что снижает связность объектов и упрощает тестирование.';

    public string $disadvantages = 'При реализации шаблона Канал событий увеличивается сложность приложения.';
}