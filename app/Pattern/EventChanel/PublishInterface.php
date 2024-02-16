<?php

namespace App\Pattern\EventChanel;

/**
 * Interface PublishInterface
 *
 * @package App\Pattern\EventChanel
 */
interface PublishInterface
{
    /**
     * @param $data
     * @return void
     */
    public function publish($data): void;
}