<?php

namespace App\Pattern\EventChanel;

/**
 * Interface SubscriberInterface
 * @package App\Pattern\EventChanel
 */
interface SubscriberInterface
{
    /**
     * @param $data
     * @return void
     */
    public function notify($data): void;

    /**
     * @return string
     */
    public function getName(): string;
}