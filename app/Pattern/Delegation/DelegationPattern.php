<?php

namespace App\Pattern\Delegation;

use App\Pattern\PatternDescriptionInterface;

class DelegationPattern implements PatternDescriptionInterface
{
    public string $name = 'Делегирование';

    public string $description = 'Шаблон , в котором объект внешне выражает некоторое поведение, но в реальности передаёт ответственность за выполнение этого поведения связанному объекту. Шаблон делегирования является фундаментальной абстракцией, на основе которой реализованы другие шаблоны - композиция (также называемая агрегацией), примеси (mixins) и аспекты (aspects).';
    public string $advantages = 'Возможность изменить поведение конкретного экземпляра объекта вместо создания нового класса путём наследования.';
    public string $disadvantages = 'Этот шаблон обычно затрудняет оптимизацию по скорости в пользу улучшенной чистоты абстракции.';
}