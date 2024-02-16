<?php

namespace App\Pattern\Singleton;

use App\Http\Controllers\Controller;
use App\Http\Resources\SuccessResource;

class SingletonController extends Controller
{
    public function __construct(
        protected readonly OrderService    $orderService,
        protected readonly RegisterService $registerService,
    )
    {
    }

    /**
     * @throws \Exception
     */
    public function buyItem(): SuccessResource
    {
        $this->orderService->order();

        return SuccessResource::empty();
    }

    /**
     * @throws \Exception
     */
    public function register(): SuccessResource
    {
        $this->registerService->register('https://test.dev');

        return SuccessResource::empty();
    }
}