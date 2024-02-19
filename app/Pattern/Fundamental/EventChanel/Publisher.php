<?php

namespace App\Pattern\Fundamental\EventChanel;

class Publisher implements PublishInterface
{
    private string $topic;

    private VideoHostingInterface $videoHosting;

    public function __construct($topic, VideoHostingInterface $videoHosting)
    {
        $this->topic = $topic;

        $this->videoHosting = $videoHosting;
    }

    public function publish($data): void
    {
        $this->videoHosting->publish($this->topic, $data);
    }
}