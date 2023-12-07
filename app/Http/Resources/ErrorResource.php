<?php


namespace App\Http\Resources;


use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

class ErrorResource extends JsonResource
{
    public static function empty(): ErrorResource
    {
        return self::make([]);
    }

    /**
     * @param string|null $message
     * @param array|null $data
     * @param int $httpStatus
     * @return ErrorResource
     */
    public static function create(?string $message = null, ?array $data = null, int $httpStatus = Response::HTTP_INTERNAL_SERVER_ERROR)
    {
        return new ErrorResource(compact('message', 'data', 'httpStatus'));
    }

    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        $acceptLang = 'ru';
        $httpMessage = Response::$statusTexts[$this['httpStatus']] ?? $this['httpStatus'];
        $message = $this['message'] ?? $httpMessage;

        try {
            $localKey = "messages.$message";
            $localizedMessage = __($localKey, [], $acceptLang);
            $localizedMessage = $localKey === $localizedMessage ? $message : $localizedMessage;
        } catch (Exception $exception) {
            $localizedMessage = $message;
        }

        return [
            'success' => false,
            'data' => [
                'message' => $message,
                'localizedMessage' => $localizedMessage,
                'data' => $this['data'] ?? null
            ]
        ];
    }

    /**
     * @param Request $request
     * @param JsonResponse $response
     */
    public function withResponse($request, $response)
    {
        $originalData = $response->getOriginalContent();
        $response->setStatusCode($originalData['httpStatus'] ?? Response::HTTP_INTERNAL_SERVER_ERROR);
    }

}
