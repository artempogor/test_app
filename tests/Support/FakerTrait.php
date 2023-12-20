<?php

namespace Tests\Support;

use Faker\Factory;

trait FakerTrait
{
    public function getFaker(): \Faker\Generator
    {
        return Factory::create();
    }
}