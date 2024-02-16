<?php

namespace App\Pattern\Delegation;

/**
 * interface MessengerInterface
 * @package App\Pattern\PropertyContainer
 *
 */
interface MessengerInterface
{
    /**
     * @param string $sender
     * @return MessengerInterface
     */
    public function setSender(string $sender): MessengerInterface;

    /**
     * @param string $receiver
     * @return MessengerInterface
     */
    public function setReceiver(string $receiver): MessengerInterface;

    /**
     * @param string$message
     * @return MessengerInterface
     */
    public function sendMessage(string $message): MessengerInterface;

    /**
     * @return bool
     */
    public function send(): bool;

}