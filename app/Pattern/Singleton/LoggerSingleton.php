<?php

namespace App\Pattern\Singleton;

class LoggerSingleton extends Logger
{
    private static ?LoggerSingleton $instance = null;

    public static function getInstance(): self
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }
    private function __construct(){}
    private function __clone(){}
}