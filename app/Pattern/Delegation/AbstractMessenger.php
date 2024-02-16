<?php

namespace App\Pattern\Delegation;

abstract class AbstractMessenger implements MessengerInterface
{
    /**
     * @var string
     */
    protected string $sender;
    /**
     * @var string
     */
    protected string $receiver;
    /**
     * @var string
     */
    protected string $message;

    public function setSender(string $sender): MessengerInterface
    {
        $this->sender = $sender;

        return $this;
    }

    public function setReceiver(string $receiver): MessengerInterface
    {
        $this->receiver = $receiver;

        return $this;
    }

    public function sendMessage(string $message): MessengerInterface
    {
        $this->message = $message;

        return $this;
    }

    public function send(): bool
    {
        return true;
    }

}