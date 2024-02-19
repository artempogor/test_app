<?php

namespace App\Providers;

use App\Pattern\Fundamental\Delegation\DelegationPattern;
use App\Pattern\Fundamental\EventChanel\EventChanelPattern;
use App\Pattern\Fundamental\Interface\InterfacePattern;
use App\Pattern\Fundamental\PropertyContainer\PropertyContainerPattern;
use App\Pattern\Singleton\LoggerSingleton;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     * @throws \Exception
     */
    public function register(): void
    {
        $logger = LoggerSingleton::getInstance();
        $logger->setDateFormat('Y-m-d H:i:s')
            ->setLogType('file')
            ->setPrefix('alert');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        new DelegationPattern();
        new EventChanelPattern();
        new PropertyContainerPattern();
        new InterfacePattern();
    }
}
