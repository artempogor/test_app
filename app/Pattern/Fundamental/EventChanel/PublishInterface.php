<?php

namespace App\Pattern\Fundamental\EventChanel;

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