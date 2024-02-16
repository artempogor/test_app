<?php

namespace App\Pattern\EventChanel;

use Barryvdh\Debugbar\Facades\Debugbar;

/**
 * class TrashTube
 * @package App\Pattern\EventChanel
 */
class TrashTube implements VideoHostingInterface
{
    /**
     * @var array
     */
    public array $topics = [];

    /**
     * @param $topic
     * @param $subscriber
     * @return void
     */
    public function subscribe($topic, $subscriber): void
    {
        $this->topics[$topic][] = $subscriber;

        Debugbar::debug(sprintf(
            'Подписчик %s подписался на тему %s',
            $subscriber->getName(),
            $topic
        ));
    }

    /**
     * @param $topic
     * @param $data
     * @return void
     */
    public function publish($topic, $data): void
    {
        if (empty($this->topics[$topic])) {
            return;
        }

        foreach ($this->topics[$topic] as $subscriber) {
            $subscriber->notify($data);
        }
    }
}