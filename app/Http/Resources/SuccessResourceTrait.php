<?php


namespace App\Http\Resources;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

trait SuccessResourceTrait
{

    /**
     * @param Request $request
     * @param JsonResponse $response
     */
    public function withResponse($request, $response): void
    {
        $originalContent = $response->getData(true);
        if (count($originalContent) > 1) {
            $successResource = SuccessResource::make($originalContent);
        } else {
            $successResource = SuccessResource::make(isset($originalContent['data']) ? $originalContent['data'] : $originalContent);
        }
        $response->setData($successResource->toArray($request));

    }
}
