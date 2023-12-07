<?php


namespace App\Support\Entity;


use ArrayAccess;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use JsonSerializable;

class Entity implements Jsonable, JsonSerializable, Arrayable, ArrayAccess
{

    use EntityTrait;
}
