<?php

namespace App\Pattern\Singleton;

use Illuminate\Support\Facades\Auth;

class OrderService
{
    /**
     * @throws \Exception
     */
    public function order(): void
    {
        $clientBalance = 10;
        $itemCost = 11;

        if ($clientBalance < $itemCost) {
            $difference = $itemCost - $clientBalance;
            $this->alert($difference);
            throw new \Exception('Недостаточно средств для покупки товара!');
        }

    }

    /**
     * @throws \Exception
     */
    private function alert(int $difference): void
    {
//        $logger = new Logger();

//        $logger->setDateFormat('Y-m-d H:i:s')
//            ->setLogType('file')
//            ->setPrefix('alert');

//        $logger->log($message);


        $logger = LoggerSingleton::getInstance();

        $message = sprintf(
            'Пользователю "%s" не хватило "%s" рублей для покупки товара! Вызван объект :%s',
            Auth::id(),
            $difference,
            spl_object_hash($logger)
        );

        $logger->log($message);
    }
}