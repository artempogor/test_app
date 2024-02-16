<?php

namespace App\Pattern\EventChanel;

/**
 * Interface VideoHostingInterface
 * @package App\Pattern\EventChanel
 */
interface VideoHostingInterface
{
    /**
     * @param string $topic
     * @param SubscriberInterface $subscriber
     * @return void
     */
    public function subscribe(string $topic, SubscriberInterface $subscriber): void;

    /**
     * @param string $topic
     * @param string $data
     * @return void
     */
    public function publish(string $topic, string $data): void;
}