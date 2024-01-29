<?php

namespace App\Support\Responses;

/**
 * Общий интерфейс одной сущности, которую возвращается сервис
 * Для того чтобы не прокидывать модели через Response.
 * Потенциально eloquent моделей может не быть.
 */
interface ResponseItemInterface
{

}