<?php

namespace App\Pattern\Fundamental\Interface;

use App\Pattern\PatternDescription;

class InterfacePattern extends PatternDescription
{
    public string $route = 'interface';

    public string $name = 'Интерфейс';

    public string $description = 'шаблон проектирования, являющийся общим методом для структурирования компьютерных программ 
    для того, чтобы их было проще понять. В общем, интерфейс — это класс, который обеспечивает программисту простой или 
    более программно-специфический способ доступа к другим классам. Интерфейс может содержать набор объектов и обеспечивать простую, 
    высокоуровневую функциональность для программиста (например, Шаблон Фасад); он может обеспечивать более чистый или более специфический 
    способ использования сложных классов («класс-обёртка»); он может использоваться в качестве «клея» между двумя различными API (Шаблон Адаптер); 
    и для многих других целей.';

    public string $advantages = 'Шаблон позволяет использовать метод не задумываясь о его содержимом. Иначе говоря предоставляет высокий уровень абстракции';

    public string $disadvantages = 'Необходимость в явном выборе интерфейса: При использовании интерфейсов может потребоваться явное выбирать, какой интерфейс использовать в каждом конкретном случае, что может снизить гибкость и упростить код.';
}