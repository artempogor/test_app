<?php

namespace App\Pattern\Fundamental\Delegation;

class AppMessenger implements MessengerInterface
{
    private MessengerInterface $messanger;

    public function __construct()
    {
        $this->toEmail();
    }

    public function setSender(string $sender): MessengerInterface
    {
        $this->messanger->setSender($sender);

        return $this;
    }

    public function setReceiver(string $receiver): MessengerInterface
    {
        $this->messanger->setReceiver($receiver);

        return $this;
    }

    public function sendMessage(string $message): MessengerInterface
    {
        $this->messanger->sendMessage($message);

        return $this;
    }

    public function send(): bool
    {
        return $this->messanger->send();
    }

    public function toEmail(): static
    {
        $this->messanger = new EmailMessenger();

        return $this;
    }

    public function toSms(): static
    {
        $this->messanger = new SmsMessenger();

        return $this;
    }
}