<?php

namespace App\Exceptions;

use App\Http\Resources\ErrorResource;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\Translation\Exception\NotFoundResourceException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e): Response|JsonResponse|RedirectResponse|ResponseAlias
    {
        if ($request->acceptsJson()) {
            return $this->returnApiResponse($request, $e);
        }

        return parent::render($request, $e);
    }

    public function returnApiResponse($request, Throwable $exception): JsonResponse
    {
        if ($exception instanceof ValidationException) {
            return ErrorResource::create(
                null,
                $exception->validator->getMessageBag()->getMessages(),
                Response::HTTP_UNPROCESSABLE_ENTITY
            )->response($request);
        }

        if ($exception instanceof ModelNotFoundException) {
            return ErrorResource::create(
                null,
                null,
                ResponseAlias::HTTP_NOT_FOUND
            )->response($request);
        }

        if ($exception instanceof AuthenticationException) {
            return ErrorResource::create(
                null,
                null,
                ResponseAlias::HTTP_UNAUTHORIZED
            )->response($request);
        }

        if ($exception instanceof NotFoundResourceException) {
            return ErrorResource::create(
                null,
                null,
                ResponseAlias::HTTP_NOT_FOUND
            )->response($request);
        }

        if ($exception instanceof HttpExceptionInterface) {
            if (!($message = $exception->getMessage())) {
                return ErrorResource::create(
                    null,
                    null,
                    $exception->getStatusCode()
                )->response($request);
            }
            return ErrorResource::create(
                $message,
                null,
                $exception->getStatusCode()
            )->response($request);
        }

        if ($exception instanceof QueryException) {
            return ErrorResource::create(
                $exception->getMessage(),
                null,
                500
            )->response($request);
        }

        return ErrorResource::create(
            null,
            ['exception_message' => $exception->getMessage()],
            $exception->getCode() ?: ResponseAlias::HTTP_INTERNAL_SERVER_ERROR)
            ->response($request);
    }
}
