<?php

namespace App\Pattern\Singleton;

use Illuminate\Support\Facades\Auth;

class RegisterService
{
    /**
     * @throws \Exception
     */
    private ?string $sync;

    /**
     * @throws \Exception
     */
    public function register(string $sync): void
    {
        $this->sync = $sync;

        $workSync = 'https://jwt-auth.readthedocs.io/en/develop/laravel-installation/';

        if ($sync !== $workSync) {
            $this->alert($workSync);
            throw new \Exception('Не действительная приглосительная ссылка!');
        }

    }

    /**
     * @throws \Exception
     */
    private function alert(): void
    {
        $logger = LoggerSingleton::getInstance();

        $message = sprintf(
            'Пользователь "%s" пытался войти по ссылке "%s"! %s',
            Auth::id(),
            $this->sync,
            spl_object_hash($logger)
        );

        $logger->log($message);
    }
}