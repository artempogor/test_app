<?php

namespace App\Pattern\Fundamental\Delegation;


use App\Pattern\Enums\PatternSectionsEnum;
use App\Pattern\PatternDescription;

class DelegationPattern extends PatternDescription
{
    public PatternSectionsEnum $section = PatternSectionsEnum::FUNDAMENTAL;

    public string $route = 'delegation';

    public string $name = 'Делегирование';

    public string $description = 'Шаблон , в котором объект внешне выражает некоторое поведение, но в реальности передаёт ответственность за выполнение этого поведения связанному объекту. Шаблон делегирования является фундаментальной абстракцией, на основе которой реализованы другие шаблоны - композиция (также называемая агрегацией), примеси (mixins) и аспекты (aspects).';
    public string $advantages = 'Возможность изменить поведение конкретного экземпляра объекта вместо создания нового класса путём наследования.';
    public string $disadvantages = 'Этот шаблон обычно затрудняет оптимизацию по скорости в пользу улучшенной чистоты абстракции.';
}