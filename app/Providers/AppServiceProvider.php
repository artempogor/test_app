<?php

namespace App\Providers;

use App\Pattern\Fundamental\Delegation\DelegationPattern;
use App\Pattern\Fundamental\EventChanel\EventChanelPattern;
use App\Pattern\Fundamental\Interface\InterfacePattern;
use App\Pattern\Fundamental\PropertyContainer\PropertyContainerPattern;
use App\Pattern\Singleton\LoggerSingleton;
use Illuminate\Support\Facades\Http;
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

        $this->bootHttpClients();
    }

    private function bootHttpClients(): void
    {
        Http::macro('imageOptimize', function () {
            $conf = config('services.image-optimize');
            return Http::withHeaders([
                'service-key' => $conf['service-key']
            ])->baseUrl($conf['host']);
        });
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
