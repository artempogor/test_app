<?php

namespace App\Pattern\Fundamental\PropertyContainer;

use App\Pattern\Enums\PatternSectionsEnum;
use App\Pattern\PatternDescription;

class PropertyContainerPattern extends PatternDescription
{
    public PatternSectionsEnum $section = PatternSectionsEnum::FUNDAMENTAL;

    public string $route = 'propertyContainer';

    public string $name = 'Контейнер свойств';

    public string $description = 'Контейнер свойств - шаблон благодаря которому возможно расширить динамические свойства в уже развернутом приложении. Это достигается путём добавления свойств непосредственно объекту в некоторый "контейнер свойств".';

    public string $advantages = 'Шаблон контейнер свойств позволяет легко и быстро придать приложению способность изменяться в процессе своего жизненного цикла и хорошо подходит для определённых типов приложений, в частности, для реализации возможности иерархии вложения. В некоторый случаях, без применения данного шаблона не удастся при возможности динамического расширения объекта инкапсулировать данные в объекте, что влияет на безопасность и надежность приложения.';

    public string $disadvantages = 'При реализации контейнера свойств теряется строгая типизация. Интерфейс класса не полностью описывает содержание и, возможно, потребуется модифицировать интерфейс взаимодействия с классом, чтобы реализовать преимущества, полученные от добавленных атрибутов. Если используется сохранение объектов в базу данных, контейнер свойств требует написать реализацию для передачи данных из контейнера свойств объекта в таблицу. Использование контейнера свойств увеличивает сложность системы, вносит накладные расходы на потребление памяти приложением и частично снижает быстродействие при работе.';
}